@extends('layouts.web.app')
@section('content')

            <!-- Title Banner Section Start -->
            <section class="title-banner mb-80">
                <div class="container-fluid">
                    <h1>About Us</h1>
                </div>
            </section>
            <!-- Title Banner Section End -->

            <!-- About Section Start -->
            <section class="about-sec mb-120">
                <div class="container-fluid">
                    <div class="row row-gap-4 align-items-center">

                        <div class="col-lg-12 order-1">
                            <div class="ps-24">
                              <div class="heading text-start">
                                <div class="tagblock mb-16">
                                  <img src="{{ asset('resource/web/assets/media/hero/buld-vec.png')}}" class="bulb-vec"
                                    alt="Lightbulb icon representing ideas and insight">
                                  <p class="black">About ISICO</p>
                                </div>
                              </div>
                              <p class="mb-36">
                                {{ $defaultSettings->about_description ?? null}}
                              </p>
                              {{-- <p class="mb-36">
                                Aligned with the National Education Policy (NEP) 2020, ISICO works to enhance the quality of education
                                while preparing future generations for evolving challenges. The organization adheres to core values of
                                inclusivity, innovation, and collaboration, and actively contributes to Sustainable Development Goals
                                (SDGs), particularly SDG 4 (Quality Education), SDG 5 (Gender Equality), and SDG 8 (Decent Work and
                                Economic Growth).
                              </p>
                              <p class="mb-36">
                                ISICO supports national initiatives like Skill India and Make in India, collaborating with various
                                sectors to build a skilled, inclusive workforce for India’s future.
                              </p> --}}
                              <div class="d-flex align-items-center gap-24 mb-36">
                                <div class="d-flex align-items-center gap-16">
                                  <img src="{{ asset('resource/web/assets/media/vector/unique-course-vec.')}}png" class="content-vector"
                                    alt="Icon representing programs">
                                  <div>
                                    <h4 class="fw-600 color-primary mb-2">Impactful</h4>
                                    <p>Skill Programs</p>
                                  </div>
                                </div>
                                <div class="d-flex align-items-center gap-16">
                                  <img src="{{ asset('resource/web/assets/media/vector/student-vector.png')}}" class="content-vector"
                                    alt="Icon representing beneficiaries">
                                  <div>
                                    <h4 class="fw-600 color-primary mb-2">Nation-wide</h4>
                                    <p>Reach & Empowerment</p>
                                  </div>
                                </div>
                              </div>
                              <!-- <div>
                                <a href="#" class="cus-btn">
                                  <span class="text">Learn More About ISICO</span>
                                </a>
                              </div> -->
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="w-100 mb-24">
                                        <img src="https://d2twr397zv17p4.cloudfront.net/image/discovery-img/about/about1.jpg" class="" alt="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="w-100 mb-24">
                                                <img src="https://d2twr397zv17p4.cloudfront.net/image/discovery-img/about/about2.jpg" class="" alt="">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="w-100">
                                                <img src="https://d2twr397zv17p4.cloudfront.net/image/discovery-img/about/about3.jpg" class="" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- About Section End -->

            <!-- Trusted Experts Team Section Start -->
            <section class="our-feature-sec mb-120">
                <div class="container-fluid">
                  <div class="heading mb-48">
                    <!-- <div class="tagblock mb-16 d-flex align-items-center">
                      <i class="bi bi-lightbulb-fill me-2 text-warning fs-4"></i>
                      <p class="black mb-0">Our Features</p>
                    </div> -->
                    <h3 class="fw-500">
                      ISICO is built on a <span class="color-primary">three-layered framework</span> to empower individuals through skills, education, and entrepreneurship
                    </h3>
                  </div>

                  <div class="row row-gap-4">
                    <!-- Feature 1 -->
                    <div class="col-lg-4 col-md-6">
                      <div class="feature-block rounded h-100">
                        <div class="icon mb-3">
                          <i class="bi bi-mortarboard-fill text-primary fs-1"></i>
                        </div>
                        <div class="feature-content">
                          <h5 class="fw-500 mb-2">Skill-Based Education</h5>
                          <p>Delivering industry-relevant, hands-on education to develop job-ready individuals and reduce the skill gap in rural and underserved regions.</p>
                        </div>
                      </div>
                    </div>

                    <!-- Feature 2 -->
                    <div class="col-lg-4 col-md-6">
                      <div class="feature-block rounded h-100">
                        <div class="icon mb-3">
                          <i class="bi bi-people-fill text-success fs-1"></i>
                        </div>
                        <div class="feature-content">
                          <h5 class="fw-500 mb-2">Inclusive Development</h5>
                          <p>Promoting gender equality and rural empowerment by making skill development accessible to all—especially women and marginalized communities.</p>
                        </div>
                      </div>
                    </div>

                    <!-- Feature 3 -->
                    <div class="col-lg-4">
                      <div class="feature-block rounded h-100">
                        <div class="icon mb-3">
                          <i class="bi bi-lightning-fill text-danger fs-1"></i>
                        </div>
                        <div class="feature-content">
                          <h5 class="fw-500 mb-2">Entrepreneurial Support</h5>
                          <p>Fostering innovation and self-reliance by mentoring young entrepreneurs and supporting start-ups through knowledge and skill initiatives.</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </section>

            <!-- Trusted Experts Team Section End -->
