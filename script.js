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
document.addEventListener('DOMContentLoaded', function() {
    const wishlistButtons = document.querySelectorAll('.wishlist-toggle');
    if (wishlistButtons.length === 0) return; // 没有就不做任何事

    wishlistButtons.forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.dataset.productId;
            fetch('wy_wishlist_toggle.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `product_id=${productId}`
            })
            .then(res => res.text())
            .then(status => {
                status = status.trim();
                if (status === "added") {
                    this.innerHTML = '<i class="fas fa-heart heart-icon"></i>';
                } else if (status === "removed") {
                    this.innerHTML = '<i class="far fa-heart heart-icon"></i>';
                } else {
                    alert('Failed to toggle wishlist. Please try again.');
                }
            })
            .catch(err => {
                console.error("Fetch error:", err);
                alert('Network error. Please try again.');
            });
        });
    });
});
function ensureLoggedIn(redirectUrl = 'wy_login.php') {
    if (!isLoggedIn) {
        return confirm("You need to log in. Go to login page?") ? window.location.href = redirectUrl : false;
    }
    return true;
}