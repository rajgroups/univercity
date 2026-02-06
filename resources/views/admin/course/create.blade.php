@extends('layouts.admin.app')

@section('content')
    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4 class="fw-bold">Create Course</h4>
                <h6>Add a new training program to the system</h6>
            </div>
        </div>
        <div class="page-btn mt-0">
            <a href="{{ route('admin.course.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-2"></i>Back to List
            </a>
        </div>
    </div>

    {{-- Success Message --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Error Message --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="{{ route('admin.course.store') }}" method="POST" enctype="multipart/form-data" id="courseForm">
        @csrf
        
        <div class="row">
            <!-- Left Column: Main Content -->
            <div class="col-lg-8">
                
                <!-- Basic Information -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-transparent border-bottom p-3">
                        <h5 class="card-title mb-0"><i class="bi bi-info-circle me-2 text-primary"></i>Basic Information</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Course Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" 
                                   name="name" value="{{ old('name') }}" 
                                   placeholder="e.g., Full Stack Web Development Masterclass" required>
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Short Description</label>
                            <textarea class="form-control @error('short_description') is-invalid @enderror" 
                                      name="short_description" rows="3" 
                                      placeholder="Brief summary (max 200 chars)...">{{ old('short_description') }}</textarea>
                             <div class="form-text text-end"><span id="shortDescCount">0</span>/200</div>
                            @error('short_description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                         <div class="mb-3">
                            <label class="form-label fw-bold">Detailed Description</label>
                            <textarea name="long_description" id="long_description" class="form-control @error('long_description') is-invalid @enderror">{{ old('long_description') }}</textarea>
                            @error('long_description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

                <!-- Course Details -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-transparent border-bottom p-3">
                        <h5 class="card-title mb-0"><i class="bi bi-book me-2 text-primary"></i>Course Details</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Training Provider</label>
                                <input type="text" class="form-control @error('provider') is-invalid @enderror"
                                       name="provider" value="{{ old('provider') }}" placeholder="Organization Name">
                                @error('provider') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Certification Type</label>
                                <input type="text" class="form-control @error('certification_type') is-invalid @enderror"
                                       name="certification_type" value="{{ old('certification_type') }}" placeholder="e.g., Completion Certificate">
                                @error('certification_type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Assessment Mode</label>
                                <input type="text" class="form-control @error('assessment_mode') is-invalid @enderror"
                                       name="assessment_mode" value="{{ old('assessment_mode') }}" placeholder="e.g., Online Exam">
                                @error('assessment_mode') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                        </div>

                         <div class="mb-3">
                            <label class="form-label fw-bold">Student Requirements</label>
                            <div class="row g-2">
                                <div class="col-md-4">
                                     <input type="text" class="form-control @error('required_age') is-invalid @enderror"
                                           name="required_age" value="{{ old('required_age') }}" placeholder="Age (e.g., 18+)">
                                </div>
                                <div class="col-md-8">
                                    <select name="minimum_education[]" class="form-control select2-multiple" multiple data-placeholder="Min Education">
                                        <option value="10th Pass" {{ in_array('10th Pass', old('minimum_education', [])) ? 'selected' : '' }}>10th Pass</option>
                                        <option value="12th Pass" {{ in_array('12th Pass', old('minimum_education', [])) ? 'selected' : '' }}>12th Pass</option>
                                        <option value="Diploma" {{ in_array('Diploma', old('minimum_education', [])) ? 'selected' : '' }}>Diploma</option>
                                        <option value="Graduate" {{ in_array('Graduate', old('minimum_education', [])) ? 'selected' : '' }}>Graduate</option>
                                        <option value="Post Graduate" {{ in_array('Post Graduate', old('minimum_education', [])) ? 'selected' : '' }}>Post Graduate</option>
                                        <option value="ITI" {{ in_array('ITI', old('minimum_education', [])) ? 'selected' : '' }}>ITI</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                             <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Industry Experience</label>
                                <div class="input-group">
                                    <input type="number" class="form-control @error('industry_experience_years') is-invalid @enderror"
                                           name="industry_experience_years" value="{{ old('industry_experience_years', 0) }}" min="0">
                                    <span class="input-group-text">Years</span>
                                </div>
                                <input type="text" class="form-control mt-2 @error('industry_experience_desc') is-invalid @enderror"
                                       name="industry_experience_desc" value="{{ old('industry_experience_desc') }}" placeholder="Specifics (optional)">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Learning Tools</label>
                                <select name="learning_tools[]" class="form-control select2-multiple" multiple data-placeholder="Select Tools">
                                    <option value="VS Code" {{ in_array('VS Code', old('learning_tools', [])) ? 'selected' : '' }}>VS Code</option>
                                    <option value="Python" {{ in_array('Python', old('learning_tools', [])) ? 'selected' : '' }}>Python</option>
                                    <option value="JavaScript" {{ in_array('JavaScript', old('learning_tools', [])) ? 'selected' : '' }}>JavaScript</option>
                                    <option value="React" {{ in_array('React', old('learning_tools', [])) ? 'selected' : '' }}>React</option>
                                    <option value="Node.js" {{ in_array('Node.js', old('learning_tools', [])) ? 'selected' : '' }}>Node.js</option>
                                    <option value="MySQL" {{ in_array('MySQL', old('learning_tools', [])) ? 'selected' : '' }}>MySQL</option>
                                    <option value="Docker" {{ in_array('Docker', old('learning_tools', [])) ? 'selected' : '' }}>Docker</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                 <!-- Program Information -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-transparent border-bottom p-3">
                        <h5 class="card-title mb-0"><i class="bi bi-briefcase me-2 text-primary"></i>Program Information</h5>
                    </div>
                    <div class="card-body p-4">
                         <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Program By</label>
                                <input type="text" class="form-control @error('program_by') is-invalid @enderror"
                                       name="program_by" value="{{ old('program_by') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Initiative Of</label>
                                <input type="text" class="form-control @error('initiative_of') is-invalid @enderror"
                                       name="initiative_of" value="{{ old('initiative_of') }}">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold">Domain</label>
                                <input type="text" class="form-control @error('domain') is-invalid @enderror"
                                       name="domain" value="{{ old('domain') }}">
                            </div>
                        </div>

                        <div class="row">
                             <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Internship Details</label>
                                <div class="btn-group w-100" role="group">
                                    <input type="radio" class="btn-check" name="internship" id="internship_no" value="0" {{ old('internship', 0) == 0 ? 'checked' : '' }}>
                                    <label class="btn btn-outline-danger" for="internship_no">No</label>
                                    <input type="radio" class="btn-check" name="internship" id="internship_yes" value="1" {{ old('internship') == 1 ? 'checked' : '' }}>
                                    <label class="btn btn-outline-success" for="internship_yes">Yes</label>
                                </div>
                                <div id="internship_note_div" class="mt-2" style="display: {{ old('internship', 0) == 1 ? 'block' : 'none' }}">
                                     <input type="text" class="form-control" name="internship_note" value="{{ old('internship_note') }}" placeholder="Internship Description">
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Stipend Details</label>
                                <div class="btn-group w-100" role="group">
                                    <input type="radio" class="btn-check" name="stipend_status" id="stipend_no" value="0" {{ old('stipend_status', 0) == 0 ? 'checked' : '' }}>
                                    <label class="btn btn-outline-danger" for="stipend_no">No</label>
                                    <input type="radio" class="btn-check" name="stipend_status" id="stipend_yes" value="1" {{ old('stipend_status') == 1 ? 'checked' : '' }}>
                                    <label class="btn btn-outline-success" for="stipend_yes">Yes</label>
                                </div>
                                <div id="stipend_amount_div" class="mt-2" style="display: {{ old('stipend_status', 0) == 1 ? 'block' : 'none' }}">
                                     <input type="text" class="form-control" name="stipend_amount" value="{{ old('stipend_amount') }}" placeholder="Amount (e.g. ₹5000)">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Course Content & Curriculum -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-transparent border-bottom p-3">
                        <h5 class="card-title mb-0"><i class="bi bi-list-ul me-2 text-primary"></i>Curriculum & Outcomes</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-4">
                            <label class="form-label fw-bold">Course Modules / Topics</label>
                            <div id="topics-wrapper">
                                @if (old('topics'))
                                    @foreach (old('topics') as $index => $topic)
                                        <div class="topic-card mb-2 border rounded p-3 bg-light position-relative">
                                            <div class="row g-2">
                                                <div class="col-md-4">
                                                    <input type="text" name="topics[{{ $index }}][title]" class="form-control form-control-sm" placeholder="Title" value="{{ $topic['title'] ?? '' }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" name="topics[{{ $index }}][description]" class="form-control form-control-sm" placeholder="Description" value="{{ $topic['description'] ?? '' }}">
                                                </div>
                                                <div class="col-md-2">
                                                    <button type="button" class="btn btn-danger btn-sm w-100 remove-topic"><i class="bi bi-trash"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="topic-card mb-2 border rounded p-3 bg-light position-relative">
                                        <div class="row g-2">
                                            <div class="col-md-4">
                                                <input type="text" name="topics[0][title]" class="form-control form-control-sm" placeholder="Title">
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" name="topics[0][description]" class="form-control form-control-sm" placeholder="Description">
                                            </div>
                                             <div class="col-md-2">
                                                <button type="button" class="btn btn-danger btn-sm w-100 remove-topic"><i class="bi bi-trash"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <button type="button" id="add-topic" class="btn btn-light btn-sm text-primary mt-2"><i class="bi bi-plus me-1"></i> Add Topic</button>
                        </div>
                        
                        <div>
                             <label class="form-label fw-bold">Learning Outcomes / Specifications</label>
                             <div id="specifications-wrapper">
                                  @if (old('other_specifications'))
                                    @foreach (old('other_specifications') as $index => $spec)
                                        <div class="specification-card mb-2 border rounded p-3 bg-light">
                                            <div class="row g-2">
                                                <div class="col-md-4">
                                                    <input type="text" name="other_specifications[{{ $index }}][label]" class="form-control form-control-sm" placeholder="Label" value="{{ $spec['label'] ?? '' }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" name="other_specifications[{{ $index }}][description]" class="form-control form-control-sm" placeholder="Value/Description" value="{{ $spec['description'] ?? '' }}">
                                                </div>
                                                 <div class="col-md-2">
                                                    <button type="button" class="btn btn-danger btn-sm w-100 remove-specification"><i class="bi bi-trash"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                  @else
                                     <div class="specification-card mb-2 border rounded p-3 bg-light">
                                            <div class="row g-2">
                                                <div class="col-md-4">
                                                    <input type="text" name="other_specifications[0][label]" class="form-control form-control-sm" placeholder="Label">
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" name="other_specifications[0][description]" class="form-control form-control-sm" placeholder="Value/Description">
                                                </div>
                                                 <div class="col-md-2">
                                                    <button type="button" class="btn btn-danger btn-sm w-100 remove-specification"><i class="bi bi-trash"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                  @endif
                             </div>
                              <button type="button" id="add-specification" class="btn btn-light btn-sm text-primary mt-2"><i class="bi bi-plus me-1"></i> Add Outcome</button>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Right Column: Settings & Media -->
            <div class="col-lg-4">
                
                <!-- Configuration -->
                <div class="card border-0 shadow-sm mb-4">
                     <div class="card-header bg-transparent border-bottom p-3">
                        <h5 class="card-title mb-0"><i class="bi bi-gear me-2 text-primary"></i>Configuration</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Status <span class="text-danger">*</span></label>
                            <select name="status" class="form-select @error('status') is-invalid @enderror">
                                <option value="1" {{ old('status', 1) == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Availability</label>
                            <select name="availability_status" class="form-select @error('availability_status') is-invalid @enderror">
                                <option value="available" {{ old('availability_status', 'available') == 'available' ? 'selected' : '' }}>Available</option>
                                <option value="not_available" {{ old('availability_status') == 'not_available' ? 'selected' : '' }}>Not Available</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Is Featured?</label>
                            <div class="btn-group w-100" role="group">
                                <input type="radio" class="btn-check" name="is_featured" id="featured_no" value="0" {{ old('is_featured', 0) == 0 ? 'checked' : '' }}>
                                <label class="btn btn-outline-secondary" for="featured_no">Regular</label>
                                <input type="radio" class="btn-check" name="is_featured" id="featured_yes" value="1" {{ old('is_featured') == 1 ? 'checked' : '' }}>
                                <label class="btn btn-outline-warning" for="featured_yes"><i class="bi bi-star-fill me-1"></i> Featured</label>
                            </div>
                        </div>
                        
                         <div class="mb-3">
                            <label class="form-label fw-bold">Sector <span class="text-danger">*</span></label>
                            <select name="sector_id" class="form-select select2 @error('sector_id') is-invalid @enderror">
                                <option value="">Select Sector</option>
                                @foreach ($sectors as $sector)
                                    <option value="{{ $sector->id }}" {{ old('sector_id') == $sector->id ? 'selected' : '' }}>{{ $sector->name }}</option>
                                @endforeach
                            </select>
                            @error('sector_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                         <div class="mb-3">
                            <label class="form-label fw-bold">Level <span class="text-danger">*</span></label>
                            <select name="level" class="form-select @error('level') is-invalid @enderror">
                                <option value="">Select Level</option>
                                <option value="Awareness" {{ old('level') == 'Awareness' ? 'selected' : '' }}>Awareness</option>
                                <option value="Foundation" {{ old('level') == 'Foundation' ? 'selected' : '' }}>Foundation</option>
                                <option value="Intermediate" {{ old('level') == 'Intermediate' ? 'selected' : '' }}>Intermediate</option>
                                <option value="Advanced" {{ old('level') == 'Advanced' ? 'selected' : '' }}>Advanced</option>
                                <option value="Professional" {{ old('level') == 'Professional' ? 'selected' : '' }}>Professional</option>
                            </select>
                            @error('level') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Duration</label>
                            <div class="input-group">
                                <input type="number" name="duration_number" class="form-control" value="{{ old('duration_number') }}" placeholder="Num">
                                <select name="duration_unit" class="form-select">
                                    <option value="days" {{ old('duration_unit') == 'days' ? 'selected' : '' }}>Days</option>
                                    <option value="weeks" {{ old('duration_unit') == 'weeks' ? 'selected' : '' }}>Weeks</option>
                                    <option value="months" {{ old('duration_unit') == 'months' ? 'selected' : '' }}>Months</option>
                                    <option value="years" {{ old('duration_unit') == 'years' ? 'selected' : '' }}>Years</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                             <div class="col-6 mb-3">
                                <label class="form-label fw-bold">Start Date</label>
                                <input type="date" class="form-control" name="start_date" value="{{ old('start_date') }}">
                             </div>
                             <div class="col-6 mb-3">
                                <label class="form-label fw-bold">End Date</label>
                                <input type="date" class="form-control" name="end_date" value="{{ old('end_date') }}">
                             </div>
                        </div>
                    </div>
                </div>

                <!-- Targeting & Logistics -->
                <div class="card border-0 shadow-sm mb-4">
                     <div class="card-header bg-transparent border-bottom p-3">
                        <h5 class="card-title mb-0"><i class="bi bi-bullseye me-2 text-primary"></i>Targeting & Logistics</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-3">
                             <label class="form-label fw-bold">Payment Type <span class="text-danger">*</span></label>
                             <select name="paid_type" class="form-select">
                                <option value="free" {{ old('paid_type', 'free') == 'free' ? 'selected' : '' }}>Free</option>
                                <option value="paid" {{ old('paid_type') == 'paid' ? 'selected' : '' }}>Paid</option>
                                <option value="na" {{ old('paid_type') == 'na' ? 'selected' : '' }}>N/A</option>
                             </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Mode of Study <span class="text-danger">*</span></label>
                            <select name="mode_of_study" class="form-select">
                                <option value="1" {{ old('mode_of_study') == '1' ? 'selected' : '' }}>Online</option>
                                <option value="2" {{ old('mode_of_study') == '2' ? 'selected' : '' }}>In-Centre</option>
                                <option value="3" {{ old('mode_of_study') == '3' ? 'selected' : '' }}>Hybrid</option>
                                <option value="4" {{ old('mode_of_study') == '4' ? 'selected' : '' }}>On-Demand</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Languages <span class="text-danger">*</span></label>
                            <select name="language[]" class="form-control select2-multiple" multiple>
                                <option value="English" {{ in_array('English', old('language', ['English'])) ? 'selected' : '' }}>English</option>
                                <option value="Hindi" {{ in_array('Hindi', old('language', [])) ? 'selected' : '' }}>Hindi</option>
                                <option value="Marathi" {{ in_array('Marathi', old('language', [])) ? 'selected' : '' }}>Marathi</option>
                                <option value="Bengali" {{ in_array('Bengali', old('language', [])) ? 'selected' : '' }}>Bengali</option>
                                <option value="Tamil" {{ in_array('Tamil', old('language', [])) ? 'selected' : '' }}>Tamil</option>
                                <option value="Telugu" {{ in_array('Telugu', old('language', [])) ? 'selected' : '' }}>Telugu</option>
                                <option value="Kannada" {{ in_array('Kannada', old('language', [])) ? 'selected' : '' }}>Kannada</option>
                                <option value="Malayalam" {{ in_array('Malayalam', old('language', [])) ? 'selected' : '' }}>Malayalam</option>
                            </select>
                        </div>
                        
                         <div class="mb-3">
                            <label class="form-label fw-bold">Locations</label>
                            <select name="location[]" class="form-control select2-multiple" multiple>
                                <option value="Mumbai" {{ in_array('Mumbai', old('location', [])) ? 'selected' : '' }}>Mumbai</option>
                                <option value="Delhi" {{ in_array('Delhi', old('location', [])) ? 'selected' : '' }}>Delhi</option>
                                <option value="Bangalore" {{ in_array('Bangalore', old('location', [])) ? 'selected' : '' }}>Bangalore</option>
                                <option value="Hyderabad" {{ in_array('Hyderabad', old('location', [])) ? 'selected' : '' }}>Hyderabad</option>
                                <option value="Chennai" {{ in_array('Chennai', old('location', [])) ? 'selected' : '' }}>Chennai</option>
                                <option value="Kolkata" {{ in_array('Kolkata', old('location', [])) ? 'selected' : '' }}>Kolkata</option>
                                <option value="Pune" {{ in_array('Pune', old('location', [])) ? 'selected' : '' }}>Pune</option>
                                <option value="Online" {{ in_array('Online', old('location', [])) ? 'selected' : '' }}>Online</option>
                            </select>
                        </div>

                        <div class="mb-3">
                             <label class="form-label fw-bold">NSQF Level</label>
                             <select name="nsqf_level" class="form-select">
                                <option value="">Select</option>
                                @for($i = 1; $i <= 10; $i++)
                                    <option value="Level {{ $i }}" {{ old('nsqf_level') == 'Level ' . $i ? 'selected' : '' }}>Level {{ $i }}</option>
                                @endfor
                             </select>
                        </div>
                        
                        <div class="mb-3">
                             <label class="form-label fw-bold">Target Occupations</label>
                             <select name="occupations[]" class="form-control select2-multiple" multiple data-placeholder="Add Occupations">
                                 <option value="Software Developer" {{ in_array('Software Developer', old('occupations', [])) ? 'selected' : '' }}>Software Developer</option>
                                 <option value="Data Analyst" {{ in_array('Data Analyst', old('occupations', [])) ? 'selected' : '' }}>Data Analyst</option>
                                 <option value="Web Designer" {{ in_array('Web Designer', old('occupations', [])) ? 'selected' : '' }}>Web Designer</option>
                                 <option value="Digital Marketer" {{ in_array('Digital Marketer', old('occupations', [])) ? 'selected' : '' }}>Digital Marketer</option>
                                 <option value="Project Manager" {{ in_array('Project Manager', old('occupations', [])) ? 'selected' : '' }}>Project Manager</option>
                             </select>
                        </div>
                    </div>
                </div>

                <!-- Media -->
                <div class="card border-0 shadow-sm mb-4">
                     <div class="card-header bg-transparent border-bottom p-3">
                        <h5 class="card-title mb-0"><i class="bi bi-image me-2 text-primary"></i>Media</h5>
                    </div>
                    <div class="card-body p-4">
                         <div class="mb-3">
                            <label class="form-label fw-bold">Featured Image <span class="text-danger">*</span></label>
                            <input type="file" class="form-control mb-2" id="imageUpload" name="image" accept="image/*" required>
                            <div class="image-preview d-none" id="imagePreview">
                                <img src="" alt="Preview" class="img-fluid rounded border p-1" style="max-height: 150px;">
                            </div>
                            @error('image') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                         </div>
                         <div class="mb-3">
                             <label class="form-label fw-bold">Gallery</label>
                             <input type="file" class="form-control mb-2" id="galleryUpload" name="gallery[]" multiple accept="image/*">
                             <div class="gallery-preview row g-2 d-none" id="galleryPreview"></div>
                         </div>
                    </div>
                </div>

                 <!-- Metrics -->
                <div class="card border-0 shadow-sm mb-4">
                     <div class="card-header bg-transparent border-bottom p-3">
                        <h5 class="card-title mb-0"><i class="bi bi-bar-chart me-2 text-primary"></i>Initial Metrics</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label class="form-label fw-bold">Rating</label>
                                <input type="number" step="0.1" max="5" class="form-control" name="review_stars" value="{{ old('review_stars', 0) }}">
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-label fw-bold">Review Count</label>
                                <input type="number" class="form-control" name="review_count" value="{{ old('review_count', 0) }}">
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold">Enrollment Count</label>
                                <input type="number" class="form-control" name="enrollment_count" value="{{ old('enrollment_count', 0) }}">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        
        <div class="d-flex justify-content-end mb-5">
            <a href="{{ route('admin.course.index') }}" class="btn btn-light me-2 btn-lg">Cancel</a>
            <button type="submit" class="btn btn-primary btn-lg px-5">
                <i class="bi bi-save me-2"></i>Create Course
            </button>
        </div>
    </form>
@endsection

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
      <style>
        .select2-container--default .select2-selection--multiple,
        .select2-container--default .select2-selection--single {
            border: 1px solid #ced4da;
            border-radius: 6px;
            padding: 0.375rem;
            min-height: calc(2.5rem + 2px);
        }
        .select2-container--default.select2-container--focus .select2-selection--multiple,
        .select2-container--default.select2-container--focus .select2-selection--single {
            border-color: #86b7fe;
            outline: 0;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }
        .image-preview img, .gallery-preview img {
            border: 1px solid #dee2e6;
            padding: 2px;
            border-radius: 4px;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
       <script>
        $(document).ready(function() {
            // Initialize Select2
            $('.select2').select2({ width: '100%', dropdownParent: $('body') });
            $('.select2-multiple').select2({
                placeholder: "Select options",
                allowClear: true,
                tags: true,
                width: '100%',
                dropdownParent: $('body')
            });

            // Initialize Summernote
            $('#long_description').summernote({
                height: 300,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'picture']],
                    ['view', ['fullscreen', 'codeview']]
                ]
            });

            // Character counter
            $('textarea[name="short_description"]').on('input', function() {
                $('#shortDescCount').text($(this).val().length);
            });

            // Image preview
            $('#imageUpload').on('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#imagePreview').removeClass('d-none').find('img').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(file);
                }
            });

             // Gallery preview
            $('#galleryUpload').on('change', function(e) {
                const files = e.target.files;
                const preview = $('#galleryPreview');
                preview.empty();
                if (files.length > 0) {
                    preview.removeClass('d-none');
                    for (let i = 0; i < files.length; i++) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            preview.append(`<div class="col-3"><img src="${e.target.result}" class="img-fluid rounded"></div>`);
                        }
                        reader.readAsDataURL(files[i]);
                    }
                } else {
                    preview.addClass('d-none');
                }
            });

            // Course code generator


             // Toggle internship note
            $('input[name="internship"]').change(function() {
                if ($(this).val() == '1') $('#internship_note_div').show();
                else $('#internship_note_div').hide();
            });

            // Toggle stipend amount
            $('input[name="stipend_status"]').change(function() {
                if ($(this).val() == '1') $('#stipend_amount_div').show();
                else $('#stipend_amount_div').hide();
            });

            // Dynamic topics
            let topicIndex = {{ old('topics') ? count(old('topics')) : 1 }};
            $('#add-topic').on('click', function() {
                const html = `
                    <div class="topic-card mb-2 border rounded p-3 bg-light position-relative">
                        <div class="row g-2">
                            <div class="col-md-4">
                                <input type="text" name="topics[${topicIndex}][title]" class="form-control form-control-sm" placeholder="Title">
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="topics[${topicIndex}][description]" class="form-control form-control-sm" placeholder="Description">
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-danger btn-sm w-100 remove-topic"><i class="bi bi-trash"></i></button>
                            </div>
                        </div>
                    </div>`;
                $('#topics-wrapper').append(html);
                topicIndex++;
            });

            // Dynamic specifications
            let specIndex = {{ old('other_specifications') ? count(old('other_specifications')) : 1 }};
            $('#add-specification').on('click', function() {
                const html = `
                     <div class="specification-card mb-2 border rounded p-3 bg-light">
                        <div class="row g-2">
                            <div class="col-md-4">
                                <input type="text" name="other_specifications[${specIndex}][label]" class="form-control form-control-sm" placeholder="Label">
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="other_specifications[${specIndex}][description]" class="form-control form-control-sm" placeholder="Value/Description">
                            </div>
                                <div class="col-md-2">
                                <button type="button" class="btn btn-danger btn-sm w-100 remove-specification"><i class="bi bi-trash"></i></button>
                            </div>
                        </div>
                    </div>`;
                $('#specifications-wrapper').append(html);
                specIndex++;
            });

            $(document).on('click', '.remove-topic, .remove-specification', function() {
                $(this).closest('.topic-card, .specification-card').remove();
            });
        });
    </script>
@endpush