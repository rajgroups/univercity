<style>
.pathway-container { max-width: 1200px; margin: 0 auto; padding: 0 16px; }
.pathway-section { margin-bottom: 32px; }
@media (min-width: 768px) { .pathway-section { margin-bottom: 64px; } }
.pathway-text { line-height: 1.6; margin-bottom: 12px; }
/* Flows Alignment */
.learning-flow-container { display: flex; gap: 24px; align-items: stretch; flex-wrap: wrap; }
.learning-flow-item { flex: 1; min-width: 280px; display: flex; flex-direction: column; }
/* Courses Alignment */
.course-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 24px; }
.course-card { display: flex; flex-direction: column; justify-content: space-between; height: 100%; }
/* Roadmap Alignment */
.roadmap-container { display: flex; justify-content: space-between; gap: 24px; flex-wrap: wrap; align-items: stretch; }
.roadmap-item { flex: 1; min-width: 250px; }
/* Mobile Fixes */
@media (max-width: 767px) {
    .pathway-container { padding: 16px; }
    .learning-flow-container, .roadmap-container { flex-direction: column; gap: 16px; }
    .pathway-section h4 { font-size: 20px !important; margin-bottom: 12px; }
    h3 { font-size: 16px !important; }
}
.icon-align { display: flex; align-items: center; gap: 8px; }
.outcomes-container { max-width: 800px; }
</style>

