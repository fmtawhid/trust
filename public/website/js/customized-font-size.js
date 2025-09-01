let content = document.getElementById("news-content");
let currentSize = 16;

function updateStyles() {
    content.style.setProperty("font-size", currentSize + "px", "important");
    content.style.setProperty("line-height", (currentSize * 1.5) + "px", "important");

    const allElements = content.querySelectorAll("*");
    allElements.forEach(el => {
        el.style.setProperty("font-size", currentSize + "px", "important");
        el.style.setProperty("line-height", (currentSize * 1.5) + "px", "important");
    });
}

function increaseFont() {
    if (currentSize < 24) {
        currentSize += 1;
        updateStyles();
    }
}

function decreaseFont() {
    currentSize -= 1;
    if (currentSize < 12) currentSize = 12;
    updateStyles();
}
