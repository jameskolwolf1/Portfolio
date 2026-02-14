<?php

$randomNumber = rand(0, 2);

$mobileQuotes = array(
    array(
        './images/logo/appleLogo.png',
        'Every time I think about buying an iphone I think about buying an art piece then a smartphone'
    ),
    array(
        './images/logo/appleLogo.png',
        'I only got an iphone because of FaceTime'
    ),
    array(
        './images/logo/andriodLogo.png',
        'I love android and I love Java but we can do better'
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
            Legacy BIOS Setup Utility - Copyright (C) &infin; future Crop
        </div>
        <div class="bios-screen__tabs" id="bios-tabs" role="tablist" aria-label="BIOS sections">
            <button type="button" class="bios-screen__tab bios-screen__tab--active" data-tab="main" role="tab" aria-selected="true">Main</button>
            <button type="button" class="bios-screen__tab" data-tab="advanced" role="tab" aria-selected="false">Advanced</button>
            <button type="button" class="bios-screen__tab" data-tab="boot" role="tab" aria-selected="false">Boot</button>
            <button type="button" class="bios-screen__tab" data-tab="security" role="tab" aria-selected="false">Security</button>
            <button type="button" class="bios-screen__tab" data-tab="save-exit" role="tab" aria-selected="false">Save & Exit</button>
        </div>
        <div class="bios-screen__layout">
            <div class="bios-screen__body">
                <section class="bios-screen__tab-panel bios-screen__tab-panel--active" data-tab-panel="main">

                    <div class="bios-screen__box">
                        <div class="bios-screen__container">
                            <p>System Time:</p>
                            <p id="bios-time"><?= htmlspecialchars($currentTime, ENT_QUOTES, 'UTF-8') ?></p>
                        </div>
                        <div class="bios-screen__container">
                            <p>System Date:</p>
                            <p id="bios-date"><?= htmlspecialchars($currentDate, ENT_QUOTES, 'UTF-8') ?></p>
                        </div>
                    </div>
                    <p>BIOS Information</p>
                        <div class="bios-screen__container">
                            <p>BIOS Version</p>
                            <p>H20</p>
                        </div>
                        <div class="bios-screen__container">
                            <p>Product Name</p>
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
                            <p class="bios-screen__cpu">AMD Ryzen 5 9600X3D 6-Core Processor
                            (Im Bias...for now)</p>
                        </div>
                    
                        <div class="bios-screen__container">
                        <p>Memory Information</p>
                        <p>Cant Afford It</p>
                    </div>
                    
                        <div class="bios-screen__container">
                        <p>System Information</p>
                    </div>
                    <p>Serial Number</p>
                    
                    <div class = "bios-screen__container">
                        <p>Access Level</p>
                        <p>Administrator</p>
                    </div>
                </section>
                <section class="bios-screen__tab-panel" data-tab-panel="advanced" hidden>
                    <p>Advanced Configuration</p>
                    <div class="bios-screen__container"><p>Virtualization</p><p>Enabled</p></div>
                    <div class="bios-screen__container"><p>CPU Boost</p><p>Auto</p></div>
                    <div class="bios-screen__container"><p>USB Legacy Support</p><p>Enabled</p></div>
                </section>
                <section class="bios-screen__tab-panel" data-tab-panel="boot" hidden>
                    <p>Boot Options</p>
                    <div class="bios-screen__container"><p>Boot Mode</p><p>UEFI</p></div>
                    <div class="bios-screen__container"><p>1st Boot Device</p><p>NVMe SSD</p></div>
                    <div class="bios-screen__container"><p>2nd Boot Device</p><p>USB Device</p></div>
                </section>
                <section class="bios-screen__tab-panel" data-tab-panel="security" hidden>
                    <p>Security Settings</p>
                    <div class="bios-screen__container"><p>Admin Password</p><p>Not Set</p></div>
                    <div class="bios-screen__container"><p>Secure Boot</p><p>Enabled</p></div>
                    <div class="bios-screen__container"><p>TPM Device</p><p>Available</p></div>
                </section>
                <section class="bios-screen__tab-panel" data-tab-panel="save-exit" hidden>
                    <p>Save & Exit</p>
                    <div class="bios-screen__container"><p>Save Changes and Exit</p><p>Enter</p></div>
                    <div class="bios-screen__container"><p>Discard Changes</p><p>F9</p></div>
                    <div class="bios-screen__container"><p>Load Defaults</p><p>F5</p></div>
                </section>
            </div>
            <aside class="bios-screen__sidebar" aria-label="BIOS help">
                <div class="bios-screen__panel">
                    <p class="bios-screen__panel-title">Description</p>
                    <p>Use this BIOS screen to review basic hardware details before booting.</p>
                </div>
                <div class="bios-screen__panel">
                    <p class="bios-screen__panel-title">Instructions</p>
                    <p>Press <strong>F2</strong> to open BIOS.</p>
                    <p>Use <strong>Left/Right</strong> arrows to switch tabs.</p>
                    <p>Press <strong>Enter</strong> to select.</p>
                    <p>Press <strong>Esc</strong> to exit BIOS.</p>
                </div>
            </aside>
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
        const biosTabs = Array.from(document.querySelectorAll('.bios-screen__tab'));
        const biosTabPanels = Array.from(document.querySelectorAll('.bios-screen__tab-panel'));
        let bootValue = 0;
        let selectedOs = 'Windows 11';
        let bootComplete = false;
        let focusedOsIndex = 0;
        let biosActive = false;
        let biosFocusedTabIndex = 0;

        function canOpenBios() {
            return !bootComplete;
        }

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
            if (!canOpenBios()) return;
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

        function setActiveBiosTab(index) {
            if (biosTabs.length === 0) return;

            biosFocusedTabIndex = (index + biosTabs.length) % biosTabs.length;
            const activeTabId = biosTabs[biosFocusedTabIndex].dataset.tab;

            biosTabs.forEach((tab, tabIndex) => {
                const isActive = tabIndex === biosFocusedTabIndex;
                tab.classList.toggle('bios-screen__tab--active', isActive);
                tab.setAttribute('aria-selected', isActive ? 'true' : 'false');
                if (isActive) {
                    tab.focus();
                }
            });

            biosTabPanels.forEach((panel) => {
                const isActive = panel.dataset.tabPanel === activeTabId;
                panel.classList.toggle('bios-screen__tab-panel--active', isActive);
                panel.hidden = !isActive;
            });
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

        biosButton.addEventListener('click', () => {
            if (!canOpenBios()) return;
            openBios();
        });

        biosTabs.forEach((tab, index) => {
            tab.addEventListener('click', () => {
                setActiveBiosTab(index);
            });
        });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'F2') {
                if (!canOpenBios()) return;
                event.preventDefault();
                openBios();
                return;
            }

            if (event.key === 'Escape' && biosActive) {
                event.preventDefault();
                closeBios();
                return;
            }

            if (biosActive) {
                if (event.key === 'ArrowRight') {
                    event.preventDefault();
                    setActiveBiosTab(biosFocusedTabIndex + 1);
                } else if (event.key === 'ArrowLeft') {
                    event.preventDefault();
                    setActiveBiosTab(biosFocusedTabIndex - 1);
                }
                return;
            }

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
            biosButton.disabled = true;
            biosButton.setAttribute('aria-disabled', 'true');
            setFocusedOs(focusedOsIndex);
            bootStatus.textContent = 'Use up/down arrows and press Enter to select OS.';
            osSelect.setAttribute('aria-hidden', 'false');
            bootScreen.classList.add('boot-screen--os-ready');
            osOptions.focus();
        }

        updateBiosClock();
        setActiveBiosTab(0);
        setInterval(updateBiosClock, 1000);
        requestAnimationFrame(animateBoot);
    </script>
</body>

</html>
