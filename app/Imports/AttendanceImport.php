<?php

namespace App\Imports;

use App\Models\Attendance;
use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class AttendanceImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        //  dd(array_keys($row));
        // Ambil activity_id dari kolom Excel 'ID Activity'
        $activityId = $row['id_activity'];

        // Cari student berdasarkan activity_id
        $student = Student::where('activity_id', $activityId)->first();

        // Jika tidak ditemukan, abaikan baris ini
        if (!$student) {
            return null;
        }

        return new Attendance([
            'student_id'   => $student->id,
            'date'         => $this->parseExcelDate($row['tanggal']),
            'time_in'      => $this->parseTime($row['jam_masuk']),
            'time_out'     => $this->parseTime($row['jam_pulang']),
            'photo_in'     => $row['foto_masuk'],
            'photo_out'    => $row['foto_pulang'],
            'location_in'  => $row['lokasi_masuk'],
            'location_out' => $row['lokasi_pulang'],
        ]);
    }

    private function parseExcelDate($excelDate)
    {
        try {
            return Date::excelToDateTimeObject($excelDate)->format('Y-m-d');
        } catch (\Exception $e) {
            return null;
        }
    }

    private function parseTime($timeString)
    {
        try {
            return date('H:i:s', strtotime($timeString));
        } catch (\Exception $e) {
            return null;
        }
    }
}
