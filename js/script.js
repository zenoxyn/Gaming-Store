// Animate hero title in
const heroTitle = document.getElementById("heroTitle");
setTimeout(() => {
  heroTitle.classList.remove("opacity-0", "translate-y-4");
  heroTitle.classList.add("transition", "duration-700", "ease-out");
}, 300);

