<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Department;
use App\Models\Mentor;
use App\Models\Position;
use App\Models\Student;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class StudentAdminTest extends TestCase
{
    use WithoutMiddleware; // Hilangkan middleware untuk testing langsung
    use DatabaseTransactions; // Testing tidak mengubah database permanen

    protected function actingAsAdmin()
    {
        $user = User::where('role', 'user')->first();
        return $this->actingAs($user);
    }

    // public function test_admin_can_view_student_page()
    // {
    //     $response = $this->actingAsAdmin()->get('/student');
    //     $response->assertStatus(200);
    // }

    public function test_admin_can_create_new_student()
    {
        Storage::fake('public');

        $department = Department::first();
        $mentor = Mentor::first();
        $position = Position::first();

        $photo = UploadedFile::fake()->image('student.jpg');

        $data = [
            'name' => 'Test Student',
            'activity_id' => 'ACT123456',
            'nim' => 'NIM123456',
            'email' => 'studenttest@example.com',
            'phone' => '081234567890',
            'university' => 'Universitas Testing',
            'gender' => 'Laki-laki',
            'placement' => 'Jl. Contoh No. 1',
            'photo' => $photo,
            'department_id' => $department->id,
            'position_id' => $position->id,
            'mentor_id' => $mentor->id,
        ];

        $response = $this->actingAsAdmin()->post('/student/store', $data);
        $response->assertRedirect(); // pastikan redirect berhasil
    }

    public function test_admin_can_edit_student()
    {
        $student = Student::first();
        $response = $this->actingAsAdmin()->post('/student/edit', ['idmhs' => $student->id]);
        $response->assertStatus(200);
    }

    public function test_admin_can_update_student()
    {
        $student = Student::first();

        $data = [
            'id' => $student->id,
            'name' => 'Updated Name',
            'activity_id' => $student->activity_id,
            'email' => $student->email,
            'phone' => $student->phone,
            'university' => $student->university,
            'gender' => $student->gender,
            'placement' => $student->placement,
            'old_photo' => $student->photo,
            'department_id' => $student->department_id,
            'position_id' => $student->position_id,
            'mentor_id' => $student->mentor_id,
        ];

        $response = $this->actingAsAdmin()->post("/student/{$student->id}/update", $data);
        $response->assertRedirect();
    }

    // public function test_admin_can_delete_student()
    // {
    //     $student = Student::factory()->create(); // gunakan factory agar tidak ganggu data asli
    //     $response = $this->actingAsAdmin()->post("/student/{$student->id}/delete");
    //     $response->assertRedirect();
    // }
}