<!-- End Upcoming Projects -->
      <style>
        .background-bubbles {
          position: fixed;
          width: 100%;
          height: 100%;
          z-index: 0;
          overflow: hidden;
        }

        .background-bubbles span {
          position: absolute;
          display: block;
          width: 20px;
          height: 20px;
          background: rgba(255, 255, 255, 0.1);
          border-radius: 50%;
          animation: float 20s linear infinite;
        }

        @keyframes float {
          0% {
            transform: translateY(100vh) scale(0.5);
            opacity: 0;
          }

          50% {
            opacity: 0.3;
          }

          100% {
            transform: translateY(-10vh) scale(1);
            opacity: 0;
          }
        }

        .circle-container {
          position: relative;
          width: 100%;
          max-width: 700px;
          height: 700px;
          margin: auto;
          top: 70%;
          transform: translateY(-50%);
          z-index: 2;
          margin-top: 70%;
        }

        .orbit-ring {
          position: absolute;
          top: 50%;
          left: 50%;
          width: 100%;
          height: 100%;
          transform: translate(-50%, -50%);
          border: 2px dashed rgba(255, 255, 255, 0.2);
          border-radius: 50%;
          z-index: 1;
        }

        .central-circle {
          position: absolute;
          top: 50%;
          left: 50%;
          width: 180px;
          height: 180px;
          transform: translate(-50%, -50%);
          background-color: #fff;
          border-radius: 50%;
          text-align: center;
          padding: 20px;
          color: #1e5631;
          font-weight: bold;
          box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
          z-index: 3;
        }

        .orbit-wrapper {
          position: absolute;
          top: 50%;
          left: 50%;
          width: 100%;
          height: 100%;
          transform: translate(-50%, -50%);
          transform-origin: center center;
          z-index: 2;
        }

        .orbiting-box {
          position: absolute;
          width: 160px;
          background-color: #fff;
          color: #1e5631;
          padding: 12px;
          border-radius: 15px;
          text-align: center;
          box-shadow: 0 0 15px rgba(0, 0, 0, 0.15);
          transition: background 0.3s;
        }

        .orbiting-box h6 {
          font-weight: bold;
          font-size: 15px;
        }

        .orbiting-box:hover {
          background-color: #6e8b38;
          cursor: pointer;
        }

        .orbiting-box button {
          background: none;
          border: none;
          color: #1e5631;
          font-weight: 600;
          text-decoration: underline;
          margin-top: 5px;
        }

        .box1 {
          top: 0%;
          left: 50%;
          transform: translate(-50%, -50%) rotate(0deg);
        }

        .box2 {
          top: 25%;
          left: 92%;
          transform: translate(-50%, -50%) rotate(0deg);
        }

        .box3 {
          top: 75%;
          left: 92%;
          transform: translate(-50%, -50%) rotate(0deg);
        }

        .box4 {
          top: 100%;
          left: 50%;
          transform: translate(-50%, -50%) rotate(0deg);
        }

        .box5 {
          top: 75%;
          left: 8%;
          transform: translate(-50%, -50%) rotate(0deg);
        }

        .box6 {
          top: 25%;
          left: 8%;
          transform: translate(-50%, -50%) rotate(0deg);
        }

        .block {
    /* background: rgba(39, 48, 126, 0.897); */
    color: #fff;
    padding-top: 20px;
    padding-bottom: 20px;
}

.flow {
    position: relative;
    width: 100%;
}

