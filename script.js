const bar = document.getElementById('bar');
const close = document.getElementById('close');
const nav = document.getElementById('navbar');

if (bar) {
    bar.addEventListener('click', () => {
        nav.classList.add('active');
    })
}

if (close) {
    close.addEventListener('click', () => {
        nav.classList.remove('active');
    })
}

/* === Nav Bar behavior=== */
window.addEventListener("scroll", function () {
  const header = document.querySelector("#header");
  if (window.scrollY > 50) {
    header.classList.add("scrolled");
  } else {
    header.classList.remove("scrolled");
  }
});

/* === HERO SECTION Slider behavior=== */
const slider = document.querySelector('.slider');
const dots = document.querySelectorAll('.dot');
const totalSlides = dots.length;
let currentIndex = 0;
let interval;

function goToSlide(index) {
  slider.scrollTo({
    left: index * slider.clientWidth,
    behavior: 'smooth'
  });
  updateDots(index);
  currentIndex = index;
}

function updateDots(index) {
  dots.forEach(dot => dot.classList.remove('active'));
  dots[index].classList.add('active');
}

function autoSlide() {
  interval = setInterval(() => {
    currentIndex = (currentIndex + 1) % totalSlides;
    goToSlide(currentIndex);
  }, 5000);
}

autoSlide();
