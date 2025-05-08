<?php

namespace Tests\Feature;

use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class StudentAuthTest extends TestCase
{
    public function test_student_can_login_with_correct_credentials()
    {
        // Pastikan data sudah ada di database dari Seeder
        $student = Student::where('email', 'everald@gmail.com')->first();

        // Jika belum ada, buat manual (tanpa refresh database, ini tidak akan menghapus data sebelumnya)
        if (!$student) {
            $student = Student::create([
                'name' => 'Everald',
                'activity_id' => '9063408',
                'nim' => '1204210097',
                'email' => 'everald@gmail.com',
                'password' => Hash::make('12345678'),
                'phone' => '08164867329',
                'university' => 'Telkom University Surabaya',
                'gender' => 'Laki-laki',
                'placement' => 'Sukolilo, Surabaya',
                'photo' => null,
                'department_id' => 1,
                'position_id' => 1,
                'mentor_id' => 2,
            ]);
        }

        // Simulasikan login
        $response = $this->post('/processlogin', [
            'email' => 'everald@gmail.com',
            'password' => '12345678',
        ]);

        // Cek apakah diarahkan ke dashboard
        $response->assertRedirect('/dashboard');
        $this->assertAuthenticatedAs($student, 'student');
    }

    public function test_student_login_fails_with_invalid_credentials()
    {
        $response = $this->post('/processlogin', [
            'email' => 'wrong@example.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertRedirect('/');
        $response->assertSessionHas('warning');
        $this->assertGuest('student');
    }
}
