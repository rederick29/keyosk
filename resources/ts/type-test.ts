const timerSelect = document.getElementById("timer-select") as HTMLSelectElement;
const wordContainer = document.getElementById("word-container") as HTMLDivElement;
const caretElement = document.getElementById("caret") as HTMLDivElement;
const timerDisplay = document.getElementById("timer-display") as HTMLParagraphElement;
const wpmDisplay = document.getElementById("wpm-display") as HTMLParagraphElement;
const accuracyDisplay = document.getElementById("accuracy-display") as HTMLParagraphElement;
const wordCountDisplay = document.getElementById("word-count") as HTMLParagraphElement;
const restartButton = document.getElementById("restart-button") as HTMLButtonElement;
const startText = document.getElementById("start-text") as HTMLParagraphElement;
const testContainer = document.getElementById("test-container") as HTMLDivElement;
const resultsContainer = document.getElementById("results-container") as HTMLDivElement;
const resultElement = document.getElementById("results-section") as HTMLDivElement;

const FIXED_WORD_COUNT = 200;

const commonWords = [
    "keyosk", "innovative", "custom", "keyboards", "best", "typing", "experience",
    "quality", "crafted", "mechanical", "switches", "fast", "responsive", "precision",
    "gaming", "performance", "elite", "premium", "smooth", "durable", "comfortable",
    "ergonomic", "built", "design", "style", "aesthetic", "perfect", "clicky",
    "silent", "tactile", "customizable", "rgb", "backlit", "advanced", "mechanics",
    "professional", "essential", "typing", "mastery", "accurate", "seamless",
    "engineered", "crafted", "innovation", "excellence", "next", "level",
    "responsive", "durability", "enhanced", "switches", "gaming", "pro",
    "competitive", "workflow", "efficiency", "built", "trust", "community",
    "reliable", "satisfaction", "elevate", "mechanical", "high", "quality",
    "personalized", "superior", "typing", "workstation", "office", "enthusiast",
    "customization", "best", "recommended", "fluid", "effortless", "modern",
    "sleek", "technology", "nextgen", "wired", "wireless", "perfected",
    "speed", "accuracy", "responsive", "feedback", "silent", "click",
    "linear", "premium", "crafted", "ultimate", "mechanical", "powerful"
];


let timer = 30;
let interval: ReturnType<typeof setInterval>;
let testRunning = false;
let wordsArray: string[] = [];
let currentWordIndex = 0;
let currentCharIndex = 0;
let correctWords = 0;
let incorrectWords = 0;
let typedCharacters = 0;
let correctCharacters = 0;
let startTime: number;
let currentInput = "";
let wordElements: HTMLSpanElement[] = [];
let activeWordElement: HTMLSpanElement | null = null;
let focused = false;
let wpmHistory: {time: number, wpm: number}[] = [];
let accuracyHistory: {time: number, accuracy: number}[] = [];

function generateWords(count: number): string[] {
    const words: string[] = [];
    for (let i = 0; i < count; i++) {
        const randomIndex = Math.floor(Math.random() * commonWords.length);
        words.push(commonWords[randomIndex]);
    }
    return words;
}

timerSelect.addEventListener("change", () => {
    timer = parseInt(timerSelect.value);
    timerDisplay.textContent = `${timer}`;
    resetTest();
});


function startTest(): void {
    if (testRunning || resultsContainer.classList.contains("hidden") === false) return;

    timer = parseInt(timerSelect.value);
    testRunning = true;
    correctWords = 0;
    incorrectWords = 0;
    typedCharacters = 0;
    correctCharacters = 0;
    currentWordIndex = 0;
    currentCharIndex = 0;
    currentInput = "";
    wpmHistory = [];
    accuracyHistory = [];
    

    testContainer.classList.remove("hidden");
    resultsContainer.classList.add("hidden");
    

    resultElement.classList.add("hidden");
    

    if (wordsArray.length === 0) {
        wordsArray = generateWords(FIXED_WORD_COUNT);
    }
    

    displayWords();
    
    timerDisplay.textContent = `${timer}`;
    wpmDisplay.textContent = "0";
    accuracyDisplay.textContent = "100%";
    wordCountDisplay.textContent = "0";
    

    restartButton.classList.remove("hidden");
    restartButton.classList.add("opacity-50");

    if (startText) startText.style.display = "none";


    wordContainer.focus();
    

    updateCaretPosition();

    startTime = Date.now();


    recordMetrics();

    interval = setInterval(() => {
        timer--;
        timerDisplay.textContent = `${timer}`;


        recordMetrics();

        if (timer <= 0) {
            clearInterval(interval);
            endTest();
        }
    }, 1000);
}