.flow .item {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    position: relative;
    padding-top: 20px;
    padding-bottom: 20px;
    word-break: break-all;
}

.flow .item:first-child {
    padding-top: 40px;
}

.flow .item:last-child {
    padding-bottom: 40px;
}

.text h3 {
    color: white;
    font-size: 21px;
}
.flow .item::after {
    content: "";
    width: 6px;
    height: 100%;
    left: calc(50% - 8px);
    top: 0;
    border-right: 4px dashed rgb(240, 240, 240);
    z-index: 1;
    position: absolute;
}

.flow .item .circle {
    width: 24px;
    height: 24px;
    border-radius: 24px;
    background: #008c01;
    position: relative;
    z-index: 2;
}

.flow .item .text {
    position: absolute;
    padding: 20px;
    background: #008c01;
    border-radius: 8px;
}

.flow .item:nth-child(odd) .text {
    left: calc(50% + 44px);
}

.flow .item:nth-child(even) .text {
    right: calc(50% + 44px);
    text-align: right;
}

@media screen and (max-width: 478px) {
    .flow .item {
        justify-content: flex-start;
    }

    .flow .item::after {
        left: 20px;
    }

    .flow .item .circle {
        margin-left: 16px;
    }

    .flow .item .text {
        position: relative;
        left: 30px;
        padding: 20px;
        background: #008c01;
    }

    .flow .item:nth-child(even) .text {
        position: relative;
        text-align: left;
        left: 30px;
    }

    .flow .item:nth-child(odd) .text {
        position: relative;
        text-align: left;
        left: 30px;
    }
}


        @media (max-width: 768px) {
          .circle-container {
            width: 100%;
            height: 100%;
            max-height: none;
            transform: none;
            top: unset;
            padding-top: 60px;
          }

          .orbiting-box {
            width: 130px;
            padding: 10px;
            font-size: 14px;
          }

          .central-circle {
            width: 140px;
            height: 140px;
            font-size: 14px;
          }
        }
      </style>
      <div class="container">
        <!-- Core Values -->
        <div class="text-center mb-5">
          <div class="d-inline-flex align-items-center mb-3">
            <img src="{{ asset('resource/web/assets/media/hero/buld-vec.png')}}" class="me-2" alt="" style="width: 30px;">
            <p class="mb-0 fw-semibold text-dark">Our Core Values</p>
          </div>
          <h2 class="fw-bold">Smart Learning. Trusted Experts. <span class="text-primary">Everywhere</span></h2>
        </div>
        <div class="row ">
          <div class="col-md-4">
            <div class="row">
              <div class="col-12">
                <div class="card h-100 shadow-sm border-0">
                  <div class="card-body pt-3 pb-3">
                    <div class="row align-items-center">
                      <div class="col-2 text-center">
                        <img src="{{ asset('resource/web/assets/media/images/equity.png')}}" alt="" srcset="">
                      </div>
                      <div class="col-10">
                        <h5 class="card-title mb-1 fw-semibold">Equity and Inclusion</h5>
                        <p class="card-text small mb-0 p-2 text-light-gray">
                          Ensuring access to quality education and training for all, with a focus on marginalized
                          communities.
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="card h-100 shadow-sm border-0">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-2 text-center">
                        <img src="{{ asset('resource/web/assets/media/images/innovation.png')}}" alt="" srcset="">
                      </div>
                      <div class="col-10">
                        <h5 class="card-title mb-1 fw-semibold">Innovation and Sustainability</h5>
                        <p class="card-text small mb-0 p-2 text-light-gray">Promoting green jobs, emerging technologies,
                          and
                          environmentally
                          sustainable practices.
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="card h-100 shadow-sm border-0">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-2 text-center">
                        <img src="{{ asset('resource/web/assets/media/images/empowerment.png')}}" alt="" srcset="">
                      </div>
                      <div class="col-10">
                        <h5 class="card-title mb-1 fw-semibold">Empowerment</h5>
                        <p class="card-text small mb-0 p-2 text-light-gray">
                          Enhancing the capabilities of children, youth, women, and farmers to achieve economic
                          independence and social impact.
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="card h-100 shadow-sm border-0">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-2 text-center">
                        <img src="{{ asset('resource/web/assets/media/images/collarabration.png')}}" alt="" srcset="">
                      </div>
                      <div class="col-10">
                        <h5 class="card-title mb-1 fw-semibold">Collaboration</h5>
                        <p class="card-text small mb-0 p-2 text-light-gray">
                          Partnering with government bodies, corporate entities, and international organizations to
                          achieve shared goals.
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-8">
            <div class="d-block d-md-block d-lg-block">
             <!-- <h1>CSS Flow</h1> -->
              <div class="block container-fluid">
                  <div class="flow">
                      <div class="item">
                          <div class="circle"></div>
                          <div class="text">
                              <h3>Step 1</h3>
                              <div>Educational Institutions</div>
                          </div>
                      </div>
                      <div class="item">
                          <div class="circle" style="background: yellow"></div>
                          <div class="text">
                              <h3>Step 2</h3>
                              <div>EdTech Platforms</div>
                          </div>
                      </div>
                      <div class="item">
                          <div class="circle" style="background: rgb(9, 156, 137)"></div>
                          <div class="text">
                              <h3>Step 3</h3>
                              <div>Infrastructure Support</div>
                          </div>
                      </div>
                      <div class="item">
                          <div class="circle" style="background: rgb(255, 0, 170)"></div>
                          <div class="text">
                              <h3>Step 4</h3>
                              <div>Community Building</div>
                          </div>
                      </div>
                      <div class="item">
                          <div class="circle" style="background: rgb(255, 60, 0)"></div>
                          <div class="text">
                              <h3>Step 5</h3>
                              <div>Empowerment</div>
                          </div>
                      </div>
                      <div class="item">
                          <div class="circle" style="background: rgb(255, 0, 157)"></div>
                          <div class="text">
                              <h3>Step 6</h3>
                              <div>Equity and Inclution</div>
                          </div>
                      </div>
                      <div class="item">
                          <div class="circle" style="background: rgb(0, 204, 255)"></div>
                          <div class="text">
                              <h3>Step 7</h3>
                              <div>Collaboration</div>
                          </div>
                      </div>
                  </div>
              </div>
            </div>
        </div>
    </div>
