let inputSequence = '';

const display = document.getElementById('display');
const numberButtons = document.querySelectorAll('.number');
const operatorButtons = document.querySelectorAll('.operator');
const clearButton = document.getElementById('clear');
const equalButton = document.getElementById('equal');
const decimalButton = document.querySelector('.decimal');

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
    try {
        const result = eval(inputSequence);
        inputSequence = result.toString(); // Display result and allow further calculations
        updateDisplay();
    } catch (error) {
        display.value = 'Error'; // Display error if input is invalid
    }
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

// Function to update display
function updateDisplay() {
    display.value = inputSequence || '0';
}

// Helper function to check if the last character is an operator
function isOperator(character) {
    return ['+', '-', '*', '/', '%', '^'].includes(character);
}
