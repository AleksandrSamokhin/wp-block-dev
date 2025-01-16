const initSlider = () => {
  const blocks = document.querySelectorAll(".wp-block-dev-slider")

  if (blocks.length < 0) return

  blocks.forEach(block => {
    const swiperOptions = block.getAttribute("data-swiper-options")
    const parsedOptions = JSON.parse(swiperOptions)

    const swiperPrevButton = block.querySelector(".swiper-button-prev")
    const swiperNextButton = block.querySelector(".swiper-button-next")
    const swiperPagination = block.querySelector(".swiper-pagination")

    const swiperConfig = {
      loop: false,
      autoplay: {
        delay: 5000
      },
      spaceBetween: 30,
      breakpoints: {
        640: {
          slidesPerView: 1
        }
      },
      modules: []
    }

    if (parsedOptions.slidesPerView) {
      swiperConfig.breakpoints = {
        640: {
          slidesPerView: 1
        },
        768: {
          slidesPerView: parsedOptions.slidesPerView
        }
      }
    }

    if (parsedOptions.autoplay) {
      swiperConfig.modules.push(SwiperAutoplay)
    }

    if (parsedOptions.loop) {
      swiperConfig.loop = parsedOptions.loop
    }

    if (parsedOptions.navigation) {
      swiperConfig.modules.push(SwiperNavigation)
      swiperConfig.navigation = {
        nextEl: swiperPrevButton,
        prevEl: swiperNextButton
      }
    }

    if (parsedOptions.pagination) {
      swiperConfig.modules.push(SwiperPagination)
      swiperConfig.pagination = {
        el: swiperPagination,
        clickable: true
      }
    }

    const swiper = new Swiper(block, swiperConfig)
  })
}

document.addEventListener("DOMContentLoaded", () => {
  initSlider()
})
