   @extends('layouts.web.app')
   @push('meta')
       <title>{{ $metaTitle ?? ($program->title ?? 'Default Page Title') }}</title>

       <meta name="description" content="{{ $metaDescription ?? Str::limit(strip_tags($program->description ?? ''), 150) }}">
       <meta name="keywords" content="{{ $metaKeywords ?? 'announcement, news, education' }}">
       <meta name="author" content="{{ $metaAuthor ?? 'YourSiteName' }}">
       <meta name="robots" content="{{ $metaRobots ?? 'index, follow' }}">

       <!-- Canonical Tag -->
       <link rel="canonical" href="{{ $metaCanonical ?? url()->current() }}">

       <!-- Open Graph -->
       <meta property="og:title" content="{{ $metaOgTitle ?? ($program->title ?? 'Default OG Title') }}">
       <meta property="og:description"
           content="{{ $metaOgDescription ?? Str::limit(strip_tags($program->description ?? ''), 150) }}">
       <meta property="og:type" content="website">
       <meta property="og:url" content="{{ $metaOgUrl ?? url()->current() }}">
       <meta property="og:image" content="{{ $metaOgImage ?? asset($program->image ?? 'default.jpg') }}">

       <!-- Twitter Card -->
       <meta name="twitter:card" content="summary_large_image">
       <meta name="twitter:title" content="{{ $metaTwitterTitle ?? ($program->title ?? 'Default Twitter Title') }}">
       <meta name="twitter:description"
           content="{{ $metaTwitterDescription ?? Str::limit(strip_tags($program->description ?? ''), 150) }}">
       <meta name="twitter:image" content="{{ $metaTwitterImage ?? asset($program->image ?? 'default.jpg') }}">
   @endpush
   @section('content')
       <!-- Yout Content Here -->
       <section class="title-banner mb-80" style="background-image: url({{ asset($program->banner_image) }})">
           <div class="container-fluid">
               <h2 class="fw-500 mb-24 fs-xs-18">{{ $program && $program->title ? Str::limit($program->title, 200, '...') : '' }}<br class="d-sm-block d-none">
                   <span class="color-primary">{{ $program && $program->subtitle ? Str::limit($program->subtitle, 200, '...') : '' }}</span>
               </h2>
               <div class="d-flex align-items-center gap-16 flex-wrap row-gap-4">
                   <div class="d-flex align-items-center gap-8">
                    <i class="bi bi-folder text-white fw-bold"></i>
                       <p class="light-gray">Announcement</p>
                   </div>
                   <div class="d-flex align-items-center gap-8">
                    <i class="bi bi-calendar text-white fw-bold"></i>
                       <p class="light-gray">{{ \Carbon\Carbon::parse($program->created_at)->format('F jS, Y') }}</p>
                   </div>
                   <div class="d-flex align-items-center gap-8">
                   </div>
               </div>
           </div>
       </section>
       <style>
           body {
               position: relative;
           }

           .nav-link {
               cursor: pointer;
           }

           .accordion-button:not(.collapsed) {
               background-color: #f5f5f5;
           }
       </style>
       <!-- BLog Detail Section Start -->
       <section class="blog-detail-sec mb-120">
           <div class="container-fluid">
               <div class="row row-gap-4">
                   <div class="col-lg-8">
                    <div class="mb-3">
                        {{-- Event Or Compition Images --}}
                        @if ($program->images && $program->images->count() > 0)
                            <div id="carouselId" class="carousel slide" data-bs-ride="carousel">

                                {{-- Indicators --}}
                                <div class="carousel-indicators">
                                @foreach ($program->images as $index => $image)
                                        <button type="button" data-bs-target="#carouselId" data-bs-slide-to="{{ $index }}"
                                            @class(['active' => $index === 0]) aria-current="{{ $index === 0 ? 'true' : 'false' }}"
                                            aria-label="Slide {{ $index + 1 }}"></button>
                                @endforeach
                                </div>

                                {{-- Slides --}}
                                <div class="carousel-inner" role="listbox">
                                @foreach ($program->images as $index => $image)
                                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                            <img src="{{ asset($image->file_name) }}" class="w-100 d-block"
                                            alt="{{ $image->alt_text ?? 'Slide ' . ($index + 1) }}">
                                        </div>
                                @endforeach
                                </div>

                                {{-- Controls --}}
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hsidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        @endif
                    </div>
                     <div class="overflow-auto">
                        {!! $program->description !!}
                     </div>
                       <div class="container my-5">
                           @php
                              $points = [];

                              if (!empty($program->points)) {
                                 $points = is_string($program->points)
                                       ? json_decode($program->points, true)
                                       : $program->points;
                              }
                           @endphp
                           @if(!empty($points))
                              <div class="row">
                                 <!-- Sidebar -->
                                 <div class="col-lg-4 mb-4">
                                    <nav id="navbar-example"
                                          class="navbar sticky-top flex-column align-items-stretch p-3 bg-light rounded">
                                          <h5 class="fw-bold mb-3">About Topics</h5>
                                          <nav class="nav nav-pills flex-column">
                                             @foreach ($points as $index => $item)
                                                @php
                                                      $parts = explode(' - ', $item, 2);
                                                      $shortTitle = $parts[0] ?? '';
                                                      $sectionId = 'section' . ($index + 1);
                                                @endphp
                                                @if (trim($shortTitle) !== '')
                                                      <a class="nav-link" href="#{{ $sectionId }}">{{ $index + 1 }}.
                                                         {{ $shortTitle }}</a>
                                                @endif
                                             @endforeach
                                          </nav>
                                    </nav>
                                 </div>

                                 <!-- Content -->
                                 <div class="col-lg-8">
                                    <h3 class="fw-bold mb-4">{{ $program->title }} - Highlights</h3>
                                    <p class="mb-4">
                                          {!! $program->short_description !!}
                                    </p>
                                    <div class="accordion" id="accordionExample">
                                          @foreach ($points as $index => $item)
                                             @php
                                                $parts = explode(' - ', $item, 2);
                                                $shortTitle = $parts[0] ?? null;
                                                $content = $parts[1] ?? null;
                                                $sectionId = 'section' . ($index + 1);
                                                $collapseId = 'collapse' . ($index + 1);
                                             @endphp

                                             @if ($shortTitle && $content)
                                                <div class="accordion-item" id="{{ $sectionId }}">
                                                      <h2 class="accordion-header">
                                                         <button
                                                            class="accordion-button {{ $index !== 0 ? 'collapsed' : '' }}"
                                                            type="button" data-bs-toggle="collapse"
                                                            data-bs-target="#{{ $collapseId }}">
                                                            {{ $index + 1 }}. {{ $shortTitle }}
                                                         </button>
                                                      </h2>
                                                      <div id="{{ $collapseId }}"
                                                         class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}"
                                                         data-bs-parent="#accordionExample">
                                                         <div class="accordion-body">
                                                            {{ $content }}
                                                         </div>
                                                      </div>
                                                </div>
                                             @endif
                                          @endforeach
                                    </div>
                                 </div>
                              </div>
                           @endif
                       </div>
                   </div>
                   <div class="col-lg-4">
                       <div class="siderbar">
                           <div class="sidebar-block mb-48">
                               <h5 class="fw-500 mb-24">Similar Programs</h5>
                               @forelse($similars as $similar)
                                   <div class="recent-article mb-12">
                                       <img src="{{ asset($similar->image) }}" class="article-img"
                                           alt="{{ $similar->title }}">
                                       <div>
                                           <a href="{{ route('web.upcoming.project', [$similar->category->slug, $similar->slug]) }}"
                                               class="fw-500 black mb-8 hover-content">
                                               {{ Str::limit($similar->title, 60) }}
                                           </a>
                                           <p class="light-gray subtitle">
                                               {{ \Carbon\Carbon::parse($similar->created_at)->format('d/m/Y') }}</p>
                                       </div>
                                   </div>
                               @empty
                                   <p>No similar programs found.</p>
                               @endforelse
                           </div>
                           <div class="sidebar-block">
                               <h5 class="fw-500 mb-24">Tags</h5>
                               <div class="tag-block">
                                   @forelse($similars as $similar)
                                       <a
                                           href="{{ route('web.announcement.program', [$similar->category->slug, $similar->slug]) }}">
                                           {{ Str::limit($similar->title, 25, '...') }}</a>
                                   @endforeach
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </section>
   @endsection
