// grid and list view and load data for category
const loadMoreBtn = document.getElementById("load-more-btn");
if (loadMoreBtn) {
    loadMoreBtn.addEventListener("click", function () {
        const button = this;
        const offset = parseInt(button.getAttribute("data-offset"));
        const categoryId = button.getAttribute("data-category-id");
        const categoryStyle = button.getAttribute("data-view-style");
        const url = categoryLoadMoreUrl;
        const token = $('input[name="_token"]').val();
        const noMoreMessage = document.getElementById("no-more-news-message");

        button.disabled = true;
        button.textContent = "Loading...";

        fetch(url, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": token,
            },
            body: JSON.stringify({
                offset: offset,
                category_id: categoryId,
                category_style: categoryStyle,
            }),
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.html_grid && data.html_list) {
                    const grid = document.querySelector("#news-grid");
                    grid.insertAdjacentHTML("beforeend", data.html_grid);

                    const list = document.querySelector("#news-list");
                    list.insertAdjacentHTML("beforeend", data.html_list);

                    button.setAttribute("data-offset", offset + data.count);

                    if (!data.hasMore) {
                        button.remove();
                        grid.classList.remove("before:bg-gradient-to-t");
                    } else {
                        button.disabled = false;
                        button.textContent = "Load More";
                    }
                } else {
                    button.remove();
                    if (noMoreMessage) {
                        noMoreMessage.classList.remove("hidden");
                    }
                }
            })
            .catch((error) => {
                console.error("Error loading news:", error);
                button.disabled = false;
                button.textContent = "Load More";
            });
    });
}

// grid and list view and load data for video
const loadMoreVideoBtn = document.getElementById("load-more-video-news-btn");
if (loadMoreVideoBtn) {
    loadMoreVideoBtn.addEventListener("click", function () {
        const button = this;
        const offset = parseInt(button.getAttribute("data-offset"));
        const url = videoLoadMoreUrl;
        const token = $('input[name="_token"]').val();
        const noMoreMessage = document.getElementById("no-more-news-message");

        button.disabled = true;
        button.textContent = "Loading...";

        fetch(url, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": token,
            },
            body: JSON.stringify({
                offset: offset,
            }),
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.html_grid && data.html_list) {
                    const grid = document.querySelector("#news-grid");
                    grid.insertAdjacentHTML("beforeend", data.html_grid);

                    const list = document.querySelector("#news-list");
                    list.insertAdjacentHTML("beforeend", data.html_list);

                    button.setAttribute("data-offset", offset + data.count);

                    if (!data.hasMore) {
                        button.remove();
                        grid.classList.remove("before:bg-gradient-to-t");
                    } else {
                        button.disabled = false;
                        button.textContent = "Load More";
                    }
                } else {
                    button.remove();
                    if (noMoreMessage) {
                        noMoreMessage.classList.remove("hidden");
                    }
                }
            })
            .catch((error) => {
                console.error("Error loading news:", error);
                button.disabled = false;
                button.textContent = "Load More";
            });
    });
}
