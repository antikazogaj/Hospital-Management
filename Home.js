// ------------------- NAV TOGGLE (nëse e shton për responsive) -------------------
const navToggle = document.querySelector("#navToggle");
const navigation = document.querySelector("nav");

if (navToggle) {
  navToggle.addEventListener("click", () => {
    navigation.classList.toggle("open");
  });
}

// ------------------- STATS NUMBER ANIMATION -------------------
const counters = document.querySelectorAll(".number");

const animateCounters = () => {
  counters.forEach(counter => {
    const target = +counter.getAttribute("data-target");
    const speed = 50; // sa shpejt të ngrihet numri
    let count = 0;

    const updateCount = () => {
      if (count < target) {
        count += Math.ceil(target / 100); // rritje graduale
        counter.textContent = count;
        setTimeout(updateCount, speed);
      } else {
        counter.textContent = target;
      }
    };

    updateCount();
  });
};

// start animation when section becomes visible
const statsSection = document.querySelector("#stats");

const observer = new IntersectionObserver(
  (entries) => {
    if (entries[0].isIntersecting) {
      animateCounters();
      observer.disconnect();
    }
  },
  { threshold: 0.5 }
);

if (statsSection) {
  observer.observe(statsSection);
}

// ------------------- OPTIONAL SIMPLE SLIDER (nëse vendos më vonë) -------------------
function initSimpleSlider() {
  const slides = document.querySelectorAll(".slide");
  let index = 0;

  if (slides.length === 0) return;

  function showSlide(i) {
    slides.forEach((s, idx) => {
      s.style.display = idx === i ? "block" : "none";
    });
  }

  setInterval(() => {
    index = (index + 1) % slides.length;
    showSlide(index);
  }, 4000);

  showSlide(index);
}