function recordMetrics(): void {
    const timeElapsed = (Date.now() - startTime) / 60000; 
    if (timeElapsed <= 0) return;
    
    const wpm = Math.round(correctWords / timeElapsed);
    const accuracy = typedCharacters > 0 ? Math.round((correctCharacters / typedCharacters) * 100) : 100;
    
    wpmHistory.push({time: (Date.now() - startTime) / 1000, wpm: wpm});
    accuracyHistory.push({time: (Date.now() - startTime) / 1000, accuracy: accuracy});
}


function endTest(): void {
    testRunning = false;
    

    const minutes = (Date.now() - startTime) / 60000;
    const wpm = Math.round(correctWords / minutes);
    const rawWpm = Math.round(typedCharacters / 5 / minutes); // 5 characters = 1 word
    const accuracy = typedCharacters > 0 ? Math.round((correctCharacters / typedCharacters) * 100) : 100;
    
    wpmDisplay.textContent = `${wpm}`;
    accuracyDisplay.textContent = `${accuracy}%`;
    restartButton.classList.remove("opacity-50");
    

    document.getElementById("result-wpm")!.textContent = wpm.toString();
    document.getElementById("result-raw-wpm")!.textContent = rawWpm.toString();
    document.getElementById("result-accuracy")!.textContent = `${accuracy}%`;
    document.getElementById("result-characters")!.textContent = typedCharacters.toString();
    document.getElementById("result-correct-words")!.textContent = correctWords.toString();
    document.getElementById("result-incorrect-words")!.textContent = incorrectWords.toString();
    
    testContainer.classList.add("hidden");
    resultsContainer.classList.remove("hidden");
    
    resultElement.classList.remove("hidden");
    
    caretElement.style.opacity = "0";
    
    drawWpmGraph();
    drawAccuracyGraph();
    drawWordDistributionChart();
}

function drawWpmGraph(): void {
    const canvas = document.getElementById('wpm-graph') as HTMLCanvasElement;
    if (!canvas || wpmHistory.length === 0) return;
    
    const ctx = canvas.getContext('2d');
    if (!ctx) return;
    
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    
    const padding = 30;
    const graphWidth = canvas.width - (padding * 2);
    const graphHeight = canvas.height - (padding * 2);
    
    ctx.beginPath();
    ctx.moveTo(padding, padding);
    ctx.lineTo(padding, canvas.height - padding);
    ctx.lineTo(canvas.width - padding, canvas.height - padding);
    ctx.strokeStyle = document.documentElement.classList.contains('dark') ? '#ccc' : '#333';
    ctx.stroke();
    
    const maxWpm = Math.max(...wpmHistory.map(p => p.wpm), 10);
    const maxTime = Math.max(...wpmHistory.map(p => p.time), parseInt(timerSelect.value));
    
    ctx.beginPath();
    ctx.moveTo(
        padding + (wpmHistory[0].time / maxTime) * graphWidth,
        canvas.height - padding - (wpmHistory[0].wpm / maxWpm) * graphHeight
    );
    
    for (let i = 1; i < wpmHistory.length; i++) {
        ctx.lineTo(
            padding + (wpmHistory[i].time / maxTime) * graphWidth,
            canvas.height - padding - (wpmHistory[i].wpm / maxWpm) * graphHeight
        );
    }
    
    ctx.strokeStyle = document.documentElement.classList.contains('dark') ? '#8b5cf6' : '#ea580c';
    ctx.lineWidth = 2;
    ctx.stroke();
    
    ctx.fillStyle = document.documentElement.classList.contains('dark') ? '#ccc' : '#333';
    ctx.font = '12px sans-serif';
    ctx.textAlign = 'center';
    
    for (let i = 0; i <= 5; i++) {
        const xPos = padding + (i / 5) * graphWidth;
        const timeValue = Math.round((i / 5) * maxTime);
        ctx.fillText(timeValue + 's', xPos, canvas.height - padding + 15);
    }
    
    ctx.textAlign = 'right';
    for (let i = 0; i <= 5; i++) {
        const yPos = canvas.height - padding - (i / 5) * graphHeight;
        const wpmValue = Math.round((i / 5) * maxWpm);
        ctx.fillText(wpmValue.toString(), padding - 5, yPos + 4);
    }
    
    ctx.textAlign = 'center';
    ctx.font = '14px sans-serif';
    ctx.fillText('WPM over Time', canvas.width / 2, padding - 10);
}