<div class="pathway-container" id="learningPathwayContainer">
    <div class="p-0">
        <!-- 1. SECTORS -->
        <div class="card border-0 shadow-sm pathway-section">
            <div class="card-body p-4">
                <h4 class="fw-bold text-start" style="margin-bottom: 12px;">🌐 Sectors</h4>
                <p class="text-muted pathway-text">Aligned with priority sectors under Skill India and CSR initiatives.</p>
                <div class="d-flex flex-wrap gap-2">
                    <!-- Primary Sector First -->
                    @if($learningPathway->primarySector)
                        <span class="badge px-3 py-2 rounded-pill" style="background: #e8f5e9; color: #2e7d32; border: 1px solid #2e7d32; box-shadow: 0 0 5px rgba(46, 125, 50, 0.3);">
                            ★ {{ $learningPathway->primarySector->name }} (Primary)
                        </span>
                    @endif
                    <!-- Associated Sectors -->
                    @forelse($learningPathway->sectors as $sector)
                        @if(!$learningPathway->primarySector || $sector->id !== $learningPathway->primarySector->id)
                            <span class="badge px-3 py-2 rounded-pill" style="background: {{ $loop->iteration % 2 == 0 ? '#fff3e0' : '#e3f2fd' }}; color: {{ $loop->iteration % 2 == 0 ? '#ef6c00' : '#1565c0' }}">
                                {{ $sector->name }}
                            </span>
                        @endif
                    @empty
                        @if(!$learningPathway->primarySector)
                            <span class="text-muted">No sectors defined.</span>
                        @endif
                    @endforelse
                </div>
            </div>
        </div>

        <!-- 2. LEARNING FLOW -->
        <div class="card border-0 shadow-sm pathway-section">
            <div class="card-body p-4">
                <h4 class="fw-bold text-start" style="margin-bottom: 12px;">🔗 Learning Flow</h4>
                <p class="text-muted pathway-text">Step-by-step skill progression across the learning journey.</p>
                
                <div class="learning-flow-container mt-4">
                    @forelse($learningPathway->flows as $index => $flow)
                    <div class="learning-flow-item">
                        <div class="card border-0 shadow-sm rounded-4 p-4 h-100" style="background-color: {{ ['#e8f5e9', '#fff3e0', '#e3f2fd', '#f3e5f5'][$index % 4] }}; border-left: 4px solid {{ ['#2e7d32', '#ef6c00', '#1565c0', '#7b1fa2'][$index % 4] }} !important;">
                            <div class="d-inline-flex align-items-center justify-content-center rounded-circle text-white fw-bold mb-3 shadow-sm"
                                 style="width: 44px; height: 44px; background-color: {{ ['#4caf50', '#ff9800', '#2196f3', '#9c27b0'][$index % 4] }};">
                                {{ $index + 1 }}
                            </div>
                            <h6 class="fw-bold mb-2" style="color: {{ ['#2e7d32', '#ef6c00', '#1565c0', '#7b1fa2'][$index % 4] }};">
                                {{ $flow->step_title }}
                            </h6>
                            <p class="small text-muted pathway-text mb-0">{{ $flow->description }}</p>
                            @if($flow->skills_text)
                                <div class="mt-3 pt-3 border-top" style="border-color: rgba(0,0,0,0.05) !important;">
                                    <small class="fw-bold d-block text-muted mb-1">Skills Acquired:</small>
                                    <small class="text-muted">{{ $flow->skills_text }}</small>
                                </div>
                            @endif
                        </div>
                    </div>
                    @empty
                    <div class="col-12 py-3 text-start">
                        <p class="text-muted">No flow steps defined.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- 3. COURSES -->
        <div class="card border-0 shadow-sm pathway-section">
            <div class="card-body p-4">
                <h4 class="fw-bold text-start" style="margin-bottom: 12px;">📚 Training Support Courses</h4>
                <p class="text-muted pathway-text">Defined training modules that translate skills into real-world capability.</p>

                <div class="course-grid mt-4">
                    @forelse($learningPathway->courses as $course)
                        <div class="course-card card border-0 shadow-sm hover-lift rounded-4 {{ ($course->availability_status ?? '') == 'not_available' ? 'unavailable' : '' }}">
                            @if(($course->availability_status ?? '') == 'not_available')
                                <div class="unavailable-overlay" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 10; background: rgba(0, 0, 0, 0.7); color: white; padding: 10px 20px; border-radius: 5px; font-weight: bold; text-transform: uppercase; letter-spacing: 1px; white-space: nowrap;">Currently Not Available</div>
                            @endif
                            <div class="position-relative">
                                <img src="{{ asset($course->image ?? 'default-course.jpg') }}" class="card-img-top rounded-top-4" alt="{{ $course->name }}" style="height: 200px; object-fit: cover;">
                                <div class="card-img-overlay d-flex justify-content-between align-items-start p-3">
                                   <span class="badge bg-{{ ($course->mode_of_study->value ?? 1) == 1 ? 'primary' : 'secondary' }}">
                                        {{ $course->mode_of_study?->label() ?? 'Online' }}
                                    </span>
                                    <span class="badge bg-{{ ($course->paid_type->value ?? 'paid') == 'free' ? 'success' : 'warning' }}">
                                        {{ strtoupper($course->paid_type->value ?? 'PAID') }}
                                    </span>
                                </div>
                            </div>
                            <div class="card-body d-flex flex-column p-4 justify-content-between" style="flex-grow: 1;">
                                <div>
                                    <h6 class="card-title text-primary mb-2 fw-bold" style="min-height: 3rem; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                        {{ $course->name }}
                                    </h6>
                                    <p class="text-muted small pathway-text">
                                        <span class="icon-align"><i class="bi bi-building"></i>{{ $course->provider ?? 'ISICO' }}</span>
                                    </p>
                                    <p class="text-warning small pathway-text">
                                        <span class="icon-align"><i class="bi bi-tags"></i>{{ $course->sector->name ?? 'General' }}</span>
                                    </p>
                                    <div class="course-meta d-flex justify-content-between text-muted small mb-3">
                                        <span class="icon-align">
                                             <i class="bi bi-translate"></i>
                                             @php
                                                $languages = is_array($course->language) ? $course->language : (is_string($course->language) ? json_decode($course->language, true) : []);
                                             @endphp
                                             {{ count($languages) > 0 ? count($languages).' Languages' : 'English' }}
                                        </span>
                                        <span class="icon-align">
                                            <i class="bi bi-clock"></i>
                                            {{ $course->duration_number ?? '' }} {{ $course->duration_unit?->label() ?? '' }}
                                        </span>
                                    </div>
                                </div>

                                <div class="mt-auto">
                                     <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div class="rating icon-align text-warning">
                                             <i class="bi bi-star-fill text-warning"></i>
                                             <small class="text-muted">{{ $course->review_stars ?? '4.5' }} ({{ $course->review_count ?? '120' }})</small>
                                        </div>
                                        <div class="enrollment icon-align">
                                            <small class="text-muted"><i class="bi bi-people"></i>{{ $course->enrollment_count ?? 0 }}</small>
                                        </div>
                                    </div>
                                    <a href="{{ route('web.course.show', $course->slug) }}" class="btn w-100 rounded-3 fw-semibold btn-primary" style="bottom: 24px; right: 24px;">
                                        View Course <i class="bi bi-arrow-right ms-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 py-4 text-start">
                            <p class="text-muted">No training courses listed yet.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- 4. ROADMAP -->
        <div class="card border-0 shadow-sm pathway-section">
            <div class="card-body p-4">
                <h4 class="fw-bold text-start" style="margin-bottom: 12px;">🧭 Roadmap</h4>
                <p class="text-muted pathway-text">Visual journey from foundation to livelihood opportunities.</p>

                <div class="roadmap-container mt-4">
                    @forelse($learningPathway->roadmaps as $index => $step)
                    <div class="roadmap-item">
                        <div class="card h-100 border-0 shadow-sm rounded-3 p-4 position-relative text-center d-flex flex-column" style="background: #fafbfd; border: 1px solid #e5e7eb;">
                            <div class="mb-3 d-flex justify-content-center">
                                <span class="badge rounded-pill px-3 py-2 text-center" style="background-color: {{ $step->color ?? ['#4caf50', '#66bb6a', '#2196f3', '#9c27b0', '#f9a825'][$index % 5] }}; color: white;">
                                    STEP {{ $index + 1 }}
                                </span>
                            </div>
                            <h6 class="fw-bold mb-2" style="color: {{ $step->color ?? ['#4caf50', '#66bb6a', '#2196f3', '#9c27b0', '#f9a825'][$index % 5] }}">{{ $step->title }}</h6>
                            <p class="small text-muted pathway-text mb-3 flex-grow-1">{{ $step->description }}</p>
                            @if($step->badge_text)
                                <div class="mt-auto">
                                    <span class="badge bg-light text-dark border px-2 py-1 rounded-pill small" style="background: #eef2ff; color: #3f51b5;">{{ $step->badge_text }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                    @empty
                    <div class="col-12 py-3 text-start">
                        <p class="text-muted">No roadmap steps defined.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- 5. OUTCOMES -->
        @if($learningPathway->learning_outcomes)
        <div class="card border-0 shadow-sm pathway-section">
            <div class="card-body p-4">
                <h4 class="fw-bold text-start" style="margin-bottom: 12px;">🎯 Outcomes</h4>
                <div class="outcomes-container text-start">
                    <p class="text-muted pathway-text mb-3">Skills, competencies, and career or income opportunities learners gain.</p>
                    <div class="p-4 rounded-3" style="background: #f8f9fa;">
                        {!! $learningPathway->learning_outcomes !!}
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
