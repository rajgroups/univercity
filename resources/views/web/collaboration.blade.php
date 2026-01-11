@extends('layouts.web.app')
@push('meta')
    <title>Partnerships & Collaborations - Indian Skill Institute Co-operation (ISICO)</title>

    <meta name="description" content="Explore partnerships and collaborations of the Indian Skill Institute Co-operation (ISICO) with corporate, government, strategic, international, and academic institutions. Together, these alliances strengthen education, skill development, and entrepreneurship for India’s future.">
    <meta name="keywords" content="ISICO partnerships, ISICO collaborations, corporate partnerships, government collaborations, strategic partnerships, international partnerships, academic collaborations, Indian Skill Institute, skill development alliances">
    <meta name="author" content="Indian Skill Institute Co-operation (ISICO)">
    <meta name="robots" content="index, follow">

    <!-- Canonical Tag -->
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph -->
    <meta property="og:title" content="Partnerships & Collaborations - Indian Skill Institute Co-operation (ISICO)">
    <meta property="og:description" content="Discover ISICO’s collaborations with corporate, government, academic, and international institutions that empower skill development and innovation.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('default-partnerships.jpg') }}">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Partnerships & Collaborations - Indian Skill Institute Co-operation (ISICO)">
    <meta name="twitter:description" content="ISICO builds partnerships across corporate, government, academic, and international sectors to strengthen education, entrepreneurship, and skill development.">
    <meta name="twitter:image" content="{{ asset('default-partnerships.jpg') }}">
@endpush

