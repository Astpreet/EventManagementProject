let menu = document.querySelector('#menu-bars');
let navbar = document.querySelector('.navbar');

menu.onclick = () =>{
  menu.classList.toggle('fa-times');
  navbar.classList.toggle('active');
}

let themeToggler = document.querySelector('.theme-toggler');
let toggleBtn = document.querySelector('.toggle-btn');

toggleBtn.onclick = () =>{
  themeToggler.classList.toggle('active');
}


window.onscroll = () =>{
    menu.classList.remove('fa-times');
    navbar.classList.remove('active');
    themeToggler.classList.toggle('active');
}
document.querySelectorAll('.theme-toggler .theme-btn').forEach(btn =>{
  
    btn.onclick = () =>{
      let color = btn.style.background;
      document.querySelector(':root').style.setProperty('--main-color', color);
    }
  
  });
var swiper = new Swiper(".home-slider", {
    effect: "coverflow",
    grabCursor: true,
    centeredSlides: true,
    slidesPerView: "auto",
    coverflowEffect: {
      rotate: 0,
      stretch: 0,
      depth: 100,
      modifier: 2,
      slideShadows: true,
    },
    loop:true,
    autoplay:{
        delay: 3000,
        disableOnInteraction:false,
      }
  });
  var swiper = new Swiper(".reviews-slider", {
    grabCursor: true,
    loop:true,
    spaceBetween: 10,
    autoplay:{
      delay: 5000,
      disableOnInteraction:false,
    },
    breakpoints: {
      0: {
          slidesPerView: 1,
      },
      700: {
        slidesPerView: 2,
      },
      1050: {
        slidesPerView: 3,
      },    
    }
});


document.addEventListener('DOMContentLoaded', function () {
    const loginBtn = document.querySelector('.login-btn');
    const loginForm = document.querySelector('.login');

    loginBtn.addEventListener('click', function () {
        loginForm.classList.toggle('show');
    });

   
    window.addEventListener('click', function (event) {
        if (!event.target.matches('.login-btn') && !event.target.closest('.login')) {
            loginForm.classList.remove('show');
        }
    });
});
function goToCheckout() {
    window.location.href = 'checkout.html';
}



document.getElementById('contactUsBtn').addEventListener('click', function() {
   
    document.getElementById('contact').scrollIntoView({ behavior: 'smooth' });

    
});

function handleBooking() {
    document.body.classList.add('booking-success');
}

function showPaymentForm() {
    updateTotalAmount();
    const paymentForm = document.getElementById('paymentForm');
    

    const rotatingText = document.getElementById('rotatingText');
    paymentForm.style.display = 'block';
            
    rotatingText.style.display = 'none';
    document.getElementById('scrollButton').style.display = 'block';
}

function updateTotalAmount() {
    const eventType = document.getElementById('event-type').value;
    let totalAmount = 0;

    switch (eventType) {
        case 'wedding':
            totalAmount = 450.99;
            break;
        case 'birthday':
            totalAmount = 250.99;
            break;
        case 'concert':
            totalAmount = 650.99;
            break;
        case 'other':
            totalAmount = 850.99;
            break;
        default:
            break;
    }

    document.getElementById('totalAmount').textContent = `Total Amount: $${totalAmount.toFixed(2)}`;
}


function scrollPage() {
    window.scrollBy({
        top: window.innerHeight,
        behavior: 'smooth'
    });
}
document.addEventListener('DOMContentLoaded', function () {
    const stars = document.querySelectorAll('.star');
    const submitBtn = document.getElementById('submitBtn');

    let selectedRating = 0;

    stars.forEach(star => {
        star.addEventListener('click', function () {
            const rating = parseInt(star.getAttribute('data-rating'));
            setRating(rating);
        });
    });

    submitBtn.addEventListener('click', function () {
        const name = document.getElementById('name').value;
        const experience = document.getElementById('experience').value;

        
        console.log("Name:", name);
        console.log("Rating:", selectedRating);
        console.log("Experience:", experience);

        
        alert('Review submitted successfully!');
    });

    function setRating(rating) {
        selectedRating = rating;

        stars.forEach(star => {
            const starRating = parseInt(star.getAttribute('data-rating'));
            star.innerHTML = starRating <= rating ? '★' : '☆';
        });
    }
});
document.addEventListener('DOMContentLoaded', function () {
    const addReviewButton = document.getElementById('add-review-button');

    addReviewButton.addEventListener('click', function () {
        window.location.href = 'review.html';
    });
});