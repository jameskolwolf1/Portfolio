<?php

$randomNumber = rand(0, 2);

$mobileQuotes = array(


    array(
        "./images/logo/appleLogo.png",
        "Every time I think about buying an iphone I think about buying an art piece then a smartphone"
    ),
    array(
        "./images/logo/appleLogo.png",
        "I only got an iphone because of FaceTime"
    ),
    array(
        "./images/logo/andriodLogo.png",
        "I love android and I love Java but we can do better"
    )
);
$desktopQuotes = array();

date_default_timezone_set('America/New_York');
$now = new DateTimeImmutable();
$currentTime = $now->format('H:i:s');
$currentDate = $now->format('m/d/Y');



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cool Profile, I mean I think it is who knows</title>
    <link rel="stylesheet" href="index.css">
</head>

<body class="booting">
    <div class="boot-screen" id="boot-screen" aria-live="polite">
        <div class="boot-screen__computer" role="presentation">
            <div class="boot-screen__bezel">
                <div class="boot-screen__display">
                    <img src="./images/logo/dell_logo.png" alt="Dell logo" class="boot-screen__logo">
                    <p class="boot-screen__status" id="boot-status">Booting...</p>
                    <div class="boot-screen__os-select" role="group" aria-label="Operating system selection" aria-hidden="true">
                        <p class="boot-screen__os-title">Select OS</p>
                        <div class="boot-screen__os-options" id="os-options" tabindex="0" aria-label="Use up and down arrow keys to choose an operating system">
                            <button type="button" class="boot-screen__os-option" data-os="Windows 11">Windows 11</button>
                            <button type="button" class="boot-screen__os-option" data-os="Linux">Linux</button>
                            <button type="button" class="boot-screen__os-option" data-os="macOS">macOS</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="boot-screen__base"></div>
        </div>
        <div class="boot-screen__bottom" aria-hidden="true">
            <div class="boot-screen__progress">
                <div class="boot-screen__progress-bar" id="boot-progress"></div>
            </div>
            <button type="button" class="boot-screen__bios">F2 BIOS</button>
        </div>
    </div>
    <div class="bios-screen" id="bios-screen" aria-hidden="true">
        <div class="bios-screen__header">
            Legacy BIOS Setup Utility
        </div>
        <div class="bios-screen__layout">
            <aside class="bios-screen__sidebar" aria-label="BIOS help">
                <div class="bios-screen__panel">
                    <p class="bios-screen__panel-title">Description</p>
                    <p>Use this BIOS screen to review basic hardware details before booting.</p>
                </div>
                <div class="bios-screen__panel">
                    <p class="bios-screen__panel-title">Instructions</p>
                    <p>Press <strong>F2</strong> to open BIOS.</p>
                    <p>Use <strong>Up/Down</strong> arrows to move through options.</p>
                    <p>Press <strong>Enter</strong> to select.</p>
                    <p>Press <strong>Esc</strong> to exit BIOS.</p>
                </div>
            </aside>
            <div class="bios-screen__body">
                <p>BIOS Information</p>
                <div class="bios-screen__container">
                    <p>BIOS Ventor</p>
                    <p>USA ... Chinnese Company Who knows </p>
                </div>
                <div class="bios-screen__container">
                    <p>Verison</p>
                    <p>1234</p>
                </div>
                <div class="bios-screen__container">
                    <p>VBIOS Version</p>
                    <p>Yes</p>
                </div>
                <div class="bios-screen__container">
                    <p>Processor Information</p>
                    <p>AMD (Im Bias...for now)</p>
                </div>
                <div class="bios-screen__container">
                    <p>Memory Information</p>
                    <p>Cant Afford It</p>
                </div>

                <div class="bios-screen__container">
                    <p>System Information</p>
                    <p>Serial Number</p>
                </div>
                <div class="bios-screen__container">
                    <p>System Time:</p>
                    <p id="bios-time"><?= htmlspecialchars($currentTime, ENT_QUOTES, 'UTF-8') ?></p>
                </div>

                <p>System Date: <span id="bios-date"><?= htmlspecialchars($currentDate, ENT_QUOTES, 'UTF-8') ?></span></p>
                <p>Boot Device: NVMe SSD</p>
                <p>Memory Test: Pass</p>
                <p class="bios-screen__hint">Press Esc to exit BIOS.</p>
            </div>
        </div>
    </div>

    <script>
        const bootScreen = document.getElementById('boot-screen');
        const biosScreen = document.getElementById('bios-screen');
        const bootProgress = document.getElementById('boot-progress');
        const bootStatus = document.getElementById('boot-status');
        const osSelect = document.querySelector('.boot-screen__os-select');
        const osOptions = document.getElementById('os-options');
        const osButtons = Array.from(document.querySelectorAll('.boot-screen__os-option'));
        const biosButton = document.querySelector('.boot-screen__bios');
        const biosTime = document.getElementById('bios-time');
        const biosDate = document.getElementById('bios-date');
        let bootValue = 0;
        let selectedOs = 'Windows 11';
        let bootComplete = false;
        let focusedOsIndex = 0;
        let biosActive = false;

        function updateBiosClock() {
            const now = new Date();
            const timeFormatter = new Intl.DateTimeFormat('en-US', {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: false,
                timeZone: 'America/New_York'
            });
            const dateFormatter = new Intl.DateTimeFormat('en-US', {
                year: 'numeric',
                month: '2-digit',
                day: '2-digit',
                timeZone: 'America/New_York'
            });

            if (biosTime) biosTime.textContent = timeFormatter.format(now);
            if (biosDate) biosDate.textContent = dateFormatter.format(now);
        }

        function openBios() {
            biosActive = true;
            biosScreen.classList.add('bios-screen--active');
            biosScreen.setAttribute('aria-hidden', 'false');
            bootScreen.setAttribute('aria-hidden', 'true');
        }

        function closeBios() {
            biosActive = false;
            biosScreen.classList.remove('bios-screen--active');
            biosScreen.setAttribute('aria-hidden', 'true');
            bootScreen.setAttribute('aria-hidden', 'false');
        }

        function setFocusedOs(index) {
            focusedOsIndex = (index + osButtons.length) % osButtons.length;
            osButtons.forEach((button, buttonIndex) => {
                button.classList.toggle('boot-screen__os-option--focused', buttonIndex === focusedOsIndex);
            });
        }

        function selectOs(index) {
            if (!bootComplete) return;

            setFocusedOs(index);
            const selectedButton = osButtons[focusedOsIndex];
            selectedOs = selectedButton.dataset.os;
            osButtons.forEach((button) => button.classList.remove('boot-screen__os-option--active'));
            selectedButton.classList.add('boot-screen__os-option--active');
            bootStatus.textContent = `Booting ${selectedOs}...`;

            setTimeout(() => {
                bootScreen.classList.add('boot-screen--hidden');
                bootScreen.setAttribute('aria-hidden', 'true');
                document.body.classList.remove('booting');
            }, 500);
        }

        osButtons.forEach((button, index) => {
            button.addEventListener('click', () => selectOs(index));
        });

        biosButton.addEventListener('click', openBios);

        document.addEventListener('keydown', (event) => {
            if (event.key === 'F2') {
                event.preventDefault();
                openBios();
                return;
            }

            if (event.key === 'Escape' && biosActive) {
                event.preventDefault();
                closeBios();
                return;
            }

            if (biosActive) return;

            if (!bootComplete || !bootScreen.classList.contains('boot-screen--os-ready')) return;

            if (event.key === 'ArrowDown') {
                event.preventDefault();
                setFocusedOs(focusedOsIndex + 1);
                return;
            }

            if (event.key === 'ArrowUp') {
                event.preventDefault();
                setFocusedOs(focusedOsIndex - 1);
                return;
            }

            if (event.key === 'Enter') {
                event.preventDefault();
                selectOs(focusedOsIndex);
            }
        });

        function animateBoot() {
            if (bootValue < 100) {

                if(bootValue >=84){

                    bootValue += 99;
                    bootProgress.style.width = `${Math.min(bootValue, 100)}%`;
                    requestAnimationFrame(animateBoot);

                    return;
                }

                bootValue += .05;
                bootProgress.style.width = `${Math.min(bootValue, 100)}%`;
                requestAnimationFrame(animateBoot);
                return;
            }

            bootComplete = true;
            setFocusedOs(focusedOsIndex);
            bootStatus.textContent = 'Use up/down arrows and press Enter to select OS.';
            osSelect.setAttribute('aria-hidden', 'false');
            bootScreen.classList.add('boot-screen--os-ready');
            osOptions.focus();
        }

        updateBiosClock();
        setInterval(updateBiosClock, 1000);
        requestAnimationFrame(animateBoot);
    </script>
</body>

</html>
