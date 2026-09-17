import sodium from 'libsodium-wrappers';

const VARIANT = sodium.base64_variants.ORIGINAL;

const toB64 = (u8) => sodium.to_base64(u8, VARIANT);
const fromB64 = (s) => sodium.from_base64(s, VARIANT);

const concatBytes = (a, b) => {
    const out = new Uint8Array(a.length + b.length);
    out.set(a, 0);
    out.set(b, a.length);
    return out;
};

let sessionPromise = null;

async function initSession() {
    await sodium.ready;

    const user = window.App.user;
    const skeyKey = 'chat_skey_' + user.id;
    const stored = localStorage.getItem(skeyKey);
    let keypair;

    if (stored) {
        const privateKey = fromB64(stored);
        keypair = { publicKey: sodium.crypto_scalarmult_base(privateKey), privateKey };
    } else {
        keypair = sodium.crypto_box_keypair();
        localStorage.setItem(skeyKey, toB64(keypair.privateKey));
    }

    const publicKey = toB64(keypair.publicKey);

    if (user.public_key !== publicKey) {
        try {
            await axios.post('/keys/publish', { public_key: publicKey });
            user.public_key = publicKey;
        } catch (e) {
            // ignore publish errors; re-publish happens on the next page load
        }
    }

    return {
        publicKey,
        seal: (pk, text) => toB64(sodium.crypto_box_seal(sodium.from_string(text), fromB64(pk))),
        openSealed: (pk, ct) => sodium.to_string(
            sodium.crypto_box_seal_open(fromB64(ct), fromB64(pk), keypair.privateKey)
        ),
    };
}

export function ensureKeys() {
    if (!sessionPromise) {
        sessionPromise = initSession();
    }
    return sessionPromise;
}

export function encryptPublic(key, text) {
    const nonce = sodium.randombytes_buf(sodium.crypto_secretbox_NONCEBYTES);
    const box = sodium.crypto_secretbox_easy(sodium.from_string(text), nonce, fromB64(key));
    return toB64(concatBytes(nonce, box));
}

export function decryptPublic(key, payload) {
    const raw = fromB64(payload);
    const nonce = raw.slice(0, sodium.crypto_secretbox_NONCEBYTES);
    const box = raw.slice(sodium.crypto_secretbox_NONCEBYTES);
    return sodium.to_string(sodium.crypto_secretbox_open_easy(box, nonce, fromB64(key)));
}