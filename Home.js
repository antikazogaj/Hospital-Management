// nav toggle per pajisje mobile//
const navToggle = document.querySelector("#navToggle");
const navigation = document.querySelector("nav");

if (navToggle) {
  navToggle.addEventListener("click", () => {
    navigation.classList.toggle("open");
  });
}

// numrat e stats per animacione//
const counters = document.querySelectorAll(".number");

const animateCounters = () => {
  counters.forEach(counter => {
    const target = +counter.getAttribute("data-target");
    const speed = 50; // sa shpejt te ngrihet numri
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

// Nis animacioni kur seksioni behet i dukshem (ne ekran)//
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

// ------------------- SLIDER I THJESHTE (opsional) -------------------//
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