@section('content')
<!-- Title Banner Section Start -->

    <style>
        .modern-page-banner {
            position: relative;
            min-height: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            overflow: hidden;
            margin-bottom: 5rem;
        }

        .modern-page-banner::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(0,0,0,0.85) 0%, rgba(13,110,253,0.3) 100%);
            z-index: 1;
        }

        .modern-banner-content {
            position: relative;
            z-index: 2;
            text-align: center;
            width: 100%;
            padding: 0 15px;
        }

        .modern-banner-title {
            font-size: 3.5rem;
            font-weight: 800;
            color: #fff;
            margin-bottom: 1rem;
            text-shadow: 0 4px 10px rgba(0,0,0,0.3);
            letter-spacing: -1px;
        }

        .modern-banner-subtitle {
            font-size: 1.2rem;
            color: rgba(255,255,255,0.85);
            font-weight: 300;
            max-width: 700px;
            margin: 0 auto;
            line-height: 1.6;
        }

        .modern-breadcrumb {
            display: inline-flex;
            padding: 8px 16px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(5px);
            border-radius: 50px;
            margin-bottom: 2rem;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .modern-breadcrumb span {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.9rem;
            font-weight: 500;
        }

        @media (max-width: 768px) {
            .modern-page-banner {
                min-height: 300px;
            }
            .modern-banner-title {
                font-size: 2.5rem;
            }
        }
    </style>

    <!-- Title Banner Section Start -->
    <section class="modern-page-banner" style="background-image: url({{ asset('resource/admin/assets/img/banner-two.jpg') }});">
        <div class="modern-banner-content" data-aos="fade-up">
            <div class="modern-breadcrumb">
                <span>Home</span>
                <span class="mx-2">/</span>
                <span class="text-white">Collaborations</span>
            </div>
            <h1 class="modern-banner-title">Building Strategic Alliances</h1>
            <p class="modern-banner-subtitle">Fostering partnerships with corporate, government, and academic leaders to drive impactful skill development.</p>
        </div>
    </section>
    <!-- Title Banner Section End -->

    <!-- Main Content Section Start -->
    <section class="collaboration-main py-5">
        <div class="container">
            <div class="row">
                <!-- Left Side Navigation -->
                <div class="col-lg-3 mb-4 mb-lg-0">
                    <div class="sticky-top" style="top: 101px;">
                        <div class="card shadow-sm">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0 text-white">Collaboration Types</h5>
                            </div>
                            <div class="list-group list-group-flush">
                                <a href="#corporate" class="list-group-item list-group-item-action active">Corporate
                                    Partnerships</a>
                                <a href="#government" class="list-group-item list-group-item-action">Government
                                    Collaborations</a>
                                <a href="#strategic" class="list-group-item list-group-item-action">Strategic
                                    Partnerships</a>
                                <a href="#international" class="list-group-item list-group-item-action">International
                                    Partnerships</a>
                                <a href="#academic" class="list-group-item list-group-item-action">Academic
                                    Collaborations</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Side Content -->
                <div class="col-lg-9">
                    <!-- Corporate Partnerships Section -->
                    <div id="corporate" class="collaboration-section mb-5">
                        <div class="card shadow-sm">
                            <div class="card-header bg-primary text-white">
                                <h2 class="h4 mb-0 text-white">Corporate Partnerships</h2>
                            </div>
                            <div class="card-body">
                                <p style="text-indent: 2em;" class="lead">At ISICO, we believe that strategic
                                    collaborations with the corporate sector are crucial for driving
                                    impactful skill development and education initiatives. Our Corporate Partnerships
                                    program is
                                    designed to foster relationships with industry leaders and corporations, enabling us to
                                    bridge the
                                    gap between education, skills, and real-world employment opportunities. Through these
                                    partnerships, we aim to build a workforce equipped with market-relevant skills,
                                    contribute to
                                    sustainable community development, and align with corporate social responsibility (CSR)
                                    objectives.</p>

                                <div class="collab-objectives">
                                    <h3 class="collab-subheading">Objectives of Corporate Partnerships:</h3>

                                    <ul class="collab-objectives-list">
                                        <li class="collab-objective-item">
                                            <span class="collab-bullet"></span>
                                            <div class="collab-objective-content">
                                                <strong>Support Skill Development:</strong> Create a talent pipeline through
                                                targeted skill training programs aligned with industry requirements.
                                            </div>
                                        </li>

                                        <li class="collab-objective-item">
                                            <span class="collab-bullet"></span>
                                            <div class="collab-objective-content">
                                                <strong>Promote Industry-Academia Linkages:</strong> Strengthen connections
                                                between corporate entities and educational institutions to align academic
                                                outcomes with market needs.
                                            </div>
                                        </li>

                                        <li class="collab-objective-item">
                                            <span class="collab-bullet"></span>
                                            <div class="collab-objective-content">
                                                <strong>Address Community Needs:</strong> Work with corporates to design and
                                                implement initiatives that cater to the specific challenges of rural and
                                                underprivileged communities.
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <style>
                                    .collab-objectives {
                                        margin: 1.5rem 0;
                                        padding: 1rem;
                                        background-color: #f8f9fa;
                                        border-radius: 8px;
                                    }

                                    .collab-subheading {
                                        color: #FF9933;
                                        font-size: 1.2rem;
                                        margin-bottom: 1rem;
                                        padding-bottom: 0.5rem;
                                        border-bottom: 1px solid #dee2e6;
                                    }

                                    .collab-objectives-list {
                                        list-style: none;
                                        padding-left: 0;
                                        margin-bottom: 0;
                                    }

                                    .collab-objective-item {
                                        display: flex;
                                        align-items: flex-start;
                                        margin-bottom: 1rem;
                                        position: relative;
                                        padding-left: 1.75rem;
                                    }

                                    .collab-objective-item:last-child {
                                        margin-bottom: 0;
                                    }

                                    .collab-bullet {
                                        position: absolute;
                                        left: 0;
                                        top: 0.4rem;
                                        width: 0.75rem;
                                        height: 0.75rem;
                                        background-color: #FF9933;
                                        border-radius: 50%;
                                    }

                                    .collab-objective-content {
                                        flex: 1;
                                    }

                                    .icon-saffron {
                                        color: #FF9933;
                                        /* India flag saffron */
                                    }

                                    @media (max-width: 768px) {
                                        .collab-objective-item {
                                            padding-left: 1.5rem;
                                        }

                                        .collab-bullet {
                                            width: 0.6rem;
                                            height: 0.6rem;
                                            top: 0.45rem;
                                        }
                                    }
                                </style>

                                <h3 class="h5 mt-4 mb-3 collab-subheading">Key Areas of Collaboration</h3>
                                <div class="accordion" id="corporateAccordion">
                                    @php
                                        $corporateAreas = [
                                            'Workforce Development Programs' => [
                                                'Partner with corporates to deliver training modules tailored to sector-specific skill demands',
                                                'Facilitate direct recruitment opportunities for program graduates',
                                            ],
                                            'CSR-Driven Skill Initiatives' => [
                                                'Develop and execute CSR projects focusing on vocational training, entrepreneurship, and community empowerment.',
                                                'Leverage corporate resources to expand access to quality education and skill development in rural areas.',
                                            ],
                                            'Internships and Apprenticeships' => [
                                                'Collaborate with industries to provide hands-on experience to learners through structured internships and apprenticeship programs.',
                                                'Align training programs with corporate hiring requirements to ensure job readiness.',
                                            ],
                                            'Technology Integration in Education' => [
                                                'Partner with tech companies to introduce advanced learning tools, such as AI-driven platforms, virtual labs, and gamified learning solutions.',
                                                'Promote the use of digital technologies to make education more accessible and engaging.',
                                            ],
                                            'Entrepreneurship Support' => [
                                                'Facilitate mentorship programs where corporate professionals guide aspiring entrepreneurs in rural areas.',
                                                'Provide funding and resources for startups and small businesses in collaboration with corporate partners.',
                                            ],
                                            'Sustainable Development Projects' => [
                                                'Work with corporates to introduce green jobs and renewable energy training programs.',
                                                'Develop community-focused projects addressing water resource management, waste reduction, and sustainable agriculture.',
                                            ],
                                            'Employee Volunteering' => [
                                                'Engage corporate employees as mentors, trainers, and consultants for skill development initiatives.',
                                                'Create volunteer programs that allow employees to contribute to community development projects.',
                                            ],
                                            'Placement Drives and Career Fairs' => [
                                                'Organize industry-specific placement drives and career fairs in collaboration with corporate partners.',
                                                'Offer guidance and resources to help learners secure meaningful employment opportunities.',
                                            ],
                                            'Custom Skill Development Solutions' => [
                                                'Work with companies to design bespoke training solutions tailored to their workforce requirements.',
                                                'Focus on upskilling and reskilling employees to keep pace with technological advancements.',
                                            ],
                                            'Shared Value Initiatives' => [
                                                'Align corporate goals with ISICO’s mission to create programs that deliver mutual benefits for communities and businesses.',
                                                'Enhance brand visibility for corporate partners through impactful communityengagement projects.',
                                            ],
                                        ];
                                        $i = 1;
                                    @endphp

                                    @foreach ($corporateAreas as $title => $points)
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="corporateHeading{{ $i }}">
                                                <button class="accordion-button {{ $i > 1 ? 'collapsed' : '' }}"
                                                    type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#corporateCollapse{{ $i }}">
                                                    <b>{{ $title }}</b>
                                                </button>
                                            </h2>
                                            <div id="corporateCollapse{{ $i }}"
                                                class="accordion-collapse collapse {{ $i == 1 ? 'show' : '' }}"
                                                data-bs-parent="#corporateAccordion">
                                                <div class="accordion-body">
                                                    <ul class="mb-0">
                                                        @foreach ($points as $point)
                                                            <li>{{ $point }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        @php $i++; @endphp
                                    @endforeach
                                </div>

                                <h3 class="h5 mt-4 text-primary mb-3">Benefits for Corporate Partners</h3>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card bg-light mb-3">
                                            <div class="card-body d-flex align-items-center">
                                                <i class="bi bi-people-fill fs-2 me-3 icon-saffron"></i>
                                                <div>
                                                    <h4 class="h6 mb-1">Skilled Workforce</h4>
                                                    <p class="small mb-0">Access to trained, job-ready candidates</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="card bg-light mb-3">
                                            <div class="card-body d-flex align-items-center">
                                                <i class="bi bi-award-fill fs-2 me-3 icon-saffron"></i>
                                                <div>
                                                    <h4 class="h6 mb-1">Enhanced Reputation</h4>
                                                    <p class="small mb-0">Positive brand association through CSR</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="card bg-light mb-3">
                                            <div class="card-body d-flex align-items-center">
                                                <i class="bi bi-bullseye fs-2 me-3 icon-saffron"></i>
                                                <div>
                                                    <h4 class="h6 mb-1">Brand Recognition</h4>
                                                    <p class="small mb-0">Visibility through community projects</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="card bg-light mb-3">
                                            <div class="card-body d-flex align-items-center">
                                                <i class="bi bi-flag-fill fs-2 me-3 icon-saffron"></i>
                                                <div>
                                                    <h4 class="h6 mb-1">National Impact</h4>
                                                    <p class="small mb-0">Contribute to skill development goals</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <p style="text-indent: 2em;">
                                    ISICO invites corporations to collaborate with us in transforming education and skill
                                    development
                                    across India. Let’s work together to create sustainable communities and unlock new
                                    opportunities
                                    for individuals and businesses alike.
                                </p>
                                <div class="mt-4 text-center">
                                    <a href="#contact" class="btn btn-outline-primary px-4">Partner With Us</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Government Collaborations Section -->
                    <div id="government" class="collaboration-section mb-5">
                        <div class="card shadow-sm">
                            <div class="card-header bg-primary text-white">
                                <h2 class="h4 mb-0 text-white">Government Collaborations</h2>
                            </div>
                            <div class="card-body">
                                <p style="text-indent: 2em" class="lead">ISICO recognizes the pivotal role of government
                                    partnerships in advancing skill development and
                                    education initiatives at a national and regional level. Through Government
                                    Collaborations, we aim
                                    to align with existing policies and programs, foster sustainable growth, and enhance the
                                    socio-
                                    economic well-being of rural and underserved communities.</p>

                                <div class="collab-objectives">
                                    <h3 class="collab-subheading">Objectives of Corporate Partnerships:</h3>

                                    <ul class="collab-objectives-list">
                                        <li class="collab-objective-item">
                                            <span class="collab-bullet"></span>
                                            <div class="collab-objective-content">
                                                <strong>Policy Alignment:</strong>Implement programs in accordance with
                                                government frameworks such as
                                                the National Education Policy (NEP) 2020, Skill India Mission, and Digital
                                                India initiatives.
                                            </div>
                                        </li>

                                        <li class="collab-objective-item">
                                            <span class="collab-bullet"></span>
                                            <div class="collab-objective-content">
                                                <strong>Infrastructure Utilization:</strong> Leverage government facilities
                                                such as schools, community
                                                centers, and public halls to conduct training and education programs.
                                            </div>
                                        </li>

                                        <li class="collab-objective-item">
                                            <span class="collab-bullet"></span>
                                            <div class="collab-objective-content">
                                                <strong>Community Development:</strong> Work with local authorities to
                                                address the specific skill and
                                                education needs of rural areas.
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <h3 class="h5 mt-4 collab-subheading">Key Areas of Collaboration</h3>
                                <div class="row g-4">
                                    @php
                                        $governmentAreas = [
                                            'Skill India Mission Support' => [
                                                'Contribute to government-led skill development initiatives by providing sector-specific training in agriculture, healthcare, IT, and more.',
                                                'Partner with government agencies to design courses that meet current and emerging workforce demands.',
                                            ],
                                            'Vocational Training in Schools' => [
                                                'Collaborate with state and central education departments to integrate vocational education into school curricula.',
                                                'Establish skill labs and training centers in government schools to promote hands-on learning.',
                                            ],
                                            'Rural Empowerment Programs' => [
                                                'Partner with rural development ministries to implement livelihood improvement initiatives.',
                                                'Promote entrepreneurial activities and self-sufficiency in rural communities through skill-based projects.',
                                            ],
                                            'Public Infrastructure Utilization' => [
                                                'Use existing government facilities such as Panchayat halls and community centers to conduct training sessions and workshops.',
                                                'Enhance infrastructure with modern tools and resources to improve the learning environment.',
                                            ],
                                            'Digital Literacy Initiatives' => [
                                                'Support government programs like Digital India by providing digital literacy and internet access in remote areas.',
                                                'Train students and community members in digital tools to foster technology-driven growth.',
                                            ],
                                            'Employment Linkage Programs' => [
                                                'Collaborate with employment offices to provide job placement services for program graduates.',
                                                'Align training programs with government employment schemes to create direct pathways to jobs.',
                                            ],
                                            'Women’s Empowerment and SHG Support' => [
                                                'Partner with women’s development organizations to train Self-Help Groups (SHGs) in entrepreneurship and financial management.',
                                                'Promote women’s participation in non-traditional sectors such as technology and renewable energy.',
                                            ],
                                            'Agri and Farmer Development' => [
                                                'Work with agricultural departments to train farmers in modern farming practices, sustainable agriculture, and value-added production.',
                                                'Support government Farmer Producer Organizations (FPO) initiatives with capacity-building programs.',
                                            ],
                                            'Healthcare Skill Development' => [
                                                'Collaborate with health ministries to train individuals in community health, elder care, and digital health technologies.',
                                                'Promote telemedicine and health awareness campaigns in partnership with local health departments.',
                                            ],
                                            'Renewable Energy and Green Jobs' => [
                                                'Partner with renewable energy programs to train youth in solar, wind, and other sustainable technologies.',
                                                'Support government policies on climate action through green job creation.',
                                            ],
                                        ];
                                    @endphp

                                    @foreach ($governmentAreas as $title => $descs)
                                        <div class="col-md-6">
                                            <div class="card h-100 border-0 shadow-sm">
                                                <div class="card-body">
                                                    <h4 class="h6 text-primary mb-2">{{ $title }}</h4>
                                                    <ul class="small mb-0 ps-3">
                                                        @foreach ($descs as $desc)
                                                            <li>{{ $desc }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>

                                <h3 class="h5 mt-4 text-primary mb-2">Benefits</h3>
                                <div class="alert alert-primary">
                                    <ul class="mb-0">
                                        <li>Expanded reach to underserved regions through government networks.</li>
                                        <li>Alignment with national and regional development goals.</li>
                                        <li>Improved infrastructure and access to resources for skill and education
                                            programs.</li>
                                        <li>Enhanced impact through joint accountability and shared objectives.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Strategic Partnerships Section -->
                    <div id="strategic" class="collaboration-section mb-5">
                        <div class="card shadow-sm">
                            <div class="card-header bg-primary text-white">
                                <h2 class="h4 mb-0 text-white">Strategic Partnerships</h2>
                            </div>
                            <div class="card-body">
                                <p style="text-indent: 2em" class="lead">ISICO believes that impactful change in
                                    education and skill development
                                    requires collaboration and
                                    shared expertise. Our Strategic Partnerships initiative is designed to build alliances
                                    with government
                                    entities, corporate organizations, educational institutions, and non-governmental
                                    organizations
                                    (NGOs) to expand opportunities for skill training, entrepreneurship, and community
                                    development.</p>

                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <h3 class="h5 text-primary mb-3">Objectives of Strategic Partnerships:</h3>
                                        <div class="d-flex align-items-start mb-3">
                                            <div class="me-3 text-primary">
                                                <i class="bi bi-arrows-angle-expand fs-4"></i>
                                            </div>
                                            <div>
                                                <h4 class="h6 mb-1">Expand Reach</h4>
                                                <p class="small mb-0">Leverage resources and networks of partners to bring
                                                    ISICO’s initiatives to a
                                                    broader audience, especially in rural and underserved regions.</p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-start mb-3">
                                            <div class="me-3 text-primary">
                                                <i class="bi bi-lightbulb fs-4"></i>
                                            </div>
                                            <div>
                                                <h4 class="h6 mb-1">Enhance Expertise</h4>
                                                <p class="small mb-0">Collaborate with industry leaders and academic
                                                    institutions to ensure
                                                    the training programs are cutting-edge and relevant to current job
                                                    markets.</p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-start">
                                            <div class="me-3 text-primary">
                                                <i class="bi bi-recycle fs-4"></i>
                                            </div>
                                            <div>
                                                <h4 class="h6 mb-1">Strengthen Sustainability</h4>
                                                <p class="small mb-0">Develop long-term projects with shared goals,
                                                    ensuring financial
                                                    and operational sustainability.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h3 class="h5 text-primary">Partner Types</h3>
                                        <div class="partner-types">
                                            <span class="badge bg-primary mb-2">Government</span>
                                            <span class="badge bg-secondary mb-2">Corporates</span>
                                            <span class="badge bg-success mb-2">Educational</span>
                                            <span class="badge bg-info mb-2">Industry</span>
                                            <span class="badge bg-warning mb-2">International</span>
                                            <span class="badge bg-danger mb-2">NGOs</span>
                                            <span class="badge bg-dark mb-2">Tech</span>
                                            <span class="badge bg-primary mb-2">Media</span>
                                        </div>
                                    </div>
                                </div>

                                <h3 class="h5 mt-4 text-primary">Key Areas</h3>
                                @php
                                    $governmentAreas = [
                                        'Government Partnerships' => [
                                            'Collaborate with central and state governments to align skill development programs with national policies such as the National Education Policy (NEP) and Skill India Mission.',
                                            'Partner with public sector entities to utilize existing infrastructure like schools and community centers for training.',
                                        ],
                                        'Corporate Social Responsibility (CSR) Alliances' => [
                                            'Work with corporates to co-create impactful CSR projects in education, women’s empowerment, and entrepreneurship.',
                                            'Seek funding and mentorship for specific initiatives like skill centers, digital learning hubs, and rural employment programs.',
                                        ],
                                        'Educational Institutions' => [
                                            'Partner with universities, technical institutes, and vocational training centers to co-design industry-relevant curriculums.',
                                            'Organize joint certification programs to provide dual accreditation and increase employment opportunities.',
                                        ],
                                        'Industry Collaborations' => [
                                            'Engage with industries to align training with sectoral needs, ensuring job placement for trainees.',
                                            'Develop apprenticeship programs and internships to provide real-world experience.',
                                        ],
                                        'International Cooperation' => [
                                            'Partner with international organizations to adapt global best practices in skill education and entrepreneurship.',
                                            'Seek technological and financial support to bring advanced solutions to local challenges.',
                                        ],
                                        'NGO and Community Organizations' => [
                                            'Collaborate with grassroots organizations to ensure inclusivity and reach marginalized communities.',
                                            'Jointly run awareness campaigns and skill-building workshops.',
                                        ],
                                        'Technology Companies' => [
                                            'Partner with IT firms to introduce innovative learning solutions like AI-based tutoring, e-learning platforms, and digital labs.',
                                            'Leverage technology to deliver training in remote areas through virtual platforms and mobile apps.',
                                        ],
                                        'Sector-Specific Partnerships' => [
                                            'Form alliances with sectoral leaders in agriculture, manufacturing, healthcare, and technology to drive focused skill training programs.',
                                            'Develop sector-specific employment pathways by co-hosting job fairs and placement drives.',
                                        ],
                                        'R&D and Innovation Hubs' => [
                                            'Collaborate with research organizations and innovation hubs to promote entrepreneurship and foster a culture of innovation.',
                                            'Facilitate startups by providing incubator support and seed funding opportunities.',
                                        ],
                                        'Media and Awareness Partnerships' => [
                                            'Partner with media outlets to amplify awareness of ISICO programs and success stories.',
                                            'Use social media influencers and content creators to engage younger audiences and promote participation in skill development.',
                                        ],
                                    ];
                                @endphp

                                <div class="row">
                                    @foreach ($governmentAreas as $title => $descs)
                                        <div class="col-md-6">
                                            <div class="card h-100 border-0 shadow-sm">
                                                <div class="card-body">
                                                    <h4 class="h6 text-primary mb-2">{{ $title }}</h4>
                                                    <ul class="small mb-0 ps-3">
                                                        @foreach ($descs as $desc)
                                                            <li>{{ $desc }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <h3 class="h5 mt-4 text-primary mb-2">Benefits</h3>
                                <div class="alert alert-primary">
                                    <ul class="mb-0">
                                        <li>Opportunity to contribute to sustainable development goals (SDGs) and national priorities.</li>
                                        <li>Recognition as a change-maker in empowering rural communities</li>
                                        <li>Access to ISICO’s network of trained individuals and successful projects, offering valuable insights and data for impactful interventions.</li>
                                    </ul>
                                </div>

                                <h3 class="h5 mt-4 text-primary mb-2">Call for Action</h3>
                                <div class="alert alert-primary">
                                   <p>ISICO invites strategic partners to collaborate with us to transform education, skill development, and community empowerment. Together, we can create sustainable growth and improve lives across India’s rural and urban landscapes.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- International Partnerships Section -->
                    <div id="international" class="collaboration-section mb-5">
                        <div class="card shadow-sm">
                            <div class="card-header bg-primary text-white">
                                <h2 class="h4 mb-0 text-white">International Partnerships</h2>
                            </div>
                            <div class="card-body">
                                <p class="lead" style="text-indent: 2em;">ISICO actively seeks International
                                    Partnerships to integrate global best practices, foster innovation, and enhance the
                                    impact of skill development and education initiatives. By collaborating with
                                    international organizations, educational institutions, and industry leaders, ISICO aims
                                    to build a globally competitive workforce while addressing local socio-economic
                                    challenges.</p>

                                <div class="row mt-4">
                                    <div class="col-md-4 mb-4">
                                        <div class="d-flex align-items-start p-3 border rounded h-100">
                                            <i class="bi bi-globe text-warning fs-1 me-3"></i>
                                            <div>
                                                <h4 class="h5 mb-1">Knowledge Exchange</h4>
                                                <p class="small mb-0">Adopt innovative teaching methods, technologies, and
                                                    skill frameworks from developed countries.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-4">
                                        <div class="d-flex align-items-start p-3 border rounded h-100">
                                            <i class="bi bi-star-fill text-warning fs-1 me-3"></i>
                                            <div>
                                                <h4 class="h5 mb-1">Global Standards</h4>
                                                <p class="small mb-0">Align training and education programs with
                                                    international quality standards to enhance employability.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-4">
                                        <div class="d-flex align-items-start p-3 border rounded h-100">
                                            <i class="bi bi-people-fill text-warning fs-1 me-3"></i>
                                            <div>
                                                <h4 class="h5 mb-1">Cultural Collaboration</h4>
                                                <p class="small mb-0">Promote cross-cultural understanding and cooperation
                                                    in education and training.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <h3 class="h5 mt-4 text-primary">Focus Areas</h3>
                                <div class="container my-5">
                                    <div class="row">
                                        <!-- Left Navigation -->
                                        <div class="col-md-4">
                                            <div class="list-group sticky-top" style="top: 80px;">
                                                <a href="#intCurriculum"
                                                    class="list-group-item list-group-item-action active">
                                                    1. Curriculum Development
                                                </a>
                                                <a href="#intTechVocational"
                                                    class="list-group-item list-group-item-action">
                                                    2. Technical & Vocational Training
                                                </a>
                                                <a href="#intExchange" class="list-group-item list-group-item-action">
                                                    3. Exchange Programs
                                                </a>
                                                <a href="#intDigital" class="list-group-item list-group-item-action">
                                                    4. Digital Learning Collaboration
                                                </a>
                                                <a href="#intEmployment" class="list-group-item list-group-item-action">
                                                    5. Global Employment Opportunities
                                                </a>
                                                <a href="#intResearch" class="list-group-item list-group-item-action">
                                                    6. Research & Innovation
                                                </a>
                                                <a href="#intWomenYouth" class="list-group-item list-group-item-action">
                                                    7. Women & Youth Empowerment
                                                </a>
                                                <a href="#intCommunity" class="list-group-item list-group-item-action">
                                                    8. Community Development Models
                                                </a>
                                                <a href="#intAccreditation"
                                                    class="list-group-item list-group-item-action">
                                                    9. Accreditation & Certification
                                                </a>
                                                <a href="#intSDGs" class="list-group-item list-group-item-action">
                                                    10. Sustainable Development Goals (SDGs)
                                                </a>
                                            </div>
                                        </div>

                                        <!-- Right Content -->
                                        <div class="col-md-8">
                                            <div id="intCurriculum" class="card mb-4">
                                                <div class="card-body">
                                                    <h5 class="text-primary">1. Curriculum Development</h5>
                                                    <ul>
                                                        <li>Collaborate with international academic institutions to design
                                                            curricula that meet global standards in sectors like healthcare,
                                                            IT, and renewable energy.</li>
                                                        <li>Introduce modular and competency-based training systems widely
                                                            recognized across industries worldwide.</li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div id="intTechVocational" class="card mb-4">
                                                <div class="card-body">
                                                    <h5 class="text-primary">2. Technical and Vocational Training</h5>
                                                    <ul>
                                                        <li>Partner with technical institutes and vocational training
                                                            organizations to implement advanced skill programs.</li>
                                                        <li>Provide training in sectors such as Artificial Intelligence,
                                                            Robotics, Green Technologies, and Digital Health.</li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div id="intExchange" class="card mb-4">
                                                <div class="card-body">
                                                    <h5 class="text-primary">3. Exchange Programs</h5>
                                                    <ul>
                                                        <li>Facilitate exchange programs for students and educators to gain
                                                            exposure to global teaching and learning practices.</li>
                                                        <li>Offer internships and apprenticeships in partnership with
                                                            international companies and institutions.</li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div id="intDigital" class="card mb-4">
                                                <div class="card-body">
                                                    <h5 class="text-primary">4. Digital Learning Collaboration</h5>
                                                    <ul>
                                                        <li>Utilize global e-learning platforms and digital tools to bridge
                                                            the rural-urban education divide.</li>
                                                        <li>Incorporate innovative technologies like Virtual Reality (VR)
                                                            and Artificial Intelligence (AI) in skill training.</li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div id="intEmployment" class="card mb-4">
                                                <div class="card-body">
                                                    <h5 class="text-primary">5. Global Employment Opportunities</h5>
                                                    <ul>
                                                        <li>Develop partnerships with international employers to provide
                                                            global job placement opportunities for program graduates.</li>
                                                        <li>Offer training tailored to specific international markets and
                                                            their labor requirements.</li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div id="intResearch" class="card mb-4">
                                                <div class="card-body">
                                                    <h5 class="text-primary">6. Research and Innovation</h5>
                                                    <ul>
                                                        <li>Collaborate with international research institutions to
                                                            introduce cutting-edge practices in agriculture, renewable
                                                            energy, and manufacturing.</li>
                                                        <li>Establish joint research centers focusing on rural development
                                                            and sustainable practices.</li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div id="intWomenYouth" class="card mb-4">
                                                <div class="card-body">
                                                    <h5 class="text-primary">7. Women and Youth Empowerment</h5>
                                                    <ul>
                                                        <li>Work with international women’s organizations to promote gender
                                                            equality in education and entrepreneurship.</li>
                                                        <li>Partner with youth organizations to create leadership programs
                                                            and capacity-building initiatives.</li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div id="intCommunity" class="card mb-4">
                                                <div class="card-body">
                                                    <h5 class="text-primary">8. Community Development Models</h5>
                                                    <ul>
                                                        <li>Learn from international rural development models and adapt them
                                                            to address local challenges effectively.</li>
                                                        <li>Implement cooperative frameworks and sustainable livelihood
                                                            projects inspired by global success stories.</li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div id="intAccreditation" class="card mb-4">
                                                <div class="card-body">
                                                    <h5 class="text-primary">9. Accreditation and Certification</h5>
                                                    <ul>
                                                        <li>Establish collaborations with international certification bodies
                                                            to ensure globally recognized qualifications for trainees.</li>
                                                        <li>Offer dual certifications to enhance mobility and career
                                                            prospects.</li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div id="intSDGs" class="card mb-4">
                                                <div class="card-body">
                                                    <h5 class="text-primary">10. Sustainable Development Goals (SDGs)</h5>
                                                    <ul>
                                                        <li>Align partnerships with global SDGs to tackle challenges like
                                                            poverty, inequality, and climate action.</li>
                                                        <li>Focus on areas such as quality education, clean energy, and
                                                            decent work through collaborative projects.</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="mt-4">
                                    <h4 class="h5 text-primary mb-3">Benefits of International Partnerships:</h4>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Access to advanced technologies, methodologies, and funding.
                                            <span class="badge bg-primary rounded-pill">1</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Enhanced credibility and global recognition of training programs
                                            <span class="badge bg-primary rounded-pill">2</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Opportunities for students and trainees to participate in international skill
                                            competitions and conferences.
                                            <span class="badge bg-primary rounded-pill">3</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Improved socio-economic outcomes through exposure to global markets and
                                            innovations.
                                            <span class="badge bg-primary rounded-pill">4</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Academic Collaborations Section -->
                    <div id="academic" class="collaboration-section">
                        <div class="card shadow-sm">
                            <div class="card-header bg-primary text-white">
                                <h2 class="h4 mb-0 text-white">Academic Collaborations</h2>
                            </div>
                            <div class="card-body">
                                <p class="lead" style="text-indent: 2em">At ISICO, we recognize the pivotal role that academic institutions play in shaping the workforce of tomorrow. Our Academic Collaborations initiative aims to create strong partnerships with schools, colleges, universities, and research organizations to build a foundation for innovative education and skill development. These collaborations are designed to integrate practical skills with academic learning, ensuring that students are prepared for industry demands and entrepreneurial ventures.</p>

                                <div class="row mt-4">
                                   <div class="col-md-6">
    <div class="card mb-4">
        <div class="card-body">
            <h3 class="h5 text-primary mb-3">Objectives</h3>
            <ul class="fa-ul">
                <li>
                    <span class="fa-li"><i class="fas fa-check text-success"></i></span>
                    <strong>Integrate Skill-Based Learning:</strong> Embed industry-relevant skills into academic curriculums to create a blend of theoretical knowledge and practical application.
                </li>
                <li>
                    <span class="fa-li"><i class="fas fa-check text-success"></i></span>
                    <strong>Foster Research and Innovation:</strong> Encourage collaborative research projects and innovation in education technology, vocational training, and entrepreneurial models.
                </li>
                <li>
                    <span class="fa-li"><i class="fas fa-check text-success"></i></span>
                    <strong>Promote Global Standards:</strong> Align academic offerings with international education and skill development standards to enhance global employability.
                </li>
            </ul>
        </div>
    </div>
</div>

                                    <div class="col-md-6">
                                        <div class="card mb-4">
                                            <div class="card-body">
                                                <h3 class="h5 text-primary mb-3">Benefits</h3>
                                                <ul class="fa-ul">
                                                    <li><span class="fa-li"><i
                                                                class="fas fa-star text-warning"></i></span> Access to cutting-edge research and innovation for academic institutions.</li>
                                                    <li><span class="fa-li"><i
                                                                class="fas fa-star text-warning"></i></span> Enhanced employability of students through skill-based training.</li>
                                                    <li><span class="fa-li"><i
                                                                class="fas fa-star text-warning"></i></span> Strengthened reputation as a progressive institution supporting national education goals.</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

<div class="container my-5">
    <h2 class="text-primary mb-4">Key Areas for Collaboration</h2>
    <div class="row g-4">

        <!-- 1 -->
        <div class="col-md-6">
            <div class="d-flex p-3 border rounded shadow-sm h-100">
                <div class="me-3">
                    <span class="badge bg-primary rounded-circle fs-5">1</span>
                </div>
                <div>
                    <h5 class="text-primary mb-2">Curriculum Development</h5>
                    <ul class="mb-0 small">
                        <li>Co-develop academic programs that incorporate vocational training, soft skills, and entrepreneurship modules.</li>
                        <li>Design sector-specific courses in emerging fields such as renewable energy, digital health, AI, and sustainable agriculture.</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- 2 -->
        <div class="col-md-6">
            <div class="d-flex p-3 border rounded shadow-sm h-100">
                <div class="me-3">
                    <span class="badge bg-primary rounded-circle fs-5">2</span>
                </div>
                <div>
                    <h5 class="text-primary mb-2">Faculty Training Programs</h5>
                    <ul class="mb-0 small">
                        <li>Provide professional development workshops for educators to adopt modern teaching methodologies.</li>
                        <li>Offer training on integrating skill-based education and digital tools into classroom teaching.</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- 3 -->
        <div class="col-md-6">
            <div class="d-flex p-3 border rounded shadow-sm h-100">
                <div class="me-3">
                    <span class="badge bg-primary rounded-circle fs-5">3</span>
                </div>
                <div>
                    <h5 class="text-primary mb-2">Dual Certification Programs</h5>
                    <ul class="mb-0 small">
                        <li>Partner with institutions to offer dual certifications combining academic degrees and skill-based qualifications.</li>
                        <li>Align certifications with national and international standards for wider recognition.</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- 4 -->
        <div class="col-md-6">
            <div class="d-flex p-3 border rounded shadow-sm h-100">
                <div class="me-3">
                    <span class="badge bg-primary rounded-circle fs-5">4</span>
                </div>
                <div>
                    <h5 class="text-primary mb-2">Research Collaborations</h5>
                    <ul class="mb-0 small">
                        <li>Facilitate joint research projects on rural education challenges, skill development models, and innovative teaching practices.</li>
                        <li>Promote the development of new technologies to address education gaps in rural areas.</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- 5 -->
        <div class="col-md-6">
            <div class="d-flex p-3 border rounded shadow-sm h-100">
                <div class="me-3">
                    <span class="badge bg-primary rounded-circle fs-5">5</span>
                </div>
                <div>
                    <h5 class="text-primary mb-2">Internship and Apprenticeship Opportunities</h5>
                    <ul class="mb-0 small">
                        <li>Work with academic institutions to offer students real-world exposure through internships, apprenticeships, and industry visits.</li>
                        <li>Establish tie-ups with industries to ensure smooth transitions from academics to employment.</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- 6 -->
        <div class="col-md-6">
            <div class="d-flex p-3 border rounded shadow-sm h-100">
                <div class="me-3">
                    <span class="badge bg-primary rounded-circle fs-5">6</span>
                </div>
                <div>
                    <h5 class="text-primary mb-2">Innovation Labs and Incubators</h5>
                    <ul class="mb-0 small">
                        <li>Set up innovation labs in educational institutions to foster creativity and entrepreneurial thinking among students.</li>
                        <li>Provide incubation support for student-led startups in collaboration with colleges and universities.</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- 7 -->
        <div class="col-md-6">
            <div class="d-flex p-3 border rounded shadow-sm h-100">
                <div class="me-3">
                    <span class="badge bg-primary rounded-circle fs-5">7</span>
                </div>
                <div>
                    <h5 class="text-primary mb-2">Exchange Programs and Workshops</h5>
                    <ul class="mb-0 small">
                        <li>Initiate exchange programs with leading academic institutions for knowledge sharing and exposure to global best practices.</li>
                        <li>Conduct regular workshops, hackathons, and boot camps to enhance student engagement and skill acquisition.</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- 8 -->
        <div class="col-md-6">
            <div class="d-flex p-3 border rounded shadow-sm h-100">
                <div class="me-3">
                    <span class="badge bg-primary rounded-circle fs-5">8</span>
                </div>
                <div>
                    <h5 class="text-primary mb-2">Digital Education Partnerships</h5>
                    <ul class="mb-0 small">
                        <li>Collaborate with academic institutions to introduce digital learning platforms and virtual classrooms.</li>
                        <li>Promote the use of AI, VR, and gamification tools to create immersive learning experiences.</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- 9 -->
        <div class="col-md-6">
            <div class="d-flex p-3 border rounded shadow-sm h-100">
                <div class="me-3">
                    <span class="badge bg-primary rounded-circle fs-5">9</span>
                </div>
                <div>
                    <h5 class="text-primary mb-2">Focus on Rural and Underprivileged Areas</h5>
                    <ul class="mb-0 small">
                        <li>Partner with government schools and rural colleges to ensure access to quality education and skill training.</li>
                        <li>Create special initiatives for marginalized communities, focusing on equity and inclusion.</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- 10 -->
        <div class="col-md-6">
            <div class="d-flex p-3 border rounded shadow-sm h-100">
                <div class="me-3">
                    <span class="badge bg-primary rounded-circle fs-5">10</span>
                </div>
                <div>
                    <h5 class="text-primary mb-2">Placement and Career Guidance</h5>
                    <ul class="mb-0 small">
                        <li>Establish career counseling cells in academic institutions to guide students toward suitable job opportunities and entrepreneurial ventures.</li>
                        <li>Work with recruitment agencies and industries to ensure successful placements for graduates.</li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>


                                <div class="call-to-action mt-5 p-4 bg-light rounded text-center">
                                    <h4 class="h5 text-primary">Join Our Academic Network</h4>
                                    <p>ISICO invites academic institutions to collaborate in creating a transformative
                                        education ecosystem.</p>
                                    <a href="#contact" class="btn btn-primary">Get Started</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Main Content Section End -->
@endsection

@push('styles')
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-font: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            --heading-font: 'Roboto', sans-serif;
        }

        body {
            font-family: var(--primary-font);
            line-height: 1.6;
            color: #333;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: var(--heading-font);
            font-weight: 600;
        }

        .title-banner {
            padding: 4rem 0;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        }

        .collaboration-section {
            scroll-margin-top: 100px;
        }

        .card {
            border-radius: 0.5rem;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .accordion-button:not(.collapsed) {
            background-color: rgba(13, 110, 253, 0.1);
            color: #0d6efd;
        }

        .accordion-button:focus {
            box-shadow: none;
            border-color: rgba(13, 110, 253, 0.25);
        }

        .scrollspy-container {
            position: relative;
            display: flex;
            flex-wrap: wrap;
        }

        .scrollspy-nav {
            flex: 0 0 200px;
            position: sticky;
            top: 20px;
            align-self: flex-start;
        }

        .scrollspy-content {
            flex: 1;
            padding-left: 30px;
        }

        .scrollspy-section {
            padding: 20px 0;
            border-bottom: 1px solid #eee;
        }

        .nav-pills .nav-link.active {
            background-color: #0d6efd;
        }

        .partner-types .badge {
            font-size: 0.85rem;
            padding: 0.5em 0.75em;
            margin-right: 0.5rem;
        }

        @media (max-width: 991.98px) {
            .scrollspy-container {
                flex-direction: column;
            }

            .scrollspy-nav {
                position: static;
                margin-bottom: 20px;
            }

            .scrollspy-content {
                padding-left: 0;
            }
        }
    </style>
@endpush

@push('scripts')
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Initialize AOS animation
        AOS.init({
            duration: 800,
            once: true
        });

        // Activate scrollspy
        const scrollSpy = new bootstrap.ScrollSpy(document.body, {
            target: '.scrollspy-nav'
        });

        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();

                const targetId = this.getAttribute('href');
                if (targetId === '#') return;

                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 80,
                        behavior: 'smooth'
                    });

                    // Update active state in left nav
                    document.querySelectorAll('.list-group-item').forEach(item => {
                        item.classList.remove('active');
                    });
                    this.classList.add('active');
                }
            });
        });

        // Update active nav item on scroll
        window.addEventListener('scroll', function() {
            const sections = document.querySelectorAll('.collaboration-section');
            let currentSection = '';

            sections.forEach(section => {
                const sectionTop = section.offsetTop - 100;
                if (pageYOffset >= sectionTop) {
                    currentSection = '#' + section.getAttribute('id');
                }
            });

            document.querySelectorAll('.list-group-item').forEach(item => {
                item.classList.remove('active');
                if (item.getAttribute('href') === currentSection) {
                    item.classList.add('active');
                }
            });
        });
    </script>
@endpush
