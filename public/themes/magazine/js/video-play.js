//Video Script
/* document.querySelectorAll(".video-container").forEach((container) => {
    const video = container.querySelector("video");
    const playBtn = container.querySelector(".play-button");
    const playIcon = container.querySelector("#playIcon");
    const pauseIcon = container.querySelector("#pauseIcon");

    playBtn.addEventListener("click", () => {
        if (video.paused) {
            video.play();
            playIcon.classList.add("hidden");
            pauseIcon.classList.remove("hidden");
        } else {
            video.pause();
            playIcon.classList.remove("hidden");
            pauseIcon.classList.add("hidden");
        }
    });

    video.addEventListener("ended", () => {
        playIcon.classList.remove("hidden");
        pauseIcon.classList.add("hidden");
    });
});
 */

document.querySelectorAll(".video-container").forEach((container) => {
    const video = container.querySelector("video");
    const playBtn = container.querySelector(".play-button");

    playBtn.addEventListener("click", () => {
        video.play();
        playBtn.classList.add("hidden");
        playIcon.classList.add("hidden");
    });

    video.addEventListener("ended", () => {
        playBtn.classList.remove("hidden");
        playIcon.classList.remove("hidden");
    });
});
