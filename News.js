/// =======================
// News.js
// =======================

// 1. Funksionalitet bazik për "Read More" (opsional në të ardhmen)
// Kjo nuk ekziston në HTML tani, por mund të shtohet thjesht duke shtuar:
// <a href="#" class="btn-read">Read More</a> në çdo news-card

document.addEventListener("DOMContentLoaded", () => {
    // Merr të gjitha news cards
    const newsCards = document.querySelectorAll(".news-card");

    // Shtojmë klikim në secilën card për alert ose për zgjerim të info
    newsCards.forEach(card => {
        card.addEventListener("click", () => {
            const title = card.querySelector("h2").textContent;
            const content = card.querySelector("p").textContent;
            alert(`News Selected:\n\n${title}\n\n${content}`);
        });
    });

    // Opsionale: mund të shtosh "Read More" modal më vonë
});

// 2. Validimi i elementeve të thjeshta
// Kjo siguron që çdo news-card ka një titull, një imazh dhe datë
document.querySelectorAll(".news-card").forEach(card => {
    const img = card.querySelector("img");
    const title = card.querySelector("h2");
    const date = card.querySelector("time");

    if (!img || !title || !date) {
        console.warn("Warning: A news-card is missing required elements!", card);
    }
});


