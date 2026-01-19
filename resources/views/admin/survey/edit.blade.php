@extends('layouts.admin.app')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Edit Survey: {{ $project->title }}</h3>
            </div>
            <div class="col-auto">
                 <a href="{{ route('admin.survey.index', $project->id) }}" class="btn btn-secondary">
                    <i class="feather feather-arrow-left me-2"></i> Back to List
                </a>
            </div>
        </div>
    </div>
    <!-- /Page Header -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form id="surveyForm" action="{{ route('admin.survey.update', ['project_id' => $project->id, 'id' => $survey->id]) }}" method="POST">
                        @csrf
                        {{-- Use POST for update as per route definition, but good practice is PUT/PATCH if defined that way. 
                             My route is POST: Route::post('/scrutiny/{project_id}/survey/{id}/update' ... --}}
                        
                        <!-- Survey Basic Info -->
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Survey Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="title"
                                            value="{{ $survey->title }}"
                                            placeholder="Enter survey title" required>
                                </div>
                            </div>
                            <div class="col-md-12 mt-3">
                                <div class="form-group">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control" name="description"
                                                rows="3" placeholder="Enter survey description">{{ $survey->description }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Questions Section -->
                        <div class="card mb-4">
                            <div class="card-header bg-light">
                                <h5 class="card-title mb-0">
                                    <i class="bi bi-question-circle"></i> Survey Questions
                                </h5>
                            </div>
                            <div class="card-body">
                                <div id="questionsContainer">
                                    <!-- Questions will be added here dynamically -->
                                    {{-- Server-side loop to populate existing questions --}}
                                    @foreach($survey->questions as $index => $question)
                                        <div class="question-item card mb-3">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <label class="form-label">Question Text <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control question-text"
                                                                    name="questions[{{ $index }}][text]" 
                                                                    value="{{ $question->question_text }}"
                                                                    placeholder="Enter your question" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="form-label">Question Type <span class="text-danger">*</span></label>
                                                            <select class="form-control question-type"
                                                                    name="questions[{{ $index }}][type]" required>
                                                                @foreach($questionTypes as $key => $label)
                                                                    <option value="{{ $key }}" {{ $question->type == $key ? 'selected' : '' }}>{{ $label }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Options Container (for choice-based questions) -->
                                                <div class="options-container mt-3" style="display: {{ in_array($question->type, ['radio', 'checkbox', 'select']) ? 'block' : 'none' }};">
                                                    <label class="form-label">Options (one per line)</label>
                                                    <textarea class="form-control options-textarea"
                                                                name="questions[{{ $index }}][options]"
                                                                rows="3"
                                                                placeholder="Option 1&#10;Option 2&#10;Option 3">{{ $question->options ? implode("\n", json_decode($question->options, true) ?? []) : '' }}</textarea>
                                                    <small class="text-muted">Enter each option on a new line</small>
                                                </div>

                                                <div class="row mt-3">
                                                    <div class="col-md-6">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                    id="required_{{ $index }}" name="questions[{{ $index }}][required]" value="1" {{ $question->is_required ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="required_{{ $index }}">
                                                                Required Question
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 text-end">
                                                        <button type="button" class="btn btn-danger btn-sm remove-question">
                                                            <i class="bi bi-trash"></i> Remove
                                                        </button>
                                                    </div>
                                                </div>
                                                
                                                {{-- Hidden Order Input (optional, if we want to preserve order) --}}
                                                <input type="hidden" name="questions[{{ $index }}][order]" value="{{ $question->order ?? $index }}">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <button type="button" id="addQuestion" class="btn btn-primary mt-3">
                                    <i class="bi bi-plus-circle"></i> Add Another Question
                                </button>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Update Survey
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Start count from existing number of questions
    let questionCount = {{ $survey->questions->count() }};
    
    // If no questions, start at 0
    if (questionCount === 0) questionCount = 0;

    // Add new question
    $('#addQuestion').click(function() {
        // Find the next available index
        let newIndex = questionCount;
        
        const template = `
        <div class="question-item card mb-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label class="form-label">Question Text <span class="text-danger">*</span></label>
                            <input type="text" class="form-control question-text"
                                   name="questions[${newIndex}][text]" placeholder="Enter your question" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Question Type <span class="text-danger">*</span></label>
                            <select class="form-control question-type"
                                    name="questions[${newIndex}][type]" required>
                                @foreach($questionTypes as $key => $label)
                                    <option value="{{ $key }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="options-container mt-3" style="display: none;">
                    <label class="form-label">Options (one per line)</label>
                    <textarea class="form-control options-textarea"
                              name="questions[${newIndex}][options]"
                              rows="3"
                              placeholder="Option 1&#10;Option 2&#10;Option 3"></textarea>
                    <small class="text-muted">Enter each option on a new line</small>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input"
                                   id="required_${newIndex}" name="questions[${newIndex}][required]" value="1">
                            <label class="form-check-label" for="required_${newIndex}">
                                Required Question
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6 text-end">
                        <button type="button" class="btn btn-danger btn-sm remove-question">
                            <i class="bi bi-trash"></i> Remove
                        </button>
                    </div>
                </div>
            </div>
        </div>`;

        $('#questionsContainer').append(template);
        questionCount++;
    });

    // Remove question
    $(document).on('click', '.remove-question', function() {
        if ($('.question-item').length > 1) {
            $(this).closest('.question-item').remove();
        } else {
            alert('At least one question is required!');
        }
    });

    // Show/hide options based on question type
    $(document).on('change', '.question-type', function() {
        const container = $(this).closest('.question-item').find('.options-container');
        const textarea = container.find('.options-textarea');
        const type = $(this).val();

        // Show options for choice-based questions
        if (['radio', 'checkbox', 'select'].includes(type)) {
            container.slideDown();
            textarea.prop('required', true);
        } else {
            container.slideUp();
            textarea.prop('required', false);
        }
    });

    // Form validation
    $('#surveyForm').submit(function(e) {
        let valid = true;

        // Check if at least one question exists
        if ($('.question-item').length === 0) {
            alert('Please add at least one question!');
            valid = false;
        }

        // Validate each question
        $('.question-item').each(function(index) {
            const questionText = $(this).find('.question-text').val().trim();
            const questionType = $(this).find('.question-type').val();
            const optionsText = $(this).find('.options-textarea').val().trim();

            if (!questionText) {
                alert(`Question #${index + 1} text is required!`);
                valid = false;
                return false;
            }

            if (['radio', 'checkbox', 'select'].includes(questionType) && !optionsText) {
                alert(`Question #${index + 1} requires options!`);
                valid = false;
                return false;
            }
        });

        if (!valid) {
            e.preventDefault();
        }
    });
});
</script>

<style>
.question-item {
    border-left: 4px solid #007bff;
    transition: all 0.3s ease;
}

.question-item:hover {
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.options-container {
    background-color: #f8f9fa;
    padding: 15px;
    border-radius: 5px;
    border: 1px solid #dee2e6;
}
</style>
@endpush
