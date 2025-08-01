   @extends('layouts.web.app')
   @push('meta')
      <title>{{ $metaTitle ?? $blog->title ?? 'Default Page Title' }}</title>

      <meta name="description" content="{{ $metaDescription ?? Str::limit(strip_tags($blog->description ?? ''), 150) }}">
      <meta name="keywords" content="{{ $metaKeywords ?? 'announcement, news, education' }}">
      <meta name="author" content="{{ $metaAuthor ?? 'YourSiteName' }}">
      <meta name="robots" content="{{ $metaRobots ?? 'index, follow' }}">

      <!-- Canonical Tag -->
      <link rel="canonical" href="{{ $metaCanonical ?? url()->current() }}">

      <!-- Open Graph -->
      <meta property="og:title" content="{{ $metaOgTitle ?? $blog->title ?? 'Default OG Title' }}">
      <meta property="og:description" content="{{ $metaOgDescription ?? Str::limit(strip_tags($blog->description ?? ''), 150) }}">
      <meta property="og:type" content="website">
      <meta property="og:url" content="{{ $metaOgUrl ?? url()->current() }}">
      <meta property="og:image" content="{{ $metaOgImage ?? asset($blog->image ?? 'default.jpg') }}">

      <!-- Twitter Card -->
      <meta name="twitter:card" content="summary_large_image">
      <meta name="twitter:title" content="{{ $metaTwitterTitle ?? $blog->title ?? 'Default Twitter Title' }}">
      <meta name="twitter:description" content="{{ $metaTwitterDescription ?? Str::limit(strip_tags($blog->description ?? ''), 150) }}">
      <meta name="twitter:image" content="{{ $metaTwitterImage ?? asset($blog->image ?? 'default.jpg') }}">
   @endpush
   @section('content')
   <!-- Yout Content Here -->
   <section class="title-banner mb-80" style="background-image: url({{ asset($blog->banner_image) }})">
      <div class="container-fluid">
         <h2 class="fw-500 mb-24">{{ $blog->title ?? null }}<br class="d-sm-block d-none">
            <span class="color-primary">{{ $blog->subtitle ?? null }}</span>
         </h2>
         <div class="d-flex align-items-center gap-16 flex-wrap row-gap-4">
            <div class="d-flex align-items-center gap-8">
               <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                  fill="none">
                  <path
                     d="M18.749 6H10.1002L8.61652 3.3801C8.5511 3.2647 8.45623 3.16871 8.3416 3.10194C8.22697 3.03516 8.09668 2.99999 7.96402 3H1.49902C1.30011 3 1.10935 3.07902 0.968693 3.21967C0.828041 3.36032 0.749023 3.55109 0.749023 3.75V20.25C0.749088 20.4252 0.810412 20.5948 0.922373 20.7295C1.03433 20.8642 1.18988 20.9555 1.36207 20.9876C1.40741 20.9956 1.45335 20.9998 1.4994 21C1.65093 21 1.7989 20.9541 1.92382 20.8683C2.04875 20.7825 2.14476 20.661 2.19922 20.5196L5.76427 11.25H18.749C18.9479 11.25 19.1387 11.171 19.2794 11.0303C19.42 10.8897 19.499 10.6989 19.499 10.5V6.75C19.499 6.55109 19.42 6.36032 19.2794 6.21967C19.1387 6.07902 18.9479 6 18.749 6Z"
                     fill="#E8A113"></path>
                  <path
                     d="M23.1175 10.0752C23.0486 9.97491 22.9563 9.8929 22.8486 9.83625C22.7409 9.77959 22.621 9.74999 22.4993 9.75H5.24934C5.09777 9.75006 4.94977 9.79599 4.8248 9.88174C4.69982 9.96749 4.60372 10.0891 4.54914 10.2305L0.799136 19.9804C0.75537 20.0941 0.739933 20.2167 0.754159 20.3376C0.768384 20.4586 0.811844 20.5742 0.880783 20.6746C0.949722 20.775 1.04207 20.8571 1.14984 20.9138C1.25761 20.9704 1.37756 21.0001 1.49934 21H18.7493C18.9009 20.9999 19.0489 20.954 19.1739 20.8683C19.2988 20.7825 19.3949 20.6609 19.4495 20.5196L23.1995 10.7695C23.2432 10.6558 23.2585 10.5332 23.2442 10.4122C23.2299 10.2913 23.1864 10.1756 23.1175 10.0752Z"
                     fill="#FFC431"></path>
               </svg>
               <p class="light-gray">Announcement</p>
            </div>
            <div class="d-flex align-items-center gap-8">
               <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                  fill="none">
                  <g clip-path="url(#clip0_11629_7425)">
                     <path
                        d="M21.2493 3.98854C21.2493 3.1138 20.5402 2.40472 19.6654 2.40472H18.6345C17.9966 2.40472 5.38931 2.40472 4.96795 2.40472C4.58194 2.40472 2.08477 2.40472 1.58386 2.40472C0.709219 2.40472 0 3.11385 0 3.98854V22.07C0 22.5227 0.190266 22.9307 0.494812 23.2194H19.6654V23.6539H22.4398C23.1214 23.6539 23.7025 23.2232 23.9258 22.6191C24.1109 22.1299 24.1763 23.0651 21.2493 3.98854Z"
                        fill="#BABABA"></path>
                     <path
                        d="M22.216 22.0701V10.2922L21.2489 3.98854C21.2489 3.1138 20.5397 2.40472 19.665 2.40472C19.1464 2.40472 6.65686 2.40472 5.9347 2.40472H4.96753H4.58067C3.6848 2.40472 3.98616 2.40472 2.55066 2.40472C1.67602 2.40472 0.966797 3.1138 0.966797 3.98854V22.07C0.966797 22.5227 1.15706 22.9307 1.46161 23.2194H19.665V23.6539H20.6322C21.5069 23.6539 22.216 22.9448 22.216 22.0701Z"
                        fill="#A8A8A8"></path>
                     <path
                        d="M19.6654 2.40472C19.1112 2.40472 5.8807 2.40472 4.96795 2.40472C4.42148 2.40472 1.95333 2.40472 1.58386 2.40472C0.709219 2.40472 0 3.11385 0 3.98854V22.07C0 22.9448 0.709219 23.6539 1.58386 23.6539H19.6654C20.5401 23.6539 21.2493 22.9448 21.2493 22.07V3.98854C21.2493 3.11385 20.5401 2.40472 19.6654 2.40472Z"
                        fill="#E6E6E6"></path>
                     <path
                        d="M0.967172 22.0701V3.98854C0.967172 3.1138 1.67639 2.40472 2.55103 2.40472C2.00588 2.40472 2.13075 2.40472 1.58386 2.40472C0.709219 2.40472 0 3.11385 0 3.98854V22.07C0 22.9448 0.709219 23.6539 1.58386 23.6539H2.55103C1.67644 23.6539 0.967172 22.9448 0.967172 22.0701Z"
                        fill="#CCCBCA"></path>
                     <path
                        d="M19.6654 2.40472C19.0362 2.40472 6.01819 2.40472 4.96795 2.40472C1.21809 2.40472 5.09405 2.40472 1.58386 2.40472C0.709219 2.40472 0 3.11385 0 3.98854V8.0571H21.2493V3.98854C21.2493 3.11385 20.5401 2.40472 19.6654 2.40472Z"
                        fill="#EA473B"></path>
                     <path
                        d="M0.967172 3.98854C0.967172 3.1138 1.67639 2.40472 2.55103 2.40472C2.00588 2.40472 2.13075 2.40472 1.58386 2.40472C0.709219 2.40472 0 3.11385 0 3.98854V8.0571H0.967172V3.98854Z"
                        fill="#D63322"></path>
                     <path
                        d="M16.9605 3.82114V4.15086C16.9605 4.47139 16.7007 4.48939 16.3802 4.48939H16.1867C15.8663 4.48939 15.6064 4.47139 15.6064 4.15086V3.82118C15.2996 4.03531 15.0986 4.39071 15.0986 4.79328C15.0986 5.44765 15.6291 5.97809 16.2834 5.97809C17.4439 5.97804 17.9049 4.4802 16.9605 3.82114Z"
                        fill="#414356"></path>
                     <path
                        d="M10.9644 3.82114V4.15086C10.9644 4.47139 10.7046 4.44101 10.3841 4.44101H10.1906C9.87016 4.44101 9.61034 4.47139 9.61034 4.15086V3.82118C9.30349 4.03531 9.10254 4.39071 9.10254 4.79328C9.10254 5.44765 9.63302 5.97809 10.2874 5.97809C10.9417 5.97809 11.4722 5.44765 11.4722 4.79328C11.4722 4.39071 11.2712 4.03526 10.9644 3.82114Z"
                        fill="#414356"></path>
                     <path
                        d="M4.96741 3.82114V4.15086C4.96741 4.52454 4.61571 4.48939 4.19364 4.48939C3.87316 4.48939 3.61333 4.47139 3.61333 4.15086V3.82118C2.668 4.4809 3.13136 5.97809 4.29035 5.97809C4.94472 5.97809 5.47516 5.44765 5.47516 4.79328C5.47516 4.39071 5.27421 4.03526 4.96741 3.82114Z"
                        fill="#414356"></path>
                     <path
                        d="M16.1142 4.79332C16.1142 4.77087 16.1151 4.74865 16.1163 4.72652C15.8291 4.6917 15.6064 4.44752 15.6064 4.1509V3.82123C15.2996 4.03535 15.0986 4.39076 15.0986 4.79332C15.0986 5.4477 15.6291 5.97813 16.2834 5.97813C16.4652 5.97813 16.6373 5.93712 16.7912 5.86395C16.391 5.67377 16.1142 5.26592 16.1142 4.79332Z"
                        fill="#2F3242"></path>
                     <path
                        d="M10.1172 4.79332C10.1172 4.77087 10.118 4.74865 10.1192 4.72652C9.83202 4.6917 9.60936 4.44752 9.60936 4.1509V3.82123C9.30252 4.03535 9.10156 4.39076 9.10156 4.79332C9.10156 5.4477 9.63205 5.97813 10.2864 5.97813C10.4681 5.97813 10.6402 5.93712 10.7942 5.86395C10.3939 5.67377 10.1172 5.26592 10.1172 4.79332Z"
                        fill="#2F3242"></path>
                     <path
                        d="M4.12312 4.72652C3.83592 4.6917 3.61327 4.44752 3.61327 4.1509V3.82123C3.30642 4.03535 3.10547 4.39076 3.10547 4.79332C3.10547 5.66595 4.01691 6.23515 4.79803 5.86395C4.37363 5.66224 4.09566 5.22138 4.12312 4.72652Z"
                        fill="#2F3242"></path>
                     <path d="M21.2494 8.05692H0V9.41099H21.2494V8.05692Z" fill="#F77C79"></path>
                     <path d="M0.967172 8.05692H0V9.41099H0.967172V8.05692Z" fill="#DD6464"></path>
                     <path
                        d="M4.38802 0.346161C4.70855 0.346161 4.96834 0.605989 4.96834 0.926473V4.15044C4.96834 4.47097 4.70855 4.73075 4.38802 4.73075H4.19457C3.87409 4.73075 3.61426 4.47097 3.61426 4.15044V0.926473C3.61426 0.605989 3.87409 0.346161 4.19457 0.346161H4.38802Z"
                        fill="#585A60"></path>
                     <path
                        d="M10.3841 0.346161C10.7046 0.346161 10.9644 0.605989 10.9644 0.926473V4.15044C10.9644 4.47097 10.7046 4.73075 10.3841 4.73075H10.1907C9.87018 4.73075 9.61035 4.47097 9.61035 4.15044V0.926473C9.61035 0.605989 9.87018 0.346161 10.1907 0.346161H10.3841Z"
                        fill="#585A60"></path>
                     <path
                        d="M16.3812 0.346161C16.7017 0.346161 16.9615 0.605989 16.9615 0.926473V4.15044C16.9615 4.47097 16.7017 4.73075 16.3812 4.73075H16.1877C15.8672 4.73075 15.6074 4.47097 15.6074 4.15044V0.926473C15.6074 0.605989 15.8672 0.346161 16.1877 0.346161H16.3812Z"
                        fill="#585A60"></path>
                     <path
                        d="M4.38705 0.346619C4.70758 0.346619 4.96736 0.606447 4.96736 0.926931V4.1509C4.96736 4.47143 4.70758 4.73121 4.38705 4.73121H4.19359C3.87311 4.73121 3.61328 4.47143 3.61328 4.1509V0.926931C3.61328 0.606447 3.87311 0.346619 4.19359 0.346619H4.38705Z"
                        fill="#585A60"></path>
                     <path
                        d="M10.3841 0.346619C10.7046 0.346619 10.9644 0.606447 10.9644 0.926931V4.1509C10.9644 4.47143 10.7046 4.73121 10.3841 4.73121H10.1907C9.87018 4.73121 9.61035 4.47143 9.61035 4.1509V0.926931C9.61035 0.606447 9.87018 0.346619 10.1907 0.346619H10.3841Z"
                        fill="#585A60"></path>
                     <path
                        d="M16.3802 0.346619C16.7007 0.346619 16.9605 0.606447 16.9605 0.926931V4.1509C16.9605 4.47143 16.7007 4.73121 16.3802 4.73121H16.1868C15.8663 4.73121 15.6064 4.47143 15.6064 4.1509V0.926931C15.6064 0.606447 15.8663 0.346619 16.1868 0.346619H16.3802Z"
                        fill="#585A60"></path>
                     <path
                        d="M4.2903 4.1509V0.926931C4.2903 0.692837 4.42923 0.49165 4.62883 0.399869C4.55514 0.366025 4.47344 0.346619 4.38705 0.346619H4.19359C3.87311 0.346619 3.61328 0.606447 3.61328 0.926931V4.1509C3.61328 4.47143 3.87311 4.73121 4.19359 4.73121H4.38705C4.47348 4.73121 4.55519 4.71181 4.62883 4.67796C4.42923 4.58623 4.2903 4.38499 4.2903 4.1509Z"
                        fill="#414356"></path>
                     <path
                        d="M10.2864 4.1509V0.926931C10.2864 0.692837 10.4253 0.49165 10.6249 0.399869C10.5512 0.366025 10.4695 0.346619 10.3831 0.346619H10.1897C9.8692 0.346619 9.60938 0.606447 9.60938 0.926931V4.1509C9.60938 4.47143 9.8692 4.73121 10.1897 4.73121H10.3831C10.4696 4.73121 10.5513 4.71181 10.6249 4.67796C10.4253 4.58623 10.2864 4.38499 10.2864 4.1509Z"
                        fill="#414356"></path>
                     <path
                        d="M16.2835 4.1509V0.926931C16.2835 0.692837 16.4224 0.49165 16.622 0.399869C16.5483 0.366025 16.4666 0.346619 16.3802 0.346619H16.1868C15.8663 0.346619 15.6064 0.606447 15.6064 0.926931V4.1509C15.6064 4.47143 15.8663 4.73121 16.1868 4.73121H16.3802C16.4666 4.73121 16.5484 4.71181 16.622 4.67796C16.4224 4.58623 16.2835 4.38499 16.2835 4.1509Z"
                        fill="#414356"></path>
                     <path
                        d="M7.90252 11.633H6.70842C6.50813 11.633 6.3457 11.7953 6.3457 11.9957C6.3457 12.196 6.50813 12.3584 6.70842 12.3584H7.90252C8.10286 12.3584 8.26523 12.196 8.26523 11.9957C8.26523 11.7954 8.10286 11.633 7.90252 11.633Z"
                        fill="#585A60"></path>
                     <path
                        d="M11.223 11.633H10.0287C9.82844 11.633 9.66602 11.7953 9.66602 11.9957C9.66602 12.196 9.82844 12.3584 10.0287 12.3584H11.223C11.4233 12.3584 11.5857 12.196 11.5857 11.9957C11.5856 11.7954 11.4233 11.633 11.223 11.633Z"
                        fill="#585A60"></path>
                     <path
                        d="M14.5424 11.633H13.3481C13.1478 11.633 12.9854 11.7953 12.9854 11.9957C12.9854 12.196 13.1478 12.3584 13.3481 12.3584H14.5424C14.7426 12.3584 14.9051 12.196 14.9051 11.9957C14.9051 11.7954 14.7426 11.633 14.5424 11.633Z"
                        fill="#585A60"></path>
                     <path
                        d="M17.8616 11.633H16.6674C16.4671 11.633 16.3047 11.7953 16.3047 11.9957C16.3047 12.196 16.4671 12.3584 16.6674 12.3584H17.8616C18.062 12.3584 18.2244 12.196 18.2244 11.9957C18.2243 11.7954 18.062 11.633 17.8616 11.633Z"
                        fill="#585A60"></path>
                     <path
                        d="M4.58332 14.5551H3.38909C3.18879 14.5551 3.02637 14.7175 3.02637 14.9179C3.02637 15.1182 3.18879 15.2806 3.38909 15.2806H4.58332C4.78366 15.2806 4.94604 15.1182 4.94604 14.9179C4.94599 14.7175 4.78366 14.5551 4.58332 14.5551Z"
                        fill="#585A60"></path>
                     <path
                        d="M7.90252 14.5551H6.70842C6.50813 14.5551 6.3457 14.7175 6.3457 14.9179C6.3457 15.1182 6.50813 15.2806 6.70842 15.2806H7.90252C8.10286 15.2806 8.26523 15.1182 8.26523 14.9179C8.26523 14.7175 8.10286 14.5551 7.90252 14.5551Z"
                        fill="#585A60"></path>
                     <path
                        d="M11.223 14.5551H10.0287C9.82844 14.5551 9.66602 14.7175 9.66602 14.9179C9.66602 15.1182 9.82844 15.2806 10.0287 15.2806H11.223C11.4233 15.2806 11.5857 15.1182 11.5857 14.9179C11.5856 14.7175 11.4233 14.5551 11.223 14.5551Z"
                        fill="#585A60"></path>
                     <path
                        d="M14.5424 14.5551H13.3481C13.1478 14.5551 12.9854 14.7175 12.9854 14.9179C12.9854 15.1182 13.1478 15.2806 13.3481 15.2806H14.5424C14.7426 15.2806 14.9051 15.1182 14.9051 14.9179C14.9051 14.7175 14.7426 14.5551 14.5424 14.5551Z"
                        fill="#585A60"></path>
                     <path
                        d="M17.8616 14.5551H16.6674C16.4671 14.5551 16.3047 14.7175 16.3047 14.9179C16.3047 15.1182 16.4671 15.2806 16.6674 15.2806H17.8616C18.062 15.2806 18.2244 15.1182 18.2244 14.9179C18.2243 14.7175 18.062 14.5551 17.8616 14.5551Z"
                        fill="#585A60"></path>
                     <path
                        d="M4.58332 17.4773H3.38909C3.18879 17.4773 3.02637 17.6397 3.02637 17.84C3.02637 18.0404 3.18879 18.2028 3.38909 18.2028H4.58332C4.78366 18.2028 4.94604 18.0404 4.94604 17.84C4.94604 17.6397 4.78366 17.4773 4.58332 17.4773Z"
                        fill="#585A60"></path>
                     <path
                        d="M7.90252 17.4773H6.70842C6.50813 17.4773 6.3457 17.6397 6.3457 17.84C6.3457 18.0404 6.50813 18.2028 6.70842 18.2028H7.90252C8.10286 18.2028 8.26523 18.0404 8.26523 17.84C8.26523 17.6397 8.10286 17.4773 7.90252 17.4773Z"
                        fill="#585A60"></path>
                     <path
                        d="M11.223 17.4773H10.0287C9.82844 17.4773 9.66602 17.6397 9.66602 17.84C9.66602 18.0404 9.82844 18.2028 10.0287 18.2028H11.223C11.4233 18.2028 11.5857 18.0404 11.5857 17.84C11.5857 17.6397 11.4233 17.4773 11.223 17.4773Z"
                        fill="#585A60"></path>
                     <path
                        d="M14.5424 17.4773H13.3481C13.1478 17.4773 12.9854 17.6397 12.9854 17.84C12.9854 18.0404 13.1478 18.2028 13.3481 18.2028H14.5424C14.7426 18.2028 14.9051 18.0404 14.9051 17.84C14.9051 17.6397 14.7426 17.4773 14.5424 17.4773Z"
                        fill="#585A60"></path>
                     <path
                        d="M17.8616 17.4773H16.6674C16.4671 17.4773 16.3047 17.6397 16.3047 17.84C16.3047 18.0404 16.4671 18.2028 16.6674 18.2028H17.8616C18.062 18.2028 18.2244 18.0404 18.2244 17.84C18.2244 17.6397 18.062 17.4773 17.8616 17.4773Z"
                        fill="#585A60"></path>
                     <path
                        d="M4.58332 20.3996H3.38909C3.18879 20.3996 3.02637 20.562 3.02637 20.7623C3.02637 20.9626 3.18879 21.125 3.38909 21.125H4.58332C4.78366 21.125 4.94604 20.9627 4.94604 20.7623C4.94599 20.562 4.78366 20.3996 4.58332 20.3996Z"
                        fill="#585A60"></path>
                     <path
                        d="M7.90252 20.3996H6.70842C6.50813 20.3996 6.3457 20.562 6.3457 20.7623C6.3457 20.9626 6.50813 21.125 6.70842 21.125H7.90252C8.10286 21.125 8.26523 20.9627 8.26523 20.7623C8.26523 20.562 8.10286 20.3996 7.90252 20.3996Z"
                        fill="#585A60"></path>
                     <path
                        d="M11.223 20.3996H10.0287C9.82844 20.3996 9.66602 20.562 9.66602 20.7623C9.66602 20.9626 9.82844 21.125 10.0287 21.125H11.223C11.4233 21.125 11.5857 20.9627 11.5857 20.7623C11.5856 20.562 11.4233 20.3996 11.223 20.3996Z"
                        fill="#585A60"></path>
                     <path
                        d="M14.5424 20.3996H13.3481C13.1478 20.3996 12.9854 20.562 12.9854 20.7623C12.9854 20.9626 13.1478 21.125 13.3481 21.125H14.5424C14.7426 21.125 14.9051 20.9627 14.9051 20.7623C14.9051 20.562 14.7426 20.3996 14.5424 20.3996Z"
                        fill="#585A60"></path>
                  </g>
                  <defs>
                     <clipPath id="clip0_11629_7425">
                        <rect width="24" height="24" fill="white"></rect>
                     </clipPath>
                  </defs>
               </svg>
               <p class="light-gray">{{ \Carbon\Carbon::parse($blog->created_at)->format('F jS, Y') }}</p>
            </div>
            <div class="d-flex align-items-center gap-8">
               {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                  fill="none">
                  <g clip-path="url(#clip0_11629_7476)">
                     <path
                        d="M24 12C24 15.512 22.491 18.6716 20.0865 20.8663C17.9531 22.8127 15.1154 24 12 24C8.88464 24 6.04688 22.8127 3.91351 20.8663C1.50897 18.6716 0 15.512 0 12C0 5.37286 5.37286 0 12 0C18.6271 0 24 5.37286 24 12Z"
                        fill="#FFAA20"></path>
                     <path
                        d="M24 12C24 15.512 22.491 18.6716 20.0865 20.8663C17.9531 22.8127 15.1154 24 12 24V0C18.6271 0 24 5.37286 24 12Z"
                        fill="#FF8900"></path>
                     <path
                        d="M20.087 20.8187V20.8665C17.9537 22.8129 15.1159 24.0002 12.0005 24.0002C8.88519 24.0002 6.04742 22.8129 3.91406 20.8665V20.8187C3.91406 17.3425 6.1192 14.371 9.20453 13.2312C10.0759 12.9086 11.018 12.7324 12.0005 12.7324C12.9831 12.7324 13.9252 12.9086 14.7971 13.2312C17.8824 14.3716 20.087 17.3425 20.087 20.8187Z"
                        fill="#7985EB"></path>
                     <path
                        d="M20.0865 20.8187V20.8665C17.9531 22.8129 15.1154 24.0002 12 24.0002V12.7324C12.9825 12.7324 13.9246 12.9086 14.7966 13.2312C17.8819 14.3716 20.0865 17.3425 20.0865 20.8187Z"
                        fill="#4B5BE6"></path>
                     <path
                        d="M16.9596 9.13751C16.9596 11.8722 14.735 14.0975 11.9998 14.0975C9.26514 14.0975 7.04004 11.8722 7.04004 9.13751C7.04004 6.40283 9.26514 4.17773 11.9998 4.17773C14.735 4.17773 16.9596 6.40283 16.9596 9.13751Z"
                        fill="#FFDBA9"></path>
                     <path
                        d="M16.9598 9.13751C16.9598 11.8722 14.7352 14.0975 12 14.0975V4.17773C14.7352 4.17773 16.9598 6.40283 16.9598 9.13751Z"
                        fill="#FFC473"></path>
                  </g>
                  <defs>
                     <clipPath>
                        <rect width="24" height="24" fill="white"></rect>
                     </clipPath>
                  </defs>
               </svg> --}}
               {{-- <p class="light-gray">By Admin</p> --}}
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
               {!! $blog->description !!}
               <div class="container my-5">

               <img src="{{ asset($blog->image) }}" class="br-24 w-100 mb-4" alt="">
                  <div class="row">
                     <!-- Sidebar -->
                     @php
                     $points = is_string($blog->points) ? json_decode($blog->points, true) : $blog->points;
                     @endphp
                     <div class="col-lg-4 mb-4">
                        <nav id="navbar-example" class="navbar sticky-top flex-column align-items-stretch p-3 bg-light rounded">
                           <h5 class="fw-bold mb-3">Programs</h5>
                           <nav class="nav nav-pills flex-column">
                              @foreach($points as $index => $item)
                              @php
                              [$shortTitle, $content] = explode(' - ', $item, 2);
                              $sectionId = 'section' . ($index + 1);
                              @endphp
                              <a class="nav-link" href="#{{ $sectionId }}">{{ $index + 1 }}. {{ $shortTitle }}</a>
                              @endforeach
                           </nav>
                        </nav>
                     </div>

                     <!-- Content -->
                     <div class="col-lg-8">
                        <h3 class="fw-bold mb-4">{{ $blog->title }} - Key Points</h3>
                        <p class="mb-4">
                           {!! $blog->short_description !!}
                        </p>
                        <div class="accordion" id="accordionExample">
                           @foreach($points as $index => $item)
                           @php
                           [$shortTitle, $content] = explode(' - ', $item, 2);
                           $sectionId = 'section' . ($index + 1);
                           $collapseId = 'collapse' . ($index + 1);
                           @endphp
                           <div class="accordion-item" id="{{ $sectionId }}">
                              <h2 class="accordion-header">
                                 <button class="accordion-button {{ $index !== 0 ? 'collapsed' : '' }}" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#{{ $collapseId }}">
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
                           @endforeach
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-lg-4">
               <div class="siderbar">
                  {{--
                  <div class="sidebar-block mb-48">
                     <h5 class="fw-500 mb-24">Programes</h5>
                     <ul>
                        <li><a href="#" class="mb-12 light-gray">Business</a></li>
                        <li><a href="#" class="mb-12 light-gray">Web Development</a></li>
                        <li><a href="#" class="mb-12 light-gray">Finance & Accounting</a></li>
                     </ul>
                  </div>
                  --}}
                  <div class="sidebar-block mb-48">

                     <h5 class="fw-500 mb-24">Similar Programs</h5>
                     @forelse($similars as $similar)
                     <div class="recent-article mb-12">
                        <img src="{{ asset($similar->image) }}" class="article-img" alt="{{ $similar->title }}">
                        <div>
                           <a href="{{ route('web.blog.show', [$similar->category->slug, $similar->slug]) }}"
                              class="fw-500 black mb-8 hover-content">
                           {{ Str::limit($similar->title, 60) }}
                           </a>
                           <p class="light-gray subtitle">{{ \Carbon\Carbon::parse($similar->created_at)->format('d/m/Y') }}</p>
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
                        <a href="{{ route('web.blog.show', [$similar->category->slug, $similar->slug]) }}"> {{ Str::limit($similar->title, 25, '...') }}</a>
                        @endforeach
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   @endsection
