    <!-- Jquery Js -->
    <script src="{{ asset('resource/web/assets/js/vendor/bootstrap.min.js')}}"></script>
    <script src="{{ asset('resource/web/assets/js/vendor/jquery-3.6.3.min.js')}}"></script>
    <!-- Chart.js and Plugins -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.2.0"></script>
    <script src="{{ asset('resource/web/assets/js/vendor/slick.min.js')}}"></script>
    <script src="{{ asset('resource/web/assets/js/vendor/wow.js')}}"></script>
    <script src="{{ asset('resource/web/assets/js/vendor/jquery-validator.js')}}"></script>
    <script src="{{ asset('resource/web/assets/js/app.js')}}"></script>
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <!-- Initialize Swiper -->
    <script>
      var swiper = new Swiper(".mySwiper", {
        effect: "coverflow",
        grabCursor: true,
        centeredSlides: true,
        slidesPerView: "auto",
        autoplay: {
          delay: 2500,
          disableOnInteraction: false,
        },
        coverflowEffect: {
          rotate: 50,
          stretch: 0,
          depth: 100,
          modifier: 1,
          slideShadows: true,
        },
        pagination: {
          el: ".swiper-pagination",
        },
      });

      $(function () {
        var tickerLength = $('.carousel-inner-data ul li').length;
        var tickerHeight = $('.carousel-inner-data ul li').outerHeight();
        $('.carousel-inner-data ul li:last-child').prependTo('.carousel-inner-data ul');
        $('.carousel-inner-data ul').css('marginTop', -tickerHeight);

        function moveTop() {
          $('.carousel-inner-data ul').animate({
            top: -tickerHeight
          }, 800, function () {
            $('.carousel-inner-data ul li:first-child').appendTo('.carousel-inner-data ul');
            $('.carousel-inner-data ul').css('top', '');
          });

        }
        setInterval(function () {
          moveTop();
        }, 3000);
      });
    </script>
    <script>
      var swiper = new Swiper(".mySwipers", {
        slidesPerView: 1,
        spaceBetween: 10,
        autoplay: {
          delay: 2500,
          disableOnInteraction: false,
        },
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
        breakpoints: {
          640: {
            slidesPerView: 2,
            spaceBetween: 20,
          },
          768: {
            slidesPerView: 3,
            spaceBetween: 10,
          },
          1024: {
            slidesPerView: 4,
            spaceBetween: 5,
          },
        },
      });

      var swiper = new Swiper(".upcomingproject", {
        slidesPerView: 1,
        spaceBetween: 10,
        autoplay: {
          delay: 2500,
          disableOnInteraction: false,
        },
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
        breakpoints: {
          640: {
            slidesPerView: 2,
            spaceBetween: 20,
          },
          768: {
            slidesPerView: 2,
            spaceBetween: 5,
          },
          1024: {
            slidesPerView: 3,
            spaceBetween: 5,
          },
        },
      });

      var swiper = new Swiper(".mySwiperstwo", {
        slidesPerView: 1,
        spaceBetween: 2,
        grabCursor: true,
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
        autoplay: {
          delay: 5000,
          disableOnInteraction: false,
        },
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
        breakpoints: {
          640: {
            slidesPerView: 2,
            spaceBetween: 20,
          },
          768: {
            slidesPerView: 3,
            spaceBetween: 10,
          },
          1024: {
            slidesPerView: 4,
            spaceBetween: 30,
          },
        },
      });

    </script>
    <script>
      const orbit = document.getElementById("orbit");
      const boxes = orbit.querySelectorAll(".orbiting-box");
      const tl = gsap.timeline({ repeat: -1, defaults: { ease: "none" } });
      tl.to(orbit, { rotate: 360, duration: 30, transformOrigin: "center center" });
      boxes.forEach(box => {
        gsap.to(box, {
          rotate: -360,
          duration: 30,
          repeat: -1,
          ease: "none",
          transformOrigin: "center center"
        });
      });
      orbit.addEventListener("mouseenter", () => {
        tl.pause();
        boxes.forEach(box => gsap.getTweensOf(box)[0]?.pause());
      });
      orbit.addEventListener("mouseleave", () => {
        tl.play();
        boxes.forEach(box => gsap.getTweensOf(box)[0]?.play());
      });

      const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
      [...tooltipTriggerList].forEach(el => new bootstrap.Tooltip(el));
    </script>