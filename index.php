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
    <div class="windows-loading-screen" id="windows-loading-screen" hidden>
        <div class="windows-loading-screen__center">
            <div class="windows-loading-screen__logo" role="img" aria-label="Windows logo">
                <img src="./images/logo/window_logo.png" alt="Windows logo" class="windows-loading-screen__logo-image">
            </div>
            <div class="windows-loading-screen__spinner" aria-hidden="true">
                <span></span><span></span><span></span>
            </div>
            <p class="windows-loading-screen__text" id="windows-loading-text">Loading Windows 11...</p>
        </div>
    </div>
    <div class="windows-bsod" id="windows-bsod" hidden>
        <div class="windows-bsod__content">
            <p class="windows-bsod__sad">:(</p>
            <p class="windows-bsod__headline">Your PC ran into a problem and needs to restart.</p>
            <p class="windows-bsod__sub">We're just collecting some error info, and then we'll restart for you.</p>
            <p class="windows-bsod__progress">100% complete</p>
            <p class="windows-bsod__code">Stop code: CRITICAL_PROCESS_DIED</p>
        </div>
    </div>
    <div class="security-lock-screen" id="security-lock-screen" hidden>
        <div class="security-lock-screen__panel">
            <p class="security-lock-screen__title" id="security-lock-title">Startup Password Required</p>
            <p class="security-lock-screen__subtitle" id="security-lock-subtitle">Enter password to continue boot.</p>
            <label for="security-lock-input" class="security-lock-screen__label">Password</label>
            <input type="password" id="security-lock-input" class="security-lock-screen__input" autocomplete="current-password">
            <button type="button" id="security-lock-button" class="security-lock-screen__button">Unlock</button>
            <p class="security-lock-screen__message" id="security-lock-message" aria-live="polite"></p>
        </div>
    </div>
    <div class="security-password-modal" id="security-password-modal" hidden>
        <div class="security-password-modal__panel">
            <p class="security-password-modal__title" id="security-password-modal-title">Set Password</p>
            <label for="security-password-modal-input" class="security-password-modal__label">New Password</label>
            <input type="password" id="security-password-modal-input" class="security-password-modal__input" maxlength="64" autocomplete="new-password">
            <label for="security-password-modal-confirm" class="security-password-modal__label">Confirm Password</label>
            <input type="password" id="security-password-modal-confirm" class="security-password-modal__input" maxlength="64" autocomplete="new-password">
            <div class="security-password-modal__actions">
                <button type="button" id="security-password-modal-save" class="security-password-modal__button">Save</button>
                <button type="button" id="security-password-modal-cancel" class="security-password-modal__button">Cancel</button>
            </div>
            <p class="security-password-modal__message" id="security-password-modal-message" aria-live="polite"></p>
        </div>
    </div>
    <div class="bios-exit-modal" id="bios-exit-modal" hidden>
        <div class="bios-exit-modal__panel">
            <p class="bios-exit-modal__title" id="bios-exit-modal-title">Confirm Exit</p>
            <p class="bios-exit-modal__text" id="bios-exit-modal-text">Are you sure?</p>
            <div class="bios-exit-modal__actions">
                <button type="button" id="bios-exit-modal-confirm" class="bios-exit-modal__button">Confirm</button>
                <button type="button" id="bios-exit-modal-cancel" class="bios-exit-modal__button">Cancel</button>
            </div>
        </div>
    </div>
    <div class="bios-screen" id="bios-screen" aria-hidden="true">
        <div class="bios-screen__header">
            Legacy BIOS Setup Utility - Copyright (C) &infin; future Crop
        </div>
        <div class="bios-screen__tabs" id="bios-tabs" role="tablist" aria-label="BIOS sections">
            <button type="button" class="bios-screen__tab bios-screen__tab--active" data-tab="main" role="tab" aria-selected="true">Main</button>
            <button type="button" class="bios-screen__tab" data-tab="advanced" role="tab" aria-selected="false">Advanced</button>
            <button type="button" class="bios-screen__tab" data-tab="security" role="tab" aria-selected="false">Security</button>
            <button type="button" class="bios-screen__tab" data-tab="boot" role="tab" aria-selected="false">Boot</button>
            <button type="button" class="bios-screen__tab" data-tab="save-exit" role="tab" aria-selected="false">Exit</button>
        </div>
        <div class="bios-screen__layout">
            <div class="bios-screen__body">
                <section class="bios-screen__tab-panel bios-screen__tab-panel--active" data-tab-panel="main">

                    <div class="bios-screen__box">
                        <div class="bios-screen__container bios-screen__container-edit">
                            <label for="bios-time-input">System Time:</label>
                            <input
                                id="bios-time-input"
                                class="bios-screen__field"
                                type="text"
                                inputmode="numeric"
                                maxlength="8"
                                value="<?= htmlspecialchars($currentTime, ENT_QUOTES, 'UTF-8') ?>"
                                aria-label="System Time in HH:MM:SS format">
                        </div>
                        <div class="bios-screen__container bios-screen__container-edit">
                            <label for="bios-date-input">System Date:</label>
                            <input
                                id="bios-date-input"
                                class="bios-screen__field"
                                type="text"
                                inputmode="numeric"
                                maxlength="10"
                                value="<?= htmlspecialchars($currentDate, ENT_QUOTES, 'UTF-8') ?>"
                                aria-label="System Date in MM/DD/YYYY format">
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
                        <p>Service Tag</p>
                        <p>49656C70</p>
                    </div>
                    <div class="bios-screen__container">
                        <p>Asset Tag</p>
                        <p>None</p>
                    </div>
                    <div class="bios-screen__container">
                        <p>CPU Type</p>
                        <p class="bios-screen__cpu">AMD Ryzen 5 9600X3D 6-Core CPU @ 3.6GHz
                            (Im Bias...for now)</p>
                    </div>
                    <div class="bios-screen__container">
                        <p>CPU Speed</p>
                        <p>3600 MHz</p>
                    </div>
                    <div class="bios-screen__container">
                        <p>CPU ID</p>
                        <p>870F00</p>
                    </div>
                    <p>CPU Cache</p>
                    <div class="bios-screen__container bios-screen__container-cache">
                        <p>L1 Cache</p>
                        <p>480 KB</p>
                    </div>
                    <div class="bios-screen__container bios-screen__container-cache">
                        <p>L2 Cache</p>
                        <p>6000 KB</p>
                    </div>
                    <div class="bios-screen__container bios-screen__container-cache">
                        <p>L3 Cache</p>
                        <p>96000 KB</p>
                    </div>
                    <div class="bios-screen__container">
                        <p>Fixed M.2</p>
                        <p>MZ-V9P2T0BW (2 TB)</p>
                    </div>
                    <div class="bios-screen__container">
                        <p>System Memory</p>
                        <p>Cant Afford It MB (DDR AI)</p>
                    </div>
                    <div class="bios-screen__container">
                        <p>Extended Memory</p>
                        <p>(≖_≖ ) Excuse Me!</p>
                    </div>
                    <div class="bios-screen__container">
                        <p>Memory Speed</p>
                        <p>Imagination Mhz</p>
                    </div>
                </section>
                <section class="bios-screen__tab-panel" data-tab-panel="advanced" hidden>
                    <p>Advanced Configuration</p>
                    <div class="bios-screen__container bios-screen__container-edit bios-screen__picker" data-setting-key="virtualization" data-default-value="enabled">
                        <p>Virtualization</p>
                        <button type="button" class="bios-screen__field bios-screen__picker-value" aria-haspopup="listbox" aria-expanded="false">[Enabled]</button>
                        <div class="bios-screen__picker-menu" hidden>
                            <button type="button" class="bios-screen__picker-option" data-value="enabled">[Enabled]</button>
                            <button type="button" class="bios-screen__picker-option" data-value="disabled">[Disabled]</button>
                        </div>
                    </div>
                    <div class="bios-screen__container bios-screen__container-edit bios-screen__picker" data-setting-key="integrated-nic" data-default-value="enabled">
                        <p>Integrated NIC</p>
                        <button type="button" class="bios-screen__field bios-screen__picker-value" aria-haspopup="listbox" aria-expanded="false">[Enabled]</button>
                        <div class="bios-screen__picker-menu" hidden>
                            <button type="button" class="bios-screen__picker-option" data-value="enabled">[Enabled]</button>
                            <button type="button" class="bios-screen__picker-option" data-value="disabled">[Disabled]</button>
                        </div>
                    </div>
                    <div class="bios-screen__container bios-screen__container-edit bios-screen__picker" data-setting-key="usb-emulation" data-default-value="enabled">
                        <p>USB Emulation</p>
                        <button type="button" class="bios-screen__field bios-screen__picker-value" aria-haspopup="listbox" aria-expanded="false">[Enabled]</button>
                        <div class="bios-screen__picker-menu" hidden>
                            <button type="button" class="bios-screen__picker-option" data-value="enabled">[Enabled]</button>
                            <button type="button" class="bios-screen__picker-option" data-value="disabled">[Disabled]</button>
                        </div>
                    </div>
                    <div class="bios-screen__container bios-screen__container-edit bios-screen__picker" data-setting-key="usb-powershare" data-default-value="enabled">
                        <p>USB Powershare</p>
                        <button type="button" class="bios-screen__field bios-screen__picker-value" aria-haspopup="listbox" aria-expanded="false">[Enabled]</button>
                        <div class="bios-screen__picker-menu" hidden>
                            <button type="button" class="bios-screen__picker-option" data-value="enabled">[Enabled]</button>
                            <button type="button" class="bios-screen__picker-option" data-value="disabled">[Disabled]</button>
                        </div>
                    </div>
                    <div class="bios-screen__container bios-screen__container-edit bios-screen__picker" data-setting-key="usb-wake-support" data-default-value="disabled">
                        <p>USB Wake Support</p>
                        <button type="button" class="bios-screen__field bios-screen__picker-value" aria-haspopup="listbox" aria-expanded="false">[Disabled]</button>
                        <div class="bios-screen__picker-menu" hidden>
                            <button type="button" class="bios-screen__picker-option" data-value="enabled">[Enabled]</button>
                            <button type="button" class="bios-screen__picker-option" data-value="disabled">[Disabled]</button>
                        </div>
                    </div>
                    <div class="bios-screen__container bios-screen__container-edit bios-screen__picker" data-setting-key="cpu-boost" data-default-value="enabled">
                        <p>CPU Boost</p>
                        <button type="button" class="bios-screen__field bios-screen__picker-value" aria-haspopup="listbox" aria-expanded="false">[Enabled]</button>
                        <div class="bios-screen__picker-menu" hidden>
                            <button type="button" class="bios-screen__picker-option" data-value="enabled">[Enabled]</button>
                            <button type="button" class="bios-screen__picker-option" data-value="disabled">[Disabled]</button>
                            <button type="button" class="bios-screen__picker-option" data-value="auto">[Auto]</button>
                        </div>
                    </div>
                    <div class="bios-screen__container bios-screen__container-edit bios-screen__picker" data-setting-key="usb-legacy-support" data-default-value="enabled">
                        <p>USB Legacy Support</p>
                        <button type="button" class="bios-screen__field bios-screen__picker-value" aria-haspopup="listbox" aria-expanded="false">[Enabled]</button>
                        <div class="bios-screen__picker-menu" hidden>
                            <button type="button" class="bios-screen__picker-option" data-value="enabled">[Enabled]</button>
                            <button type="button" class="bios-screen__picker-option" data-value="disabled">[Disabled]</button>
                        </div>
                    </div>
                </section>
                <section class="bios-screen__tab-panel" data-tab-panel="security" hidden>
                    <p>Security Settings</p>
                    <div class="bios-screen__container">
                        <p>Unlock Setup Status</p>
                        <p id="unlock-setup-status">Unlocked</p>
                    </div>
                    <div class="bios-screen__container">
                        <p>User Password Status</p>
                        <p id="user-password-status">Not Set</p>
                    </div>
                    <div class="bios-screen__container spacing1">
                        <p>System Password Status</p>
                        <p id="system-password-status">Not Set</p>
                    </div>
                    <div class="bios-screen__container">
                        <p>Password on Boot</p>
                        <p id="password-on-boot-status">[Disable]</p>
                    </div>
                    <div class="bios-screen__container bios-screen__container-edit" data-security-password="user">
                        <p>Set User Password</p>
                    </div>
                    <div class="bios-screen__container bios-screen__container-edit" data-security-password="system">
                        <p>Set System Password</p>
                    </div>
                    <p class="bios-screen__security-message" id="security-password-message" aria-live="polite"></p>
                </section>
                <section class="bios-screen__tab-panel" data-tab-panel="boot" hidden>
                    <p>Boot Options</p>
                    <div class="bios-screen__container bios-screen__container-edit bios-screen__picker" data-setting-key="boot-mode" data-default-value="uefi">
                        <p>Boot Mode</p>
                        <button type="button" class="bios-screen__field bios-screen__picker-value" aria-haspopup="listbox" aria-expanded="false">UEFI</button>
                        <div class="bios-screen__picker-menu" hidden>
                            <button type="button" class="bios-screen__picker-option" data-value="uefi">UEFI</button>
                            <button type="button" class="bios-screen__picker-option" data-value="legacy">Legacy</button>
                            <button type="button" class="bios-screen__picker-option" data-value="csm">CSM</button>
                        </div>
                    </div>
                    <div class="bios-screen__container bios-screen__container-edit bios-screen__boot-device-row" data-boot-device-index="0">
                        <p class="bios-screen__boot-device-label">1st Boot Device</p>
                        <p class="bios-screen__boot-device-value">NVMe SSD</p>
                    </div>
                    <div class="bios-screen__container bios-screen__container-edit bios-screen__boot-device-row" data-boot-device-index="1">
                        <p class="bios-screen__boot-device-label">2nd Boot Device</p>
                        <p class="bios-screen__boot-device-value">USB Device</p>
                    </div>
                    <div class="bios-screen__container bios-screen__container-edit bios-screen__boot-device-row" data-boot-device-index="2">
                        <p class="bios-screen__boot-device-label">3rd Boot Device</p>
                        <p class="bios-screen__boot-device-value">Network PXE</p>
                    </div>
                    <div class="bios-screen__container bios-screen__container-edit bios-screen__boot-device-row" data-boot-device-index="3">
                        <p class="bios-screen__boot-device-label">4th Boot Device</p>
                        <p class="bios-screen__boot-device-value">SATA HDD</p>
                    </div>
                </section>
                <section class="bios-screen__tab-panel" data-tab-panel="save-exit" hidden>
                    <p>Save & Exit</p>
                    <div class="bios-screen__container bios-screen__container-edit" data-exit-action="save">
                        <p>Save Changes and Exit</p>
                    </div>
                    <div class="bios-screen__container bios-screen__container-edit" data-exit-action="discard">
                        <p>Discard Changes</p>
                    </div>
                </section>
            </div>
            <aside class="bios-screen__sidebar" aria-label="BIOS help">
                <div class="bios-screen__panel">
                    <p class="bios-screen__panel-title">Description</p>
                    <p id="bios-description">Use this BIOS screen to review basic hardware details before booting.</p>
                </div>
                <div class="bios-screen__panel">
                    <p class="bios-screen__panel-title">Instructions</p>
                    <p>Press <strong>F2</strong> to open BIOS.</p>
                    <p>Use <strong>Left/Right</strong> arrows to switch tabs.</p>
                    <p>Use <strong>Up/Down</strong> arrows to select editable rows.</p>
                    <p>Press <strong>Enter</strong> to edit selected row.</p>
                    <p>Boot Device: <strong>Enter</strong> start move, <strong>Up/Down</strong> position, <strong>Enter</strong> save, <strong>Esc</strong> cancel.</p>
                    <p>Exit: select Save/Discard, press <strong>Enter</strong>, then confirm or cancel.</p>
                    <p>Press <strong>Esc</strong> to exit BIOS.</p>
                </div>
            </aside>
        </div>
    </div>
    <script src="index.js"></script>
</body>

</html>
