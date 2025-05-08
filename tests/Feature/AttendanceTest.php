<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Storage;
use App\Models\Student;
use Tests\TestCase;

class AttendanceTest extends TestCase
{
    public function test_student_can_submit_attendance()
    {
        // Simulasi penyimpanan file testing dengan disk public
        Storage::fake('public');

        // Buat student dummy
        $student = Student::factory()->create();

        // Simulasi login student dengan guard student
        $this->actingAs($student, 'student');

        // Buat dummy base64 image
        $imagePath = base_path('tests/testfiles/dummy.png');
        $base64 = 'data:image/jpeg;base64,' . base64_encode(file_get_contents($imagePath));

        // Lokasi di Surabaya
        $lokasi = '-7.2565280548557825,112.7375558738815';

        // Kirim request untuk menyimpan data absensi
        $response = $this->post('/attendance/store', [
            'image' => $base64,
            'lokasi' => $lokasi,
        ]);

        // Pastikan response mengandung "success"
        // $response->assertSee("success");

        // Cek apakah file tersimpan di disk public
        $expectedPath = 'uploads/absensi/' . $student->id . '-' . now()->toDateString() . '-in.png';

        // Pastikan file benar-benar disimpan pada path yang tepat
        Storage::disk('public')->assertExists($expectedPath);
    }
}
