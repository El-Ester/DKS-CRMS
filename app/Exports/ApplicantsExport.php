<?php

namespace App\Exports;

use App\Models\JobApplication;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ApplicantsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return JobApplication::with('candidate')->get()->map(function ($application) {
            return [
                'Applicant Name' => $application->candidate->name,
                'Application Date' => $application->created_at->format('Y-m-d H:i'),
                'Status' => ucfirst($application->application_status),
            ];
        });
    }

    public function headings(): array
    {
        return ['Applicant Name', 'Application Date', 'Status'];
    }
}

