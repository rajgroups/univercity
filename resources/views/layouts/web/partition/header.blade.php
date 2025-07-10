  <!-- Cursor Style -->
  <div id="cursor"></div>
  <div id="cursor-border"></div>
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
  <!-- Main Wrapper Start -->
  <div id="scroll-container" class="main-wrapper">
    <!-- Header Menu Start -->
    <div class="header-wrapper">
      <div class="header-top">
        <div class="container-fluid">
          <p class="white"> Indian Skill Institute Co-operation (ISICO)</p>
        </div>
      </div>
      <div class="main-header" style="background-color: #fafafa;border-bottom: 1px solid rgb(202, 202, 202);">
        <div class="container-fluid">
          <div class="row p-2 bg-white text-dark justify-content-between align-items-center">
            <div class="col-md-6 text-center-sm">
              <img src="https://www.skillindiadigital.gov.in/assets/new-ux-img/india-flag.svg" alt="" srcset=""> |
              Indian Skill Institute
            </div>
            <div class="col-md-6 d-flex justify-content-between-sm" style="align-items: center;">
              <p class="p-2 d-none d-lg-block">Skip To Main Content</p>
              <div class="item p-2">
                <i class="bi bi-badge-ad p-2"></i>
              </div>
              <div class="item p-2">
                <i class="bi bi-geo-alt-fill"></i> Chennai
              </div>
              <div class="item p-2 text-light-gray">
                <i class="bi bi-house-fill"></i> Home
              </div>
              <div class="item p-2 text-light-gray">
                <i class="bi bi-three-dots-vertical"></i> More
              </div>
            </div>
          </div>
        </div>
      </div>
      <header class="main-menu">
        <div class="header-section">
          <div class="container-fluid" style="background-color: #fafafa;border-bottom: 0px solid rgb(202, 202, 202);">
            <div class="hero-topbar-block py-2 bg-white"
              style="background-color: #fafafa;border-bottom: 0px solid rgb(202, 202, 202);">
              <div class="row align-items-center justify-content-between gy-2">
                <!-- Search Bar (Always First on Mobile) -->
                <div class="col-12 d-block d-md-none order-1">
                  <div class="input-group">
                    <span class="input-group-text bg-white border-end-0">
                      <i class="fa fa-search"></i>
                    </span>
                    <input type="text" class="form-control border-start-0" placeholder="Search Skill Courses">
                  </div>
                </div>
                <!-- Logos -->
                <div
                  class="col-md-4 d-flex align-items-center gap-3 order-2 order-md-1 justify-content-center justify-content-md-start">
                  <img src="https://www.skillindiadigital.gov.in/assets/new-ux-img/minstry-bigsize-logo.svg"
                    alt="Govt Logo" style="height: 44px;">
                  <img src="https://www.skillindiadigital.gov.in/assets/new-ux-img/skill-india-big-logo.svg"
                    alt="Skill India Logo" style="height: 44px;">
                </div>
                <!-- Search Bar (Visible on md+ screens only) -->
                <div class="col-md-4 my-2 d-none d-md-block order-md-2 mt-2">
                  <div class="input-group mt-2 rounded-1">
                    <span class="input-group-text bg-white border-end-0"><i class="fa fa-search"></i></span>
                    <input type="text" class="form-control border-start-0 p-2" placeholder="Search Skill Courses">
                  </div>
                </div>
                <!-- Right Buttons -->
                <div class="col-md-4 text-end gap-3 order-3 d-none d-md-block">
                  <a href="#" class="btn btn-outline-success btn-sm d-none-tblet d-lg-block-one">
                    <i class="fa fa-tachometer-alt me-1 p-2"></i> Dashboards
                  </a>
                  <button class="btn btn-warning text-white btn-sm fw-bold p-2">REGISTER</button>
                  <button class="btn btn-outline-warning btn-sm fw-bold p-2">LOGIN</button>
                </div>
              </div>
            </div>
          </div>
          <div class="container-fluid">
            <!-- <div class="hero-topbar-block">
                     <div class="row align-items-center">
                       <div class="col-xl-5 col-lg-3 col-1">
                         <a href="index-2.html" class="header-logo d-lg-flex d-none">
                           <img src="assets/media/logo.png" alt="">
                         </a>
                       </div>
                       <div class="col-xl-7 col-lg-9 col-md-11">
                         <div class="d-flex align-items-center gap-24">
                           <div class="dropdown flex-shrink-0">
                             <a href="javascript:void(0);" class="fw-600 black"><svg xmlns="http://www.w3.org/2000/svg" width="33" height="32" viewBox="0 0 33 32" fill="none">
                               <g clip-path="url(#clip0_9539_215)">
                                 <path d="M31.25 5H1.75C1.05963 5 0.5 5.4477 0.5 6C0.5 6.5523 1.05963 7 1.75 7H31.25C31.9404 7 32.5 6.5523 32.5 6C32.5 5.4477 31.9404 5 31.25 5Z" fill="#141516"/>
                                 <path d="M31.25 15H1.75C1.05963 15 0.5 15.4477 0.5 16C0.5 16.5523 1.05963 17 1.75 17H31.25C31.9404 17 32.5 16.5523 32.5 16C32.5 15.4477 31.9404 15 31.25 15Z" fill="#141516"/>
                                 <path d="M31.25 25H1.75C1.05963 25 0.5 25.4477 0.5 26C0.5 26.5523 1.05963 27 1.75 27H31.25C31.9404 27 32.5 26.5523 32.5 26C32.5 25.4477 31.9404 25 31.25 25Z" fill="#141516"/>
                               </g>
                               <defs>
                                 <clipPath>
                                   <rect width="32" height="32" fill="white" transform="translate(0.5)"/>
                                 </clipPath>
                               </defs>
                             </svg>&nbsp;&nbsp;&nbsp;Categories&nbsp;<i
                                 class="fa-solid fa-chevron-down"></i></a>
                             <ul class="sub-menu unstyled">
                               <li><a href="#">Programming & IT</a></li>
                               <li><a href="#">Business & Marketing</a></li>
                               <li><a href="#">Design & Creativity</a></li>
                               <li><a href="#">Copy Writing</a></li>
                               <li><a href="#">Business Studies</a></li>
                             </ul>
                           </div>
                           <form class="searchbar">
                             <svg class="searchbar-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                               viewBox="0 0 20 20" fill="none">
                               <path
                                 d="M17.5 17.5L14.5834 14.5833M16.6667 9.58333C16.6667 13.4954 13.4954 16.6667 9.58333 16.6667C5.67132 16.6667 2.5 13.4954 2.5 9.58333C2.5 5.67132 5.67132 2.5 9.58333 2.5C13.4954 2.5 16.6667 5.67132 16.6667 9.58333Z"
                                 stroke="#92949F" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round" />
                             </svg>
                             <input type="text" name="search" id="searchbar" placeholder="Search for a course">
                           </form>
                         </div>
                       </div>
                     </div>
                     </div> -->
            <div style="border-top: 1px solid #d8d8dc;" class="row align-items-center">
              <div class="col-lg-8 col-6 mt-3">
                <!-- <a href="index-2.html" class="header-logo d-lg-none d-block">
                           <img src="assets/media/logo.png" alt="">
                           </a> -->
                <div
                  class="d-flex align-items-center justify-content-center justify-content-md-end gap-3 order-3 d-block d-md-none">
                  <button class="btn btn-warning text-white btn-sm fw-bold">REGISTER</button>
                  <button class="btn btn-outline-warning btn-sm fw-bold">LOGIN</button>
                </div>
                <nav class="navigation d-md-flex d-none">
                  <div class="menu-button-right">
                    <div class="main-menu__nav">
                      <ul class="main-menu__list">
                        <li>
                          <a href="/" class="active"> Home</a>
                        </li>
                        <li><a href="{{ route('about') }}"> About</a></li>
                        <li class="dropdown">
                          <a href="javascript:void(0);">Initiatives</a>
                          <ul class="sub-menu">
                             <li>
                                <a href="{{ route('programe') }}">1. Digital Programs(For Design)</a>
                             </li>

                             <li>
                                <a href="{{ route('scheme') }}">3. Scheme (For Design)</a>
                             </li>
                              <li>
                                <a href="{{ route('event') }}">4. women Scheme (For Design)</a>
                             </li>
                            <li>
                              <a href="{{ route('programe') }}">1. Educational Programs</a>
                              <ul class="sub-menu mt-5">
                                <li><a href="{{ route('programe') }}">• Schools Program</a></li>
                                <li><a href="#">• Colleges Program</a></li>
                                <li><a href="#">• Digital Learning Program</a></li>
                              </ul>
                            </li>
                            <li>
                              <a href="#">2. Skill Development Programs</a>
                              <ul class="sub-menu mt-5">
                                <li><a href="#">• Sector-Specific Training</a></li>
                                <li><a href="#">• On-the-Job Training (OJT)</a></li>
                                <li><a href="#">• Entrepreneurship Development</a></li>
                                <li><a href="#">• Women’s Skill Development</a></li>
                                <li><a href="#">• Skill Development for PWDs</a></li>
                                <li><a href="#">• Youth Empowerment</a></li>
                              </ul>
                            </li>
                            <li>
                              <a href="#">3. CSR Initiatives</a>
                              <ul class="sub-menu mt-5">
                                <li><a href="#">• Community and Rural Development</a></li>
                                <li><a href="#">• Transforming Rural Schools</a></li>
                                <li><a href="#">• Women’s Self-Help Group Skill Development</a></li>
                                <li><a href="#">• Farmer Producer Organizations (FPO) Awareness and
                                    Development </a>
                                </li>
                              </ul>
                            </li>
                          </ul>
                        </li>
                        <li class="dropdown">
                          <a href="/course"> Sectors </a>
                        </li>
                        <li class="dropdown">
                          <a href="javascript:void(0);">Collaborations</a>
                          <ul>
                            <li><a href="#">• Strategic Partnerships</a></li>
                            <li><a href="#">• Academic collaborations</a></li>
                            <li><a href="#">• Corporate Partnerships</a></li>
                            <li><a href="#">• Government Collaborations</a></li>
                            <li><a href="#">• International Partnerships</a></li>
                          </ul>
                        </li>
                        <li class="dropdown">
                          <a href="javascript:void(0);">Resources </a>
                          <ul>
                            <li><a href="#">• Blogs</a></li>
                            <li><a href="#">• Training Models</a></li>
                            <li><a href="#">• Research & Publications</a></li>
                            <li><a href="#">• Best Practices & Case Studies</a></li>
                          </ul>
                        </li>
                        <li><a href="#">Global Pathways</a></li>
                        <li><a href="{{ route('contact') }}">Contact</a></li>
                        <!-- <li class="dropdown">
                                       <a href="javascript:void(0);">Pages</a>
                                       <ul>
                                         <li><a href="cart.html">Cart</a></li>
                                         <li><a href="checkout.html">Check Out</a></li>
                                         <li><a href="login.html">Login</a></li>
                                         <li><a href="signup.html">Sign Up</a></li>
                                         <li><a href="contact.html">Contact Us</a></li>
                                       </ul>
                                       </li> -->
                      </ul>
                    </div>
                  </div>
                </nav>
              </div>
              <div class="col-lg-4 col-6 p-0 mt-3">
                <div class="header-buttons">
                  <div class="right-nav d-sm-flex gap-16 align-items-center d-none">
                    <a href="courses.html" class="cus-btn">
                      <span class="text"> Donate Now</span>
                    </a>
                    <a href="#" class="cus-btn-2">
                      <span class="text">NTI Competetions/Events</span>
                    </a>
                  </div>
                  <a href="#" class="main-menu__toggler mobile-nav__toggler">
                    <img src="{{ asset('resource/web/assets/media/icons/menu-2.png')}}" alt="">
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </header>
    </div>
    <!-- Header Menu End -->
    <div class="stricky-header stricked-menu">
      <div class="sticky-header__content"></div>
    </div>
