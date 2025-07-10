@extends('layouts.web.app')
@section('content')

            <!-- Yout Content Here -->
            <div class="container-fluid mt-5">
                <div class="row">
                    <div class="col-md-12 col-lg-6">
                        <div id="prodetailsslider" class="carousel slide" data-bs-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-bs-target="#carouselId" data-bs-slide-to="0" class="active" aria-current="true"
                                    aria-label="First slide"></li>
                                <li data-bs-target="#carouselId" data-bs-slide-to="1" aria-label="Second slide"></li>
                                <li data-bs-target="#carouselId" data-bs-slide-to="2" aria-label="Third slide"></li>
                            </ol>
                            <div class="carousel-inner" role="listbox">
                                <div class="carousel-item active">
                                    <img src="https://iso.500px.com/wp-content/uploads/2019/11/Man-doing-postproduction-of-his-photos-on-laptop-at-night-By-Carina-Konig-1500x1000.jpg"
                                        class="w-100 d-block" alt="First slide" />
                                </div>
                                <div class="carousel-item">
                                    <img src="https://www.qualitymag.com/ext/resources/Issues/2023/June/Management/QM0623-FEAT-manage-p1FT-qspan_fwd-center_demo2_500px.webp"
                                        class="w-100 d-block" alt="Second slide" />
                                </div>
                                <div class="carousel-item">
                                    <img src="https://iso.500px.com/wp-content/uploads/2019/11/Man-doing-postproduction-of-his-photos-on-laptop-at-night-By-Carina-Konig-1500x1000.jpg"
                                        class="w-100 d-block" alt="Third slide" />
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselId"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselId"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6">
                        <div class="card text-start">
                            <!-- <img class="card-img-top" src="holder.js/100px180/" alt="Title" /> -->
                            <div class="card-body">
                                <div class="pt-3 pb-3 course-info">
                                    <h4 class="card-title">Finance For All</h4>
                                </div>
                                <div class="course-provider d-flex align-items-center gap-20">
                                    <div class="course-provider-name"><a>HDFC Ergo</a></div>
                                    <div class="course-ratings"><!----></div>
                                    <div class="course-payment">
                                        <h6><svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <mask id="mask0_3096_37566" maskUnits="userSpaceOnUse" x="0" y="0"
                                                    width="16" height="16" style="mask-type: alpha;">
                                                    <rect width="16" height="16" fill="#009C4D"></rect>
                                                </mask>
                                                <g mask="url(#mask0_3096_37566)">
                                                    <path
                                                        d="M8.00521 15.3359L3.20521 11.7359C3.03854 11.6137 2.9081 11.4582 2.81387 11.2693C2.71921 11.0804 2.67188 10.8804 2.67188 10.6693V2.66927C2.67188 2.3026 2.80254 1.9886 3.06387 1.72727C3.32476 1.46638 3.63854 1.33594 4.00521 1.33594H12.0052C12.3719 1.33594 12.6859 1.46638 12.9472 1.72727C13.2081 1.9886 13.3385 2.3026 13.3385 2.66927V10.6693C13.3385 10.8804 13.2914 11.0804 13.1972 11.2693C13.1025 11.4582 12.9719 11.6137 12.8052 11.7359L8.00521 15.3359ZM7.30521 10.0026L11.0719 6.23594L10.1385 5.26927L7.30521 8.1026L5.90521 6.7026L4.93854 7.63594L7.30521 10.0026Z"
                                                        fill="#009C4D"></path>
                                                </g>
                                            </svg> Free </h6><!----><!---->
                                    </div>
                                </div>
                                <div
                                    class="course-sector-info d-flex flex-column flex-md-row justify-content-evenly align-items-center text-light-gray pt-2 pb-2">
                                    <p>Banking,Financial Services &amp; Insurance (BFSI)</p>
                                    <p><i class="fa fa-users"></i>&nbsp;&nbsp;4811+ Enrolled </p>

                                    <p><i class="fa fa-clock" aria-hidden="true"></i>&nbsp;&nbsp; 90 Minutes</p>
                                </div>
                                <div class="course-short-desc pt-3 text-secondary">
                                    <p class="">This Certificate Course in Customer Service Excellence (Aviation) equips
                                        you with the essential knowledge and skills to thrive in the dynamic aviation
                                        industry.,,Through modules covering the industry landscape, fundamental service
                                        principles, their application in aviation scenarios, and crucial soft skills
                                        development, you will gain a comprehensive understanding of how to excel in
                                        serving customers in this specialized field.</p>
                                </div>
                                <hr class="mt-2 mb-2">
                                <div class="mt-2">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <div class="mb-3">
                                                <label for="" class="form-label">Name</label>
                                                <input type="text" class="form-control" name="" id=""
                                                    aria-describedby="helpId" placeholder="" />
                                                <!-- <small id="helpId" class="form-text text-muted">Help text</small> -->
                                            </div>

                                        </div>
                                        <div class="col-md-2">
                                            <a name="" id="" class="mt-4 btn btn-primary" href="#"
                                                role="button">Enrolle</a>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

            <div class="container mt-5">
                <ul class="nav nav-tabs justify-content-start" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="tab1-tab" data-bs-toggle="tab" data-bs-target="#tab1"
                            type="button" role="tab">Course Details</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tab2-tab" data-bs-toggle="tab" data-bs-target="#tab2" type="button"
                            role="tab">Addition details</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tab3-tab" data-bs-toggle="tab" data-bs-target="#tab3" type="button"
                            role="tab">Topics</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tab4-tab" data-bs-toggle="tab" data-bs-target="#tab4" type="button"
                            role="tab">Elibibility Criteria</button>
                    </li>
                </ul>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="tab1" role="tabpanel">
                        <div class="container mt-4">
                            <div class="row bg-light p-3 rounded shadow-sm">

                                <div class="col-md-3 mb-3">
                                    <div class="d-flex align-items-start">
                                        <i class="bi bi-person-badge fs-3 me-3 text-primary"></i>
                                        <div>
                                            <h6 class="mb-1">Training Partner</h6>
                                            <p class="mb-0 text-muted">Reliance Foundation Skilling Academy</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="d-flex align-items-start">
                                        <i class="bi bi-translate fs-3 me-3 text-success"></i>
                                        <div>
                                            <h6 class="mb-1">Languages</h6>
                                            <p class="mb-0 text-muted">English</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="d-flex align-items-start">
                                        <i class="bi bi-award fs-3 me-3 text-warning"></i>
                                        <div>
                                            <h6 class="mb-1">Certification Type</h6>
                                            <p class="mb-0 text-muted">Certificate of Completion</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="d-flex align-items-start">
                                        <i class="bi bi-person-check-fill fs-3 me-3 text-info"></i>
                                        <div>
                                            <h6 class="mb-1">Assessment Mode</h6>
                                            <p class="mb-0 text-muted">Proctor Assessment</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="d-flex align-items-start">
                                        <i class="bi bi-code-slash fs-3 me-3 text-danger"></i>
                                        <div>
                                            <h6 class="mb-1">QP Code</h6>
                                            <p class="mb-0 text-muted">Non QP Aligned</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="d-flex align-items-start">
                                        <i class="bi bi-layers fs-3 me-3 text-secondary"></i>
                                        <div>
                                            <h6 class="mb-1">NSQF Level</h6>
                                            <p class="mb-0 text-muted">Non QP Aligned</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="d-flex align-items-start">
                                        <i class="bi bi-journal-x fs-3 me-3 text-dark"></i>
                                        <div>
                                            <h6 class="mb-1">Credits Assigned</h6>
                                            <p class="mb-0 text-muted">No Credit Available</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="tab2" role="tabpanel">
                        <div class="row bg-light p-3 rounded shadow-sm">

                            <div class="col-md-3 mb-3">
                                <div class="d-flex align-items-start">
                                    <i class="bi bi-book fs-3 me-3 text-primary"></i>
                                    <div>
                                        <h6 class="mb-1">Learning Product Type</h6>
                                        <p class="mb-0 text-muted">Skill Course</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 mb-3">
                                <div class="d-flex align-items-start">
                                    <i class="bi bi-award-fill fs-3 me-3 text-success"></i>
                                    <div>
                                        <h6 class="mb-1">Program By</h6>
                                        <p class="mb-0 text-muted">Skill India CSR</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 mb-3">
                                <div class="d-flex align-items-start">
                                    <i class="bi bi-bullseye fs-3 me-3 text-warning"></i>
                                    <div>
                                        <h6 class="mb-1">Initiative of</h6>
                                        <p class="mb-0 text-muted">Reliance Foundation</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 mb-3">
                                <div class="d-flex align-items-start">
                                    <i class="bi bi-building fs-3 me-3 text-danger"></i>
                                    <div>
                                        <h6 class="mb-1">Program</h6>
                                        <p class="mb-0 text-muted">Reliance Foundation Skilling Academy</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 mb-3">
                                <div class="d-flex align-items-start">
                                    <i class="bi bi-globe2 fs-3 me-3 text-info"></i>
                                    <div>
                                        <h6 class="mb-1">Domain</h6>
                                        <p class="mb-0 text-muted">Airline</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 mb-3">
                                <div class="d-flex align-items-start">
                                    <i class="bi bi-people-fill fs-3 me-3 text-secondary"></i>
                                    <div>
                                        <h6 class="mb-1">Occupations</h6>
                                        <p class="mb-0 text-muted">Customer Service</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab3" role="tabpanel">
                        <div class="accordion" id="aviationAccordion">

                            <div class="accordion-item border-0 bg-transparent">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button bg-transparent shadow-none" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true">
                                        Introduction to the Aviation Industry
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show"
                                    data-bs-parent="#aviationAccordion">
                                    <div class="accordion-body text-muted">
                                        Overview and fundamentals of how the aviation industry functions, including key
                                        roles and stakeholders.
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item border-0 bg-transparent">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed bg-transparent shadow-none" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false">
                                        Principles of Customer Service Excellence
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse"
                                    data-bs-parent="#aviationAccordion">
                                    <div class="accordion-body text-muted">
                                        Key principles to deliver exceptional service and build customer satisfaction
                                        and loyalty.
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item border-0 bg-transparent">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button collapsed bg-transparent shadow-none" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false">
                                        Applications in Aviation Industry
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse"
                                    data-bs-parent="#aviationAccordion">
                                    <div class="accordion-body text-muted">
                                        Practical applications of service principles in real-world aviation scenarios
                                        and workplace settings.
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item border-0 bg-transparent">
                                <h2 class="accordion-header" id="headingFour">
                                    <button class="accordion-button collapsed bg-transparent shadow-none" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false">
                                        Customer Service Soft Skills
                                    </button>
                                </h2>
                                <div id="collapseFour" class="accordion-collapse collapse"
                                    data-bs-parent="#aviationAccordion">
                                    <div class="accordion-body text-muted">
                                        Development of soft skills like communication, empathy, and professionalism
                                        essential for customer service roles.
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab4" role="tabpanel">
                        <div class="row bg-light p-3 rounded shadow-sm">

                            <div class="col-md-3 mb-3">
                                <div class="d-flex align-items-start">
                                    <i class="bi bi-calendar2-week fs-3 me-3 text-primary"></i>
                                    <div>
                                        <h6 class="mb-1">Required Age</h6>
                                        <p class="mb-0 text-muted">Any</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 mb-3">
                                <div class="d-flex align-items-start">
                                    <i class="bi bi-mortarboard-fill fs-3 me-3 text-success"></i>
                                    <div>
                                        <h6 class="mb-1">Minimum Education</h6>
                                        <p class="mb-0 text-muted">12th Pass, ITI, Diploma</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 mb-3">
                                <div class="d-flex align-items-start">
                                    <i class="bi bi-briefcase-fill fs-3 me-3 text-warning"></i>
                                    <div>
                                        <h6 class="mb-1">Industry Experience</h6>
                                        <p class="mb-0 text-muted">0</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 mb-3">
                                <div class="d-flex align-items-start">
                                    <i class="bi bi-tools fs-3 me-3 text-danger"></i>
                                    <div>
                                        <h6 class="mb-1">Learning Tools</h6>
                                        <p class="mb-0 text-muted">NA</p>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

                  <!-- Our Programmes -->
      <section class="out-team-sec mt-80 mb-120 wow fadeInUp animated animated" data-wow-delay="540ms"
        style="visibility: visible; animation-delay: 540ms; animation-name: fadeInUp;">
        <div class="container-fluid">
          <div class="heading mb-48">
            <div class="tagblock mb-16">
              <img src="{{ asset('resource/web/assets/media/hero/buld-vec.png')}}" class="bulb-vec" alt="">
              <p class="black">Our Program</p>
            </div>
            <div class="text-start mt-2">Courses and Professional Certificates</div>
            <h3 class="fw-500 text-start mt-2 mb-2">Guided by passionate instructors, <span class="color-primary">
                Leaders in
                their
                Fields</span>
            </h3>
            <p class="text-start">Explore free online courses from the world's top universities and companies.</p>
          </div>
          <div class="row align-items-stretch h-100">
            <div class="swiper mySwiperstwo p-0 m-0">
              <div class="swiper-wrapper">
                <!-- Slide 1 -->
                <div class="swiper-slide">
                  <div class="col-md-*">
                    <div class="team-block">
                      <div class="img-block">
                        <img class=" w-100"
                          src="https://d3njjcbhbojbot.cloudfront.net/api/utilities/v1/imageproxy/https://coursera-course-photos.s3.amazonaws.com/44/4f51448ef4484ca7aaf8ea2fe3b1eb/SCSP_Logo.png?auto=format%2C%20compress%2C%20enhance&dpr=2&w=320&h=180&fit=crop&q=50"
                          alt="">
                      </div>
                      <div class="team-content">
                        <div class="">
                          <a href="" class="h6 fw-500 mb-4p">Educational Programs &nbsp; &nbsp; &nbsp;</a>
                          <p class="subtitle"> </p>
                        </div>
                        <div class="d-flex gap-8 align-items-center">
                          <a href="">
                            <img class="links-icon" src="{{ asset('resource/web/assets/media/vector/message.png')}}" alt="">
                          </a>
                          <a href="">
                            <img class="links-icon" src="{{ asset('resource/web/assets/media/vector/linkedin.png')}}" alt="">
                          </a>
                          <a href="">
                            <img class="links-icon" src="{{ asset('resource/web/assets/media/vector/facebook.png')}}" alt="">
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="swiper-slide">
                  <div class="col-md-*">
                    <div class="team-block">
                      <div class="img-block">
                        <img class=" w-100"
                          src="https://d3njjcbhbojbot.cloudfront.net/api/utilities/v1/imageproxy/https://coursera-course-photos.s3.amazonaws.com/a5/29e1bc993e4e63897f1f1b233b7474/DeepLearning_Hugging_Face_AI_Banner_1000x1000.png?auto=format%2C%20compress%2C%20enhance&dpr=2&w=320&h=180&fit=crop&q=50"
                          alt="">
                      </div>
                      <div class="team-content">
                        <div class="">
                          <a href="" class="h6 fw-500 mb-4p">Skill Development Programs</a>
                          <p class="subtitle"> </p>
                        </div>
                        <div class="d-flex gap-8 align-items-center">
                          <a href="">
                            <img class="links-icon" src="{{ asset('resource/web/assets/media/vector/message.png')}}" alt="">
                          </a>
                          <a href="">
                            <img class="links-icon" src="{{ asset('resource/web/assets/media/vector/linkedin.png')}}" alt="">
                          </a>
                          <a href="">
                            <img class="links-icon" src="{{ asset('resource/web/assets/media/vector/facebook.png')}}" alt="">
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="swiper-slide">
                  <div class="col-md-*">
                    <div class="team-block">
                      <div class="img-block">
                        <img class=" w-100"
                          src="https://d3njjcbhbojbot.cloudfront.net/api/utilities/v1/imageproxy/https://coursera-course-photos.s3.amazonaws.com/d8/6a5782475148a69fe5ea690ea0867f/V5_DeepLearning_Meta_Multimodal_Llama_Banner_1000x1000.png?auto=format%2C%20compress%2C%20enhance&dpr=2&w=320&h=180&fit=crop&q=50"
                          alt="">
                      </div>
                      <div class="team-content">
                        <div class="">
                          <a href="" class="h6 fw-500 mb-4p">Youth Empowerment Program</a>
                          <!-- <p class="subtitle">Web Instructor</p> -->
                        </div>
                        <div class="d-flex gap-8 align-items-center">
                          <a href="">
                            <img class="links-icon" src="{{ asset('resource/web/assets/media/vector/message.png')}}" alt="">
                          </a>
                          <a href="">
                            <img class="links-icon" src="{{ asset('resource/web/assets/media/vector/linkedin.png')}}" alt="">
                          </a>
                          <a href="">
                            <img class="links-icon" src="{{ asset('resource/web/assets/media/vector/facebook.png')}}" alt="">
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="swiper-slide">
                  <div class="col-md-*">
                    <div class="team-block">
                      <div class="img-block">
                        <img class=" w-100"
                          src="https://d3njjcbhbojbot.cloudfront.net/api/utilities/v1/imageproxy/https://d15cw65ipctsrr.cloudfront.net/16/27af50564b4e4db763eb057b45d8d2/Professional_Cert_1200x1200.jpg?auto=format%2C%20compress%2C%20enhance&dpr=2&w=320&h=180&fit=crop&q=50"
                          alt="">
                      </div>
                      <div class="team-content">
                        <div class="">
                          <a href="" class="h6 fw-500 mb-4p">On-the-Job Training (OJT)</a>
                          <!-- <p class="subtitle">Python Instructor</p> -->
                        </div>
                        <div class="d-flex gap-8 align-items-center">
                          <a href="">
                            <img class="links-icon" src="{{ asset('resource/web/assets/media/vector/message.png')}}" alt="">
                          </a>
                          <a href="">
                            <img class="links-icon" src="{{ asset('resource/web/assets/media/vector/linkedin.png')}}" alt="">
                          </a>
                          <a href="">
                            <img class="links-icon" src="{{ asset('resource/web/assets/media/vector/facebook.png')}}" alt="">
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="swiper-slide">
                  <div class="col-md-*">
                    <div class="team-block">
                      <div class="img-block">
                        <img class=" w-100"
                          src="https://d3njjcbhbojbot.cloudfront.net/api/utilities/v1/imageproxy/https://d15cw65ipctsrr.cloudfront.net/16/27af50564b4e4db763eb057b45d8d2/Professional_Cert_1200x1200.jpg?auto=format%2C%20compress%2C%20enhance&dpr=2&w=320&h=180&fit=crop&q=50"
                          alt="">
                      </div>
                      <div class="team-content">
                        <div class="">
                          <a href="" class="h6 fw-500 mb-4p">Mr. Cory</a>
                          <p class="subtitle">Python Instructor</p>
                        </div>
                        <div class="d-flex gap-8 align-items-center">
                          <a href="">
                            <img class="links-icon" src="{{ asset('resource/web/assets/media/vector/message.png')}}" alt="">
                          </a>
                          <a href="">
                            <img class="links-icon" src="{{ asset('resource/web/assets/media/vector/linkedin.png')}}" alt="">
                          </a>
                          <a href="">
                            <img class="links-icon" src="{{ asset('resource/web/assets/media/vector/facebook.png')}}" alt="">
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div> <!-- .swiper-wrapper -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
            <!-- Pagination -->
            <div class="swiper-pagination"></div>
          </div>
      </section>
      <!-- end of our Programmes -->

            <!-- How We Operate Section End -->
      <div class="blog-sec mt-80 mb-5">
        <div class="container-fluid">
          <div class="heading mb-10 text-start">
            <div class="tagblock mb-16">
              <img src="{{ asset('resource/web/assets/media/hero/buld-vec.png')}}" class="bulb-vec" alt="">
              <p class="black">Ongoing Projects</p>
            </div>
            <div class="cds-119 css-1v1mgi3 cds-121 mt-2">Specializations and Professional Certificates</div>
            <h3 class="fw-bold mt-2 mb-2">Learn more with our curated <span class="color-primary"> Community
                Wisdom</span></h3>
            <p class="cds-119 css-lg65q1 cds-121">Explore our most popular programs, get job-ready for an in-demand
              career.</p>
          </div>
          <!-- Swiper -->
          <div class="swiper mySwipers">
            <div class="swiper-wrapper">
              <!-- Slide 1 -->
              <div class="swiper-slide" data-swiper-autoplay="2000">
                <div class="blog-card">
                  <a href="blog-detail.html" class="card-img">
                    <img src="{{ asset('resource/web/assets/media/blogs/img-1.jpg')}}" alt="">
                    <span class="date-block">
                      <span class="h6 fw-400 light-black">08</span>
                      <span class="h6 fw-400 light-black">May</span>
                    </span>
                  </a>
                  <div class="card-content">
                    <div class="d-flex align-items-center gap-8 mb-20">
                      <img src="{{ asset('resource/web/assets/media/user/user-2.png')}}" class="card-user" alt="">
                      <p>By Admin</p>
                    </div>
                    <a href="blog-detail.html" class="h6 fw-500 mb-8">Time Management Hacks for Busy Online Learners</a>
                    <p class="light-gray mb-24">Lorem ipsum dolor sit amet consectetur. Vitae vel sit convallis aliquet
                      amet</p>
                    <a href="blog-detail.html" class="card-btn">
                      Read More
                      <!-- your SVG here -->
                    </a>
                  </div>
                </div>
              </div>
              <!-- Slide 1 -->
              <div class="swiper-slide" data-swiper-autoplay="2000">
                <div class="blog-card">
                  <a href="blog-detail.html" class="card-img">
                    <img src="{{ asset('resource/web/assets/media/blogs/img-1.jpg')}}" alt="">
                    <span class="date-block">
                      <span class="h6 fw-400 light-black">08</span>
                      <span class="h6 fw-400 light-black">May</span>
                    </span>
                  </a>
                  <div class="card-content">
                    <div class="d-flex align-items-center gap-8 mb-20">
                      <img src="{{ asset('resource/web/assets/media/user/user-2.png')}}" class="card-user" alt="">
                      <p>By Admin</p>
                    </div>
                    <a href="blog-detail.html" class="h6 fw-500 mb-8">Time Management Hacks for Busy Online Learners</a>
                    <p class="light-gray mb-24">Lorem ipsum dolor sit amet consectetur. Vitae vel sit convallis aliquet
                      amet</p>
                    <a href="blog-detail.html" class="card-btn">
                      Read More
                      <!-- your SVG here -->
                    </a>
                  </div>
                </div>
              </div>
              <!-- Slide 1 -->
              <div class="swiper-slide" data-swiper-autoplay="2000">
                <div class="blog-card">
                  <a href="blog-detail.html" class="card-img">
                    <img src="{{ asset('resource/web/assets/media/blogs/img-1.jpg')}}" alt="">
                    <span class="date-block">
                      <span class="h6 fw-400 light-black">08</span>
                      <span class="h6 fw-400 light-black">May</span>
                    </span>
                  </a>
                  <div class="card-content">
                    <div class="d-flex align-items-center gap-8 mb-20">
                      <img src="{{ asset('resource/web/assets/media/user/user-2.png')}}" class="card-user" alt="">
                      <p>By Admin</p>
                    </div>
                    <a href="blog-detail.html" class="h6 fw-500 mb-8">Time Management Hacks for Busy Online Learners</a>
                    <p class="light-gray mb-24">Lorem ipsum dolor sit amet consectetur. Vitae vel sit convallis aliquet
                      amet</p>
                    <a href="blog-detail.html" class="card-btn">
                      Read More
                      <!-- your SVG here -->
                    </a>
                  </div>
                </div>
              </div>
              <!-- Slide 1 -->
              <div class="swiper-slide" data-swiper-autoplay="2000">
                <div class="blog-card">
                  <a href="blog-detail.html" class="card-img">
                    <img src="{{ asset('resource/web/assets/media/blogs/img-1.jpg')}}" alt="">
                    <span class="date-block">
                      <span class="h6 fw-400 light-black">08</span>
                      <span class="h6 fw-400 light-black">May</span>
                    </span>
                  </a>
                  <div class="card-content">
                    <div class="d-flex align-items-center gap-8 mb-20">
                      <img src="{{ asset('resource/web/assets/media/user/user-2.png')}}" class="card-user" alt="">
                      <p>By Admin</p>
                    </div>
                    <a href="blog-detail.html" class="h6 fw-500 mb-8">Time Management Hacks for Busy Online Learners</a>
                    <p class="light-gray mb-24">Lorem ipsum dolor sit amet consectetur. Vitae vel sit convallis aliquet
                      amet</p>
                    <a href="blog-detail.html" class="card-btn">
                      Read More
                      <!-- your SVG here -->
                    </a>
                  </div>
                </div>
              </div>
              <!-- Slide 1 -->
              <div class="swiper-slide" data-swiper-autoplay="2000">
                <div class="blog-card">
                  <a href="blog-detail.html" class="card-img">
                    <img src="{{ asset('resource/web/assets/media/blogs/img-1.jpg')}}" alt="">
                    <span class="date-block">
                      <span class="h6 fw-400 light-black">08</span>
                      <span class="h6 fw-400 light-black">May</span>
                    </span>
                  </a>
                  <div class="card-content">
                    <div class="d-flex align-items-center gap-8 mb-20">
                      <img src="{{ asset('resource/web/assets/media/user/user-2.png')}}" class="card-user" alt="">
                      <p>By Admin</p>
                    </div>
                    <a href="blog-detail.html" class="h6 fw-500 mb-8">Time Management Hacks for Busy Online Learners</a>
                    <p class="light-gray mb-24">Lorem ipsum dolor sit amet consectetur. Vitae vel sit convallis aliquet
                      amet</p>
                    <a href="blog-detail.html" class="card-btn">
                      Read More
                      <!-- your SVG here -->
                    </a>
                  </div>
                </div>
              </div>
              <!-- Repeat for other slides -->
            </div>
            <!-- Pagination -->
            <div class="swiper-pagination"></div>
          </div>
        </div>
      </div>
      <!-- Our Courses Section Start -->
                   <!-- BLog Detail Section Start -->
            <section class="blog-detail-sec mb-120">
                <div class="container-fluid">
                    <div class="row row-gap-4">
                        <div class="col-lg-8">
                            <img src="{{ asset('resource/web/assets/media/blogs/blog-detail-img-1.jpg')}}" class="br-24 w-100 mb-36" alt="">
                            <h5 class="fw-500 mb-24">From Zero to React Hero: The Ultimate Hands-On Tutorial for
                                Beginners 🛠️💡</h5>
                            <p class="mb-16">Tired of tutorials that leave you drowning in jargon? This is your
                                stress-free zone! Whether you’re a coding newbie or shifting from HTML/CSS, I’ll guide
                                you through React JS like a patient friend—not a textbook. We’ll start with “What even
                                is a component?” and level up to creating your first interactive app (think to-do lists,
                                meme generators, or mini e-commerce pages!).</p>
                            <p class="mb-36">Uniquely pursue emerging experiences before liemerging content. Efficiently
                                underwhelm customer directed total linkage after B2C synergy. Dynamically simplify
                                superior human capital whereas efficient infrastructures generate business web-readiness
                                after wireless outsourcing.</p>
                            <div class="qoutes mb-36">
                                <svg class="mb-16" xmlns="http://www.w3.org/2000/svg" width="32" height="26"
                                    viewBox="0 0 32 26" fill="none">
                                    <path
                                        d="M1.97044 25.3005V19.9409H5.04433C7.46141 19.9409 8.66995 18.7324 8.66995 16.3153V13.7931H7.33005C5.22824 13.7931 3.49425 13.1626 2.12808 11.9015C0.709358 10.6404 0 9.03781 0 7.09364C0 4.99183 0.709358 3.28411 2.12808 1.97049C3.49425 0.656857 5.22824 4.00543e-05 7.33005 4.00543e-05C9.4844 4.00543e-05 11.2447 0.656857 12.6108 1.97049C13.977 3.33666 14.6601 5.14947 14.6601 7.40891V16.473C14.6601 22.358 11.7176 25.3005 5.83251 25.3005H1.97044ZM19.3103 25.3005V19.9409H22.3842C24.8013 19.9409 26.0099 18.7324 26.0099 16.3153V13.7931H24.67C22.5681 13.7931 20.8342 13.1626 19.468 11.9015C18.0493 10.6404 17.3399 9.03781 17.3399 7.09364C17.3399 4.99183 18.0493 3.28411 19.468 1.97049C20.8342 0.656857 22.5681 4.00543e-05 24.67 4.00543e-05C26.8243 4.00543e-05 28.5846 0.656857 29.9507 1.97049C31.3169 3.33666 32 5.14947 32 7.40891V16.473C32 22.358 29.0575 25.3005 23.1724 25.3005H19.3103Z"
                                        fill="#F59300" />
                                </svg>
                                <h5 class="fw-500 mb-16">Lorem ipsum dolor sit amet consectetur. Volutpat leo porta
                                    ultrices at posuere sollicitudin leo turpis ullamcorper. In morbi tincidunt nam
                                    sodales.</h5>
                                <div class="d-flex align-items-center gap-12">
                                    <div class="vr-line"></div>
                                    <p class="fw-500 color-primary">David Anderson</p>
                                </div>
                            </div>
                            <p class="mb-16">Tired of tutorials that leave you drowning in jargon? This is your
                                stress-free zone! Whether you’re a coding newbie or shifting from HTML/CSS, I’ll guide
                                you through React JS like a patient friend—not a textbook. We’ll start with “What even
                                is a component?” and level up to creating your first interactive app (think to-do lists,
                                meme generators, or mini e-commerce pages!).</p>
                            <p class="mb-36">Uniquely pursue emerging experiences before liemerging content. Efficiently
                                underwhelm customer directed total linkage after B2C synergy. Dynamically simplify
                                superior human capital whereas efficient infrastructures generate business web-readiness
                                after wireless outsourcing.</p>
                            <h5 class="fw-500 mb-24">Similar Blogs</h5>
                            <p class="mb-16">Tired of tutorials that leave you drowning in jargon? This is your
                                stress-free zone! Whether you’re a coding newbie or shifting from HTML/CSS, I’ll guide
                                you through React JS like a patient friend—not a textbook. We’ll start with “What even
                                is a component?” and level up to creating your first interactive app (think to-do lists,
                                meme generators, or mini e-commerce pages!).</p>
                            <p class="mb-36">Uniquely pursue emerging experiences before liemerging content. Efficiently
                                underwhelm customer directed total linkage after B2C synergy. Dynamically simplify
                                superior human capital whereas efficient infrastructures generate business web-readiness
                                after wireless outsourcing.</p>
                            <img src="{{ asset('resource/web/assets/media/blogs/blog-detail-img-2.jpg')}}" class="br-24 w-100 mb-36" alt="">
                            <p class="mb-16">Uniquely pursue emerging experiences before liemerging content. Efficiently
                                underwhelm customer directed total linkage after B2C synergy. Dynamically simplify
                                superior human capital whereas efficient infrastructures generate business web-readiness
                                after wireless outsourcing.</p>
                            <p>Tired of tutorials that leave you drowning in jargon? This is your stress-free zone!
                                Whether you’re a coding newbie or shifting from HTML/CSS, I’ll guide you through React
                                JS like a patient friend—not a textbook. We’ll start with “What even is a component?”
                                and level up to creating your first interactive app (think to-do lists, meme generators,
                                or mini e-commerce pages!).</p>
                        </div>
                        <div class="col-lg-4">
                            <div class="siderbar">
                                <div class="sidebar-block mb-48">
                                    <form class="search-form">
                                        <input type="text" name="search" id="search" placeholder="Search">
                                        <button type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                height="21" viewBox="0 0 20 21" fill="none">
                                                <path
                                                    d="M17.5 18L14.5834 15.0833M16.6667 10.0833C16.6667 13.9954 13.4954 17.1667 9.58333 17.1667C5.67132 17.1667 2.5 13.9954 2.5 10.0833C2.5 6.17132 5.67132 3 9.58333 3C13.4954 3 16.6667 6.17132 16.6667 10.0833Z"
                                                    stroke="#92949F" stroke-width="1.66667" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg></button>
                                    </form>
                                </div>
                                <div class="sidebar-block mb-48">
                                    <h5 class="fw-500 mb-24">Category</h5>
                                    <ul>
                                        <li><a href="#" class="mb-12 light-gray">Business</a></li>
                                        <li><a href="#" class="mb-12 light-gray">Web Development</a></li>
                                        <li><a href="#" class="mb-12 light-gray">Finance & Accounting</a></li>
                                    </ul>
                                </div>
                                <div class="sidebar-block mb-48">
                                    <h5 class="fw-500 mb-24">Similar Blogs</h5>
                                    <div class="recent-article mb-12">
                                        <img src="{{ asset('resource/web/assets/media/blogs/recent-blog-1.jpg')}}" class="article-img" alt="">
                                        <div>
                                            <a href="#" class="fw-500 black mb-8 hover-content">How roofing can pay off
                                                itself in
                                                heating bills</a>
                                            <p class="light-gray subtitle">11/05/2025</p>
                                        </div>
                                    </div>
                                    <div class="recent-article mb-12">
                                        <img src="{{ asset('resource/web/assets/media/blogs/recent-blog-2.jpg')}}" class="article-img" alt="">
                                        <div>
                                            <a href="#" class="fw-500 black mb-8 hover-content">How roofing can pay off
                                                itself in
                                                heating bills</a>
                                            <p class="light-gray subtitle">03/03/2025</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="sidebar-block">
                                    <h5 class="fw-500 mb-24">Tags</h5>
                                    <div class="tag-block">
                                        <a href="#">Web Development</a>
                                        <a href="#">Personal Development</a>
                                        <a href="#">IT & Networking</a>
                                        <a href="#">Finance & Accounting</a>
                                        <a href="#">Health & Fitness</a>
                                        <a href="#">Language Learning</a>
                                        <a href="#">Academics & Test Prep</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- BLog Detail Section End -->
             <section class="title-banner mb-80 mb-5">
                <div class="container-fluid">
                    <h2 class="fw-500 mb-24">Mastering Webflow: Build Stunning<br class="d-sm-block d-none">
                        Websites <span class="color-primary"> Without Code</span></h2>
                    <div class="d-flex align-items-center gap-16 flex-wrap row-gap-4">
                        <div class="d-flex align-items-center gap-8">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M18.749 6H10.1002L8.61652 3.3801C8.5511 3.2647 8.45623 3.16871 8.3416 3.10194C8.22697 3.03516 8.09668 2.99999 7.96402 3H1.49902C1.30011 3 1.10935 3.07902 0.968693 3.21967C0.828041 3.36032 0.749023 3.55109 0.749023 3.75V20.25C0.749088 20.4252 0.810412 20.5948 0.922373 20.7295C1.03433 20.8642 1.18988 20.9555 1.36207 20.9876C1.40741 20.9956 1.45335 20.9998 1.4994 21C1.65093 21 1.7989 20.9541 1.92382 20.8683C2.04875 20.7825 2.14476 20.661 2.19922 20.5196L5.76427 11.25H18.749C18.9479 11.25 19.1387 11.171 19.2794 11.0303C19.42 10.8897 19.499 10.6989 19.499 10.5V6.75C19.499 6.55109 19.42 6.36032 19.2794 6.21967C19.1387 6.07902 18.9479 6 18.749 6Z" fill="#E8A113"></path>
                                <path d="M23.1175 10.0752C23.0486 9.97491 22.9563 9.8929 22.8486 9.83625C22.7409 9.77959 22.621 9.74999 22.4993 9.75H5.24934C5.09777 9.75006 4.94977 9.79599 4.8248 9.88174C4.69982 9.96749 4.60372 10.0891 4.54914 10.2305L0.799136 19.9804C0.75537 20.0941 0.739933 20.2167 0.754159 20.3376C0.768384 20.4586 0.811844 20.5742 0.880783 20.6746C0.949722 20.775 1.04207 20.8571 1.14984 20.9138C1.25761 20.9704 1.37756 21.0001 1.49934 21H18.7493C18.9009 20.9999 19.0489 20.954 19.1739 20.8683C19.2988 20.7825 19.3949 20.6609 19.4495 20.5196L23.1995 10.7695C23.2432 10.6558 23.2585 10.5332 23.2442 10.4122C23.2299 10.2913 23.1864 10.1756 23.1175 10.0752Z" fill="#FFC431"></path>
                            </svg>
                            <p class="light-gray">Development</p>
                        </div>
                        <div class="d-flex align-items-center gap-8">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <g clip-path="url(#clip0_11629_7425)">
                                    <path d="M21.2493 3.98854C21.2493 3.1138 20.5402 2.40472 19.6654 2.40472H18.6345C17.9966 2.40472 5.38931 2.40472 4.96795 2.40472C4.58194 2.40472 2.08477 2.40472 1.58386 2.40472C0.709219 2.40472 0 3.11385 0 3.98854V22.07C0 22.5227 0.190266 22.9307 0.494812 23.2194H19.6654V23.6539H22.4398C23.1214 23.6539 23.7025 23.2232 23.9258 22.6191C24.1109 22.1299 24.1763 23.0651 21.2493 3.98854Z" fill="#BABABA"></path>
                                    <path d="M22.216 22.0701V10.2922L21.2489 3.98854C21.2489 3.1138 20.5397 2.40472 19.665 2.40472C19.1464 2.40472 6.65686 2.40472 5.9347 2.40472H4.96753H4.58067C3.6848 2.40472 3.98616 2.40472 2.55066 2.40472C1.67602 2.40472 0.966797 3.1138 0.966797 3.98854V22.07C0.966797 22.5227 1.15706 22.9307 1.46161 23.2194H19.665V23.6539H20.6322C21.5069 23.6539 22.216 22.9448 22.216 22.0701Z" fill="#A8A8A8"></path>
                                    <path d="M19.6654 2.40472C19.1112 2.40472 5.8807 2.40472 4.96795 2.40472C4.42148 2.40472 1.95333 2.40472 1.58386 2.40472C0.709219 2.40472 0 3.11385 0 3.98854V22.07C0 22.9448 0.709219 23.6539 1.58386 23.6539H19.6654C20.5401 23.6539 21.2493 22.9448 21.2493 22.07V3.98854C21.2493 3.11385 20.5401 2.40472 19.6654 2.40472Z" fill="#E6E6E6"></path>
                                    <path d="M0.967172 22.0701V3.98854C0.967172 3.1138 1.67639 2.40472 2.55103 2.40472C2.00588 2.40472 2.13075 2.40472 1.58386 2.40472C0.709219 2.40472 0 3.11385 0 3.98854V22.07C0 22.9448 0.709219 23.6539 1.58386 23.6539H2.55103C1.67644 23.6539 0.967172 22.9448 0.967172 22.0701Z" fill="#CCCBCA"></path>
                                    <path d="M19.6654 2.40472C19.0362 2.40472 6.01819 2.40472 4.96795 2.40472C1.21809 2.40472 5.09405 2.40472 1.58386 2.40472C0.709219 2.40472 0 3.11385 0 3.98854V8.0571H21.2493V3.98854C21.2493 3.11385 20.5401 2.40472 19.6654 2.40472Z" fill="#EA473B"></path>
                                    <path d="M0.967172 3.98854C0.967172 3.1138 1.67639 2.40472 2.55103 2.40472C2.00588 2.40472 2.13075 2.40472 1.58386 2.40472C0.709219 2.40472 0 3.11385 0 3.98854V8.0571H0.967172V3.98854Z" fill="#D63322"></path>
                                    <path d="M16.9605 3.82114V4.15086C16.9605 4.47139 16.7007 4.48939 16.3802 4.48939H16.1867C15.8663 4.48939 15.6064 4.47139 15.6064 4.15086V3.82118C15.2996 4.03531 15.0986 4.39071 15.0986 4.79328C15.0986 5.44765 15.6291 5.97809 16.2834 5.97809C17.4439 5.97804 17.9049 4.4802 16.9605 3.82114Z" fill="#414356"></path>
                                    <path d="M10.9644 3.82114V4.15086C10.9644 4.47139 10.7046 4.44101 10.3841 4.44101H10.1906C9.87016 4.44101 9.61034 4.47139 9.61034 4.15086V3.82118C9.30349 4.03531 9.10254 4.39071 9.10254 4.79328C9.10254 5.44765 9.63302 5.97809 10.2874 5.97809C10.9417 5.97809 11.4722 5.44765 11.4722 4.79328C11.4722 4.39071 11.2712 4.03526 10.9644 3.82114Z" fill="#414356"></path>
                                    <path d="M4.96741 3.82114V4.15086C4.96741 4.52454 4.61571 4.48939 4.19364 4.48939C3.87316 4.48939 3.61333 4.47139 3.61333 4.15086V3.82118C2.668 4.4809 3.13136 5.97809 4.29035 5.97809C4.94472 5.97809 5.47516 5.44765 5.47516 4.79328C5.47516 4.39071 5.27421 4.03526 4.96741 3.82114Z" fill="#414356"></path>
                                    <path d="M16.1142 4.79332C16.1142 4.77087 16.1151 4.74865 16.1163 4.72652C15.8291 4.6917 15.6064 4.44752 15.6064 4.1509V3.82123C15.2996 4.03535 15.0986 4.39076 15.0986 4.79332C15.0986 5.4477 15.6291 5.97813 16.2834 5.97813C16.4652 5.97813 16.6373 5.93712 16.7912 5.86395C16.391 5.67377 16.1142 5.26592 16.1142 4.79332Z" fill="#2F3242"></path>
                                    <path d="M10.1172 4.79332C10.1172 4.77087 10.118 4.74865 10.1192 4.72652C9.83202 4.6917 9.60936 4.44752 9.60936 4.1509V3.82123C9.30252 4.03535 9.10156 4.39076 9.10156 4.79332C9.10156 5.4477 9.63205 5.97813 10.2864 5.97813C10.4681 5.97813 10.6402 5.93712 10.7942 5.86395C10.3939 5.67377 10.1172 5.26592 10.1172 4.79332Z" fill="#2F3242"></path>
                                    <path d="M4.12312 4.72652C3.83592 4.6917 3.61327 4.44752 3.61327 4.1509V3.82123C3.30642 4.03535 3.10547 4.39076 3.10547 4.79332C3.10547 5.66595 4.01691 6.23515 4.79803 5.86395C4.37363 5.66224 4.09566 5.22138 4.12312 4.72652Z" fill="#2F3242"></path>
                                    <path d="M21.2494 8.05692H0V9.41099H21.2494V8.05692Z" fill="#F77C79"></path>
                                    <path d="M0.967172 8.05692H0V9.41099H0.967172V8.05692Z" fill="#DD6464"></path>
                                    <path d="M4.38802 0.346161C4.70855 0.346161 4.96834 0.605989 4.96834 0.926473V4.15044C4.96834 4.47097 4.70855 4.73075 4.38802 4.73075H4.19457C3.87409 4.73075 3.61426 4.47097 3.61426 4.15044V0.926473C3.61426 0.605989 3.87409 0.346161 4.19457 0.346161H4.38802Z" fill="#585A60"></path>
                                    <path d="M10.3841 0.346161C10.7046 0.346161 10.9644 0.605989 10.9644 0.926473V4.15044C10.9644 4.47097 10.7046 4.73075 10.3841 4.73075H10.1907C9.87018 4.73075 9.61035 4.47097 9.61035 4.15044V0.926473C9.61035 0.605989 9.87018 0.346161 10.1907 0.346161H10.3841Z" fill="#585A60"></path>
                                    <path d="M16.3812 0.346161C16.7017 0.346161 16.9615 0.605989 16.9615 0.926473V4.15044C16.9615 4.47097 16.7017 4.73075 16.3812 4.73075H16.1877C15.8672 4.73075 15.6074 4.47097 15.6074 4.15044V0.926473C15.6074 0.605989 15.8672 0.346161 16.1877 0.346161H16.3812Z" fill="#585A60"></path>
                                    <path d="M4.38705 0.346619C4.70758 0.346619 4.96736 0.606447 4.96736 0.926931V4.1509C4.96736 4.47143 4.70758 4.73121 4.38705 4.73121H4.19359C3.87311 4.73121 3.61328 4.47143 3.61328 4.1509V0.926931C3.61328 0.606447 3.87311 0.346619 4.19359 0.346619H4.38705Z" fill="#585A60"></path>
                                    <path d="M10.3841 0.346619C10.7046 0.346619 10.9644 0.606447 10.9644 0.926931V4.1509C10.9644 4.47143 10.7046 4.73121 10.3841 4.73121H10.1907C9.87018 4.73121 9.61035 4.47143 9.61035 4.1509V0.926931C9.61035 0.606447 9.87018 0.346619 10.1907 0.346619H10.3841Z" fill="#585A60"></path>
                                    <path d="M16.3802 0.346619C16.7007 0.346619 16.9605 0.606447 16.9605 0.926931V4.1509C16.9605 4.47143 16.7007 4.73121 16.3802 4.73121H16.1868C15.8663 4.73121 15.6064 4.47143 15.6064 4.1509V0.926931C15.6064 0.606447 15.8663 0.346619 16.1868 0.346619H16.3802Z" fill="#585A60"></path>
                                    <path d="M4.2903 4.1509V0.926931C4.2903 0.692837 4.42923 0.49165 4.62883 0.399869C4.55514 0.366025 4.47344 0.346619 4.38705 0.346619H4.19359C3.87311 0.346619 3.61328 0.606447 3.61328 0.926931V4.1509C3.61328 4.47143 3.87311 4.73121 4.19359 4.73121H4.38705C4.47348 4.73121 4.55519 4.71181 4.62883 4.67796C4.42923 4.58623 4.2903 4.38499 4.2903 4.1509Z" fill="#414356"></path>
                                    <path d="M10.2864 4.1509V0.926931C10.2864 0.692837 10.4253 0.49165 10.6249 0.399869C10.5512 0.366025 10.4695 0.346619 10.3831 0.346619H10.1897C9.8692 0.346619 9.60938 0.606447 9.60938 0.926931V4.1509C9.60938 4.47143 9.8692 4.73121 10.1897 4.73121H10.3831C10.4696 4.73121 10.5513 4.71181 10.6249 4.67796C10.4253 4.58623 10.2864 4.38499 10.2864 4.1509Z" fill="#414356"></path>
                                    <path d="M16.2835 4.1509V0.926931C16.2835 0.692837 16.4224 0.49165 16.622 0.399869C16.5483 0.366025 16.4666 0.346619 16.3802 0.346619H16.1868C15.8663 0.346619 15.6064 0.606447 15.6064 0.926931V4.1509C15.6064 4.47143 15.8663 4.73121 16.1868 4.73121H16.3802C16.4666 4.73121 16.5484 4.71181 16.622 4.67796C16.4224 4.58623 16.2835 4.38499 16.2835 4.1509Z" fill="#414356"></path>
                                    <path d="M7.90252 11.633H6.70842C6.50813 11.633 6.3457 11.7953 6.3457 11.9957C6.3457 12.196 6.50813 12.3584 6.70842 12.3584H7.90252C8.10286 12.3584 8.26523 12.196 8.26523 11.9957C8.26523 11.7954 8.10286 11.633 7.90252 11.633Z" fill="#585A60"></path>
                                    <path d="M11.223 11.633H10.0287C9.82844 11.633 9.66602 11.7953 9.66602 11.9957C9.66602 12.196 9.82844 12.3584 10.0287 12.3584H11.223C11.4233 12.3584 11.5857 12.196 11.5857 11.9957C11.5856 11.7954 11.4233 11.633 11.223 11.633Z" fill="#585A60"></path>
                                    <path d="M14.5424 11.633H13.3481C13.1478 11.633 12.9854 11.7953 12.9854 11.9957C12.9854 12.196 13.1478 12.3584 13.3481 12.3584H14.5424C14.7426 12.3584 14.9051 12.196 14.9051 11.9957C14.9051 11.7954 14.7426 11.633 14.5424 11.633Z" fill="#585A60"></path>
                                    <path d="M17.8616 11.633H16.6674C16.4671 11.633 16.3047 11.7953 16.3047 11.9957C16.3047 12.196 16.4671 12.3584 16.6674 12.3584H17.8616C18.062 12.3584 18.2244 12.196 18.2244 11.9957C18.2243 11.7954 18.062 11.633 17.8616 11.633Z" fill="#585A60"></path>
                                    <path d="M4.58332 14.5551H3.38909C3.18879 14.5551 3.02637 14.7175 3.02637 14.9179C3.02637 15.1182 3.18879 15.2806 3.38909 15.2806H4.58332C4.78366 15.2806 4.94604 15.1182 4.94604 14.9179C4.94599 14.7175 4.78366 14.5551 4.58332 14.5551Z" fill="#585A60"></path>
                                    <path d="M7.90252 14.5551H6.70842C6.50813 14.5551 6.3457 14.7175 6.3457 14.9179C6.3457 15.1182 6.50813 15.2806 6.70842 15.2806H7.90252C8.10286 15.2806 8.26523 15.1182 8.26523 14.9179C8.26523 14.7175 8.10286 14.5551 7.90252 14.5551Z" fill="#585A60"></path>
                                    <path d="M11.223 14.5551H10.0287C9.82844 14.5551 9.66602 14.7175 9.66602 14.9179C9.66602 15.1182 9.82844 15.2806 10.0287 15.2806H11.223C11.4233 15.2806 11.5857 15.1182 11.5857 14.9179C11.5856 14.7175 11.4233 14.5551 11.223 14.5551Z" fill="#585A60"></path>
                                    <path d="M14.5424 14.5551H13.3481C13.1478 14.5551 12.9854 14.7175 12.9854 14.9179C12.9854 15.1182 13.1478 15.2806 13.3481 15.2806H14.5424C14.7426 15.2806 14.9051 15.1182 14.9051 14.9179C14.9051 14.7175 14.7426 14.5551 14.5424 14.5551Z" fill="#585A60"></path>
                                    <path d="M17.8616 14.5551H16.6674C16.4671 14.5551 16.3047 14.7175 16.3047 14.9179C16.3047 15.1182 16.4671 15.2806 16.6674 15.2806H17.8616C18.062 15.2806 18.2244 15.1182 18.2244 14.9179C18.2243 14.7175 18.062 14.5551 17.8616 14.5551Z" fill="#585A60"></path>
                                    <path d="M4.58332 17.4773H3.38909C3.18879 17.4773 3.02637 17.6397 3.02637 17.84C3.02637 18.0404 3.18879 18.2028 3.38909 18.2028H4.58332C4.78366 18.2028 4.94604 18.0404 4.94604 17.84C4.94604 17.6397 4.78366 17.4773 4.58332 17.4773Z" fill="#585A60"></path>
                                    <path d="M7.90252 17.4773H6.70842C6.50813 17.4773 6.3457 17.6397 6.3457 17.84C6.3457 18.0404 6.50813 18.2028 6.70842 18.2028H7.90252C8.10286 18.2028 8.26523 18.0404 8.26523 17.84C8.26523 17.6397 8.10286 17.4773 7.90252 17.4773Z" fill="#585A60"></path>
                                    <path d="M11.223 17.4773H10.0287C9.82844 17.4773 9.66602 17.6397 9.66602 17.84C9.66602 18.0404 9.82844 18.2028 10.0287 18.2028H11.223C11.4233 18.2028 11.5857 18.0404 11.5857 17.84C11.5857 17.6397 11.4233 17.4773 11.223 17.4773Z" fill="#585A60"></path>
                                    <path d="M14.5424 17.4773H13.3481C13.1478 17.4773 12.9854 17.6397 12.9854 17.84C12.9854 18.0404 13.1478 18.2028 13.3481 18.2028H14.5424C14.7426 18.2028 14.9051 18.0404 14.9051 17.84C14.9051 17.6397 14.7426 17.4773 14.5424 17.4773Z" fill="#585A60"></path>
                                    <path d="M17.8616 17.4773H16.6674C16.4671 17.4773 16.3047 17.6397 16.3047 17.84C16.3047 18.0404 16.4671 18.2028 16.6674 18.2028H17.8616C18.062 18.2028 18.2244 18.0404 18.2244 17.84C18.2244 17.6397 18.062 17.4773 17.8616 17.4773Z" fill="#585A60"></path>
                                    <path d="M4.58332 20.3996H3.38909C3.18879 20.3996 3.02637 20.562 3.02637 20.7623C3.02637 20.9626 3.18879 21.125 3.38909 21.125H4.58332C4.78366 21.125 4.94604 20.9627 4.94604 20.7623C4.94599 20.562 4.78366 20.3996 4.58332 20.3996Z" fill="#585A60"></path>
                                    <path d="M7.90252 20.3996H6.70842C6.50813 20.3996 6.3457 20.562 6.3457 20.7623C6.3457 20.9626 6.50813 21.125 6.70842 21.125H7.90252C8.10286 21.125 8.26523 20.9627 8.26523 20.7623C8.26523 20.562 8.10286 20.3996 7.90252 20.3996Z" fill="#585A60"></path>
                                    <path d="M11.223 20.3996H10.0287C9.82844 20.3996 9.66602 20.562 9.66602 20.7623C9.66602 20.9626 9.82844 21.125 10.0287 21.125H11.223C11.4233 21.125 11.5857 20.9627 11.5857 20.7623C11.5856 20.562 11.4233 20.3996 11.223 20.3996Z" fill="#585A60"></path>
                                    <path d="M14.5424 20.3996H13.3481C13.1478 20.3996 12.9854 20.562 12.9854 20.7623C12.9854 20.9626 13.1478 21.125 13.3481 21.125H14.5424C14.7426 21.125 14.9051 20.9627 14.9051 20.7623C14.9051 20.562 14.7426 20.3996 14.5424 20.3996Z" fill="#585A60"></path>
                                </g>
                                <defs>
                                    <clipPath id="clip0_11629_7425">
                                        <rect width="24" height="24" fill="white"></rect>
                                    </clipPath>
                                </defs>
                            </svg>
                            <p class="light-gray">February 26th, 2025</p>
                        </div>
                        <div class="d-flex align-items-center gap-8">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <g clip-path="url(#clip0_11629_7476)">
                                    <path d="M24 12C24 15.512 22.491 18.6716 20.0865 20.8663C17.9531 22.8127 15.1154 24 12 24C8.88464 24 6.04688 22.8127 3.91351 20.8663C1.50897 18.6716 0 15.512 0 12C0 5.37286 5.37286 0 12 0C18.6271 0 24 5.37286 24 12Z" fill="#FFAA20"></path>
                                    <path d="M24 12C24 15.512 22.491 18.6716 20.0865 20.8663C17.9531 22.8127 15.1154 24 12 24V0C18.6271 0 24 5.37286 24 12Z" fill="#FF8900"></path>
                                    <path d="M20.087 20.8187V20.8665C17.9537 22.8129 15.1159 24.0002 12.0005 24.0002C8.88519 24.0002 6.04742 22.8129 3.91406 20.8665V20.8187C3.91406 17.3425 6.1192 14.371 9.20453 13.2312C10.0759 12.9086 11.018 12.7324 12.0005 12.7324C12.9831 12.7324 13.9252 12.9086 14.7971 13.2312C17.8824 14.3716 20.087 17.3425 20.087 20.8187Z" fill="#7985EB"></path>
                                    <path d="M20.0865 20.8187V20.8665C17.9531 22.8129 15.1154 24.0002 12 24.0002V12.7324C12.9825 12.7324 13.9246 12.9086 14.7966 13.2312C17.8819 14.3716 20.0865 17.3425 20.0865 20.8187Z" fill="#4B5BE6"></path>
                                    <path d="M16.9596 9.13751C16.9596 11.8722 14.735 14.0975 11.9998 14.0975C9.26514 14.0975 7.04004 11.8722 7.04004 9.13751C7.04004 6.40283 9.26514 4.17773 11.9998 4.17773C14.735 4.17773 16.9596 6.40283 16.9596 9.13751Z" fill="#FFDBA9"></path>
                                    <path d="M16.9598 9.13751C16.9598 11.8722 14.7352 14.0975 12 14.0975V4.17773C14.7352 4.17773 16.9598 6.40283 16.9598 9.13751Z" fill="#FFC473"></path>
                                </g>
                                <defs>
                                    <clipPath>
                                        <rect width="24" height="24" fill="white"></rect>
                                    </clipPath>
                                </defs>
                            </svg>
                            <p class="light-gray">Emily Watson</p>
                        </div>
                    </div>
                </div>
            </section>
    </div>
    
    <!-- content @e -->
    @endsection