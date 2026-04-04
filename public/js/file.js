let slider = document.querySelectorAll('.slider .item');
let pagination = document.querySelectorAll('.slider .paginations .pagination');
let prev = document.querySelector('.prev');
let next = document.querySelector('.next');
let menu = document.querySelector('.menu_display');
let links_ss = document.querySelector('.links_ss');
let nav = document.querySelector('.navbar');
let blog = document.querySelectorAll('.blog');
let category = document.querySelectorAll('.category');
let post = document.querySelectorAll('.post');
let menuBtn = document.querySelector('.menu_display');
let closeBtn = document.querySelector('.menu_close');
var prevScrollpos = window.pageYOffset;
var navbar = document.querySelector('.navbar');
const HIDE_OFFSET = -50; // Use a variable for your navbar's height
let active = 0;
let len = slider.length;

prev.addEventListener('click', () => {
  active--;
  if (active < 0) {
    active = len - 1;
  }
  showSlider();
  clearInterval(int);
  int = setInterval(() => {
    next.click();
  }, 3000);
});
next.addEventListener('click', () => {
  active++;
  if (active >= len) {
    active = 0;
  }
  showSlider();
  clearInterval(int);
  int = setInterval(() => {
    next.click();
  }, 5000);
});
let int = setInterval(() => {
  next.click();
}, 5000);
function showSlider() {
  let activeOld = document.querySelector('.slider .item.active');
  let activeOld2 = document.querySelector(
    '.slider .paginations .pagination.active'
  );
  activeOld.classList.remove('active');
  activeOld2.classList.remove('active');

  slider[active].classList.add('active');
  pagination[active].classList.add('active');
}
menu.addEventListener('click', () => {
  links_ss.classList.toggle('show');
});
window.addEventListener('scroll', () => {
  if (window.scrollY > 50) {
    nav.classList.add('hide');
  } else {
    nav.classList.remove('hide');
  }
});
const blogObserver = new IntersectionObserver(
  (entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.classList.add('show');
      } else {
        entry.target.classList.remove('show');
      }
    });
  },
  { threshold: 0.1 }
);
blog.forEach((item) => {
  blogObserver.observe(item);
});
const categoryObserver = new IntersectionObserver(
  (entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.classList.add('show');
      } else {
        entry.target.classList.remove('show');
      }
    });
  },
  { threshold: 0.1 }
);

category.forEach((item) => {
  categoryObserver.observe(item);
});

const postObserver = new IntersectionObserver((entries) => {
  entries.forEach((entry) => {
    if (entry.isIntersecting) {
      entry.target.classList.add('show');
    } else {
      entry.target.classList.remove('show');
    }
  });
});

post.forEach((item) => {
  postObserver.observe(item);
});

menuBtn.addEventListener('click', () => {
  links_ss.classList.toggle.apply('show');
});

if (navbar) {
  navbar.style.top = '0';

  window.onscroll = function () {
    var currentScrollPos = window.pageYOffset;

    // **Dynamic Logic Addition:** If the user is at the very top (e.g., scroll position < 10)
    // ensure the navbar is always visible and reset tracking.
    if (currentScrollPos < 10) {
      navbar.style.top = '0';
      prevScrollpos = currentScrollPos; // Reset tracking
      return; // Exit the function early
    }

    // Standard Scroll Logic (Show on Down, Hide on Up)
    if (prevScrollpos > currentScrollPos) {
      // Scrolling UP -> HIDE
      navbar.style.top = HIDE_OFFSET + 'px';
    } else {
      // Scrolling DOWN -> SHOW
      navbar.style.top = '0';
    }

    // **THIS IS THE KEY LINE THAT MAKES IT DYNAMIC**
    prevScrollpos = currentScrollPos;
  };
}