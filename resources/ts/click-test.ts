const timerSelect = document.getElementById("timer-select") as HTMLSelectElement;
const clickArea = document.getElementById("click-area") as HTMLDivElement;
const timerDisplay = document.getElementById("timer-display") as HTMLParagraphElement;
const clickCountDisplay = document.getElementById("click-count") as HTMLParagraphElement;
const cpsDisplay = document.getElementById("cps-display") as HTMLParagraphElement;
const restartButton = document.getElementById("restart-button") as HTMLButtonElement;
const startText = document.getElementById("start-text") as HTMLParagraphElement;

let timer = 10;
let clickCount = 0;
let interval: ReturnType<typeof setInterval>;
let testRunning = false;
let isClickable = true;

// Update timer when user selects a different duration
timerSelect.addEventListener("change", () => {
    timer = parseInt(timerSelect.value);
    timerDisplay.textContent = `${timer}`;
    resetTest();
});

// Function to start the test
function startTest(): void {
    if (testRunning || !isClickable) return;

    timer = parseInt(timerSelect.value);
    clickCount = 0;
    testRunning = true;
    isClickable = true;
    
    timerDisplay.textContent = `${timer}`;
    clickCountDisplay.textContent = `${clickCount}`;
    cpsDisplay.textContent = "0";
    restartButton.classList.add("hidden");

    if (startText) startText.style.display = "none";

    interval = setInterval(() => {
        timer--;
        timerDisplay.textContent = `${timer}`;

        if (timer <= 0) {
            clearInterval(interval);
            endTest();
        }
    }, 1000);
}

// Function to end the test
function endTest(): void {
    testRunning = false;
    cpsDisplay.textContent = (clickCount / parseInt(timerSelect.value)).toFixed(2);
    restartButton.classList.remove("hidden");

    isClickable = false;
    clickArea.classList.add("disabled");

    setTimeout(() => {
        isClickable = true;
        clickArea.classList.remove("disabled");
    }, 3000);
}

// Handle clicks inside the box
clickArea.addEventListener("click", () => {
    if (!testRunning && isClickable) {
        startTest();
    } else if (testRunning) {
        clickCount++;
        clickCountDisplay.textContent = `${clickCount}`;
    }
});

// Restart button click event
restartButton.addEventListener("click", resetTest);

function resetTest(): void {
    testRunning = false;
    clickCount = 0;
    timerDisplay.textContent = `${timer}`;
    clickCountDisplay.textContent = "0";
    cpsDisplay.textContent = "0";
    restartButton.classList.add("hidden");
    startText.style.display = "block";
}
