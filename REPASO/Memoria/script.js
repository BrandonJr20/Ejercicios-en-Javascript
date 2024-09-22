// script.js
const cardImages = [
    '🍎', '🍎', '🍌', '🍌', '🍇',
    '🍇', '🍊', '🍊', '🍉', '🍉',
    '🍒', '🍒', '🍍', '🍍', '🍓',
    '🍓', '🍑', '🍑', '🍋', '🍋',
    '🍈', '🍈', '🍊', '🍊', '🍉'
];

let firstCard = null;
let secondCard = null;
let lockBoard = false;
let attempts = 0;
let timer = 0;
let timerInterval;

function shuffle(array) {
    for (let i = array.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]];
    }
}

function createCard(image) {
    const card = document.createElement('div');
    card.classList.add('card');
    card.addEventListener('click', flipCard);

    const cardInner = document.createElement('div');
    cardInner.classList.add('card-inner');

    const cardFront = document.createElement('div');
    cardFront.classList.add('card-side', 'card-front');
    cardFront.innerText = ''; // Lado frontal vacío

    const cardBack = document.createElement('div');
    cardBack.classList.add('card-side', 'card-back');
    cardBack.innerText = image; // Lado trasero con la imagen

    cardInner.appendChild(cardFront);
    cardInner.appendChild(cardBack);
    card.appendChild(cardInner);
    
    return card;
}

function flipCard() {
    if (lockBoard || this === firstCard) return;

    this.classList.toggle('flipped');
    if (!firstCard) {
        firstCard = this;
        return;
    }
    
    secondCard = this;
    attempts++; // Aumentar el contador de intentos
    document.getElementById('attempts').innerText = `Intentos: ${attempts}`; // Actualizar el contador de intentos

    checkForMatch();
}

function checkForMatch() {
    lockBoard = true;

    const isMatch = firstCard.querySelector('.card-back').innerText === secondCard.querySelector('.card-back').innerText;
    if (isMatch) {
        resetCards();
    } else {
        setTimeout(() => {
            firstCard.classList.remove('flipped');
            secondCard.classList.remove('flipped');
            resetCards();
        }, 1000);
    }
}

function resetCards() {
    [firstCard, secondCard, lockBoard] = [null, null, false];
}

function setupGame() {
    shuffle(cardImages);
    const gameBoard = document.getElementById('gameBoard');
    gameBoard.innerHTML = ''; // Limpiar el tablero
    cardImages.forEach(image => {
        const card = createCard(image);
        gameBoard.appendChild(card);
    });
    
    resetCounters();
    startTimer();
}

function startTimer() {
    timerInterval = setInterval(() => {
        timer++;
        document.getElementById('timer').innerText = `Tiempo: ${timer}s`;
    }, 1000);
}

function resetCounters() {
    attempts = 0;
    timer = 0;
    document.getElementById('attempts').innerText = `Intentos: ${attempts}`;
    document.getElementById('timer').innerText = `Tiempo: ${timer}s`;
}

document.getElementById('restartButton').addEventListener('click', () => {
    clearInterval(timerInterval); // Detener el temporizador anterior
    setupGame(); // Reiniciar el juego
});

setupGame();
