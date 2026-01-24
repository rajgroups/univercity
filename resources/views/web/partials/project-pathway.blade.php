
<div class="container-fluid" id="learningPathwayContainer">
    <div class="row">
        <div class="col-12">
            <!-- Header -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="fw-bold mb-1">
                                <i class="feather icon-eye me-2"></i>Learning Pathway Preview
                            </h4>
                            <p class="text-muted mb-0">Live preview of how your learning pathway will appear to users</p>
                        </div>
                      
                    </div>
                </div>
            </div>

            <!-- PREVIEW SECTION -->
            <div class="p-0">
                <!-- SECTORS CONNECTED -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h4 class="fw-bold mb-2">🌐 Sectors Connected to This Project</h4>
                        <p class="text-muted mb-3">Aligned with priority sectors under Skill India and CSR initiatives.</p>
                        <div class="d-flex flex-wrap gap-2">
                            @forelse($learningPathway->sectors as $sector)
                                <span class="badge px-3 py-2 rounded-pill" style="background: {{ $loop->iteration % 3 == 1 ? '#e8f5e9' : ($loop->iteration % 3 == 2 ? '#fff3e0' : '#e3f2fd') }}; color: {{ $loop->iteration % 3 == 1 ? '#2e7d32' : ($loop->iteration % 3 == 2 ? '#ef6c00' : '#1565c0') }}">
                                    {{ $sector->name }}
                                </span>
                            @empty
                                <span class="text-muted">No sectors defined.</span>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- COURSES -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h4 class="fw-bold mb-2">📚 Training Support Courses</h4>
                        <p class="text-muted mb-4">Defined training modules that translate skills into real-world capability.</p>
                        
                        <!-- Swiper Implementation for Courses -->
                        <div class="swiper course-swiper pb-5">
                            <div class="swiper-wrapper">
                                @forelse($learningPathway->courses as $course)
                                    <div class="swiper-slide h-auto">
                                        <div class="card h-100 border-0 shadow-sm rounded-4">
                                            <div class="card-body p-4 d-flex flex-column">
                                                <div class="mb-3">
                                                    <span class="badge px-3 py-1 rounded-pill" style="background: {{ $loop->iteration % 3 == 1 ? '#e8f5e9' : ($loop->iteration % 3 == 2 ? '#fff3e0' : '#e3f2fd') }}; color: {{ $loop->iteration % 3 == 1 ? '#2e7d32' : ($loop->iteration % 3 == 2 ? '#ef6c00' : '#1565c0') }}">
                                                        {{ $course->sector->name ?? 'General' }}
                                                    </span>
                                                </div>
                                                <h5 class="fw-bold mb-2">{{ $course->name }}</h5>
                                                <p class="text-muted small mb-3 flex-grow-1">{{ Str::limit($course->short_description ?? 'No description available', 80) }}</p>
                                                
                                                <div class="d-flex align-items-center text-muted small mb-4">
                                                    <i class="feather icon-clock me-1"></i> {{ $course->duration_number ?? '' }} {{ ucfirst($course->duration_unit ?? '') }}
                                                    <span class="mx-2">•</span> 
                                                    <i class="feather icon-bar-chart-2 me-1"></i> {{ $course->level ?? 'All Levels' }}
                                                </div>
                                                
                                                <a href="{{ route('web.course.show', $course->slug) }}" class="btn w-100 rounded-3 fw-semibold" style="background: #2e7d32; color: #fff;">
                                                    View Course
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="swiper-slide">
                                        <div class="col-12 text-center py-4">
                                            <p class="text-muted">No training courses listed yet.</p>
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                </div>

                <!-- LEARNING PATH -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h4 class="fw-bold mb-2">🧭 Standard ISICO Learning Path (Customizable)</h4>
                        <p class="text-muted mb-4">A universal, project-agnostic framework guiding learners from awareness to sustainable income or employment.</p>
                        
                        <!-- Swiper Implementation for Roadmap -->
                        <div class="swiper roadmap-swiper">
                            <div class="swiper-wrapper">
                                @forelse($learningPathway->roadmaps as $index => $step)
                                <div class="swiper-slide h-auto">
                                    <div class="card h-100 border-0 shadow-sm rounded-3 p-3 position-relative" style="background: #fafbfd; border: 1px solid #e5e7eb;">
                                        <div class="position-absolute top-0 start-0 bottom-0 ms-2 my-2 rounded-pill" style="width: 4px; background-color: {{ $step->color ?? ['#4caf50', '#66bb6a', '#2196f3', '#9c27b0', '#f9a825'][$index % 5] }};"></div>
                                        <div class="ps-3">
                                            <small class="fw-bold text-muted d-block mb-1">STEP {{ $index + 1 }}</small>
                                            <h6 class="fw-bold mb-2" style="color: {{ $step->color ?? ['#4caf50', '#66bb6a', '#2196f3', '#9c27b0', '#f9a825'][$index % 5] }}">{{ $step->title }}</h6>
                                            <p class="small text-muted mb-2 lh-sm">{{ $step->description }}</p>
                                            @if($step->badge_text)
                                                <span class="badge bg-light text-dark border px-2 py-1 rounded-pill small" style="background: #eef2ff; color: #3f51b5;">{{ $step->badge_text }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <div class="swiper-slide">
                                    <div class="col-12 py-3">
                                        <p class="text-muted">No roadmap steps defined.</p>
                                    </div>
                                </div>
                                @endforelse
                            </div>
                        </div>
                        
                        <div class="alert mt-4 rounded-3 text-center" style="background: #eef7ee; border: none;">
                            <strong>Impact Promise:</strong> This standard learning path ensures every ISICO project delivers measurable skills, employability, and sustainable economic outcomes.
                        </div>
                    </div>
                </div>

                <!-- MULTIDISCIPLINARY MODEL -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h4 class="fw-bold mb-2">🔗 Multidisciplinary Integrated Skill-to-Income Model</h4>
                        <p class="text-muted mb-4">A flat, professional timeline model showing how ISICO integrates multiple sectors into a complete Skill-to-Income ecosystem.</p>

                        <p class="text-muted" style="font-size: 0.95rem; max-width: 900px;">
                            This model is designed as a <strong>clean timeline infographic</strong>, similar to corporate roadmaps used in CSR and government projects. Each stage represents a sector-linked capability, connected through a single value-chain flow. Together, these stages form an adoptable ecosystem across all ISICO initiatives.
                        </p>

                        <!-- FLAT TIMELINE AXIS -->
                        <div class="py-4 position-relative">
                            
                            <div class="d-none d-lg-block position-absolute start-0 end-0 top-50 translate-middle-y" style="height: 4px; background: #e5e7eb; border-radius: 4px; z-index: 0; margin-top: -47px;"></div>
                            
                            <!-- Swiper Implementation for Flow -->
                            <div class="swiper flow-swiper">
                                <div class="swiper-wrapper">
                                    @forelse($learningPathway->flows as $index => $flow)
                                    <div class="swiper-slide h-auto">
                                        <div class="text-center position-relative" style="z-index: 1;">
                                            <div class="d-inline-flex align-items-center justify-content-center rounded-circle text-white fw-bold mb-3 shadow-sm" 
                                                 style="width: 44px; height: 44px; background-color: {{ ['#4caf50', '#ff9800', '#2196f3', '#9c27b0'][$index % 4] }};">
                                                {{ $index + 1 }}
                                            </div>
                                            
                                            <div class="card border-0 shadow-sm rounded-4 p-3 h-100" style="background-color: {{ ['#e8f5e9', '#fff3e0', '#e3f2fd', '#f3e5f5'][$index % 4] }};">
                                                <h6 class="fw-bold mb-2" style="color: {{ ['#2e7d32', '#ef6c00', '#1565c0', '#7b1fa2'][$index % 4] }};">
                                                    {{ $flow->step_title }}
                                                </h6>
                                                <p class="small text-muted mb-0">{{ $flow->description }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    @empty
                                    <div class="swiper-slide">
                                        <div class="col-12 py-3 text-center">
                                            <p class="text-muted">No flow steps defined.</p>
                                        </div>
                                    </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                        
                        <div class="alert mt-4 border" style="background: #eef7ee;">
                            This flat timeline model builds strong stakeholder confidence by clearly demonstrating how ISICO training courses integrate into a structured, scalable Skill-to-Income ecosystem.
                        </div>
                    </div>
                </div>

                <!-- LEARNING OUTCOMES -->
                @if($learningPathway->learning_outcomes)
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h4 class="fw-bold mb-2">🎯 Learning Outcomes</h4>
                        <p class="text-muted mb-3">Measurable outcomes ensuring accountability, employability, and rural impact.</p>
                        <div class="p-4 rounded-3" style="background: #f8f9fa;">
                            {!! $learningPathway->learning_outcomes !!}
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>