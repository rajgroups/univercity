  <!-- PRELOADER START -->
  <div id="preloader">
    <div class="zip-loader">
      {{-- <img src="{{ asset('resource/web/assets/media/zip-loader.gif')}}" alt="Loading..." /> --}}
      <img src="{{ asset($defaultSettings->loader_image)  ?? null }}" alt="Loading..." />
    </div>
  </div>
  
  <!-- PRELOADER END -->

  <style>
    #preloader {
      position: fixed;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      z-index: 9999;
      background-color: #fff;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .zip-loader img {
      width: 100px;
      /* adjust size as needed */
      height: auto;
    }

    @media (max-width: 767.98px) {
      .col-md-4.d-flex.align-items-center.gap-3.order-2.order-md-1.justify-content-center.justify-content-md-start {
        display: flex !important;
        margin-top: 10px;
      }

      .justify-content-between-sm {
        justify-content: space-between !important;
      }

      .text-center-sm {
        text-align: center;
      }

      .d-none-tblet {
        display: none;
      }
    }

    @media only screen and (min-width: 768px) {
      .d-lg-block-one {
        display: none;
      }

      @media only screen and (min-width: 992px) {
        .d-lg-block-one {
          display: inline-block;
        }
      }
    }

    .swiper {
      width: 100%;
      padding-top: 50px;
      padding-bottom: 50px;
    }

    .swiper-slide {
      background-position: center;
      background-size: cover;
      width: 300px;
      height: auto;
    }

    .swiper-slide img {
      display: block;
      width: 100%;
    }
  </style>