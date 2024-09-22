const words = ["javascript", "ahorcado", "programacion", "computadora", "html"];
let selectedWord = words[Math.floor(Math.random() * words.length)];
let displayedWord = Array(selectedWord.length).fill("_");
let incorrectGuesses = 0;
const maxGuesses = 6;
let guessedLetters = [];

function updateWordDisplay() {
    document.getElementById('word').textContent = displayedWord.join(" ");
}

function checkLetter() {
    const guessInput = document.getElementById('guess');
    const letter = guessInput.value.toLowerCase();

    if (letter && !guessedLetters.includes(letter)) {
        guessedLetters.push(letter);
        document.getElementById('letters-used').textContent = `Letras usadas: ${guessedLetters.join(", ")}`;

        if (selectedWord.includes(letter)) {
            for (let i = 0; i < selectedWord.length; i++) {
                if (selectedWord[i] === letter) {
                    displayedWord[i] = letter;
                }
            }
            updateWordDisplay();

            if (!displayedWord.includes("_")) {
                document.getElementById('message').textContent = "¡Felicidades! Adivinaste la palabra.";
            }
        } else {
            incorrectGuesses++;
            document.getElementById('message').textContent = `Fallaste, te quedan ${maxGuesses - incorrectGuesses} intentos.`;
            drawHangman();

            if (incorrectGuesses === maxGuesses) {
                document.getElementById('message').textContent = "¡Perdiste! La palabra era: " + selectedWord;
            }
        }
    }

    guessInput.value = "";
}

function drawHangman() {
    const parts = ['head', 'body', 'left-arm', 'right-arm', 'left-leg', 'right-leg'];
    document.getElementById(parts[incorrectGuesses - 1]).style.display = 'block';
}

updateWordDisplay();
