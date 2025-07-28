<!-- FOOTER Start -->
<div class="newlatter wow fadeInUp animated" data-wow-delay="690ms">
    <div class="container-fluid">
      <div class="newslatter-wrapper">
        <!-- Join Us -->
        <div class="mb-5 text-center">
          <!-- <h3 class="text-primary mb-3"> </h3> -->
          <h3 class="fw-500 white mb-3 text-white text-capitalize">
            Empowering minds to unlock <span class="text-warning">Full Potential</span>
          </h3>
          <p class="mb-0 text-white w-100 text-center mx-auto">Join us on a journey of learning, growth, and
            limitless possibilities.
            Whether it's education, support, or opportunity — we're here to guide and empower.
          </p>
        </div>
        <div class="row row-gap-4">
          <div class="col-lg-6">
            <div class="d-flex gap-16 mt-2 mb-2">
              <h2 class="fw-bold mb-3 text-white text-center fs-1">Join <span class="text-primary">Us</span></h2>
              <a href="#"><button class="cus-btn bg-white"><span class="text light-black">Donate
                    Now</span></button></a>
            </div>

            <p class="lead text-white">We invite partnerships with government bodies, corporate entities, and
              development
              organizations to expand our reach and deliver impactful programs across the nation.
            </p>
            <p class="fw-bold text-white">Together, let us create a skilled, empowered, and sustainable India.</p>
          </div>
          <div class="col-lg-6">
            <div class="news-form mt-1">
              <!-- Contact form content paragraph -->
              <p class="text-white mb-3">
                We'd love to hear from you! Fill out the form below and we'll get in touch.
              </p>

              <!-- Contact form -->
              <form class="row g-3">
                <div class="col-md-6">
                  <input type="text" class="form-control" placeholder="Your Name" required>
                </div>
                <div class="col-md-6">
                  <input type="email" class="form-control" placeholder="Your Email" required>
                </div>
                <div class="col-md-6">
                  <input type="tel" class="form-control" placeholder="Mobile Number" required>
                </div>
                <div class="col-md-6">
                  <input type="text" class="form-control" placeholder="Mobile Number" required>
                </div>
                <div class="col-md-6 form-check">
                  <input class="form-check-input" type="checkbox" id="philanthropistCheck">
                  <label class="form-check-label text-white" for="philanthropistCheck">
                    Register as a Philanthropist or Sponsor
                  </label>
                </div>
                <div class="col-12">
                  <button type="submit" class="btn cus-btn bg-white">Submit</button>
                </div>
              </form>
            </div>
          </div>


        </div>
      </div>
    </div>
  </div>
  <footer>
    <div class="container-fluid">
      <div class="row row-gap-5 mb-64">
        <div class="col-lg-4">
          <img src="{{ asset($defaultSettings->site_logo ?? null)}}" class="footer-logo mb-16" alt="">
          <p class="dark-gray mb-32">{{ $defaultSettings->about_description ?? null}}</p>
        </div>
        <div class="col-lg-8">
          <div class="link-wrapper">
            <div>
              <h5 class="fw-500 mb-24">USEFUL LINKS</h5>
              <ul class="unstyled">
                <li class="link mb-12"><a href="/"><i class="fa fa-arrow-alt-circle-right"></i> Home</a></li>
                <li class="link mb-12"><a href="/about"><i class="fa fa-arrow-alt-circle-right"></i> About Us</a></li>
                <li class="link mb-12"><a href="/contact"><i class="fa fa-arrow-alt-circle-right"></i> Contact Us</a></li>
                <li class="link mb-12"><a href="#"><i class="fa fa-arrow-alt-circle-right"></i> Donate Now</a></li>
                <li class="link mb-12"><a href="#"><i class="fa fa-arrow-alt-circle-right"></i> NTI
                    Competetions/Events</a>
                </li>
              </ul>
            </div>
            <div>
              <h5 class="fw-500 mb-24">USEFUL LINKS</h5>
              <ul class="unstyled">
                <li class="link mb-12"><a href="#"><i class="fa fa-arrow-alt-circle-right"></i> Initiatives</a></li>
                <li class="link mb-12"><a href="#"><i class="fa fa-arrow-alt-circle-right"></i> Sectors</a></li>
                <li class="link mb-12"><a href="#"><i class="fa fa-arrow-alt-circle-right"></i> Collaborations</a>
                </li>
                <li class="link mb-12"><a href="#"><i class="fa fa-arrow-alt-circle-right"></i> Resources</a></li>
                <li class="link mb-12"><a href="#"><i class="fa fa-arrow-alt-circle-right"></i> Global Pathways</a>
                </li>
              </ul>
            </div>
            <div class="">
              <h5 class="fw-600 mb-24">CONTACT DETALIS</h5>
              <div class="d-flex align-items-center gap-8 mb-12">
                <a href="tel:+91{{ $defaultSettings->footer_phone ?? null }}" class="h6 fw-400 black hover-content"> <i
                    class="fa fa-phone text-primary"></i> +(91) {{ $defaultSettings->footer_phone ?? null }}</a>
              </div>
              <div class="d-flex align-items-center gap-8">
                <a href="mailto:{{ $defaultSettings->footer_email }}" class="h6 fw-400 black  hover-content"><i
                    class="fa fa-envelope text-primary"></i> {{ $defaultSettings->footer_email ?? null }}</a>
              </div>
              <div class="d-flex align-items-center gap-8 mt-2">
                <a href="#" class="h6 fw-400 black  hover-content"><i class="fa fa-map-location text-primary"></i>
                  {{ $defaultSettings->footer_address ?? null }}</a>
              </div>
              <!-- Social Media Icons -->
              <div class="d-flex align-items-center gap-3 ms-3 mt-3">
                <a href="{{ $defaultSettings->facebook ?? null}}" target="_blank" class="text-primary fs-5" aria-label="Facebook">
                  <i class="fab fa-facebook-f"></i>
                </a>
                <a href="{{ $defaultSettings->twitter ?? null}}" target="_blank" class="text-primary fs-5" aria-label="Twitter">
                  <i class="fab fa-twitter"></i>
                </a>
                <a href="{{ $defaultSettings->instagram ?? null}}" target="_blank" class="text-primary fs-5" aria-label="Instagram">
                  <i class="fab fa-instagram"></i>
                </a>
                <a href="{{ $defaultSettings->linkedin ?? null}}" target="_blank" class="text-primary fs-5" aria-label="LinkedIn">
                  <i class="fab fa-linkedin-in"></i>
                </a>
                 <a href="{{ $defaultSettings->youtube ?? null}}" target="_blank" class="text-primary fs-5" aria-label="LinkedIn">
                  <i class="fab fa-youtube"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="hr-line mb-36"></div>
      <div class="privacy-text">
        <p>{{ $defaultSettings->footer_copyright ?? null}}</p>
      </div>
    </div>
  </footer>
  <!-- FOOTER End -->
