@extends('layouts.admin.app')
@section('content')
    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4 class="fw-bold">Survey Responses</h4>
                <h6>{{ $survey->title }} ({{ $project->title }})</h6>
            </div>
        </div>
        <div class="page-btn mt-0">
            <a href="{{ route('admin.survey.index', $project->id) }}" class="btn btn-secondary">
                <i class="feather feather-arrow-left me-2"></i>Back to Surveys
            </a>
        </div>
    </div>

    <!-- Stats -->
    <div class="row mb-4">
        <div class="col-xl-3 col-sm-6">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="avatar-sm bg-soft-primary rounded">
                                <span class="avatar-title bg-primary rounded-circle fs-4">
                                    <i class="feather feather-users text-white"></i>
                                </span>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="text-muted mb-1">Total Responses</h5>
                            <h2 class="mb-0">{{ $survey->responses->count() }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            @if($survey->responses->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 5%">#</th>
                                <th style="width: 20%">User / Respondent</th>
                                @foreach($survey->questions->take(3) as $question)
                                    <th>{{ Str::limit($question->question_text, 30) }}</th>
                                @endforeach
                                <th style="width: 15%">Submitted At</th>
                                <th style="width: 10%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($survey->responses as $response)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if($response->user)
                                                <div class="avatar-sm bg-soft-info rounded-circle me-2 d-flex align-items-center justify-content-center">
                                                    <span class="text-info fw-bold">{{ substr($response->user->name, 0, 1) }}</span>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">{{ $response->user->name }}</h6>
                                                    <small class="text-muted">{{ $response->user->email }}</small>
                                                </div>
                                            @else
                                                <div class="avatar-sm bg-soft-secondary rounded-circle me-2 d-flex align-items-center justify-content-center">
                                                    <i class="feather feather-user text-secondary"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">Anonymous</h6>
                                                    <small class="text-muted">{{ $response->ip_address ?? 'N/A' }}</small>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    
                                    @foreach($survey->questions->take(3) as $question)
                                        <td>
                                            @php
                                                $answers = is_string($response->answers) ? json_decode($response->answers, true) : $response->answers;
                                                $answer = $answers[$question->id] ?? '-';
                                                if(is_array($answer)) {
                                                    $answer = implode(', ', $answer);
                                                }
                                            @endphp
                                            <span class="text-truncate d-inline-block" style="max-width: 200px;" title="{{ $answer }}">
                                                {{ Str::limit($answer, 40) }}
                                            </span>
                                        </td>
                                    @endforeach

                                    <td>
                                        {{ $response->created_at->format('M d, Y h:i A') }}
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#responseModal{{ $response->id }}">
                                            <i class="feather feather-eye"></i> View
                                        </button>
                                    </td>
                                </tr>

                                <!-- View Modal -->
                                <div class="modal fade" id="responseModal{{ $response->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Response Details</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body p-4">
                                                <div class="d-flex align-items-center mb-4 p-3 bg-light rounded-3">
                                                    <div class="me-3">
                                                        <i class="feather feather-user fs-3 text-primary"></i>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-1 fw-bold">{{ $response->user ? $response->user->name : 'Anonymous User' }}</h6>
                                                        <p class="mb-0 text-muted small">
                                                            Submitted on {{ $response->created_at->format('F d, Y \a\t h:i A') }}
                                                        </p>
                                                    </div>
                                                </div>

                                                <h6 class="fw-bold mb-3 border-bottom pb-2">Survey Answers</h6>
                                                
                                                @php
                                                    $answers = is_string($response->answers) ? json_decode($response->answers, true) : $response->answers;
                                                @endphp

                                                <div class="d-flex flex-column gap-4">
                                                    @foreach($survey->questions as $question)
                                                        @php
                                                           $ans = $answers[$question->id] ?? null;
                                                        @endphp
                                                        <div class="question-item">
                                                            <p class="fw-bold mb-2 text-dark">{{ $loop->iteration }}. {{ $question->question_text }}</p>
                                                            <div class="p-3 rounded-3" style="background-color: #f8f9fa; border-left: 4px solid #0d6efd;">
                                                                @if(is_array($ans))
                                                                    <ul class="mb-0 ps-3">
                                                                        @foreach($ans as $a)
                                                                            <li>{{ $a }}</li>
                                                                        @endforeach
                                                                    </ul>
                                                                @elseif($ans)
                                                                    <p class="mb-0 text-secondary">{{ $ans }}</p>
                                                                @else
                                                                    <p class="mb-0 text-muted fst-italic">No answer provided</p>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <img src="https://cdni.iconscout.com/illustration/premium/thumb/empty-state-2130362-1800926.png" alt="No Responses" style="width: 200px; opacity: 0.8;">
                    <h5 class="mt-3 text-muted">No responses yet</h5>
                    <p class="text-muted">Share the survey to start collecting responses.</p>
                </div>
            @endif
        </div>
    </div>
@endsection
