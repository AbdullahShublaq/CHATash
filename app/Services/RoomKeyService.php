<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Support\Facades\Crypt;

class RoomKeyService
{
    private const string KEY = 'public_room_keyring';

    public function history(): array
    {
        $setting = Setting::firstOrCreate(['key' => self::KEY], ['value' => null]);

        if (empty($setting->value)) {
            $legacy = Setting::where('key', 'public_room_key')->first();
            if ($legacy && !empty($legacy->value)) {
                $key = Crypt::decryptString($legacy->value);
                $legacy->delete();
            } else {
                $key = base64_encode(random_bytes(32));
            }

            $setting->update([
                'value' => Crypt::encryptString(json_encode([['version' => 1, 'key' => $key]])),
            ]);
        }

        return json_decode(Crypt::decryptString($setting->value), true);
    }

    public function current(): array
    {
        $history = $this->history();
        return end($history);
    }

    public function version(): int
    {
        return (int) $this->current()['version'];
    }

    public function keyFor(int $version): string
    {
        foreach ($this->history() as $entry) {
            if ((int) $entry['version'] === $version) {
                return $entry['key'];
            }
        }

        return $this->current()['key'];
    }

    public function rotate(): array
    {
        $history = $this->history();
        $version = $this->version() + 1;
        $history[] = ['version' => $version, 'key' => base64_encode(random_bytes(32))];

        Setting::updateOrCreate(
            ['key' => self::KEY],
            ['value' => Crypt::encryptString(json_encode($history))]
        );

        return $this->current();
    }
}