<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Attendance;
use App\Models\Department;
use App\Models\Student;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class AttendanceMonitoringTest extends TestCase
{
    use WithoutMiddleware; // Hilangkan middleware untuk testing langsung
    use DatabaseTransactions; // Testing tidak mengubah database permanen

    protected function actingAsAdmin()
    {
        // Pastikan Anda memiliki admin yang login untuk tes ini
        $user = User::where('role', 'user')->first();
        return $this->actingAs($user);
    }

    public function admin_can_view_map_for_attendance()
    {
        // Misalnya, kita buat data attendance
        $attendance = Attendance::create([
            'student_id' => 1,  // ID student yang sesuai
            'date' => '2025-05-08',
        ]);

        $response = $this->get(route('attendance.showmap', ['id' => $attendance->id]));

        // Periksa apakah respons statusnya adalah 200
        $response->assertStatus(200);

        // Verifikasi jika ada data attendance yang ditampilkan
        $response->assertSee('John Doe'); // Pastikan data attendance muncul
    }

    // Test untuk mengambil data kehadiran berdasarkan tanggal
    public function test_admin_can_get_attendance_data()
    {
        $response = $this->actingAsAdmin()->post('/getattendance', [
            'tanggal' => '2025-05-08', // Contoh tanggal, ganti sesuai kebutuhan
            '_token' => csrf_token(),
        ]);

        $response->assertStatus(200);
        $response->assertViewHas('attendance');
    }

    // Test untuk melihat lokasi absensi menggunakan Leaflet JS
    // public function test_admin_can_view_attendance_location()
    // {
    //     // Buat data absensi untuk tes
    //     $attendance = Attendance::create([
    //         'student_id' => Student::first()->id,
    //         'date' => '2025-05-08',
    //         'time_in' => '08:00',
    //         'time_out' => '16:00',
    //         'photo_in' => 'photo_in.jpg',
    //         'photo_out' => 'photo_out.jpg',
    //         'location_in' => '10.123456,20.123456', // Contoh lokasi
    //     ]);

    //     $response = $this->actingAsAdmin()->post('/showmap', [
    //         'id' => $attendance->id,
    //         '_token' => csrf_token(),
    //     ]);

    //     $response->assertStatus(200);
    //     $response->assertViewHas('attendance');
    // }
}
