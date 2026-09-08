<?php

namespace App\Imports;

use App\Models\Resident;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class ResidentsImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading
{
    public function model(array $row)
    {
        if (empty($row['first_name']) || empty($row['last_name'])) {
            return null;
        }

        $resident = Resident::where('first_name', trim($row['first_name']))
            ->where('last_name', trim($row['last_name']))
            ->first();

        if ($resident) {
            // Already exists, skip to prevent overwrite
            return null;
        }

        // Handle Date parsing robustly
        $birthday = null;
        if (!empty($row['birthday'])) {
            try {
                if (is_numeric($row['birthday'])) {
                    $birthday = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['birthday'])->format('Y-m-d');
                } else {
                    $birthday = \Carbon\Carbon::parse($row['birthday'])->format('Y-m-d');
                }
            } catch (\Exception $e) {
                // Keep null if failed to parse
            }
        }

        return new Resident([
            'resident_code' => 'RES-' . strtoupper(Str::random(8)),
            'first_name' => trim($row['first_name'] ?? ''),
            'last_name' => trim($row['last_name'] ?? ''),
            'middle_name' => trim($row['middle_name'] ?? ''),
            'suffix' => trim($row['suffix'] ?? ''),
            'birthday' => $birthday,
            'age' => isset($row['age']) ? (int)$row['age'] : 0,
            'birthplace' => trim($row['birthplace'] ?? 'N/A'),
            'gender' => trim($row['gender'] ?? 'Male'),
            'civil_status' => trim($row['civil_status'] ?? 'Single'),
            'contact_number' => trim($row['contact_number'] ?? ''),
            'occupation' => trim($row['occupation'] ?? 'Unemployed'),
            'address' => trim($row['address'] ?? ''),
            'purok' => trim($row['purok'] ?? ''),
            // Boolean flags
            'is_voter' => isset($row['is_voter']) ? filter_var($row['is_voter'], FILTER_VALIDATE_BOOLEAN) : false,
            'is_non_voter' => isset($row['is_non_voter']) ? filter_var($row['is_non_voter'], FILTER_VALIDATE_BOOLEAN) : false,
            'is_pwd' => isset($row['is_pwd']) ? filter_var($row['is_pwd'], FILTER_VALIDATE_BOOLEAN) : false,
            'is_senior' => isset($row['is_senior']) ? filter_var($row['is_senior'], FILTER_VALIDATE_BOOLEAN) : false,
            'is_single_parent' => isset($row['is_single_parent']) ? filter_var($row['is_single_parent'], FILTER_VALIDATE_BOOLEAN) : false,
            'is_student' => isset($row['is_student']) ? filter_var($row['is_student'], FILTER_VALIDATE_BOOLEAN) : false,
            'status' => 'active',
        ]);
    }

    public function batchSize(): int
    {
        return 500;
    }

    public function chunkSize(): int
    {
        return 500;
    }
}
