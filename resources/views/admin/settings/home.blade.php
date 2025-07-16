@extends('layouts.admin.app')
@section('content')
    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4 class="fw-bold">Create Project</h4>
                <h6>Create new Project</h6>
            </div>
        </div>
        <ul class="table-top-head">
            <li><a data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Refresh"><i class="ti ti-refresh"></i></a></li>
            <li><a data-bs-toggle="tooltip" data-bs-placement="top" id="collapse-header" aria-label="Collapse"><i class="ti ti-chevron-up"></i></a></li>
        </ul>
        <div class="page-btn mt-0">
            <a href="{{ route('admin.project.index') }}" class="btn btn-secondary">
                <i class="feather feather-arrow-left me-2"></i>Back to Projects
            </a>
        </div>
    </div>
<form action="" method="POST" enctype="multipart/form-data">
    @csrf
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- For individual fields --}}
    <input type="text" class="form-control @error('about_main_title') is-invalid @enderror" name="about_main_title" value="{{ old('about_main_title', $data->about_main_title ?? '') }}">
    @error('about_main_title')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror

    {{-- For array fields, e.g., operate_title[] --}}
    <input type="text" class="form-control @error('operate_title.0') is-invalid @enderror" name="operate_title[]" value="">
    @error('operate_title.0')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    {{-- You'll need to dynamically generate error messages for array fields if you want specific index errors --}}
    <!-- Empowering Section -->
    <div class="card mb-4">
        <div class="card-header fw-bold"><i class="fa fa-user"></i> About Section</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Main Title</label>
                        <input type="text" class="form-control" name="about_main_title" value="{{ old('about_main_title', $data->about_main_title ?? '') }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Sub Title</label>
                        <input type="text" class="form-control" name="about_sub_title" value="{{ old('about_sub_title', $data->about_sub_title ?? '') }}">
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Empowering Title</label>
                <input type="text" class="form-control" name="about_title" value="{{ old('about_title', $data->empowering_title ?? '') }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Empowering Description</label>
                <textarea class="form-control" name="about_description" rows="4">{{ old('about_description', $data->about_description ?? '') }}</textarea>
            </div>
        </div>
    </div>
    <!-- Join Section -->
    <div class="card mb-4">
        <div class="card-header">Operate Section</div>
        <div class="card-body">
            <div class="row">
             <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" class="form-control" name="operate_main_title" value="{{ old('operate_main_title', $data->operate_main_title ?? '') }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Learning Subtitle</label>
                <input type="text" class="form-control" name="operate_sub_title" value="{{ old('operate_sub_title', $data->operate_sub_title ?? '') }}">
            </div>
                <div id="join-section-wrapper">
                    <div class="row join-group">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Join Title</label>
                                <input type="text" class="form-control" name="operate_title[]" value="">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">content</label>
                                <input type="text" class="form-control" name="operate_desc[]" value="">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Image</label>
                                <input type="file" class="form-control" name="operate_icon[]">
                            </div>
                        </div>
                        <div class="col-md-3 d-flex align-items-center">
                            <div class="mt-3">
                                <button type="button" class="btn btn-outline-info add-btn"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Ongoing Section -->
    <div class="card mb-4">
        <div class="card-header">Ongoing Section</div>
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label">Top Small title</label>
                <input type="text" class="form-control" name="on_going_project_title" value="{{ old('on_going_project_title', $data->on_going_project_title ?? '') }}">
            </div>
             <div class="mb-3">
                <label class="form-label">Middle Main Title</label>
                <input type="text" class="form-control" name="on_going_project_main_title" value="{{ old('on_going_project_main_title', $data->on_going_project_main_title ?? '') }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Middle Main sub Title</label>
                <input type="text" class="form-control" name="on_going_project_main_sub_title" value="{{ old('on_going_project_main_sub_title', $data->on_going_project_main_sub_title ?? '') }}">
            </div>
             <div class="mb-3">
                <label class="form-label">Final Title</label>
                <input type="text" class="form-control" name="onging_final_title" value="{{ old('onging_final_title', $data->onging_final_title ?? '') }}">
            </div>
        </div>
    </div>


    <!-- Ongoing Section -->
    <div class="card mb-4">
        <div class="card-header">Upcoming Section</div>
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label">Top Small title</label>
                <input type="text" class="form-control" name="upcoming_project_title" value="{{ old('upcoming_project_title', $data->upcoming_project_title ?? '') }}">
            </div>
             <div class="mb-3">
                <label class="form-label">Middle Main Title</label>
                <input type="text" class="form-control" name="upcoming_project_main_title" value="{{ old('upcoming_project_main_title', $data->upcoming_project_main_title ?? '') }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Middle Main sub Title</label>
                <input type="text" class="form-control" name="upcoming_project_main_sub_title" value="{{ old('upcoming_project_main_sub_title', $data->upcoming_project_main_sub_title ?? '') }}">
            </div>
             <div class="mb-3">
                <label class="form-label">Final Title</label>
                <input type="text" class="form-control" name="upcoming_final_title" value="{{ old('upcoming_final_title', $data->upcoming_final_title ?? '') }}">
            </div>
            <hr>
            <div class="mb-3">
                <label class="form-label">Secodary Title</label>
                <input type="text" class="form-control" name="upcoming_secondary_title" value="{{ old('upcoming_secondary_title', $data->upcoming_secondary_title ?? '') }}">
            </div>
             <div class="mb-3">
                <label class="form-label">Secodary description</label>
                <input type="text" class="form-control" name="upcoming_secondary_desc" value="{{ old('upcoming_secondary_desc', $data->upcoming_secondary_desc ?? '') }}">
            </div>
        </div>
    </div>

     <!-- Ongoing Section -->
    <div class="card mb-4">
        <div class="card-header">Program  Section</div>
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label">Top Small title</label>
                <input type="text" class="form-control" name="program_project_title" value="{{ old('program_project_title', $data->program_project_title ?? '') }}">
            </div>
             <div class="mb-3">
                <label class="form-label">Middle Main Title</label>
                <input type="text" class="form-control" name="program_project_main_title" value="{{ old('program_project_main_title', $data->program_project_main_title ?? '') }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Middle Main sub Title</label>
                <input type="text" class="form-control" name="program_project_main_sub_title" value="{{ old('program_project_main_sub_title', $data->program_project_main_sub_title ?? '') }}">
            </div>
             <div class="mb-3">
                <label class="form-label">Final Title</label>
                <input type="text" class="form-control" name="program_final_title" value="{{ old('program_final_title', $data->program_final_title ?? '') }}">
            </div>
        </div>
    </div>

     <!-- Key Areas of Focus -->
    <div class="card mb-4">
        <div class="card-header">Core Values Section</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Core Title First</label>
                        <input type="text" class="form-control" name="core_title_one" value="{{ old('core_title_one', $data->core_title_one ?? '') }}">
                    </div>
                </div>
                <div class="col-md-6">
                     <div class="mb-3">
                        <label class="form-label">Core Title two</label>
                        <input type="text" class="form-control" name="core_title_two" value="{{ old('core_title_two', $data->core_title_two ?? '') }}">
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Image</label>
               <input type="file" name="core_image" id="core_image" class="form-control">
            </div>
        </div>
    </div>

    <!-- Key Areas of Focus -->
    <div class="card mb-4">
        <div class="card-header">Key Areas of Focus</div>
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label">Focus Main Title</label>
                <input type="text" class="form-control" name="focus_main_title" value="{{ old('focus_main_title', $data->focus_main_title ?? '') }}">
            </div>
            <div id="focus-section-wrapper">
                <div class="row focus-group">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Focus Title</label>
                            <input type="text" class="form-control" name="focus_title[]" value="">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Focus Description</label>
                            <textarea class="form-control" name="focus_description[]" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="col-md-4 d-flex align-items-center">
                        <div class="mt-3">
                            <button type="button" class="btn btn-outline-info add-focus-btn"><i class="fa fa-plus"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Message from Founder -->
    <div class="card mb-4">
        <div class="card-header">Message from Founder</div>
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label">Founder Message</label>
                <textarea class="form-control" name="founder_message" rows="4">{{ old('founder_message', $data->founder_message ?? '') }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Founder Name</label>
                <input type="text" class="form-control" name="founder_name" value="{{ old('founder_name', $data->founder_name ?? '') }}">
            </div>
        </div>
    </div>

    <!-- Future Goals -->
    <div class="card mb-4">
        <div class="card-header">Future Goals</div>
        <div class="card-body">
            <div id="goal-section-wrapper">
                <div class="row goal-group">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Goal Title</label>
                            <input type="text" class="form-control" name="goal_title[]" value="">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Goal Description</label>
                            <textarea class="form-control" name="goal_description[]" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="col-md-4 d-flex align-items-center">
                        <div class="mt-3">
                            <button type="button" class="btn btn-outline-info add-goal-btn"><i class="fa fa-plus"></i></button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

        <!-- International Collaboration -->
    <div class="card mb-4">
        <div class="card-header">International Collaboration</div>
        <div class="card-body">
            <div class="row">
             <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" class="form-control" name="collaboration_main_title" value="{{ old('collaboration_main_title', $data->collaboration_main_title ?? '') }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Subtitle</label>
                <input type="text" class="form-control" name="collaboration_sub_title" value="{{ old('collaboration_sub_title', $data->collaboration_sub_title ?? '') }}">
            </div>
                <div id="collaboration-section-wrapper">
                    <div class="row collaboration mb-2">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Join Title</label>
                                <input type="text" class="form-control" name="collaboration_ques[]" value="">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Content</label>
                                <input type="text" class="form-control" name="collaboration_ans[]" value="">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Image</label>
                                <input type="file" class="form-control" name="collaboration_icon[]">
                            </div>
                        </div>
                        <div class="col-md-3 d-flex align-items-center">
                            <div class="mt-3">
                                <button type="button" class="btn btn-outline-info add-collab-btn"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Submit Button -->
    <div class="text-end">
        <button type="submit" class="btn btn-success">Save Changes</button>
    </div>
</form>

@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        // Add new field group
        $(document).on('click', '.add-btn', function () {
            var wrapper = $('#join-section-wrapper');
            var html = `
            <div class="row join-group mt-2">
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="form-label">Join Title</label>
                        <input type="text" class="form-control" name="operate_title[]" value="">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="form-label">Join Subtitle</label>
                        <input type="text" class="form-control" name="operate_desc[]" value="">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="form-label">Image</label>
                        <input type="file" class="form-control" name="operate_icon[]">
                    </div>
                </div>
                <div class="col-md-3 d-flex align-items-center">
                    <div class="mt-3">
                        <button type="button" class="btn btn-outline-danger remove-btn"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
            </div>`;
            wrapper.append(html);
        });

        // Remove field group
        $(document).on('click', '.remove-btn', function () {
            $(this).closest('.join-group').remove();
        });
    });
</script>
@endpush
@push('scripts')
<script>
$(document).ready(function () {
    // Add focus section
    $(document).on('click', '.add-focus-btn', function () {
        var html = `
        <div class="row focus-group mt-2">
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label">Focus Title</label>
                    <input type="text" class="form-control" name="focus_title[]" value="">
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label">Focus Description</label>
                    <textarea class="form-control" name="focus_description[]" rows="3"></textarea>
                </div>
            </div>
            <div class="col-md-4 d-flex align-items-center">
                <div class="mt-3">
                    <button type="button" class="btn btn-outline-danger remove-focus-btn"><i class="fa fa-minus"></i></button>
                </div>
            </div>
        </div>`;
        $('#focus-section-wrapper').append(html);
    });

    // Remove focus section
    $(document).on('click', '.remove-focus-btn', function () {
        $(this).closest('.focus-group').remove();
    });

    // Add goal section
    $(document).on('click', '.add-goal-btn', function () {
        var html = `
        <div class="row goal-group mt-2">
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label">Goal Title</label>
                    <input type="text" class="form-control" name="goal_title[]" value="">
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label">Goal Description</label>
                    <textarea class="form-control" name="goal_description[]" rows="3"></textarea>
                </div>
            </div>
            <div class="col-md-4 d-flex align-items-center">
                <div class="mt-3">
                    <button type="button" class="btn btn-outline-danger remove-goal-btn"><i class="fa fa-minus"></i></button>
                </div>
            </div>
        </div>`;
        $('#goal-section-wrapper').append(html);
    });

    // Remove goal section
    $(document).on('click', '.remove-goal-btn', function () {
        $(this).closest('.goal-group').remove();
    });
});
</script>
<script>
$(document).ready(function () {
    // Add new collaboration field group
    $(document).on('click', '.add-collab-btn', function () {
        var html = `
        <div class="row collaboration mb-2">
            <div class="col-md-3">
                <div class="mb-3">
                    <label class="form-label">Join Title</label>
                    <input type="text" class="form-control" name="collaboration_ques[]" value="">
                </div>
            </div>
            <div class="col-md-3">
                <div class="mb-3">
                    <label class="form-label">Content</label>
                    <input type="text" class="form-control" name="collaboration_ans[]" value="">
                </div>
            </div>
            <div class="col-md-3">
                <div class="mb-3">
                    <label class="form-label">Image</label>
                    <input type="file" class="form-control" name="collaboration_icon[]">
                </div>
            </div>
            <div class="col-md-3 d-flex align-items-center">
                <div class="mt-3">
                    <button type="button" class="btn btn-outline-danger remove-collab-btn"><i class="fa fa-minus"></i></button>
                </div>
            </div>
        </div>`;
        $('#collaboration-section-wrapper').append(html);
    });

    // Remove collaboration field group
    $(document).on('click', '.remove-collab-btn', function () {
        $(this).closest('.collaboration').remove();
    });
});
</script>
// ... existing scripts ...

<script>
    $(document).ready(function () {
        $('form').on('submit', function (e) {
            let isValid = true;
            let errorMessage = '';

            // --- About Section Validation ---
            if (!$('input[name="about_main_title"]').val().trim()) {
                isValid = false;
                errorMessage += '• About Main Title is required.\n';
            }
            if (!$('textarea[name="about_description"]').val().trim()) {
                isValid = false;
                errorMessage += '• About Description is required.\n';
            }

            // --- Operate Section Validation ---
            if (!$('input[name="operate_main_title"]').val().trim()) {
                isValid = false;
                errorMessage += '• Operate Main Title is required.\n';
            }
            // Validate dynamic Operate sections
            $('.join-group').each(function(index) {
                if (!$(this).find('input[name="operate_title[]"]').val().trim()) {
                    isValid = false;
                    errorMessage += `• Operate Section ${index + 1}: Join Title is required.\n`;
                }
                if (!$(this).find('input[name="operate_desc[]"]').val().trim()) {
                    isValid = false;
                    errorMessage += `• Operate Section ${index + 1}: Content is required.\n`;
                }
                // For file inputs, checking if a new file is selected or if it's an edit and no old file exists
                // This is a basic check; for edit, you'd need logic to see if a file was already uploaded.
                if (!$(this).find('input[name="operate_icon[]"]').val() && !$(this).find('.existing-image').length) {
                    // Assuming you'd have a class 'existing-image' on an img tag if editing
                    // For now, it simply checks if a file input has a value
                    isValid = false;
                    errorMessage += `• Operate Section ${index + 1}: Image is required.\n`;
                }
            });

            // --- Ongoing Section Validation ---
            if (!$('input[name="on_going_project_main_title"]').val().trim()) {
                isValid = false;
                errorMessage += '• Ongoing Middle Main Title is required.\n';
            }

            // --- Upcoming Section Validation ---
            if (!$('input[name="upcoming_project_main_title"]').val().trim()) {
                isValid = false;
                errorMessage += '• Upcoming Middle Main Title is required.\n';
            }
            if (!$('input[name="upcoming_secondary_title"]').val().trim()) {
                isValid = false;
                errorMessage += '• Upcoming Secondary Title is required.\n';
            }

            // --- Program Section Validation ---
            if (!$('input[name="program_project_main_title"]').val().trim()) {
                isValid = false;
                errorMessage += '• Program Middle Main Title is required.\n';
            }

            // --- Core Values Section Validation ---
            if (!$('input[name="core_title_one"]').val().trim()) {
                isValid = false;
                errorMessage += '• Core Title First is required.\n';
            }
            // For core_image, similar logic as operate_icon
            if (!$('input[name="core_image"]').val() && !$('.existing-core-image').length) {
                 isValid = false;
                 errorMessage += '• Core Values Image is required.\n';
            }


            // --- Key Areas of Focus Validation ---
            if (!$('input[name="focus_main_title"]').val().trim()) {
                isValid = false;
                errorMessage += '• Focus Main Title is required.\n';
            }
            $('.focus-group').each(function(index) {
                if (!$(this).find('input[name="focus_title[]"]').val().trim()) {
                    isValid = false;
                    errorMessage += `• Focus Area ${index + 1}: Title is required.\n`;
                }
                if (!$(this).find('textarea[name="focus_description[]"]').val().trim()) {
                    isValid = false;
                    errorMessage += `• Focus Area ${index + 1}: Description is required.\n`;
                }
            });

            // --- Message from Founder Validation ---
            if (!$('textarea[name="founder_message"]').val().trim()) {
                isValid = false;
                errorMessage += '• Founder Message is required.\n';
            }
            if (!$('input[name="founder_name"]').val().trim()) {
                isValid = false;
                errorMessage += '• Founder Name is required.\n';
            }

            // --- Future Goals Validation ---
            $('.goal-group').each(function(index) {
                if (!$(this).find('input[name="goal_title[]"]').val().trim()) {
                    isValid = false;
                    errorMessage += `• Goal ${index + 1}: Title is required.\n`;
                }
                if (!$(this).find('textarea[name="goal_description[]"]').val().trim()) {
                    isValid = false;
                    errorMessage += `• Goal ${index + 1}: Description is required.\n`;
                }
            });

            // --- International Collaboration Validation ---
            if (!$('input[name="collaboration_main_title"]').val().trim()) {
                isValid = false;
                errorMessage += '• Collaboration Main Title is required.\n';
            }
            $('.collaboration').each(function(index) {
                if (!$(this).find('input[name="collaboration_ques[]"]').val().trim()) {
                    isValid = false;
                    errorMessage += `• Collaboration ${index + 1}: Join Title (Question) is required.\n`;
                }
                if (!$(this).find('input[name="collaboration_ans[]"]').val().trim()) {
                    isValid = false;
                    errorMessage += `• Collaboration ${index + 1}: Content (Answer) is required.\n`;
                }
                if (!$(this).find('input[name="collaboration_icon[]"]').val() && !$(this).find('.existing-collab-image').length) {
                    isValid = false;
                    errorMessage += `• Collaboration ${index + 1}: Image is required.\n`;
                }
            });


            if (!isValid) {
                e.preventDefault(); // Stop form submission
                alert('Please correct the following errors:\n\n' + errorMessage);
                // Or display errors in a more user-friendly way (e.g., Bootstrap alerts next to fields)
            }
        });
    });
</script>
@endpush