function drawAccuracyGraph(): void {
    const canvas = document.getElementById('accuracy-graph') as HTMLCanvasElement;
    if (!canvas || accuracyHistory.length === 0) return;
    
    const ctx = canvas.getContext('2d');
    if (!ctx) return;
    
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    
    const padding = 30;
    const graphWidth = canvas.width - (padding * 2);
    const graphHeight = canvas.height - (padding * 2);
    
    ctx.beginPath();
    ctx.moveTo(padding, padding);
    ctx.lineTo(padding, canvas.height - padding);
    ctx.lineTo(canvas.width - padding, canvas.height - padding);
    ctx.strokeStyle = document.documentElement.classList.contains('dark') ? '#ccc' : '#333';
    ctx.stroke();
    
    const maxTime = Math.max(...accuracyHistory.map(p => p.time), parseInt(timerSelect.value));
    
    ctx.beginPath();
    ctx.moveTo(
        padding + (accuracyHistory[0].time / maxTime) * graphWidth,
        canvas.height - padding - (accuracyHistory[0].accuracy / 100) * graphHeight
    );
    
    for (let i = 1; i < accuracyHistory.length; i++) {
        ctx.lineTo(
            padding + (accuracyHistory[i].time / maxTime) * graphWidth,
            canvas.height - padding - (accuracyHistory[i].accuracy / 100) * graphHeight
        );
    }
    
    ctx.strokeStyle = document.documentElement.classList.contains('dark') ? '#8b5cf6' : '#ea580c';
    ctx.lineWidth = 2;
    ctx.stroke();
    
    ctx.fillStyle = document.documentElement.classList.contains('dark') ? '#ccc' : '#333';
    ctx.font = '12px sans-serif';
    ctx.textAlign = 'center';
    
    for (let i = 0; i <= 5; i++) {
        const xPos = padding + (i / 5) * graphWidth;
        const timeValue = Math.round((i / 5) * maxTime);
        ctx.fillText(timeValue + 's', xPos, canvas.height - padding + 15);
    }
    
    ctx.textAlign = 'right';
    for (let i = 0; i <= 5; i++) {
        const yPos = canvas.height - padding - (i / 5) * graphHeight;
        const accuracyValue = Math.round((i / 5) * 100);
        ctx.fillText(accuracyValue + '%', padding - 5, yPos + 4);
    }
    
    ctx.textAlign = 'center';
    ctx.font = '14px sans-serif';
    ctx.fillText('Accuracy over Time', canvas.width / 2, padding - 10);
}

function drawWordDistributionChart(): void {
    const canvas = document.getElementById('word-distribution') as HTMLCanvasElement;
    if (!canvas) return;
    
    const ctx = canvas.getContext('2d');
    if (!ctx) return;
    
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    
    const padding = 30;
    const chartWidth = canvas.width - (padding * 2);
    const chartHeight = canvas.height - (padding * 2);
    
    const total = correctWords + incorrectWords;
    if (total === 0) return;
    
    const correctAngle = (correctWords / total) * 2 * Math.PI;
    const centerX = canvas.width / 2;
    const centerY = canvas.height / 2;
    const radius = Math.min(chartWidth, chartHeight) / 2.5; 
    
    ctx.beginPath();
    ctx.moveTo(centerX, centerY);
    ctx.arc(centerX, centerY, radius, 0, correctAngle);
    ctx.fillStyle = '#10b981';
    ctx.fill();
    
    ctx.beginPath();
    ctx.moveTo(centerX, centerY);
    ctx.arc(centerX, centerY, radius, correctAngle, 2 * Math.PI);
    ctx.fillStyle = '#ef4444'; 
    ctx.fill();
    
    const legendY = centerY + radius + 15;
    
    ctx.fillStyle = '#10b981';
    ctx.fillRect(centerX - 70, legendY, 12, 12);
    ctx.fillStyle = document.documentElement.classList.contains('dark') ? '#ccc' : '#333';
    ctx.textAlign = 'left';
    ctx.font = '10px sans-serif';
    ctx.fillText(`Correct: ${correctWords} (${Math.round((correctWords/total)*100)}%)`, centerX - 55, legendY + 10);
    
    ctx.fillStyle = '#ef4444';
    ctx.fillRect(centerX + 5, legendY, 12, 12);
    ctx.fillStyle = document.documentElement.classList.contains('dark') ? '#ccc' : '#333';
    ctx.fillText(`Incorrect: ${incorrectWords} (${Math.round((incorrectWords/total)*100)}%)`, centerX + 20, legendY + 10);
    
    ctx.textAlign = 'center';
    ctx.font = '14px sans-serif';
    ctx.fillText('Word Accuracy', canvas.width / 2, padding - 10);
}


