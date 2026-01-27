document.addEventListener("DOMContentLoaded", () => {
	// TEAM Swiper
	const el = document.querySelector(".team-swiper");
	if (el && typeof Swiper !== "undefined") {
	  new Swiper(el, {
		slidesPerView: "auto",
		spaceBetween: 16,
		loop: true,
		autoplay: {
		  delay: 3000,
		  disableOnInteraction: false,
		  pauseOnMouseEnter: true,
		},
		speed: 600,
		pagination: {
		  el: ".team-swiper-pagination",
		  clickable: true,
		},
	  });
	}
  
	// AOS
	if (typeof AOS !== "undefined") {
	  AOS.init({
		duration: 700,
		easing: "ease-out-cubic",
		once: true, 
		offset: 80,        
	  });
	}
  });
  