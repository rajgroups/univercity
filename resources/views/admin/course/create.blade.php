@extends('layouts.admin.app')

@section('content')
<div class="container mt-4">
    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4 class="fw-bold">Create Course</h4>
                <h6>Create new Course</h6>
            </div>
        </div>
        <ul class="table-top-head">
            <li>
                <a data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Refresh"><i class="ti ti-refresh"></i></a>
            </li>
            <li>
                <a data-bs-toggle="tooltip" data-bs-placement="top" id="collapse-header" aria-label="Collapse">
                    <i class="ti ti-chevron-up"></i>
                </a>
            </li>
        </ul>
        <div class="page-btn mt-0">

            <a href="{{ route('admin.course.index') }}" class="btn btn-secondary">
                <i class="feather feather-arrow-left me-2"></i>Back to List
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
    <div class="card shadow rounded-3">
        <div class="card-header text-white">
            <h4 class="mb-0">Create New Course</h4>
        </div>
        <form action="{{ route('admin.course.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="card-body row g-3">

                <!-- Name & Short Name -->
                <div class="col-md-6">
                    <label for="name" class="form-label">Course Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="short_name" class="form-label">Short Name <span class="text-danger">*</span></label>
                    <select name="short_name" class="form-select @error('short_name') is-invalid @enderror" required>
                        <option value="">Select Level</option>
                        <option value="Awareness" {{ old('short_name') == 'Awareness' ? 'selected' : '' }}>Awareness</option>
                        <option value="Foundation" {{ old('short_name') == 'Foundation' ? 'selected' : '' }}>Foundation</option>
                        <option value="Intermediate" {{ old('short_name') == 'Intermediate' ? 'selected' : '' }}>Intermediate</option>
                        <option value="Advanced" {{ old('short_name') == 'Advanced' ? 'selected' : '' }}>Advanced</option>
                        <option value="Professional" {{ old('short_name') == 'Professional' ? 'selected' : '' }}>Professional</option>
                    </select>
                    @error('short_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Image Upload -->
                <div class="col-md-6">
                    <label class="form-label">Image <span class="text-danger">*</span></label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" required>
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Duration & Paid Type -->
                <div class="col-md-6">
                    <label class="form-label">Duration</label>
                    <input type="text" class="form-control @error('duration') is-invalid @enderror" name="duration" value="{{ old('duration') }}">
                    @error('duration')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Sector -->
                <div class="col-md-6">
                    <label class="form-label">Sector <span class="text-danger">*</span></label>
                    <select name="sector_id" class="form-select @error('sector_id') is-invalid @enderror">
                        <option value="">Select Sector</option>
                        @foreach($sectors as $sector)
                            <option value="{{ $sector->id }}" {{ old('sector_id') == $sector->id ? 'selected' : '' }}>
                                {{ $sector->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('sector_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Paid Type <span class="text-danger">*</span></label>
                    <select name="paid_type" class="form-select @error('paid_type') is-invalid @enderror">
                        <option value="Free" {{ old('paid_type', 'Free') == 'Free' ? 'selected' : '' }}>Free</option>
                        <option value="Paid" {{ old('paid_type') == 'Paid' ? 'selected' : '' }}>Paid</option>
                        <option value="Nill" {{ old('paid_type') == 'Nill' ? 'selected' : '' }}>N/A</option>
                    </select>
                    @error('paid_type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Descriptions -->
                <div class="col-md-12">
                    <label class="form-label">Short Description</label>
                    <textarea class="form-control @error('short_description') is-invalid @enderror" name="short_description" rows="2">{{ old('short_description') }}</textarea>
                    @error('short_description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-12">
                    <label class="form-label">Long Description</label>
                    <textarea class="form-control @error('long_description') is-invalid @enderror" name="long_description" rows="4" id="long_description">{{ old('long_description') }}</textarea>
                    @error('long_description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Provider and Language -->
                <div class="col-md-6">
                    <label class="form-label">Training Provider</label>
                    <input type="text" class="form-control @error('provider') is-invalid @enderror" name="provider" value="{{ old('provider') }}">
                    @error('provider')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Language</label>
                    <input type="text" class="form-control @error('language') is-invalid @enderror" name="language" value="{{ old('language', 'English') }}">
                    @error('language')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Certification & Assessment -->
                <div class="col-md-6">
                    <label class="form-label">Certification Type</label>
                    <input type="text" class="form-control @error('certification_type') is-invalid @enderror" name="certification_type" value="{{ old('certification_type') }}">
                    @error('certification_type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Assessment Mode</label>
                    <input type="text" class="form-control @error('assessment_mode') is-invalid @enderror" name="assessment_mode" value="{{ old('assessment_mode') }}">
                    @error('assessment_mode')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- QP & NSQF & Credit -->
                <div class="col-md-4">
                    <label class="form-label">QP Code</label>
                    <input type="text" class="form-control @error('qp_code') is-invalid @enderror" name="qp_code" value="{{ old('qp_code') }}">
                    @error('qp_code')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">NSQF-referenced (non-accredited)</label>
                    <input type="text" class="form-control @error('nsqf_level') is-invalid @enderror" name="nsqf_level" value="{{ old('nsqf_level') }}">
                    @error('nsqf_level')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Credits Assigned</label>
                    <input type="text" class="form-control @error('credits_assigned') is-invalid @enderror" name="credits_assigned" value="{{ old('credits_assigned') }}">
                    @error('credits_assigned')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Learning Product, Program, Domain -->
                <div class="col-md-4">
                    <label class="form-label">Learning Product Type</label>
                     <select name="learning_product_type" class="form-select @error('learning_product_type') is-invalid @enderror">
                                <option value="">Select Pathway Type</option>
                                <option value="online_pathway" {{ old('online_pathway') == 'online_pathway' ? 'selected' : '' }}>Online Pathway</option>
                                <option value="onsite_abroad" {{ old('onsite_abroad') == 'onsite_abroad' ? 'selected' : '' }}>Onsite Abroad</option>
                                <option value="hybrid" {{ old('hybrid') == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                                <option value="dual_credit" {{ old('dual_credit') == 'dual_credit' ? 'selected' : '' }}>Dual-credit</option>
                                <option value="twinning_program" {{ old('twinning_program') == 'twinning_program' ? 'selected' : '' }}>Twinning Program</option>
                    </select>
                    @error('learning_product_type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Program By</label>
                    <input type="text" class="form-control @error('program_by') is-invalid @enderror" name="program_by" value="{{ old('program_by') }}">
                    @error('program_by')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Initiative Of</label>
                    <input type="text" class="form-control @error('initiative_of') is-invalid @enderror" name="initiative_of" value="{{ old('initiative_of') }}">
                    @error('initiative_of')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Program</label>
                    <input type="text" class="form-control @error('program') is-invalid @enderror" name="program" value="{{ old('program') }}">
                    @error('program')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Domain</label>
                    <input type="text" class="form-control @error('domain') is-invalid @enderror" name="domain" value="{{ old('domain') }}">
                    @error('domain')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Occupations</label>
                    <input type="text" class="form-control @error('occupations') is-invalid @enderror" name="occupations" value="{{ old('occupations') }}">
                    @error('occupations')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Age, Education, Experience -->
                <div class="col-md-4">
                    <label class="form-label">Required Age</label>
                    <input type="text" class="form-control @error('required_age') is-invalid @enderror" name="required_age" value="{{ old('required_age') }}">
                    @error('required_age')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Minimum Education</label>
                    <input type="text" class="form-control @error('minimum_education') is-invalid @enderror" name="minimum_education" value="{{ old('minimum_education') }}">
                    @error('minimum_education')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Industry Experience</label>
                    <input type="text" class="form-control @error('industry_experience') is-invalid @enderror" name="industry_experience" value="{{ old('industry_experience') }}">
                    @error('industry_experience')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Tools & Topics -->
                <div class="col-md-12">
                    <label class="form-label">Learning Tools</label>
                    <input type="text" class="form-control @error('learning_tools') is-invalid @enderror" name="learning_tools" value="{{ old('learning_tools') }}">
                    @error('learning_tools')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-12">
                    <label class="form-label">Topics (Title & Description)</label>
                    <div id="topics-wrapper">
                        @if(old('topics'))
                            @foreach(old('topics') as $index => $topic)
                                <div class="row g-2 topic-row mb-2">
                                    <div class="col-md-5">
                                        <input type="text" name="topics[{{ $index }}][title]" class="form-control @error('topics.'.$index.'.title') is-invalid @enderror" placeholder="Topic Title" value="{{ $topic['title'] ?? '' }}">
                                        @error('topics.'.$index.'.title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" name="topics[{{ $index }}][description]" class="form-control @error('topics.'.$index.'.description') is-invalid @enderror" placeholder="Topic Description" value="{{ $topic['description'] ?? '' }}">
                                        @error('topics.'.$index.'.description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-danger remove-topic w-100">Remove</button>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="row g-2 topic-row mb-2">
                                <div class="col-md-5">
                                    <input type="text" name="topics[0][title]" class="form-control" placeholder="Topic Title">
                                </div>
                                <div class="col-md-5">
                                    <input type="text" name="topics[0][description]" class="form-control" placeholder="Topic Description">
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-danger remove-topic w-100">Remove</button>
                                </div>
                            </div>
                        @endif
                    </div>
                    <button type="button" id="add-topic" class="btn btn-primary mt-2">Add More Topic</button>
                </div>

                <!-- Dates -->
                <div class="col-md-6">
                    <label class="form-label">Start Date</label>
                    <input type="date" class="form-control @error('start_date') is-invalid @enderror" name="start_date" value="{{ old('start_date') }}">
                    @error('start_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">End Date</label>
                    <input type="date" class="form-control @error('end_date') is-invalid @enderror" name="end_date" value="{{ old('end_date') }}">
                    @error('end_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Featured + Status -->
                <div class="col-md-4">
                    <label class="form-label">Is Featured?</label>
                    <select name="is_featured" class="form-select @error('is_featured') is-invalid @enderror">
                        <option value="0" {{ old('is_featured', 0) == 0 ? 'selected' : '' }}>No</option>
                        <option value="1" {{ old('is_featured') == 1 ? 'selected' : '' }}>Yes</option>
                    </select>
                    @error('is_featured')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4">
                     <div class="mb-3">
                        <label class="form-label">Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-select @error('status') is-invalid @enderror">
                            <option value="">Select</option>
                            <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Enrollment Count</label>
                    <input type="number" class="form-control @error('enrollment_count') is-invalid @enderror" name="enrollment_count" value="{{ old('enrollment_count', 0) }}">
                    @error('enrollment_count')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <div class="card-footer text-end">
                <button type="submit" class="btn btn-success">Create Course</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
let topicIndex = {{ old('topics') ? count(old('topics')) : 1 }};

$('#add-topic').on('click', function () {
    $('#topics-wrapper').append(`
        <div class="row g-2 topic-row mb-2">
            <div class="col-md-5">
                <input type="text" name="topics[${topicIndex}][title]" class="form-control" placeholder="Topic Title">
            </div>
            <div class="col-md-5">
                <input type="text" name="topics[${topicIndex}][description]" class="form-control" placeholder="Topic Description">
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger remove-topic w-100">Remove</button>
            </div>
        </div>
    `);
    topicIndex++;
});

$(document).on('click', '.remove-topic', function () {
    $(this).closest('.topic-row').remove();
});
</script>
    <script>
        $(document).ready(function() {
            $('#long_description').summernote({
                height: 200,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'picture']],
                    ['view', ['fullscreen', 'codeview']]
                ],
                placeholder: 'Write your project description here (max 60 words)...'
            });
        });
    </script>
@endpush
