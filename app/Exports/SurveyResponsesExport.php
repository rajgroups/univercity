<?php

namespace App\Exports;

use App\Models\SurveyResponse;
use App\Models\Survey;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SurveyResponsesExport implements FromCollection, WithHeadings, WithMapping
{
    protected $surveyId;
    protected $survey;

    public function __construct($surveyId)
    {
        $this->surveyId = $surveyId;
        $this->survey = Survey::with('questions')->findOrFail($surveyId);
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return SurveyResponse::with('user')->where('survey_id', $this->surveyId)->get();
    }

    public function headings(): array
    {
        $headings = [
            'ID',
            'Name',
            'Email',
            'Mobile',
            'Location',
            'IP Address',
        ];

        foreach ($this->survey->questions as $question) {
            $headings[] = $question->question_text;
        }

        $headings[] = 'Submitted At';

        return $headings;
    }

    public function map($response): array
    {
        $row = [
            $response->id,
            $response->name ?? ($response->user ? $response->user->name : 'Anonymous'),
            $response->email ?? ($response->user ? $response->user->email : '-'),
            $response->mobile ?? '-',
            $response->location ?? '-',
            $response->ip_address ?? '-',
        ];

        $answers = is_string($response->answers) ? json_decode($response->answers, true) : $response->answers;

        foreach ($this->survey->questions as $question) {
            $answer = $answers[$question->id] ?? '-';
            if (is_array($answer)) {
                $answer = implode(', ', $answer);
            }
            $row[] = $answer;
        }

        $row[] = $response->created_at->format('Y-m-d H:i:s');

        return $row;
    }
}
