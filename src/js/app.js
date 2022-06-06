import '../scss/app.scss';
import Swiper from 'swiper/bundle';
import { Fancybox, Carousel, Panzoom } from "@fancyapps/ui";
import "@fancyapps/ui/dist/fancybox.css";
// import styles bundle
import 'swiper/css/bundle';
function requireAll(r) {
  r.keys().forEach(r);
}
requireAll(require.context('../images/svg/', true, /\.svg$/));
function closest(node, elem) {
  if (node === elem) return true;
  if (node == null) return false;
  return closest(node.parentNode, elem);
}


window.addEventListener('load', () => {

  const galleryThumb = new Swiper('.js-gallery-thumbs', {
    spaceBetween: 13,
    slidesPerView: 3,
    watchSlidesProgress: true,
    pagination: {
      el: '.swiper-pagination',
      type: 'bullets',
    },
  })
  const galleryMain = new Swiper('.js-gallery-main', {
    spaceBetween: 0,
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    thumbs: {
      swiper: galleryThumb,
    },
  })

  const frontSlider = new Swiper('.js-front-slider', {
    slidesPerView: 'auto',
    effect: 'fade',
    fadeEffect: {
      crossFade: true
    },
    pagination: {
      el: '.swiper-pagination',
      type: 'bullets',
    },
  })
})


class Menu {
  constructor() {
    this.menu = document.querySelector('.js-header-nav')
    this.btn = document.querySelector('.js-nav-btn')

    this.listener();

  }
  open() {
    document.documentElement.classList.add('lock')
    this.menu.classList.add('active');
    this.btn.classList.add('open');
    this.state = true;
  
  }
  close() {
    document.documentElement.classList.remove('lock')
    this.menu.classList.remove('active');
    this.btn.classList.remove('open');
    this.state = false;

  }

  listener() {
    document.addEventListener('click', (e) => {
      if (closest(e.target, this.btn) && !this.state) {
        this.open()
      } else if (!closest(e.target, this.menu) || closest(e.target, this.btn)) {
        this.close();
      }
      this.state ? this.btn.classList.add('open') : this.btn.classList.remove('open');
    });
  }
}

new Menu()
const dropdownItem = document.querySelectorAll('.js-activated .arrow')
let isOpen = false;
document.addEventListener('click', (e) => {
  dropdownItem.forEach(elem => {
    if (!isOpen && closest( e.target, elem)) {
      elem.parentNode.nextElementSibling.classList.add('active')
      isOpen = true;
    } else if (isOpen && closest(e.target, elem)) {
      elem.parentNode.nextElementSibling.classList.remove('active')
      isOpen = false;

    }
  })

})