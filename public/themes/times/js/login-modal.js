const openBtn = document.getElementById("openModal");
const openBtn_ = document.getElementById("openModal_");
const closeBtn = document.getElementById("closeModal");
const loginRequiredBtn = document.getElementById("loginRequiredBtn");
const loginReplyButtons = document.querySelectorAll(".loginReplyRequiredBtn");
const modal = document.getElementById("loginModal");

if (modal) { 
    if (openBtn) {
        openBtn.addEventListener("click", () => {
            modal.classList.remove("hidden");
            modal.classList.add("flex");
            document.body.classList.add("overflow-hidden");
        });
    }

    if (openBtn_) {
        openBtn_.addEventListener("click", () => {
            modal.classList.remove("hidden");
            modal.classList.add("flex");
            document.body.classList.add("overflow-hidden");
        });
    }
    
    if (loginRequiredBtn) {
        loginRequiredBtn.addEventListener("click", () => {
            modal.classList.remove("hidden");
            modal.classList.add("flex");
            document.body.classList.add("overflow-hidden");
        });
    }
    
    if (loginReplyButtons.length > 0) {
        loginReplyButtons.forEach(button => {
            button.addEventListener("click", () => {
                if (modal) {
                    modal.classList.remove("hidden");
                    modal.classList.add("flex");
                    document.body.classList.add("overflow-hidden");
                }
            });
        });
    }

    if (closeBtn) {
        closeBtn.addEventListener("click", () => {
            modal.classList.remove("flex");
            modal.classList.add("hidden");
            document.body.classList.remove("overflow-hidden");
        });
    }

    window.addEventListener("click", (e) => {
        if (e.target === modal) {
            modal.classList.remove("flex");
            modal.classList.add("hidden");
            document.body.classList.remove("overflow-hidden");
        }
    });
}