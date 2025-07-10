@extends('layouts.web.app')
@section('content')
            <!-- Title Banner Section Start -->
            <section class="title-banner mb-80">
                <div class="container-fluid">
                    <h1>All Courses</h1>
                </div>
            </section>
            <!-- Title Banner Section End -->
            <!-- Couse Section Start -->
            <section class="couses-sec mb-120">
                <div class="container-fluid">
                    <h4 class="text-center mb-2">Please select sectoy to expore skill courses</h4>
                    <div class="wrapper">
                        <div class="searchBar mb-4">
                            <input id="searchQueryInput" type="text" name="searchQueryInput" placeholder="Search"
                                value="" />
                            <button id="searchQuerySubmit" type="submit" name="searchQuerySubmit">
                                <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                    <path fill="#666666"
                                        d="M9.5,3A6.5,6.5 0 0,1 16,9.5C16,11.11 15.41,12.59 14.44,13.73L14.71,14H15.5L20.5,19L19,20.5L14,15.5V14.71L13.73,14.44C12.59,15.41 11.11,16 9.5,16A6.5,6.5 0 0,1 3,9.5A6.5,6.5 0 0,1 9.5,3M9.5,5C7,5 5,7 5,9.5C5,12 7,14 9.5,14C12,14 14,12 14,9.5C14,7 12,5 9.5,5Z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <style>
                        .wrapper {
                            width: 100%;
                            max-width: 31.25rem;
                            margin: 1rem auto;
                        }

                        .label {
                            font-size: .625rem;
                            font-weight: 400;
                            text-transform: uppercase;
                            letter-spacing: +1.3px;
                            margin-bottom: 1rem;
                        }

                        .searchBar {
                            width: 100%;
                            display: flex;
                            flex-direction: row;
                            align-items: center;
                        }

                        #searchQueryInput {
                            width: 100%;
                            height: 2.8rem;
                            background: #f5f5f5;
                            outline: none;
                            border: none;
                            border-radius: 1.625rem;
                            padding: 0 3.5rem 0 1.5rem;
                            font-size: 1rem;
                        }

                        #searchQuerySubmit {
                            width: 3.5rem;
                            height: 2.8rem;
                            margin-left: -3.5rem;
                            background: none;
                            border: none;
                            outline: none;
                        }

                        #searchQuerySubmit:hover {
                            cursor: pointer;
                        }
                    </style>
                    <!-- <div
                     class="d-flex align-items-center justify-content-sm-between justify-content-center row-gap-4 flex-wrap mb-24">
                     <h4 class="text-center">Please select sectoy to expore skill courses</h4>
                     <div class="d-flex align-items-center gap-8">
                         <p class="flex-shrink-0">Sort By:</p>
                         <div class="w-100 drop-container">
                             <div class="wrapper-dropdown form-control" id="dropdown-l2">
                                 <div class=" d-flex align-items-center justify-content-between gap-64">
                                     <span class="selected-display black" id="desation112">Newest First</span>
                                     <svg id="drop-down2" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                         viewBox="0 0 20 20" fill="none">
                                         <path
                                             d="M19.7337 4.81165C19.3788 4.45668 18.8031 4.45662 18.4481 4.81171L10.0002 13.2598L1.55191 4.81165C1.19694 4.45668 0.621303 4.45662 0.266273 4.81171C-0.0887576 5.16674 -0.0887576 5.74232 0.266273 6.09735L9.35742 15.1883C9.52791 15.3587 9.75912 15.4545 10.0002 15.4545C10.2413 15.4545 10.4726 15.3587 10.643 15.1882L19.7337 6.09729C20.0888 5.74232 20.0888 5.16668 19.7337 4.81165Z"
                                             fill="#92949F" />
                                     </svg>
                                 </div>
                                 <ul class="topbar-dropdown">
                                     <li class="item">Newest First</li>
                                     <li class="item">Newest Last</li>
                                     <li class="item">End</li>
                                 </ul>
                             </div>
                         </div>
                     </div>
                     </div> -->
                    <div class="row row-gap-4 mb-48">
                        <div class="col-lg-3 col-md-6">
                            <div class="course-card">
                                <a href="/coursemode" class="card-img">
                                    <img src="{{ asset('resource/web/assets/media/images/course-img-1.jpg')}}" alt="">
                                </a>
                                <div class="card-content">
                                    <a href="/coursemode" class="h5 fw-500 mb-16">Mastering Webflow: </a>
                                    <p>Compellingly procrastinate equity invested markets with efficient..</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="course-card">
                                <a href="/coursemode" class="card-img">
                                    <img src="{{ asset('resource/web/assets/media/images/course-img-2.jpg')}}" alt="">
                                </a>
                                <div class="card-content">
                                    <a href="/coursemode" class="h5 fw-500 mb-16">Learning Java Script:
                                    </a>
                                    <p>Compellingly procrastinate equity invested markets with efficient..</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="course-card">
                                <a href="/coursemode" class="card-img">
                                    <img src="{{ asset('resource/web/assets/media/images/course-img-3.jpg')}}" alt="">
                                </a>
                                <div class="card-content">
                                    <a href="/coursemode" class="h5 fw-500 mb-16">Excelling Web:</a>
                                    <p>Compellingly procrastinate equity invested markets with efficient..</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="course-card">
                                <a href="/coursemode" class="card-img">
                                    <img src="{{ asset('resource/web/assets/media/images/course-img-3.jpg')}}" alt="">
                                </a>
                                <div class="card-content">
                                    <a href="/coursemode" class="h5 fw-500 mb-16">Excelling Web</a>
                                    <p>Compellingly procrastinate equity invested markets with efficient..</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="course-card">
                                <a href="/coursemode" class="card-img">
                                    <img src="{{ asset('resource/web/assets/media/images/course-img-2.jpg')}}" alt="">
                                </a>
                                <div class="card-content">
                                    <a href="/coursemode" class="h5 fw-500 mb-16">Learning Java Script:</a>
                                    <p>Compellingly procrastinate equity invested markets with efficient..</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="course-card">
                                <a href="/coursemode" class="card-img">
                                    <img src="{{ asset('resource/web/assets/media/images/course-img-1.jpg')}}" alt="">
                                </a>
                                <div class="card-content">
                                    <a href="/coursemode" class="h5 fw-500 mb-16">Mastering Webflow: </a>
                                    <p>Compellingly procrastinate equity invested markets with efficient..</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="course-card">
                                <a href="/coursemode" class="card-img">
                                    <img src="{{ asset('resource/web/assets/media/images/course-img-1.jpg')}}" alt="">
                                </a>
                                <div class="card-content">
                                    <a href="/coursemode" class="h5 fw-500 mb-16">Mastering Webflow: </a>
                                    <p>Compellingly procrastinate equity invested markets with efficient..</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="course-card">
                                <a href="/coursemode" class="card-img">
                                    <img src="{{ asset('resource/web/assets/media/images/course-img-2.jpg')}}" alt="">
                                </a>
                                <div class="card-content">
                                    <a href="/coursemode" class="h5 fw-500 mb-16">Learning Java Script:
                                    </a>
                                    <p>Compellingly procrastinate equity invested markets with efficient..</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pagination">
                        <ul id="border-pagination" class="mb-0">
                            <li>
                                <a href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="14" viewBox="0 0 19 14"
                                        fill="none">
                                        <path
                                            d="M0.876656 6.61218L6.70999 0.778849C6.86716 0.62705 7.07766 0.543055 7.29616 0.544953C7.51465 0.546852 7.72366 0.634493 7.87817 0.789C8.03268 0.943507 8.12032 1.15252 8.12222 1.37101C8.12412 1.58951 8.04012 1.80001 7.88832 1.95718L3.47749 6.36801H18.1325C18.3535 6.36801 18.5655 6.45581 18.7217 6.61209C18.878 6.76837 18.9658 6.98033 18.9658 7.20135C18.9658 7.42236 18.878 7.63432 18.7217 7.7906C18.5655 7.94688 18.3535 8.03468 18.1325 8.03468H3.47749L7.88832 12.4455C7.96791 12.5224 8.0314 12.6143 8.07507 12.716C8.11875 12.8177 8.14174 12.927 8.1427 13.0377C8.14366 13.1483 8.12257 13.2581 8.08067 13.3605C8.03877 13.4629 7.9769 13.5559 7.89865 13.6342C7.82041 13.7124 7.72736 13.7743 7.62495 13.8162C7.52254 13.8581 7.4128 13.8792 7.30215 13.8782C7.19151 13.8773 7.08216 13.8543 6.98048 13.8106C6.87882 13.7669 6.78686 13.7034 6.70999 13.6238L0.876656 7.79051C0.72043 7.63424 0.632668 7.42232 0.632668 7.20135C0.632668 6.98038 0.72043 6.76845 0.876656 6.61218Z"
                                            fill="#F59300" />
                                    </svg>
                                </a>
                            </li>
                            <li><a href="#" class="active">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li>
                                <a href="#" class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 21 21"
                                        fill="none">
                                        <path
                                            d="M19.1233 9.61218L13.29 3.77885C13.1328 3.62705 12.9223 3.54305 12.7038 3.54495C12.4853 3.54685 12.2763 3.63449 12.1218 3.789C11.9673 3.94351 11.8797 4.15252 11.8778 4.37101C11.8759 4.58951 11.9599 4.80001 12.1117 4.95718L16.5225 9.36801H1.86751C1.6465 9.36801 1.43454 9.45581 1.27826 9.61209C1.12198 9.76837 1.03418 9.98033 1.03418 10.2013C1.03418 10.4224 1.12198 10.6343 1.27826 10.7906C1.43454 10.9469 1.6465 11.0347 1.86751 11.0347H16.5225L12.1117 15.4455C12.0321 15.5224 11.9686 15.6143 11.9249 15.716C11.8813 15.8177 11.8583 15.927 11.8573 16.0377C11.8563 16.1483 11.8774 16.2581 11.9193 16.3605C11.9612 16.4629 12.0231 16.5559 12.1013 16.6342C12.1796 16.7124 12.2726 16.7743 12.375 16.8162C12.4775 16.8581 12.5872 16.8792 12.6978 16.8782C12.8085 16.8773 12.9178 16.8543 13.0195 16.8106C13.1212 16.7669 13.2131 16.7034 13.29 16.6238L19.1233 10.7905C19.2796 10.6342 19.3673 10.4223 19.3673 10.2013C19.3673 9.98038 19.2796 9.76845 19.1233 9.61218Z"
                                            fill="#F59300" />
                                    </svg>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </section>
            <!-- Couse Section End -->
            
    <!-- content @e -->
    @endsection