<?php
$today = (new DateTimeImmutable('now', new DateTimeZone('America/New_York')))->format('l, F j, Y');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Windows 11</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="windows.css">
</head>
<body>
    <div class="windows-desktop" id="windows-desktop">
        <div class="windows-desktop__wallpaper">
            <div class="windows-shortcuts" aria-label="Desktop shortcuts">
                <a class="windows-shortcut" href="https://www.google.com/chrome/" target="_blank" rel="noopener noreferrer">
                    <span class="windows-shortcut__icon windows-shortcut__icon--chrome" aria-hidden="true">C</span>
                    <span class="windows-shortcut__label">Chrome</span>
                </a>
                <a class="windows-shortcut" href="https://www.mozilla.org/firefox/" target="_blank" rel="noopener noreferrer">
                    <span class="windows-shortcut__icon windows-shortcut__icon--firefox" aria-hidden="true">F</span>
                    <span class="windows-shortcut__label">Firefox</span>
                </a>
                <a class="windows-shortcut" href="https://discord.com/" target="_blank" rel="noopener noreferrer">
                    <span class="windows-shortcut__icon windows-shortcut__icon--discord" aria-hidden="true">D</span>
                    <span class="windows-shortcut__label">Discord</span>
                </a>
                <a class="windows-shortcut" href="#" aria-disabled="true">
                    <span class="windows-shortcut__icon windows-shortcut__icon--trash" aria-hidden="true">🗑</span>
                    <span class="windows-shortcut__label">Recycle Bin</span>
                </a>
                <a class="windows-shortcut" href="https://example.com/" target="_blank" rel="noopener noreferrer">
                    <span class="windows-shortcut__icon windows-shortcut__icon--url" aria-hidden="true">🔗</span>
                    <span class="windows-shortcut__label">Saved URL</span>
                </a>
            </div>
            <div class="windows-desktop__welcome">
                <p class="windows-desktop__title">Windows 11</p>
                <p class="windows-desktop__subtitle">Welcome back.</p>
            </div>
        </div>
        <div class="windows-desktop__taskbar-container">
            <div class="windows-desktop__taskbar">
                <button type="button" class="windows-desktop__start" id="start-button">
                    <img class="windows-desktop__app" src="./images/logo/window_start_icon.png" alt="">
                </button>
            <div class="windows-desktop__app">
            </div>
            <div class="windows-desktop__app">
                <img class="windows-desktop__app" src="./images/logo/folder_icon.png" alt="">
            </div>
            <div class="windows-desktop__app">
                <img class="windows-desktop__app" src="./images/logo/edge_icon.png" alt="">
            </div>
            <div class="windows-desktop__app">App Store</div>
            </div>
            <div class="windows-desktop__taskbar-timeDate">
            <div class="windows-desktop__clock">
                <p id='windows-desktop-clock'></p>
            </div>
        </div>
        </div>
    </div>

    <div class="windows-start-menu" id="windows-start-menu" hidden>
        <p class="windows-start-menu__title">Pinned</p>
        <div class="windows-start-menu__apps">
            <div class="windows-start-menu__app">Settings</div>
            <div class="windows-start-menu__app">Terminal</div>
            <div class="windows-start-menu__app">Store</div>
            <div class="windows-start-menu__app">Photos</div>
            <div class="windows-start-menu__app">Notes</div>
            <div class="windows-start-menu__app">Browser</div>
        </div>
        <p class="windows-start-menu__meta"><?= htmlspecialchars($today, ENT_QUOTES, 'UTF-8') ?></p>
    </div>

    <script>
        const navigationEntry = performance.getEntriesByType('navigation')[0];
        const isReloadNavigation = navigationEntry
            ? navigationEntry.type === 'reload'
            : performance.navigation && performance.navigation.type === 1;

        if (isReloadNavigation) {
            window.location.replace('index.php');
        }

        const clockElement = document.getElementById('windows-desktop-clock');
        const startButton = document.getElementById('start-button');
        const startMenu = document.getElementById('windows-start-menu');

        function updateClock() {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            clockElement.textContent = `${hours}:${minutes}`;
        }

        startButton.addEventListener('click', () => {
            startMenu.hidden = !startMenu.hidden;
        });

        document.addEventListener('click', (event) => {
            if (startMenu.hidden) return;
            if (startMenu.contains(event.target) || startButton.contains(event.target)) return;
            startMenu.hidden = true;
        });

        document.querySelectorAll('.windows-shortcut[aria-disabled="true"]').forEach((shortcut) => {
            shortcut.addEventListener('click', (event) => {
                event.preventDefault();
            });
        });

        updateClock();
        setInterval(updateClock, 1000);
    </script>
</body>
</html>
