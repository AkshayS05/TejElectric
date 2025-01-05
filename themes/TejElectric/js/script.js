document.addEventListener("DOMContentLoaded", function () {
  console.log("DOM fully loaded and parsed.");

  // The container that moves (translated) to show each slide:
  const slidesContainer = document.querySelector(".hero-slider .slides");
  // Each individual slide element:
  const slides = document.querySelectorAll(".hero-slider .slide");
  // Button elements:
  const prevButton = document.querySelector(".slider-controls .prev");
  const nextButton = document.querySelector(".slider-controls .next");

  // Total number of slides:
  const slideCount = slides.length;
  let currentIndex = 0;

  // Validate required elements:
  if (!slidesContainer || slideCount === 0 || !prevButton || !nextButton) {
    console.error("Slider elements are missing or incorrect!");
    return;
  }

  // Optional: Ensure the container is wide enough for all slides (if needed)
  // slidesContainer.style.width = `${slideCount * 100}%`;

  // Smooth transitions via CSS (if not already set in stylesheet):
  slidesContainer.style.display = "flex";
  slidesContainer.style.transition = "transform 0.5s ease-in-out";

  // Ensure each slide is 100% of the slider width (if not in CSS):
  slides.forEach((slide) => {
    slide.style.flex = "0 0 100%";
  });

  function updateSlider() {
    // Move the container so that the current slide is in view:
    const offset = -currentIndex * 100;
    slidesContainer.style.transform = `translateX(${offset}%)`;
    console.log(`Slide moved to index: ${currentIndex}`);
  }

  // Click handlers for "Prev" and "Next"
  prevButton.addEventListener("click", () => {
    currentIndex = currentIndex === 0 ? slideCount - 1 : currentIndex - 1;
    updateSlider();
  });

  nextButton.addEventListener("click", () => {
    currentIndex = currentIndex === slideCount - 1 ? 0 : currentIndex + 1;
    updateSlider();
  });

  // Initialize the slider position
  updateSlider();
});

document.addEventListener("DOMContentLoaded", function () {
  const toggle = document.getElementById("electric-toggle");
  const body = document.body;

  // 1) Check localStorage on page load
  if (localStorage.getItem("darkMode") === "enabled") {
    body.classList.add("dark-mode");
    toggle.checked = true; // visually set switch to "on"
  }

  // 2) When user toggles the switch
  toggle.addEventListener("change", function () {
    if (toggle.checked) {
      // Turn dark mode on
      body.classList.add("dark-mode");
      localStorage.setItem("darkMode", "enabled");
    } else {
      // Turn dark mode off
      body.classList.remove("dark-mode");
      localStorage.setItem("darkMode", "disabled");
    }
  });
});
