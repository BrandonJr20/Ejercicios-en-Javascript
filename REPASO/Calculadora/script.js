function appendCharacter(character) {
    const expressionInput = document.getElementById('expression');
    if (expressionInput.value === '0') {
        expressionInput.value = character;
    } else {
        expressionInput.value += character;
    }
}

function clearExpression() {
    document.getElementById('expression').value = '0';
    document.getElementById('result').textContent = '0';
}

function calculate() {
    const expressionInput = document.getElementById('expression').value;
    const resultDiv = document.getElementById('result');
    
    try {
        // Validar que no haya caracteres inválidos
        if (/[^0-9+\-*/().\s]/.test(expressionInput)) {
            throw new Error("Expresión inválida.");
        }

        // Evaluar la expresión
        const result = eval(expressionInput);

        // Mostrar el resultado
        resultDiv.textContent = result;
    } catch (error) {
        resultDiv.textContent = "Error";
    }
}
