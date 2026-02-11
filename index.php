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

    <script>
        const bootScreen = document.getElementById('boot-screen');
        const bootProgress = document.getElementById('boot-progress');
        const bootStatus = document.getElementById('boot-status');
        const osSelect = document.querySelector('.boot-screen__os-select');
        const osOptions = document.getElementById('os-options');
        const osButtons = Array.from(document.querySelectorAll('.boot-screen__os-option'));
        let bootValue = 0;
        let selectedOs = 'Windows 11';
        let bootComplete = false;
        let focusedOsIndex = 0;

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

        document.addEventListener('keydown', (event) => {
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
            bootStatus.textContent = 'Loading complete. Use up/down arrows and press Enter.';
            osSelect.setAttribute('aria-hidden', 'false');
            bootScreen.classList.add('boot-screen--os-ready');
            osOptions.focus();
        }

        requestAnimationFrame(animateBoot);
    </script>
</body>

</html>