function displayWords(): void {
    wordContainer.innerHTML = "";
    wordElements = [];
    
    wordsArray.forEach((word, index) => {
        const wordSpan = document.createElement("span");
        wordSpan.className = "inline-block px-1 py-0.5 rounded mr-2 mb-2";
        wordSpan.setAttribute("data-index", index.toString());
        
        word.split("").forEach((char, charIndex) => {
            const charSpan = document.createElement("span");
            charSpan.textContent = char;
            charSpan.className = "";
            charSpan.setAttribute("data-index", charIndex.toString());
            wordSpan.appendChild(charSpan);
        });
        
        wordContainer.appendChild(wordSpan);
        wordElements.push(wordSpan);
    });
    
    activeWordElement = wordElements[0];
    if (activeWordElement) {
        activeWordElement.classList.add("bg-zinc-200", "dark:bg-zinc-800");
    }
}

function updateCaretPosition(): void {
    if (!activeWordElement) return;
    
    const charElements = activeWordElement.querySelectorAll("span");
    
    if (currentCharIndex < charElements.length) {
        const charElement = charElements[currentCharIndex];
        const rect = charElement.getBoundingClientRect();
        const containerRect = wordContainer.getBoundingClientRect();
        
        caretElement.style.left = `${rect.left - containerRect.left}px`;
        caretElement.style.top = `${rect.top - containerRect.top}px`;
        caretElement.style.height = `${rect.height}px`;
    } else {
        if (charElements.length > 0) {
            const lastCharElement = charElements[charElements.length - 1];
            const rect = lastCharElement.getBoundingClientRect();
            const containerRect = wordContainer.getBoundingClientRect();
            
            caretElement.style.left = `${rect.right - containerRect.left}px`;
            caretElement.style.top = `${rect.top - containerRect.top}px`;
            caretElement.style.height = `${rect.height}px`;
        }
    }
    
    caretElement.style.opacity = "1";
}

function handleCharPress(char: string): void {
    if (!testRunning || !activeWordElement) return;
    
    const currentWord = wordsArray[currentWordIndex];
    const charElements = activeWordElement.querySelectorAll("span");
    
    if (currentCharIndex < currentWord.length) {
        typedCharacters++;
        
        const isCorrect = char === currentWord[currentCharIndex];
        if (isCorrect) {
            correctCharacters++;
            charElements[currentCharIndex].classList.add("text-green-500");
        } else {
            charElements[currentCharIndex].classList.add("text-red-500");
        }
        
        currentCharIndex++;
        updateCaretPosition();
        
    } else if (char === " " || char === "Enter") {
        processWordCompletion();
    }
    
    updateStats();
}

function processWordCompletion(): void {
    if (!activeWordElement) return;
    
    const currentWord = wordsArray[currentWordIndex];
    const charElements = activeWordElement.querySelectorAll("span");
    
    typedCharacters++;
    
    let allCorrect = true;
    for (let i = 0; i < currentWord.length; i++) {
        if (i >= charElements.length || !charElements[i].classList.contains("text-green-500")) {
            allCorrect = false;
            break;
        }
    }
    
    if (allCorrect && currentCharIndex >= currentWord.length) {
        correctWords++;
        correctCharacters++; 
        activeWordElement.classList.add("text-gray-500");
    } else {
        incorrectWords++;
        activeWordElement.classList.add("text-red-500");
    }
    
    currentWordIndex++;
    currentCharIndex = 0;
    activeWordElement.classList.remove("bg-zinc-200", "dark:bg-zinc-800");
    if (currentWordIndex < wordsArray.length) {
        activeWordElement = wordElements[currentWordIndex];
        if (activeWordElement) {
            activeWordElement.classList.add("bg-zinc-200", "dark:bg-zinc-800");
            activeWordElement.scrollIntoView({ behavior: "smooth", block: "center" });
        }
    }
    
    updateCaretPosition();
}

