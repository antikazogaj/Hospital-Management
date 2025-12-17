

document.addEventListener("DOMContentLoaded", () => {
    // Merr te gjitha news cards
    const newsCards = document.querySelectorAll(".news-card");

    // Shtojme klikim ne secilen card per zgjerim te info
    newsCards.forEach(card => {
        card.addEventListener("click", () => {
            const title = card.querySelector("h2").textContent;
            const content = card.querySelector("p").textContent;
            alert(`News Selected:\n\n${title}\n\n${content}`);
        });
    });

   
});

// 2. Validimi i elementeve te thjeshta
// Kjo siguron qe çdo news-card ka nje titull, nje imazh dhe date
document.querySelectorAll(".news-card").forEach(card => {
    const img = card.querySelector("img");
    const title = card.querySelector("h2");
    const date = card.querySelector("time");

    if (!img || !title || !date) {
        console.warn("Warning: A news-card is missing required elements!", card);
    }
});


