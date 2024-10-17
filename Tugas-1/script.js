let inputSequence = '';

const display = document.getElementById('display');
const numberButtons = document.querySelectorAll('.number');
const operatorButtons = document.querySelectorAll('.operator');
const clearButton = document.getElementById('clear');
const equalButton = document.getElementById('equal');
const decimalButton = document.querySelector('.decimal');
const historyList = document.getElementById('historyList');
const clearHistoryBtn = document.getElementById('clearHistoryBtn');

// Add number to the display
numberButtons.forEach(button => {
    button.addEventListener('click', () => {
        inputSequence += button.getAttribute('data-number');
        updateDisplay();
    });
});

// Add operator to the display and handle operator change
operatorButtons.forEach(button => {
    button.addEventListener('click', () => {
        const operator = button.getAttribute('data-operator');
        if (inputSequence !== '') {
            const lastCharacter = inputSequence.slice(-1);

            // If the last character is an operator, replace it with the new one
            if (isOperator(lastCharacter)) {
                inputSequence = inputSequence.slice(0, -1) + operator;
            } else {
                inputSequence += operator;
            }

            updateDisplay();
        }
    });
});

// Calculate the result
equalButton.addEventListener('click', () => {
    calculateResult();
});

// Add decimal point
decimalButton.addEventListener('click', () => {
    const lastNumber = inputSequence.split(/[\+\-\*\/\%\^]/).pop();
    if (!lastNumber.includes('.')) {
        inputSequence += '.';
        updateDisplay();
    }
});

// Clear all
clearButton.addEventListener('click', () => {
    inputSequence = '';
    updateDisplay();
});

document.getElementById("backspace").addEventListener("click", function() {
    let display = document.getElementById("display");
    display.value = display.value.slice(0, -1); // Hapus karakter terakhir
});


// Listen for keyboard input
document.addEventListener('keydown', (event) => {
    const key = event.key;

    // Allow only numbers, operators, and some special keys
    if (isNumber(key)) {
        inputSequence += key;
        updateDisplay();
    } else if (isOperator(key)) {
        const lastCharacter = inputSequence.slice(-1);
        if (inputSequence !== '' && !isOperator(lastCharacter)) {
            inputSequence += key;
            updateDisplay();
        } else if (inputSequence !== '' && isOperator(lastCharacter)) {
            // Replace the operator if the last character is already an operator
            inputSequence = inputSequence.slice(0, -1) + key;
            updateDisplay();
        }
    } else if (key === 'Enter') {
        calculateResult();
    } else if (key === '.') {
        const lastNumber = inputSequence.split(/[\+\-\*\/\%\^]/).pop();
        if (!lastNumber.includes('.')) {
            inputSequence += '.';
            updateDisplay();
        }
    } else if (key === 'Escape') {
        // Clear the calculator when 'Escape' key is pressed
        inputSequence = '';
        updateDisplay();
    }
});

// Function to calculate result
function calculateResult() {
    try {
        const result = eval(inputSequence);
        addToHistory(`${inputSequence} = ${result}`);
        inputSequence = result.toString(); // Display result and allow further calculations
        updateDisplay();
    } catch (error) {
        display.value = 'Error'; // Display error if input is invalid
    }
}

// Function to update display
function updateDisplay() {
    display.value = inputSequence || '0';
}

// Helper function to check if a character is an operator
function isOperator(character) {
    return ['+', '-', '*', '/', '%', '^'].includes(character);
}

// Helper function to check if a character is a number
function isNumber(character) {
    return /\d/.test(character);
}

// Save calculation to local storage
function addToHistory(calculation) {
    let history = JSON.parse(localStorage.getItem('calcHistory')) || [];
    history.push(calculation);
    localStorage.setItem('calcHistory', JSON.stringify(history));
    renderHistory();
}

// Render history from local storage
function renderHistory() {
    const history = JSON.parse(localStorage.getItem('calcHistory')) || [];
    historyList.innerHTML = ''; // Clear current list
    history.forEach((entry) => {
        const li = document.createElement('li');
        li.textContent = entry;
        historyList.appendChild(li);
    });
}

// Clear history
clearHistoryBtn.addEventListener('click', () => {
    localStorage.removeItem('calcHistory');
    renderHistory();
});

// Load history on page load
window.onload = function () {
    renderHistory();
};