function updateStats(): void {
    if (!testRunning) return;
    
    const timeElapsed = (Date.now() - startTime) / 60000; // in minutes
    if (timeElapsed <= 0) return;
    
    const wpm = Math.round(correctWords / timeElapsed);
    const accuracy = typedCharacters > 0 ? Math.round((correctCharacters / typedCharacters) * 100) : 100;
    
    wpmDisplay.textContent = `${wpm}`;
    accuracyDisplay.textContent = `${accuracy}%`;
    wordCountDisplay.textContent = `${correctWords}`;
}

document.addEventListener("keydown", (event) => {
    if (!testRunning && !event.ctrlKey && !event.altKey && !event.metaKey) {
        if (event.key.length === 1 || event.key === "Enter" || event.key === " ") {
            startTest();
        }
    }
    
    if (!testRunning || !focused) return;
    
    if (event.key.length === 1) {
        handleCharPress(event.key);
        event.preventDefault();
    } else if (event.key === "Enter" || event.key === " ") {
        if (currentCharIndex > 0) {
            processWordCompletion();
        }
        event.preventDefault();
    } else if (event.key === "Backspace") {
        if (currentCharIndex > 0 && activeWordElement) {
            currentCharIndex--;
            
            const charElements = activeWordElement.querySelectorAll("span");
            if (charElements[currentCharIndex]) {
                charElements[currentCharIndex].className = "";
            }
            
            updateCaretPosition();
        }
        event.preventDefault();
    }
});

wordContainer.addEventListener("click", () => {
    if (!testRunning) {
        startTest();
    } else {
        focused = true;
        wordContainer.focus();
        caretElement.style.opacity = "1";
    }
});

wordContainer.addEventListener("focus", () => {
    focused = true;
    if (testRunning) {
        caretElement.style.opacity = "1";
    }
});

wordContainer.addEventListener("blur", () => {
    focused = false;
    caretElement.style.opacity = "0";
});

setInterval(() => {
    if (focused && testRunning) {
        caretElement.style.opacity = caretElement.style.opacity === "0" ? "1" : "0";
    }
}, 530);

restartButton.addEventListener("click", resetTest);
document.getElementById("new-test-button")?.addEventListener("click", resetTest);

function resetTest(): void {
    testRunning = false;
    clearInterval(interval);
    timer = parseInt(timerSelect.value);
    correctWords = 0;
    incorrectWords = 0;
    typedCharacters = 0;
    correctCharacters = 0;
    currentWordIndex = 0;
    currentCharIndex = 0;
    testContainer.classList.remove("hidden");
    resultsContainer.classList.add("hidden");
    resultElement.classList.add("hidden");
    displayWords();
    
    timerDisplay.textContent = `${timer}`;
    wpmDisplay.textContent = "0";
    accuracyDisplay.textContent = "100%";
    wordCountDisplay.textContent = "0";
    restartButton.classList.remove("hidden");
    restartButton.classList.add("opacity-50");
    startText.style.display = "block";
    caretElement.style.opacity = "0";
}

document.getElementById("share-results-button")?.addEventListener("click", () => {
    const wpm = document.getElementById("result-wpm")?.textContent;
    const accuracy = document.getElementById("result-accuracy")?.textContent;
    const shareText = `I just scored ${wpm} WPM with ${accuracy} accuracy on Keyosk Typing Test!`;
    
    if (navigator.share) {
        navigator.share({
            title: 'Keyosk Typing Test Results',
            text: shareText,
            url: window.location.href
        })
        .catch(error => {
            copyToClipboard(shareText);
        });
    } else {
        copyToClipboard(shareText);
    }
});

function copyToClipboard(text: string): void {
    navigator.clipboard.writeText(text)
        .then(() => {
            alert("Results copied to clipboard!");
        })
        .catch(err => {
            console.error('Failed to copy: ', err);
        });
}


