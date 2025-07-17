/*home slider*/
var swiper = new Swiper(".blogs-slider", {
	autoplay: {
		delay: 4500,
		disableOnInteraction: false,
	},
	grabCursor: true,
	loop: true,
	spaceBetween: 20,
	centeredSlides: true,
	pagination: {
		el: '.swiper-pagination',
		clickable: true,
	},
	breakpoints: {
		0:{
			slidesPerView: 1,
		},
		768:{
			slidesPerView: 2,
		},
		991:{
			slidesPerView: 3,
		},
	},
});