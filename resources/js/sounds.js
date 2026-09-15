let context = null;
const lastPlayed = { typing: 0, send: 0, receive: 0 };

function getContext() {
    if (!context) {
        const AudioCtx = window.AudioContext || window.webkitAudioContext;
        if (!AudioCtx) return null;
        context = new AudioCtx();
    }
    if (context.state === 'suspended') context.resume();
    return context;
}

function tone({ freq, freqEnd = null, duration = 0.15, type = 'sine', volume = 0.3, when = 0 }) {
    const ac = getContext();
    if (!ac) return;

    const start = ac.currentTime + when;
    const oscillator = ac.createOscillator();
    const gain = ac.createGain();

    oscillator.type = type;
    oscillator.frequency.setValueAtTime(freq, start);
    if (freqEnd) {
        oscillator.frequency.exponentialRampToValueAtTime(freqEnd, start + duration);
    }

    gain.gain.setValueAtTime(0.0001, start);
    gain.gain.exponentialRampToValueAtTime(volume, start + 0.01);
    gain.gain.exponentialRampToValueAtTime(0.0001, start + duration);

    oscillator.connect(gain).connect(ac.destination);
    oscillator.start(start);
    oscillator.stop(start + duration + 0.05);
}

function throttled(name, minGap, player) {
    const now = performance.now();
    if (now - lastPlayed[name] < minGap) return;
    lastPlayed[name] = now;
    player();
}

export function playTyping() {
    throttled('typing', 700, () => {
        tone({ freq: 460, duration: 0.06, type: 'triangle', volume: 0.08 });
        tone({ freq: 560, duration: 0.05, type: 'triangle', volume: 0.06, when: 0.07 });
    });
}

export function playSend() {
    throttled('send', 150, () => {
        tone({ freq: 500, freqEnd: 880, duration: 0.12, type: 'sine', volume: 0.22 });
        tone({ freq: 660, freqEnd: 990, duration: 0.1, type: 'sine', volume: 0.18, when: 0.06 });
    });
}

export function playReceive() {
    throttled('receive', 300, () => {
        tone({ freq: 880, duration: 0.12, type: 'sine', volume: 0.28 });
        tone({ freq: 1320, duration: 0.2, type: 'sine', volume: 0.28, when: 0.12 });
    });
}