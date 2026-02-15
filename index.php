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
                        <p>Unlocked</p>
                    </div>
                    <div class="bios-screen__container">
                        <p>Admin Password Status</p>
                        <p>Not Set</p>
                    </div>
                    <div class="bios-screen__container">
                        <p>Set Admin Password</p>
                        <p>Not Set</p>
                    </div>
                    <div class="bios-screen__container ">
                        <p>Set System Password</p>
                        <p>Not Set</p>
                    </div>
                    <div class="bios-screen__container bios-screen__container-edit">
                        <p>Password on Boot</p>
                        <p>[Disable]</p>
                    </div>
                    <div class="bios-screen__container bios-screen__container-edit">
                        <p>Password ByPass</p>
                        <p>[Disable]</p>
                    </div>
                </section>
                <section class="bios-screen__tab-panel" data-tab-panel="boot" hidden>
                    <p>Boot Options</p>
                    <div class="bios-screen__container">
                        <p>Boot Mode</p>
                        <p>UEFI</p>
                    </div>
                    <div class="bios-screen__container">
                        <p>1st Boot Device</p>
                        <p>NVMe SSD</p>
                    </div>
                    <div class="bios-screen__container">
                        <p>2nd Boot Device</p>
                        <p>USB Device</p>
                    </div>
                </section>
                <section class="bios-screen__tab-panel" data-tab-panel="save-exit" hidden>
                    <p>Save & Exit</p>
                    <div class="bios-screen__container">
                        <p>Save Changes and Exit</p>
                        <p>Enter</p>
                    </div>
                    <div class="bios-screen__container">
                        <p>Discard Changes</p>
                        <p>F9</p>
                    </div>
                    <div class="bios-screen__container">
                        <p>Load Defaults</p>
                        <p>F5</p>
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
        const biosTimeInput = document.getElementById('bios-time-input');
        const biosDateInput = document.getElementById('bios-date-input');
        const biosTabs = Array.from(document.querySelectorAll('.bios-screen__tab'));
        const biosTabPanels = Array.from(document.querySelectorAll('.bios-screen__tab-panel'));
        const biosEditableRows = Array.from(document.querySelectorAll('.bios-screen__container-edit'));
        const biosPickerRows = Array.from(document.querySelectorAll('.bios-screen__picker'));
        const biosDescription = document.getElementById('bios-description');
        const biosClockStorageKey = 'biosClockStateV1';
        const biosAdvancedSettingsStorageKey = 'biosAdvancedSettingsV1';
        const biosRowFocusedClass = 'bios-screen__container-edit--focused';
        const biosDefaultDescription = 'Use this BIOS screen to review basic hardware details before booting.';
        const biosRowDescriptions = {
            'System Time': 'Set the system clock time in 24-hour format (HH:MM:SS).',
            'System Date': 'Set the system calendar date in MM/DD/YYYY format.'
        };
        let bootValue = 0;
        let selectedOs = 'Windows 11';
        let bootComplete = false;
        let focusedOsIndex = 0;
        let biosActive = false;
        let biosFocusedTabIndex = 0;
        let biosFocusedEditIndex = -1;
        let activePickerRow = null;
        let activePickerOptionIndex = -1;
        let biosClockState = loadBiosClockState();
        let biosAdvancedSettings = loadBiosAdvancedSettings();

        function canOpenBios() {
            return !bootComplete;
        }

        function getActiveBiosPanel() {
            return biosTabPanels.find((panel) => panel.classList.contains('bios-screen__tab-panel--active')) || null;
        }

        function getBiosEditableRows() {
            const activePanel = getActiveBiosPanel();
            if (!activePanel) return [];
            return Array.from(activePanel.querySelectorAll('.bios-screen__container-edit'));
        }

        function clearFocusedBiosRows() {
            biosTabPanels.forEach((panel) => {
                panel.querySelectorAll('.bios-screen__container-edit').forEach((row) => {
                    row.classList.remove(biosRowFocusedClass);
                });
            });
        }

        function getBiosRowLabelText(row) {
            if (!row) return '';
            const labelElement = row.querySelector('label') || row.querySelector('p');
            if (!labelElement) return '';
            return labelElement.textContent.replace(/:$/, '').trim();
        }

        function updateBiosDescription(row, pickerOpen = false) {
            if (!biosDescription) return;

            if (!row) {
                biosDescription.textContent = biosDefaultDescription;
                return;
            }

            const rowLabel = getBiosRowLabelText(row);
            let descriptionText = biosRowDescriptions[rowLabel] || `Selected: ${rowLabel}. Press Enter to edit this option.`;

            if (pickerOpen && row.classList.contains('bios-screen__picker')) {
                descriptionText = `${descriptionText} Use Up/Down to choose, Enter to confirm.`;
            }

            biosDescription.textContent = descriptionText;
        }

        function setFocusedBiosRow(index, options = {}) {
            const rows = getBiosEditableRows();
            const shouldReset = Boolean(options.reset);
            clearFocusedBiosRows();

            if (rows.length === 0) {
                biosFocusedEditIndex = -1;
                updateBiosDescription(null);
                return;
            }

            if (shouldReset || index < 0 || index >= rows.length) {
                biosFocusedEditIndex = 0;
            } else {
                biosFocusedEditIndex = index;
            }

            const focusedRow = rows[biosFocusedEditIndex];
            focusedRow.classList.add(biosRowFocusedClass);
            focusedRow.scrollIntoView({ block: 'nearest' });
            updateBiosDescription(focusedRow);
        }

        function moveFocusedBiosRow(step) {
            const rows = getBiosEditableRows();
            if (rows.length === 0) return;

            const nextIndex = (biosFocusedEditIndex + step + rows.length) % rows.length;
            setFocusedBiosRow(nextIndex);
        }

        function isAdvancedPickerRow(row) {
            return Boolean(row && row.classList.contains('bios-screen__picker'));
        }

        function getPickerOptions(row) {
            if (!row) return [];
            return Array.from(row.querySelectorAll('.bios-screen__picker-option'));
        }

        function getPickerValueElement(row) {
            if (!row) return null;
            return row.querySelector('.bios-screen__picker-value');
        }

        function getPickerMenuElement(row) {
            if (!row) return null;
            return row.querySelector('.bios-screen__picker-menu');
        }

        function findPickerOptionIndexByValue(row, value) {
            const options = getPickerOptions(row);
            return options.findIndex((option) => option.dataset.value === value);
        }

        function refreshPickerOptionState(row) {
            const options = getPickerOptions(row);
            options.forEach((option, optionIndex) => {
                const isActiveOption = row === activePickerRow && optionIndex === activePickerOptionIndex;
                const isSelectedOption = option.dataset.value === row.dataset.currentValue;
                option.classList.toggle('bios-screen__picker-option--active', isActiveOption);
                option.classList.toggle('bios-screen__picker-option--selected', isSelectedOption);
            });
        }

        function setPickerValue(row, value, shouldPersist = false) {
            const optionIndex = findPickerOptionIndexByValue(row, value);
            if (optionIndex < 0) return false;

            const options = getPickerOptions(row);
            const selectedOption = options[optionIndex];
            row.dataset.currentValue = selectedOption.dataset.value;

            const valueElement = getPickerValueElement(row);
            if (valueElement) {
                valueElement.textContent = selectedOption.textContent.trim();
            }

            refreshPickerOptionState(row);

            if (shouldPersist) {
                const settingKey = row.dataset.settingKey;
                if (settingKey) {
                    biosAdvancedSettings[settingKey] = row.dataset.currentValue;
                    persistBiosAdvancedSettings();
                }
            }

            return true;
        }

        function openAdvancedPicker(row) {
            if (!isAdvancedPickerRow(row)) return;

            if (activePickerRow && activePickerRow !== row) {
                closeAdvancedPicker({ commit: false });
            }

            activePickerRow = row;
            row.classList.add('bios-screen__picker--open');

            const menuElement = getPickerMenuElement(row);
            if (menuElement) {
                menuElement.hidden = false;
            }

            const valueElement = getPickerValueElement(row);
            if (valueElement) {
                valueElement.setAttribute('aria-expanded', 'true');
            }

            const selectedValue = row.dataset.currentValue || row.dataset.defaultValue;
            const selectedIndex = findPickerOptionIndexByValue(row, selectedValue);
            activePickerOptionIndex = selectedIndex >= 0 ? selectedIndex : 0;
            refreshPickerOptionState(row);
            updateBiosDescription(row, true);
        }

        function applyAdvancedPickerSelection() {
            if (!activePickerRow) return;

            const options = getPickerOptions(activePickerRow);
            if (options.length === 0) return;
            if (activePickerOptionIndex < 0 || activePickerOptionIndex >= options.length) return;

            const selectedValue = options[activePickerOptionIndex].dataset.value;
            setPickerValue(activePickerRow, selectedValue, true);
        }

        function closeAdvancedPicker(options = {}) {
            if (!activePickerRow) return;

            const { commit = false, navStep = 0 } = options;
            const closingRow = activePickerRow;

            if (commit) {
                applyAdvancedPickerSelection();
            }

            closingRow.classList.remove('bios-screen__picker--open');
            const menuElement = getPickerMenuElement(closingRow);
            if (menuElement) {
                menuElement.hidden = true;
            }

            const valueElement = getPickerValueElement(closingRow);
            if (valueElement) {
                valueElement.setAttribute('aria-expanded', 'false');
            }

            activePickerRow = null;
            activePickerOptionIndex = -1;
            refreshPickerOptionState(closingRow);

            const rows = getBiosEditableRows();
            const rowIndex = rows.indexOf(closingRow);
            if (rowIndex === -1) return;

            if (navStep !== 0) {
                const nextIndex = (rowIndex + navStep + rows.length) % rows.length;
                setFocusedBiosRow(nextIndex);
                return;
            }

            setFocusedBiosRow(rowIndex);
        }

        function moveAdvancedPickerOption(step) {
            if (!activePickerRow) return;
            const options = getPickerOptions(activePickerRow);
            if (options.length === 0) return;

            activePickerOptionIndex = (activePickerOptionIndex + step + options.length) % options.length;
            refreshPickerOptionState(activePickerRow);
            options[activePickerOptionIndex].scrollIntoView({ block: 'nearest' });
        }

        function isEditingBiosField() {
            const activeElement = document.activeElement;
            if (!activeElement || !biosScreen.contains(activeElement)) return false;

            const tagName = activeElement.tagName;
            return tagName === 'INPUT'
                || tagName === 'TEXTAREA'
                || tagName === 'SELECT'
                || activeElement.isContentEditable;
        }

        function focusEditableControl(row) {
            const editableControl = row.querySelector('input, textarea, select, [contenteditable="true"]');
            if (!editableControl) return false;

            editableControl.focus();
            if (typeof editableControl.select === 'function') {
                editableControl.select();
            }
            return true;
        }

        function startInlineValueEdit(row) {
            const valueCell = row.lastElementChild;
            if (!valueCell) return;

            const originalText = valueCell.textContent.trim();
            const replacementTagName = valueCell.tagName.toLowerCase() || 'p';
            const replacementClassName = valueCell.className;

            const inlineInput = document.createElement('input');
            inlineInput.type = 'text';
            inlineInput.className = 'bios-screen__field bios-screen__inline-field';
            inlineInput.value = originalText;
            inlineInput.setAttribute('aria-label', 'Edit BIOS value');

            row.replaceChild(inlineInput, valueCell);
            inlineInput.focus();
            inlineInput.select();

            const finishInlineEdit = (saveChanges, navStep = 0) => {
                if (!row.contains(inlineInput)) return;

                const replacementCell = document.createElement(replacementTagName);
                if (replacementClassName) {
                    replacementCell.className = replacementClassName;
                }

                const nextText = saveChanges ? inlineInput.value.trim() : originalText;
                replacementCell.textContent = nextText || originalText;
                row.replaceChild(replacementCell, inlineInput);

                const rows = getBiosEditableRows();
                const rowIndex = rows.indexOf(row);
                if (rowIndex === -1) return;

                if (navStep !== 0) {
                    const nextIndex = (rowIndex + navStep + rows.length) % rows.length;
                    setFocusedBiosRow(nextIndex);
                    return;
                }

                setFocusedBiosRow(rowIndex);
            };

            inlineInput.addEventListener('keydown', (event) => {
                if (event.key === 'Enter') {
                    event.preventDefault();
                    event.stopPropagation();
                    inlineInput.blur();
                    return;
                }

                if (event.key === 'Escape') {
                    event.preventDefault();
                    event.stopPropagation();
                    inlineInput.dataset.cancelEdit = 'true';
                    inlineInput.blur();
                }

                if (event.key === 'Tab') {
                    event.preventDefault();
                    event.stopPropagation();
                    inlineInput.dataset.navStep = event.shiftKey ? '-1' : '1';
                    inlineInput.blur();
                }
            });

            inlineInput.addEventListener('blur', () => {
                const shouldSave = inlineInput.dataset.cancelEdit !== 'true';
                const navStep = Number(inlineInput.dataset.navStep || '0');
                delete inlineInput.dataset.navStep;
                finishInlineEdit(shouldSave, Number.isFinite(navStep) ? navStep : 0);
            }, { once: true });
        }

        function activateFocusedBiosRow() {
            const rows = getBiosEditableRows();
            if (rows.length === 0) return;

            if (biosFocusedEditIndex < 0 || biosFocusedEditIndex >= rows.length) {
                biosFocusedEditIndex = 0;
            }

            const selectedRow = rows[biosFocusedEditIndex];
            if (isAdvancedPickerRow(selectedRow)) {
                openAdvancedPicker(selectedRow);
                return;
            }

            if (focusEditableControl(selectedRow)) return;
            startInlineValueEdit(selectedRow);
        }

        function isValidClockState(state) {
            return state
                && Number.isFinite(state.biosTimestamp)
                && Number.isFinite(state.baseTimestamp);
        }

        function loadBiosAdvancedSettings() {
            try {
                const rawSettings = localStorage.getItem(biosAdvancedSettingsStorageKey);
                if (!rawSettings) return {};

                const parsedSettings = JSON.parse(rawSettings);
                if (!parsedSettings || typeof parsedSettings !== 'object') {
                    return {};
                }

                return parsedSettings;
            } catch (error) {
                return {};
            }
        }

        function persistBiosAdvancedSettings() {
            try {
                localStorage.setItem(biosAdvancedSettingsStorageKey, JSON.stringify(biosAdvancedSettings));
            } catch (error) {
                // Ignore storage errors to keep interaction available.
            }
        }

        function applyBiosAdvancedSettings() {
            biosPickerRows.forEach((row) => {
                const settingKey = row.dataset.settingKey;
                if (!settingKey) return;

                const defaultValue = row.dataset.defaultValue || '';
                const savedValue = biosAdvancedSettings[settingKey];
                const nextValue = typeof savedValue === 'string' ? savedValue : defaultValue;
                setPickerValue(row, nextValue, false);
            });
        }

        function syncBiosAdvancedSettingsFromFields() {
            biosPickerRows.forEach((row) => {
                const settingKey = row.dataset.settingKey;
                if (!settingKey) return;
                biosAdvancedSettings[settingKey] = row.dataset.currentValue || row.dataset.defaultValue || '';
            });
            persistBiosAdvancedSettings();
        }

        function loadBiosClockState() {
            try {
                const rawState = localStorage.getItem(biosClockStorageKey);
                if (!rawState) return null;
                const parsedState = JSON.parse(rawState);
                return isValidClockState(parsedState) ? parsedState : null;
            } catch (error) {
                return null;
            }
        }

        function persistBiosClockState() {
            if (!isValidClockState(biosClockState)) return;

            try {
                localStorage.setItem(biosClockStorageKey, JSON.stringify(biosClockState));
            } catch (error) {
                // Ignore storage errors so BIOS remains usable in restricted browsing modes.
            }
        }

        function formatTwoDigits(value) {
            return String(value).padStart(2, '0');
        }

        function formatBiosTime(date) {
            return `${formatTwoDigits(date.getHours())}:${formatTwoDigits(date.getMinutes())}:${formatTwoDigits(date.getSeconds())}`;
        }

        function formatBiosDate(date) {
            return `${formatTwoDigits(date.getMonth() + 1)}/${formatTwoDigits(date.getDate())}/${date.getFullYear()}`;
        }

        function parseTimeValue(value) {
            const match = value.trim().match(/^(\d{2}):(\d{2}):(\d{2})$/);
            if (!match) return null;

            const hours = Number(match[1]);
            const minutes = Number(match[2]);
            const seconds = Number(match[3]);

            if (hours > 23 || minutes > 59 || seconds > 59) return null;

            return { hours, minutes, seconds };
        }

        function parseDateValue(value) {
            const match = value.trim().match(/^(\d{2})\/(\d{2})\/(\d{4})$/);
            if (!match) return null;

            const month = Number(match[1]);
            const day = Number(match[2]);
            const year = Number(match[3]);
            const parsedDate = new Date(year, month - 1, day);

            if (
                parsedDate.getFullYear() !== year
                || parsedDate.getMonth() !== month - 1
                || parsedDate.getDate() !== day
            ) {
                return null;
            }

            return { year, month, day };
        }

        function markFieldValidity(field, isValid) {
            if (!field) return;
            field.classList.toggle('bios-screen__field--invalid', !isValid);
            field.setAttribute('aria-invalid', isValid ? 'false' : 'true');
        }

        function getBiosNow() {
            const elapsedTime = Date.now() - biosClockState.baseTimestamp;
            return new Date(biosClockState.biosTimestamp + elapsedTime);
        }

        function setDefaultClockState() {
            let now = new Date();
            const initialTime = biosTimeInput ? parseTimeValue(biosTimeInput.value) : null;
            const initialDate = biosDateInput ? parseDateValue(biosDateInput.value) : null;

            if (initialTime && initialDate) {
                now = new Date(
                    initialDate.year,
                    initialDate.month - 1,
                    initialDate.day,
                    initialTime.hours,
                    initialTime.minutes,
                    initialTime.seconds,
                    0
                );
            }

            biosClockState = {
                biosTimestamp: now.getTime(),
                baseTimestamp: Date.now()
            };
            persistBiosClockState();
        }

        function saveBiosClockFromInputs() {
            if (!biosTimeInput || !biosDateInput) return;

            const parsedTime = parseTimeValue(biosTimeInput.value);
            const parsedDate = parseDateValue(biosDateInput.value);
            const hasValidTime = Boolean(parsedTime);
            const hasValidDate = Boolean(parsedDate);

            markFieldValidity(biosTimeInput, hasValidTime);
            markFieldValidity(biosDateInput, hasValidDate);

            if (!hasValidTime || !hasValidDate) return;

            const newClockDate = new Date(
                parsedDate.year,
                parsedDate.month - 1,
                parsedDate.day,
                parsedTime.hours,
                parsedTime.minutes,
                parsedTime.seconds,
                0
            );

            if (Number.isNaN(newClockDate.getTime())) return;

            biosClockState = {
                biosTimestamp: newClockDate.getTime(),
                baseTimestamp: Date.now()
            };
            persistBiosClockState();
            updateBiosClock();
        }

        function bindClockField(field) {
            if (!field) return;

            field.addEventListener('keydown', (event) => {
                if (event.key === 'Enter') {
                    event.preventDefault();
                    event.stopPropagation();
                    saveBiosClockFromInputs();
                    field.blur();
                    return;
                }

                if (event.key === 'Tab') {
                    event.preventDefault();
                    event.stopPropagation();
                    field.dataset.navStep = event.shiftKey ? '-1' : '1';
                    saveBiosClockFromInputs();
                    field.blur();
                }
            });

            field.addEventListener('blur', () => {
                saveBiosClockFromInputs();
                updateBiosClock();
                const parentRow = field.closest('.bios-screen__container-edit');
                const rows = getBiosEditableRows();
                const parentRowIndex = rows.indexOf(parentRow);
                if (parentRowIndex !== -1) {
                    const navStep = Number(field.dataset.navStep || '0');
                    delete field.dataset.navStep;

                    if (Number.isFinite(navStep) && navStep !== 0) {
                        const nextIndex = (parentRowIndex + navStep + rows.length) % rows.length;
                        setFocusedBiosRow(nextIndex);
                        return;
                    }

                    setFocusedBiosRow(parentRowIndex);
                }
            });
        }

        function bindAdvancedPickerRow(row) {
            if (!row) return;

            const valueElement = getPickerValueElement(row);
            const optionElements = getPickerOptions(row);

            if (valueElement) {
                valueElement.addEventListener('click', (event) => {
                    event.preventDefault();
                    event.stopPropagation();

                    const rows = getBiosEditableRows();
                    const rowIndex = rows.indexOf(row);
                    if (rowIndex !== -1) {
                        setFocusedBiosRow(rowIndex);
                    }

                    if (activePickerRow === row) {
                        closeAdvancedPicker({ commit: false });
                        return;
                    }

                    openAdvancedPicker(row);
                });
            }

            optionElements.forEach((optionElement, optionIndex) => {
                optionElement.addEventListener('click', (event) => {
                    event.preventDefault();
                    event.stopPropagation();

                    if (activePickerRow !== row) {
                        openAdvancedPicker(row);
                    }

                    activePickerOptionIndex = optionIndex;
                    closeAdvancedPicker({ commit: true });
                });
            });
        }

        function updateBiosClock() {
            const biosNow = getBiosNow();
            const activeElement = document.activeElement;

            if (biosTimeInput && activeElement !== biosTimeInput) {
                biosTimeInput.value = formatBiosTime(biosNow);
                markFieldValidity(biosTimeInput, true);
            }

            if (biosDateInput && activeElement !== biosDateInput) {
                biosDateInput.value = formatBiosDate(biosNow);
                markFieldValidity(biosDateInput, true);
            }
        }

        function openBios() {
            if (!canOpenBios()) return;
            biosActive = true;
            biosScreen.classList.add('bios-screen--active');
            biosScreen.setAttribute('aria-hidden', 'false');
            bootScreen.setAttribute('aria-hidden', 'true');
            setFocusedBiosRow(biosFocusedEditIndex, { reset: biosFocusedEditIndex < 0 });
        }

        function closeBios() {
            if (activePickerRow) {
                closeAdvancedPicker({ commit: false });
            }
            biosActive = false;
            biosScreen.classList.remove('bios-screen--active');
            biosScreen.setAttribute('aria-hidden', 'true');
            bootScreen.setAttribute('aria-hidden', 'false');
            clearFocusedBiosRows();
        }

        function setActiveBiosTab(index) {
            if (biosTabs.length === 0) return;
            if (activePickerRow) {
                closeAdvancedPicker({ commit: false });
            }

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

            setFocusedBiosRow(0, { reset: true });
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

        biosEditableRows.forEach((row) => {
            row.addEventListener('click', () => {
                const rows = getBiosEditableRows();
                const rowIndex = rows.indexOf(row);
                if (rowIndex === -1) return;

                if (activePickerRow && activePickerRow !== row) {
                    closeAdvancedPicker({ commit: false });
                }

                setFocusedBiosRow(rowIndex);
            });
        });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'F2') {
                if (!canOpenBios()) return;
                event.preventDefault();
                openBios();
                return;
            }

            if (event.key === 'Escape' && biosActive && !isEditingBiosField() && !activePickerRow) {
                event.preventDefault();
                closeBios();
                return;
            }

            if (biosActive) {
                if (activePickerRow) {
                    if (event.key === 'ArrowDown') {
                        event.preventDefault();
                        moveAdvancedPickerOption(1);
                    } else if (event.key === 'ArrowUp') {
                        event.preventDefault();
                        moveAdvancedPickerOption(-1);
                    } else if (event.key === 'Enter') {
                        event.preventDefault();
                        closeAdvancedPicker({ commit: true });
                    } else if (event.key === 'Tab') {
                        event.preventDefault();
                        closeAdvancedPicker({ commit: true, navStep: event.shiftKey ? -1 : 1 });
                    } else if (event.key === 'Escape') {
                        event.preventDefault();
                        closeAdvancedPicker({ commit: false });
                    }
                    return;
                }

                if (isEditingBiosField()) {
                    if (event.key === 'Escape') {
                        event.preventDefault();
                        document.activeElement.blur();
                    }
                    return;
                }

                if (event.key === 'ArrowRight') {
                    event.preventDefault();
                    setActiveBiosTab(biosFocusedTabIndex + 1);
                } else if (event.key === 'ArrowLeft') {
                    event.preventDefault();
                    setActiveBiosTab(biosFocusedTabIndex - 1);
                } else if (event.key === 'ArrowDown') {
                    event.preventDefault();
                    moveFocusedBiosRow(1);
                } else if (event.key === 'ArrowUp') {
                    event.preventDefault();
                    moveFocusedBiosRow(-1);
                } else if (event.key === 'Enter') {
                    event.preventDefault();
                    activateFocusedBiosRow();
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

                if (bootValue >= 84) {

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

        if (!isValidClockState(biosClockState)) {
            setDefaultClockState();
        }

        applyBiosAdvancedSettings();
        bindClockField(biosTimeInput);
        bindClockField(biosDateInput);
        biosPickerRows.forEach(bindAdvancedPickerRow);
        syncBiosAdvancedSettingsFromFields();
        updateBiosClock();
        setActiveBiosTab(0);
        setInterval(updateBiosClock, 1000);
        requestAnimationFrame(animateBoot);
    </script>
</body>

</html>
