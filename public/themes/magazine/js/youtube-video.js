let players = [];

function onYouTubeIframeAPIReady() {
    const containers = document.querySelectorAll(".youtube__video__container");

    containers.forEach((container, index) => {
        const iframe = container.querySelector(".youtube__player");
        iframe.id = `youtubePlayer-${index}`; // assign unique ID for API

        // Create YT Player
        players[index] = new YT.Player(iframe.id, {
            events: {
                onReady: () => setupControls(container, players[index]),
                onStateChange: (event) => handleStateChange(container, event),
            },
        });
    });
}

function setupControls(container, player) {
    const playButton = container.querySelector(".custom__play__button");
    const playIcon = container.querySelector(".play__icon");
    const pauseIcon = container.querySelector(".pause__icon");

    playButton.addEventListener("click", () => {
        const state = player.getPlayerState();
        if (state === YT.PlayerState.PLAYING) {
            player.pauseVideo();
        } else {
            player.playVideo();
        }
    });
}

function handleStateChange(container, event) {
    const playIcon = container.querySelector(".play__icon");
    const pauseIcon = container.querySelector(".pause__icon");
    const thumbnail = container.querySelector(".video__thumbnail");

    if (event.data === YT.PlayerState.PLAYING) {
        playIcon.classList.add("hidden");
        pauseIcon.classList.remove("hidden");
        if (thumbnail) {
            thumbnail.style.opacity = "0";
            setTimeout(() => {
                thumbnail.style.display = "none";
            }, 500);
        }
    } else if (
        event.data === YT.PlayerState.PAUSED ||
        event.data === YT.PlayerState.ENDED
    ) {
        playIcon.classList.remove("hidden");
        pauseIcon.classList.add("hidden");
        if (thumbnail) {
            thumbnail.style.display = "block";
            setTimeout(() => {
                thumbnail.style.opacity = "1";
            }, 0);
        }
    }
}