</div>
    <section class="py-5 bg-light mt-5 mb-5">
        <div class="container-fluid">
            <!-- Heading -->
            <div class="text-center mb-5">
            <h2 class="fw-bold">The User Base of <span class="text-primary">Skill India Digital Hub</span></h2>
            <p class="text-muted">Empowering learners of all ages — from students to professionals — to build skills and grow careers.</p>
            </div>

            <!-- User Categories -->
            <div class="row g-4">
            <!-- Card Template -->
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100 text-center p-4 rounded-4">
                <div class="icon-circle bg-primary text-white mb-3 mx-auto">
                    <i class="bi bi-book-fill fs-2"></i>
                </div>
                <h5 class="fw-semibold mb-2">Students</h5>
                <p class="text-muted small mb-0">Currently enrolled learners exploring new skills alongside formal education.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100 text-center p-4 rounded-4">
                <div class="icon-circle bg-warning text-white mb-3 mx-auto">
                    <i class="bi bi-door-open-fill fs-2"></i>
                </div>
                <h5 class="fw-semibold mb-2">Early Exit</h5>
                <p class="text-muted small mb-0">Individuals who left education early and seek meaningful skill-building pathways.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100 text-center p-4 rounded-4">
                <div class="icon-circle bg-success text-white mb-3 mx-auto">
                    <i class="bi bi-mortarboard-fill fs-2"></i>
                </div>
                <h5 class="fw-semibold mb-2">Finished Education</h5>
                <p class="text-muted small mb-0">Graduates aiming to upskill, specialize, or enter the workforce with confidence.</p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100 text-center p-4 rounded-4">
                <div class="icon-circle bg-info text-white mb-3 mx-auto">
                    <i class="bi bi-briefcase-fill fs-2"></i>
                </div>
                <h5 class="fw-semibold mb-2">In-Service Professionals</h5>
                <p class="text-muted small mb-0">Working individuals enhancing their career through flexible learning.</p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100 text-center p-4 rounded-4">
                <div class="icon-circle bg-danger text-white mb-3 mx-auto">
                    <i class="bi bi-person-x-fill fs-2"></i>
                </div>
                <h5 class="fw-semibold mb-2">Not in Employment, Education, or Training</h5>
                <p class="text-muted small mb-0">Individuals ready to re-enter education or work through upskilling programs.</p>
                </div>
            </div>
            </div>
        </div>
    </section>

    <!-- Custom Styles -->
    <style>
    .icon-circle {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    </style>




            <!-- Testimonial Section Start -->
            <section class="testimonial-sec mb-120">
                <div class="container-fluid">
                      <!-- Heading -->
                    <div class="text-center mb-5">
                        <h2 class="fw-bold">Features of  <span class="text-primary">Skill India Digital Hub</span></h2>

                        </div>
                    <div class="row row-gap-4 align-items-center">
                        <div class="col-lg-6">
                            <h4 class="mb-4">Skill India Map<h4>
                                <img src="https://d2twr397zv17p4.cloudfront.net/image/discovery-img/about/about-map.png" alt="img">
                        </div>
                        <div class="col-lg-6">
                            <h4 class="mb-4">A. Engines of Skill India Digital Hub<h4>
                            <div class="accordion" id="faqAccordion">

                                <!-- Discovery -->
                                <div class="accordion-item">
                                  <h2 class="accordion-header" id="faq1">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faqContent1" aria-expanded="true">
                                      What can users discover on the Skill India Digital Hub?
                                    </button>
                                  </h2>
                                  <div id="faqContent1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                      Users can explore <strong>free content, services, courses, training centres, and employers</strong> based on their location and interests. The platform also showcases <strong>success stories</strong> to inspire learners, trainers, and more.
                                    </div>
                                  </div>
                                </div>

                                <!-- Skilling -->
                                <div class="accordion-item">
                                  <h2 class="accordion-header" id="faq2">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqContent2">
                                      What is the focus of the Skilling section?
                                    </button>
                                  </h2>
                                  <div id="faqContent2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                      The Skilling section provides users with access to <strong>industry-aligned training programs</strong>, certifications, and courses designed to boost employability across sectors.
                                    </div>
                                  </div>
                                </div>

                                <!-- Lifelong Learning -->
                                <div class="accordion-item">
                                  <h2 class="accordion-header" id="faq3">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqContent3">
                                      Does the platform support lifelong learning?
                                    </button>
                                  </h2>
                                  <div id="faqContent3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                      Yes, Skill India Digital Hub enables <strong>learning at every stage of life</strong> — from early school leavers to professionals looking to upskill or reskill.
                                    </div>
                                  </div>
                                </div>

                                <!-- Apprenticeship -->
                                <div class="accordion-item">
                                  <h2 class="accordion-header" id="faq4">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqContent4">
                                      What apprenticeship opportunities are available?
                                    </button>
                                  </h2>
                                  <div id="faqContent4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                      Users can discover a wide range of <strong>apprenticeship opportunities</strong> that combine learning with hands-on industry experience to prepare them for the workforce.
                                    </div>
                                  </div>
                                </div>

                                <!-- Assessment -->
                                <div class="accordion-item">
                                  <h2 class="accordion-header" id="faq5">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqContent5">
                                      Is there any assessment process involved?
                                    </button>
                                  </h2>
                                  <div id="faqContent5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                      Yes, after completing a course or training, users may undergo <strong>assessments or evaluations</strong> to test their learning and receive certifications.
                                    </div>
                                  </div>
                                </div>

                                <!-- LMS -->
                                <div class="accordion-item">
                                  <h2 class="accordion-header" id="faq6">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqContent6">
                                      What is the Learning Management System (LMS) in Skill India Digital Hub?
                                    </button>
                                  </h2>
                                  <div id="faqContent6" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                      The LMS is an integrated platform that enables users to <strong>access courses, track progress, complete modules, and receive feedback</strong> in a structured online environment.
                                    </div>
                                  </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-lg-6 mt-4">
                            <h4>B. Skill India Map<h4>
                                <p>Skill India Digital Hub has a Digital Map, a blue dot concept, which can showcase the following:</p>
                                <ul>
                                    <li>Candidates will be able to locate training centres based on the courses offered, fee,location, course delivery</li>
                                    <li>Candidates will be able to identify assessment agencies for on-demand assessment</li>
                                    <li>Training partners will be able to locate candidates based on their aspiration, profile, experience, eligibility, and location Training partners will have access to the industry to help in collating demand and</li>
                                    <li>preparing course content to the need of the industry.</li>
                                </ul>
                        </div> -->
                        <!-- <div class="col-lg-6 mt-4">
                            <img src="https://d2twr397zv17p4.cloudfront.net/image/discovery-img/about/about-map.png" alt="img">
                        </div> -->
                    </div>
                </div>
            </section>
            <!-- Testimonial Section End -->

    <!-- content @e -->
    @endsection
