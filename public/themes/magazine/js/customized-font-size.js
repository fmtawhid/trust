let content = document.getElementById("news-content");
let currentSize = 16; // starting font size in px

function increaseFont() {
    if (currentSize < 24) {
        currentSize += 1;
        content.style.fontSize = currentSize + "px";
    }
}

function decreaseFont() {
    currentSize -= 1;
    if (currentSize < 12) currentSize = 12; // minimum size
    content.style.fontSize = currentSize + "px";
}
