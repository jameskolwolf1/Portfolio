window.addEventListener('load', () => {
        const bootScreen = document.getElementById('boot-screen');
        const biosScreen = document.getElementById('bios-screen');
        const bootProgress = document.getElementById('boot-progress');
        const bootStatus = document.getElementById('boot-status');
        const osSelect = document.querySelector('.boot-screen__os-select');
        const osOptions = document.getElementById('os-options');
        const osButtons = Array.from(document.querySelectorAll('.boot-screen__os-option'));
        const windowsLoadingScreen = document.getElementById('windows-loading-screen');
        const windowsLoadingText = document.getElementById('windows-loading-text');
        const windowsDesktop = document.getElementById('windows-desktop');
        const windowsDesktopClock = document.getElementById('windows-desktop-clock');
        const windowsBsod = document.getElementById('windows-bsod');
        const biosButton = document.querySelector('.boot-screen__bios');
        const securityLockScreen = document.getElementById('security-lock-screen');
        const securityLockTitle = document.getElementById('security-lock-title');
        const securityLockSubtitle = document.getElementById('security-lock-subtitle');
        const securityLockInput = document.getElementById('security-lock-input');
        const securityLockButton = document.getElementById('security-lock-button');
        const securityLockMessage = document.getElementById('security-lock-message');
        const securityPasswordModal = document.getElementById('security-password-modal');
        const securityPasswordModalTitle = document.getElementById('security-password-modal-title');
        const securityPasswordModalInput = document.getElementById('security-password-modal-input');
        const securityPasswordModalConfirm = document.getElementById('security-password-modal-confirm');
        const securityPasswordModalSave = document.getElementById('security-password-modal-save');
        const securityPasswordModalCancel = document.getElementById('security-password-modal-cancel');
        const securityPasswordModalMessage = document.getElementById('security-password-modal-message');
        const biosExitModal = document.getElementById('bios-exit-modal');
        const biosExitModalTitle = document.getElementById('bios-exit-modal-title');
        const biosExitModalText = document.getElementById('bios-exit-modal-text');
        const biosExitModalConfirm = document.getElementById('bios-exit-modal-confirm');
        const biosExitModalCancel = document.getElementById('bios-exit-modal-cancel');
        const biosTimeInput = document.getElementById('bios-time-input');
        const biosDateInput = document.getElementById('bios-date-input');
        const biosTabs = Array.from(document.querySelectorAll('.bios-screen__tab'));
        const biosTabPanels = Array.from(document.querySelectorAll('.bios-screen__tab-panel'));
        const biosEditableRows = Array.from(document.querySelectorAll('.bios-screen__container-edit'));
        const biosPickerRows = Array.from(document.querySelectorAll('.bios-screen__picker'));
        const biosBootDeviceRows = Array.from(document.querySelectorAll('.bios-screen__boot-device-row'));
        const biosDescription = document.getElementById('bios-description');
        const biosClockStorageKey = 'biosClockStateV1';
        const biosAdvancedSettingsStorageKey = 'biosAdvancedSettingsV1';
        const biosSecurityStorageKey = 'biosSecurityStateV2';
        const biosBootOrderStorageKey = 'biosBootOrderV1';
        const biosRowFocusedClass = 'bios-screen__container-edit--focused';
        const biosDefaultDescription = 'Use this BIOS screen to review basic hardware details before booting.';
        const unlockSetupStatus = document.getElementById('unlock-setup-status');
        const userPasswordStatus = document.getElementById('user-password-status');
        const systemPasswordStatus = document.getElementById('system-password-status');
        const passwordOnBootStatus = document.getElementById('password-on-boot-status');
        const securityPasswordMessage = document.getElementById('security-password-message');
        const biosRowDescriptions = {
            'System Time': 'Set the system clock time in 24-hour format (HH:MM:SS).',
            'System Date': 'Set the system calendar date in MM/DD/YYYY format.',
            'Set User Password': 'Create or change the user password used to unlock setup.',
            'Set System Password': 'Create or change the system startup password.',
            'Boot Mode': 'Select which firmware boot mode is used during startup.',
            'Save Changes and Exit': 'Save all current BIOS changes, then continue boot using the selected OS.',
            'Discard Changes': 'Discard BIOS changes made in this session, then continue boot using the selected OS.'
        };
        const biosDefaultBootOrder = ['NVMe SSD', 'USB Device', 'Network PXE', 'SATA HDD'];
        const windowsLoadingMessages = [
            'Loading Bloatware...',
            'Why this OS has ads on my system...',
            'They got AI, and I used openClaw...',
            'My OS show me the weather but I "Weather" go to weather.com or AI...',
            'Installing updates you did not ask for...',
            'Preparing to pin more apps to your taskbar...',
            '~30 GB for an Operatiion System...?',
            'If it wasnt for gaming......',
            'Soo...You like blue screens...',
        ];
        let bootValue = 0;
        let selectedOs = 'Windows 11';
        let bootComplete = false;
        let focusedOsIndex = 0;
        let biosActive = false;
        let biosFocusedTabIndex = 0;
        let biosFocusedEditIndex = -1;
        let activePickerRow = null;
        let activePickerOptionIndex = -1;
        let bootDeviceMoveActive = false;
        let bootDeviceMoveOriginalOrder = null;
        let bootDeviceMoveIndex = -1;
        let securityLockActive = false;
        let securityPasswordModalActive = false;
        let activeSecurityPasswordType = '';
        let biosExitModalActive = false;
        let pendingExitAction = '';
        let bootAnimationStarted = false;
        let osTransitionActive = false;
        let biosClockState = loadBiosClockState();
        let biosAdvancedSettings = loadBiosAdvancedSettings();
        let biosSecurityState = loadBiosSecurityState();
        let biosBootOrder = loadBiosBootOrder();
        let biosSessionSnapshot = null;

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

            if (row.classList.contains('bios-screen__boot-device-row')) {
                if (bootDeviceMoveActive) {
                    descriptionText = 'Move mode active. Use Up/Down to change position. Press Enter to save or Esc to cancel.';
                } else {
                    descriptionText = 'Press Enter to start moving this boot device priority.';
                }
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
            const exitAction = selectedRow.dataset.exitAction;
            if (exitAction) {
                openExitModal(exitAction);
                return;
            }

            const securityPasswordType = selectedRow.dataset.securityPassword;
            if (securityPasswordType) {
                openSecurityPasswordModal(securityPasswordType);
                return;
            }

            if (selectedRow.classList.contains('bios-screen__boot-device-row')) {
                if (bootDeviceMoveActive) {
                    finishBootDeviceMove(true);
                } else {
                    startBootDeviceMove();
                }
                return;
            }

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

        function getBootOrdinalLabel(index) {
            const rank = index + 1;
            if (rank === 1) return '1st Boot Device';
            if (rank === 2) return '2nd Boot Device';
            if (rank === 3) return '3rd Boot Device';
            return `${rank}th Boot Device`;
        }

        function normalizeBootOrder(order) {
            if (!Array.isArray(order)) return [...biosDefaultBootOrder];
            const cleanedOrder = order
                .filter((entry) => typeof entry === 'string' && entry.trim())
                .map((entry) => entry.trim());

            if (cleanedOrder.length !== biosDefaultBootOrder.length) {
                return [...biosDefaultBootOrder];
            }

            return cleanedOrder;
        }

        function loadBiosBootOrder() {
            try {
                const rawOrder = localStorage.getItem(biosBootOrderStorageKey);
                if (!rawOrder) return [...biosDefaultBootOrder];
                return normalizeBootOrder(JSON.parse(rawOrder));
            } catch (error) {
                return [...biosDefaultBootOrder];
            }
        }

        function cloneState(state) {
            return JSON.parse(JSON.stringify(state));
        }

        function getCurrentBiosSnapshot() {
            return {
                clockState: biosClockState ? cloneState(biosClockState) : null,
                advancedSettings: cloneState(biosAdvancedSettings),
                bootOrder: [...biosBootOrder],
                securityState: cloneState(biosSecurityState)
            };
        }

        function restoreBiosSnapshot(snapshot) {
            if (!snapshot) return;

            if (snapshot.clockState && isValidClockState(snapshot.clockState)) {
                biosClockState = cloneState(snapshot.clockState);
                persistBiosClockState();
                updateBiosClock();
            }

            if (snapshot.advancedSettings && typeof snapshot.advancedSettings === 'object') {
                biosAdvancedSettings = cloneState(snapshot.advancedSettings);
                persistBiosAdvancedSettings();
                applyBiosAdvancedSettings();
            }

            if (Array.isArray(snapshot.bootOrder)) {
                biosBootOrder = [...snapshot.bootOrder];
                persistBiosBootOrder();
                renderBiosBootOrder();
            }

            if (snapshot.securityState && typeof snapshot.securityState === 'object') {
                biosSecurityState = normalizeSecurityState(snapshot.securityState);
                persistBiosSecurityState();
                updateSecurityStatus();
            }
        }

        function openExitModal(action) {
            if (!biosExitModal || (action !== 'save' && action !== 'discard')) return;

            pendingExitAction = action;
            biosExitModalActive = true;
            biosExitModal.hidden = false;

            if (action === 'save') {
                biosExitModalTitle.textContent = 'Save Changes and Exit';
                biosExitModalText.textContent = 'Save current BIOS settings and continue boot?';
            } else {
                biosExitModalTitle.textContent = 'Discard Changes';
                biosExitModalText.textContent = 'Discard BIOS changes from this session and continue boot?';
            }

            biosExitModalConfirm.focus();
        }

        function moveExitModalFocus(step) {
            const buttons = [biosExitModalConfirm, biosExitModalCancel].filter(Boolean);
            if (buttons.length === 0) return;

            const currentIndex = Math.max(0, buttons.indexOf(document.activeElement));
            const nextIndex = (currentIndex + step + buttons.length) % buttons.length;
            buttons[nextIndex].focus();
        }

        function closeExitModal() {
            pendingExitAction = '';
            biosExitModalActive = false;
            if (biosExitModal) {
                biosExitModal.hidden = true;
            }
        }

        function bootToSelectedOsFromBios() {
            closeBios();
            setTimeout(() => {
                if (!bootComplete) {
                    bootValue = 100;
                    bootProgress.style.width = '100%';
                    bootComplete = true;
                    biosButton.disabled = true;
                    biosButton.setAttribute('aria-disabled', 'true');
                    bootStatus.textContent = 'Use up/down arrows and press Enter to select OS.';
                    osSelect.setAttribute('aria-hidden', 'false');
                    bootScreen.classList.add('boot-screen--os-ready');
                    setFocusedOs(focusedOsIndex);
                }
                selectOs(focusedOsIndex);
            }, 0);
        }

        function confirmExitAction() {
            if (!pendingExitAction) return;

            if (isEditingBiosField()) {
                document.activeElement.blur();
            }

            if (activePickerRow) {
                closeAdvancedPicker({ commit: true });
            }

            if (bootDeviceMoveActive) {
                finishBootDeviceMove(true);
            }

            if (pendingExitAction === 'discard' && biosSessionSnapshot) {
                restoreBiosSnapshot(biosSessionSnapshot);
            }

            if (pendingExitAction === 'save') {
                biosSessionSnapshot = getCurrentBiosSnapshot();
            }

            closeExitModal();
            bootToSelectedOsFromBios();
        }

        function persistBiosBootOrder() {
            try {
                localStorage.setItem(biosBootOrderStorageKey, JSON.stringify(biosBootOrder));
            } catch (error) {
                // Ignore storage errors and keep BIOS usable.
            }
        }

        function renderBiosBootOrder() {
            biosBootDeviceRows.forEach((row, index) => {
                row.dataset.bootDeviceIndex = String(index);
                const labelElement = row.querySelector('.bios-screen__boot-device-label');
                const valueElement = row.querySelector('.bios-screen__boot-device-value');
                if (labelElement) {
                    labelElement.textContent = getBootOrdinalLabel(index);
                }
                if (valueElement) {
                    valueElement.textContent = biosBootOrder[index] || '';
                }
            });
        }

        function setBootDeviceMoveHighlight() {
            biosBootDeviceRows.forEach((row) => {
                const rowIndex = Number(row.dataset.bootDeviceIndex);
                const isMovingRow = bootDeviceMoveActive && rowIndex === bootDeviceMoveIndex;
                row.classList.toggle('bios-screen__boot-device-row--moving', isMovingRow);
            });
        }

        function startBootDeviceMove() {
            const rows = getBiosEditableRows();
            const focusedRow = rows[biosFocusedEditIndex];
            if (!focusedRow || !focusedRow.classList.contains('bios-screen__boot-device-row')) return false;

            const rowIndex = Number(focusedRow.dataset.bootDeviceIndex);
            if (!Number.isFinite(rowIndex)) return false;

            bootDeviceMoveActive = true;
            bootDeviceMoveOriginalOrder = [...biosBootOrder];
            bootDeviceMoveIndex = rowIndex;
            setBootDeviceMoveHighlight();
            updateBiosDescription(focusedRow);
            return true;
        }

        function placeBootDeviceAtIndex(targetIndex) {
            if (!bootDeviceMoveActive) return false;
            if (!Number.isFinite(targetIndex) || targetIndex < 0 || targetIndex >= biosBootOrder.length) {
                return false;
            }

            if (targetIndex === bootDeviceMoveIndex) return true;

            const [movedDevice] = biosBootOrder.splice(bootDeviceMoveIndex, 1);
            biosBootOrder.splice(targetIndex, 0, movedDevice);
            bootDeviceMoveIndex = targetIndex;
            renderBiosBootOrder();
            setBootDeviceMoveHighlight();

            const rows = getBiosEditableRows();
            const nextRow = rows.find((row) => row.classList.contains('bios-screen__boot-device-row') && Number(row.dataset.bootDeviceIndex) === targetIndex);
            if (!nextRow) return true;

            const nextRowIndex = rows.indexOf(nextRow);
            if (nextRowIndex !== -1) {
                setFocusedBiosRow(nextRowIndex);
            }

            return true;
        }

        function finishBootDeviceMove(shouldSave) {
            if (!bootDeviceMoveActive) return false;

            const finalIndex = bootDeviceMoveIndex;
            if (!shouldSave && Array.isArray(bootDeviceMoveOriginalOrder)) {
                biosBootOrder = [...bootDeviceMoveOriginalOrder];
                renderBiosBootOrder();
            }

            if (shouldSave) {
                persistBiosBootOrder();
            }

            bootDeviceMoveActive = false;
            bootDeviceMoveOriginalOrder = null;
            bootDeviceMoveIndex = -1;
            setBootDeviceMoveHighlight();

            const rows = getBiosEditableRows();
            const focusIndex = shouldSave ? finalIndex : Math.max(0, finalIndex);
            const nextRow = rows.find((row) => row.classList.contains('bios-screen__boot-device-row') && Number(row.dataset.bootDeviceIndex) === focusIndex);
            if (nextRow) {
                const nextRowIndex = rows.indexOf(nextRow);
                if (nextRowIndex !== -1) {
                    setFocusedBiosRow(nextRowIndex);
                }
            }

            return true;
        }

        function moveBootDevice(step) {
            if (!bootDeviceMoveActive) return false;
            return placeBootDeviceAtIndex(bootDeviceMoveIndex + step);
        }

        function normalizeSecurityState(state) {
            if (!state || typeof state !== 'object') {
                return {
                    userPassword: '',
                    systemPassword: '',
                    userPasswordEnabled: false,
                    systemPasswordEnabled: false
                };
            }

            const sanitizePassword = (value) => {
                if (typeof value !== 'string') return '';
                const trimmedValue = value.trim();
                if (!trimmedValue) return '';
                if (trimmedValue === 'undefined' || trimmedValue === 'null') return '';
                return value;
            };

            const userPassword = sanitizePassword(state.userPassword);
            const systemPassword = sanitizePassword(state.systemPassword);
            const userPasswordEnabled = Boolean(state.userPasswordEnabled && userPassword);
            const systemPasswordEnabled = Boolean(state.systemPasswordEnabled && systemPassword);

            return {
                userPassword,
                systemPassword,
                userPasswordEnabled,
                systemPasswordEnabled
            };
        }

        function loadBiosSecurityState() {
            try {
                const rawState = localStorage.getItem(biosSecurityStorageKey);
                if (!rawState) {
                    return {
                        userPassword: '',
                        systemPassword: '',
                        userPasswordEnabled: false,
                        systemPasswordEnabled: false
                    };
                }
                return normalizeSecurityState(JSON.parse(rawState));
            } catch (error) {
                return {
                    userPassword: '',
                    systemPassword: '',
                    userPasswordEnabled: false,
                    systemPasswordEnabled: false
                };
            }
        }

        function persistBiosSecurityState() {
            try {
                localStorage.setItem(biosSecurityStorageKey, JSON.stringify(biosSecurityState));
            } catch (error) {
                // Ignore storage errors to keep BIOS interaction available.
            }
        }

        function getStartupPasswordConfig() {
            if (biosSecurityState.systemPassword && biosSecurityState.systemPasswordEnabled) {
                return {
                    key: 'system',
                    label: 'System Password',
                    value: biosSecurityState.systemPassword
                };
            }

            if (biosSecurityState.userPassword && biosSecurityState.userPasswordEnabled) {
                return {
                    key: 'user',
                    label: 'User Password',
                    value: biosSecurityState.userPassword
                };
            }

            return null;
        }

        function updateSecurityStatus() {
            const hasUserPassword = Boolean(biosSecurityState.userPassword);
            const hasSystemPassword = Boolean(biosSecurityState.systemPassword);
            const hasBootPassword = Boolean(
                (biosSecurityState.userPassword && biosSecurityState.userPasswordEnabled)
                || (biosSecurityState.systemPassword && biosSecurityState.systemPasswordEnabled)
            );

            if (unlockSetupStatus) {
                unlockSetupStatus.textContent = hasUserPassword ? 'Locked' : 'Unlocked';
            }

            if (userPasswordStatus) {
                userPasswordStatus.textContent = hasUserPassword ? 'Set' : 'Not Set';
            }

            if (systemPasswordStatus) {
                systemPasswordStatus.textContent = hasSystemPassword ? 'Set' : 'Not Set';
            }

            if (passwordOnBootStatus) {
                passwordOnBootStatus.textContent = hasBootPassword ? '[Enable]' : '[Disable]';
            }
        }

        function setSecurityMessage(message, isError = false) {
            if (!securityPasswordMessage) return;
            securityPasswordMessage.textContent = message;
            securityPasswordMessage.classList.toggle('bios-screen__security-message--error', isError);
        }

        function saveSecurityPassword(type, nextPassword) {
            if (!nextPassword || !nextPassword.trim()) {
                setSecurityMessage('Password cannot be empty.', true);
                return false;
            }

            if (isUserPassword) {
                biosSecurityState.userPassword = nextPassword;
                biosSecurityState.userPasswordEnabled = true;
                setSecurityMessage('User password saved.');
            } else {
                biosSecurityState.systemPassword = nextPassword;
                biosSecurityState.systemPasswordEnabled = true;
                setSecurityMessage('System password saved.');
            }

            persistBiosSecurityState();
            updateSecurityStatus();
            return true;
        }

        function openSecurityPasswordModal(type) {
            if (!securityPasswordModal) return;
            if (type !== 'user' && type !== 'system') return;

            securityPasswordModalActive = true;
            activeSecurityPasswordType = type;
            securityPasswordModal.hidden = false;
            securityPasswordModalInput.value = '';
            securityPasswordModalConfirm.value = '';
            securityPasswordModalMessage.textContent = '';
            securityPasswordModalMessage.classList.remove('security-password-modal__message--error');
            securityPasswordModalTitle.textContent = type === 'system' ? 'Set System Password' : 'Set User Password';
            securityPasswordModalInput.focus();
        }

        function closeSecurityPasswordModal() {
            securityPasswordModalActive = false;
            activeSecurityPasswordType = '';
            if (!securityPasswordModal) return;

            securityPasswordModal.hidden = true;
            securityPasswordModalInput.value = '';
            securityPasswordModalConfirm.value = '';
            securityPasswordModalMessage.textContent = '';
            securityPasswordModalMessage.classList.remove('security-password-modal__message--error');
        }

        function setSecurityModalMessage(message, isError = false) {
            if (!securityPasswordModalMessage) return;
            securityPasswordModalMessage.textContent = message;
            securityPasswordModalMessage.classList.toggle('security-password-modal__message--error', isError);
        }

        function submitSecurityPasswordModal() {
            if (!securityPasswordModalActive || !activeSecurityPasswordType) return false;

            const passwordValue = securityPasswordModalInput ? securityPasswordModalInput.value : '';
            const confirmValue = securityPasswordModalConfirm ? securityPasswordModalConfirm.value : '';

            if (!passwordValue || !passwordValue.trim()) {
                setSecurityModalMessage('Password cannot be empty.', true);
                securityPasswordModalInput.focus();
                return false;
            }

            if (passwordValue !== confirmValue) {
                setSecurityModalMessage('Passwords do not match.', true);
                securityPasswordModalConfirm.focus();
                securityPasswordModalConfirm.select();
                return false;
            }

            const saved = saveSecurityPassword(activeSecurityPasswordType, passwordValue);
            if (!saved) {
                setSecurityModalMessage('Unable to save password.', true);
                return false;
            }

            setSecurityModalMessage('Password saved.');
            closeSecurityPasswordModal();
            return true;
        }

        function showSecurityLock() {
            const passwordConfig = getStartupPasswordConfig();
            if (!passwordConfig || !securityLockScreen) return;

            securityLockActive = true;
            securityLockScreen.hidden = false;
            securityLockMessage.textContent = '';
            securityLockMessage.classList.remove('security-lock-screen__message--error');
            securityLockTitle.textContent = 'Startup Password Required';
            securityLockSubtitle.textContent = `Enter ${passwordConfig.label} to continue boot.`;
            securityLockInput.value = '';
            securityLockInput.focus();
        }

        function hideSecurityLock() {
            securityLockActive = false;
            if (securityLockScreen) {
                securityLockScreen.hidden = true;
            }
        }

        function unlockBootWithPassword() {
            const passwordConfig = getStartupPasswordConfig();
            if (!passwordConfig) {
                hideSecurityLock();
                startBootAnimation();
                return true;
            }

            const enteredPassword = securityLockInput ? securityLockInput.value : '';
            if (enteredPassword !== passwordConfig.value) {
                securityLockMessage.textContent = 'Incorrect password. Try again.';
                securityLockMessage.classList.add('security-lock-screen__message--error');
                if (securityLockInput) {
                    securityLockInput.focus();
                    securityLockInput.select();
                }
                return false;
            }

            hideSecurityLock();
            startBootAnimation();
            return true;
        }

        function bindSecurityPasswordControls() {
            if (securityLockButton) {
                securityLockButton.addEventListener('click', () => {
                    unlockBootWithPassword();
                });
            }

            if (securityLockInput) {
                securityLockInput.addEventListener('keydown', (event) => {
                    if (event.key !== 'Enter') return;
                    event.preventDefault();
                    event.stopPropagation();
                    unlockBootWithPassword();
                });
            }

            if (securityPasswordModalSave) {
                securityPasswordModalSave.addEventListener('click', () => {
                    submitSecurityPasswordModal();
                });
            }

            if (securityPasswordModalCancel) {
                securityPasswordModalCancel.addEventListener('click', () => {
                    closeSecurityPasswordModal();
                });
            }

            if (securityPasswordModalInput) {
                securityPasswordModalInput.addEventListener('keydown', (event) => {
                    if (event.key !== 'Enter') return;
                    event.preventDefault();
                    event.stopPropagation();
                    submitSecurityPasswordModal();
                });
            }

            if (securityPasswordModalConfirm) {
                securityPasswordModalConfirm.addEventListener('keydown', (event) => {
                    if (event.key !== 'Enter') return;
                    event.preventDefault();
                    event.stopPropagation();
                    submitSecurityPasswordModal();
                });
            }
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
            biosSessionSnapshot = getCurrentBiosSnapshot();
            biosActive = true;
            biosScreen.classList.add('bios-screen--active');
            biosScreen.setAttribute('aria-hidden', 'false');
            bootScreen.setAttribute('aria-hidden', 'true');
            setFocusedBiosRow(biosFocusedEditIndex, { reset: biosFocusedEditIndex < 0 });
        }

        function closeBios() {
            closeExitModal();
            if (bootDeviceMoveActive) {
                finishBootDeviceMove(false);
            }
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
            if (bootDeviceMoveActive) {
                finishBootDeviceMove(false);
            }
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

        function hideWindowsScreens() {
            if (windowsLoadingScreen) {
                windowsLoadingScreen.hidden = true;
            }
            if (windowsDesktop) {
                windowsDesktop.hidden = true;
            }
            if (windowsBsod) {
                windowsBsod.hidden = true;
            }
        }

        function updateWindowsDesktopClock() {
            if (!windowsDesktopClock) return;
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            windowsDesktopClock.textContent = `${hours}:${minutes}`;
        }

        function setRandomWindowsLoadingMessage() {
            if (!windowsLoadingText) return '';
            const randomIndex = Math.floor(Math.random() * windowsLoadingMessages.length);
            const nextMessage = windowsLoadingMessages[randomIndex];
            windowsLoadingText.textContent = nextMessage;
            return nextMessage;
        }

        function showWindowsBootSequence() {
            setTimeout(() => {
                bootScreen.classList.add('boot-screen--hidden');
                bootScreen.setAttribute('aria-hidden', 'true');

                setRandomWindowsLoadingMessage();
                const loadingDuration = 10000;

                if (windowsLoadingScreen) {
                    windowsLoadingScreen.hidden = false;
                }

                setTimeout(() => {
                    if (windowsLoadingScreen) {
                        windowsLoadingScreen.hidden = true;
                    }

                    window.location.href = 'windows.php';
                    return;

                    document.body.classList.remove('booting');
                    osTransitionActive = false;
                }, loadingDuration);
            }, 500);
        }

        function selectOs(index) {
            if (!bootComplete || osTransitionActive) return;

            osTransitionActive = true;
            setFocusedOs(index);
            const selectedButton = osButtons[focusedOsIndex];
            selectedOs = selectedButton.dataset.os;
            osButtons.forEach((button) => button.classList.remove('boot-screen__os-option--active'));
            selectedButton.classList.add('boot-screen__os-option--active');
            bootStatus.textContent = `Booting ${selectedOs}...`;

            hideWindowsScreens();
            if (selectedOs === 'Windows 11') {
                showWindowsBootSequence();
                return;
            }

            setTimeout(() => {
                bootScreen.classList.add('boot-screen--hidden');
                bootScreen.setAttribute('aria-hidden', 'true');
                document.body.classList.remove('booting');
                osTransitionActive = false;
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

                if (bootDeviceMoveActive) {
                    if (row.classList.contains('bios-screen__boot-device-row')) {
                        const targetIndex = Number(row.dataset.bootDeviceIndex);
                        if (placeBootDeviceAtIndex(targetIndex)) {
                            finishBootDeviceMove(true);
                        }
                    }
                    return;
                }

                setFocusedBiosRow(rowIndex);
            });
        });

        document.addEventListener('keydown', (event) => {
            if (securityLockActive) {
                if (event.key === 'Escape') {
                    event.preventDefault();
                }
                return;
            }

            if (securityPasswordModalActive) {
                if (event.key === 'Escape') {
                    event.preventDefault();
                    closeSecurityPasswordModal();
                }
                return;
            }

            if (biosExitModalActive) {
                if (event.key === 'Enter') {
                    event.preventDefault();
                    if (document.activeElement === biosExitModalCancel) {
                        closeExitModal();
                    } else {
                        confirmExitAction();
                    }
                } else if (event.key === 'ArrowRight' || event.key === 'ArrowDown') {
                    event.preventDefault();
                    moveExitModalFocus(1);
                } else if (event.key === 'ArrowLeft' || event.key === 'ArrowUp') {
                    event.preventDefault();
                    moveExitModalFocus(-1);
                } else if (event.key === 'Escape') {
                    event.preventDefault();
                    closeExitModal();
                }
                return;
            }

            if (event.key === 'F2') {
                if (!canOpenBios()) return;
                event.preventDefault();
                openBios();
                return;
            }

            if (event.key === 'Escape' && biosActive && !isEditingBiosField() && !activePickerRow) {
                event.preventDefault();
                if (bootDeviceMoveActive) {
                    finishBootDeviceMove(false);
                    return;
                }
                closeBios();
                return;
            }

            if (biosActive) {
                if (bootDeviceMoveActive) {
                    if (event.key === 'ArrowDown') {
                        event.preventDefault();
                        moveBootDevice(1);
                    } else if (event.key === 'ArrowUp') {
                        event.preventDefault();
                        moveBootDevice(-1);
                    } else if (event.key === 'Enter') {
                        event.preventDefault();
                        finishBootDeviceMove(true);
                    } else if (event.key === 'Escape') {
                        event.preventDefault();
                        finishBootDeviceMove(false);
                    }
                    return;
                }

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

        function startBootAnimation() {
            if (bootAnimationStarted) return;
            bootAnimationStarted = true;
            requestAnimationFrame(animateBoot);
        }

        function animateBoot() {
            if (bootValue < 100) {

                if (bootValue <= 84) {

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
        renderBiosBootOrder();
        setBootDeviceMoveHighlight();
        bindClockField(biosTimeInput);
        bindClockField(biosDateInput);
        biosPickerRows.forEach(bindAdvancedPickerRow);
        bindSecurityPasswordControls();
        if (biosExitModalConfirm) {
            biosExitModalConfirm.addEventListener('click', () => {
                confirmExitAction();
            });
        }
        if (biosExitModalCancel) {
            biosExitModalCancel.addEventListener('click', () => {
                closeExitModal();
            });
        }
        syncBiosAdvancedSettingsFromFields();
        updateSecurityStatus();
        updateBiosClock();
        setActiveBiosTab(0);
        setInterval(updateBiosClock, 1000);

        if (getStartupPasswordConfig()) {
            showSecurityLock();
        } else {
            startBootAnimation();
        }
});
