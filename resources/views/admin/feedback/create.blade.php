@extends('layouts.admin.app')
@section('content')
    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4 class="fw-bold">Create Survey</h4>
                <h6>Submit a new project survey</h6>
            </div>
        </div>
        <div class="page-btn mt-0">
            <a href="{{ route('admin.feedback.index') }}" class="btn btn-secondary">
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
            <strong>Please fix the following errors:</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="{{ route('admin.feedback.store') }}" method="POST" id="surveyBatchForm">
        @csrf
        <div class="card mb-4">
            <div class="card-header bg-white border-bottom">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Select Project <span class="text-danger">*</span></label>
                        <select name="project_id" id="project_id_select" class="form-select @error('project_id') is-invalid @enderror" onchange="reloadForProject(this.value)">
                            <option value="">Choose a project...</option>
                            @foreach($projects as $project)
                                <option value="{{ $project->id }}" {{ (old('project_id', $selectedProjectId) == $project->id) ? 'selected' : '' }}>
                                    {{ $project->project_code }} - {{ $project->title }}
                                </option>
                            @endforeach
                        </select>
                        @error('project_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 text-end pt-4">
                        <button type="button" class="btn btn-success" onclick="addSurveyCard()">
                            <i class="feather feather-plus-circle me-2"></i>Add Survey Response
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div id="surveyCardsContainer">
            @php
                $surveys = old('surveys', (count($existingSurveys) > 0 ? $existingSurveys->toArray() : []));
            @endphp

            @forelse($surveys as $index => $survey)
                @include('admin.survey.partials.card', ['index' => $index, 'survey' => $survey])
            @empty
                <div class="text-center py-5 bg-white border rounded mb-4 empty-state">
                    <i class="feather feather-file-text display-4 text-muted mb-3 d-block"></i>
                    <h5>No responses added yet</h5>
                    <p class="text-muted">Click the "Add Survey Response" button to start.</p>
                </div>
            @endforelse
        </div>

        <div class="card fixed-footer-card">
            <div class="card-body py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-muted">
                        Total Responses: <span id="total_responses_count">{{ count($surveys) }}</span>
                    </div>
                    <div>
                        <a href="{{ route('admin.feedback.index') }}" class="btn btn-light me-2">Cancel</a>
                        <button type="submit" class="btn btn-primary px-5">Save All Surveys</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    {{-- Template for new cards --}}
    <template id="surveyCardTemplate">
        @include('admin.feedback.partials.card', ['index' => 'INDEX_PLACEHOLDER', 'survey' => []])
    </template>

    @push('styles')
    <style>
        .survey-card {
            border-left: 4px solid #0d6efd !important;
            transition: all 0.2s ease;
        }
        .survey-card:hover {
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .remove-card-btn {
            opacity: 0.5;
            transition: opacity 0.2s;
        }
        .remove-card-btn:hover {
            opacity: 1;
        }
    </style>
    @endpush

    @push('scripts')
    <script>
        let cardCount = {{ count($surveys) }};

        function reloadForProject(projectId) {
            if (projectId) {
                window.location.href = `{{ route('admin.feedback.create') }}?project_id=${projectId}`;
            }
        }

        function addSurveyCard() {
            const container = document.getElementById('surveyCardsContainer');
            const template = document.getElementById('surveyCardTemplate').innerHTML;
            
            // Remove empty state if exists
            const emptyState = container.querySelector('.empty-state');
            if (emptyState) emptyState.remove();

            const newIndex = cardCount++;
            const newHtml = template.replace(/INDEX_PLACEHOLDER/g, newIndex);
            
            container.insertAdjacentHTML('beforeend', newHtml);
            updateTotalCount();
            
            // Scroll to the new card
            const newCard = container.lastElementChild;
            newCard.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }

        function removeCard(btn) {
            if (confirm('Are you sure you want to remove this survey response?')) {
                const card = btn.closest('.survey-card');
                card.classList.add('fade-out');
                setTimeout(() => {
                    card.remove();
                    updateTotalCount();
                    
                    const container = document.getElementById('surveyCardsContainer');
                    if (container.children.length === 0) {
                        container.innerHTML = `
                            <div class="text-center py-5 bg-white border rounded mb-4 empty-state">
                                <i class="feather feather-file-text display-4 text-muted mb-3 d-block"></i>
                                <h5>No responses added yet</h5>
                                <p class="text-muted">Click the "Add Survey Response" button to start.</p>
                            </div>
                        `;
                    }
                }, 200);
            }
        }

        function updateTotalCount() {
            const container = document.getElementById('surveyCardsContainer');
            const count = container.querySelectorAll('.survey-card').length;
            document.getElementById('total_responses_count').textContent = count;
        }
    </script>
    @endpush
@endsection
