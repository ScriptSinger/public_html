/* Smooth scroll */
let link = document.querySelectorAll('[data-scroll]');
function smoothScroll(event) {
    event.preventDefault();
    let blockId = this.getAttribute('data-scroll');
    document.querySelector('' + blockId).scrollIntoView({ behavior: "smooth", block: "start" });
}
for (let i = 0; i < link.length; i++) {
    link[i].onclick = smoothScroll;
}
/* upBtn */
let goTopBtn = document.querySelector('.up-top');
window.addEventListener('scroll', trackScroll);
goTopBtn.addEventListener('click', backToTop);
function trackScroll() {
    let scrolled = window.pageYOffset;
    let coords = document.documentElement.clientHeight;

    if (scrolled > coords) {
        goTopBtn.classList.add('up-top-show');
    }
    if (scrolled < coords) {
        goTopBtn.classList.remove('up-top-show');
    }

}
function backToTop() {
    if (window.pageYOffset > 0) {
        window.scrollBy(0, -80);
        setTimeout(backToTop, 0);
    }
}