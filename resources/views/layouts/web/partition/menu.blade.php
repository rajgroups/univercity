 <!-- Main Wrapper End -->
  <!-- Back To Top Start -->
  <a href="#main-wrapper" id="backto-top" class="back-to-top"><i class="fas fa-angle-up"></i></a>
  <!-- Mobile Menu Start -->
  <div class="mobile-nav__wrapper">
    <div class="mobile-nav__overlay mobile-nav__toggler"></div>
    <div class="mobile-nav__content">
      <span class="mobile-nav__close mobile-nav__toggler"><i class="fa fa-times"></i></span>
      <div class="logo-box">
        <a href="/" aria-label="logo image"><img src="{{ asset($defaultSettings->site_logo ?? null)}}" alt=""></a>
      </div>
      <div class="mobile-nav__container"></div>
       <div class="header-buttons">
            <div class="right-nav d-sm-flex gap-16 align-items-center">
                <a href="{{ route('contact') }}" class="cus-btn mb-4">
                    <span class="text"> Donate Now</span>
                </a>
                <a href="{{ route('web.activity') }}" class="cus-btn-2">
                    <span class="text">NTI Competetions/Events</span>
                </a>
            </div>
        </div>
      <ul class="mobile-nav__contact list-unstyled">
        <li>
          <i class="fas fa-envelope"></i>
          <a href="mailto:{{ $defaultSettings->footer_email ?? null }}">{{ $defaultSettings->footer_email ?? null }}</a>
        </li>
        <li>
          <i class="fa fa-phone-alt"></i>
          <a href="tel:+(91){{ $defaultSettings->footer_phone ?? null }}">+(91) {{ $defaultSettings->footer_phone ?? null }}</a>
        </li>
      </ul>
      <div class="mobile-nav__social">
        <a href="{{ $defaultSettings->twitter ?? null}}"><i class="fa-brands fa-x-twitter"></i></a>
        <a href="{{ $defaultSettings->facebook ?? null}}"><i class="fab fa-facebook"></i></a>
        <a href="{{ $defaultSettings->instagram ?? null}}"><i class="fab fa-instagram"></i></a>
      </div>
    </div>
  </div>
  <!-- Mobile Menu End -->
