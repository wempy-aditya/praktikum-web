document.getElementById('calculator-form').addEventListener('submit', function (e) {
    e.preventDefault();

    // Get the input values
    const num1 = parseFloat(document.getElementById('num1').value);
    const num2 = parseFloat(document.getElementById('num2').value);
    const operation = document.getElementById('operation').value;
    let result = 0;

    // Perform the selected operation
    if (operation === 'add') {
        result = num1 + num2;
    } else if (operation === 'subtract') {
        result = num1 - num2;
    } else if (operation === 'multiply') {
        result = num1 * num2;
    } else if (operation === 'divide') {
        if (num2 !== 0) {
            result = num1 / num2;
        } else {
            alert("Division by zero is not allowed!");
            return;
        }
    }

    // Display the result
    document.getElementById('result').textContent = result;
});

// Reset button functionality
document.getElementById('reset-btn').addEventListener('click', function () {
    document.getElementById('num1').value = '';
    document.getElementById('num2').value = '';
    document.getElementById('operation').value = 'add';
    document.getElementById('result').textContent = '0';
});
