<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Department;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class DepartmentAdminTest extends TestCase
{
    use WithoutMiddleware; // Hilangkan middleware untuk testing langsung
    use DatabaseTransactions; // Testing tidak mengubah database permanen

    // Fungsi untuk login sebagai admin
    protected function actingAsAdmin()
    {
        $user = User::where('role', 'user')->first(); // Cari admin yang valid
        return $this->actingAs($user); // Login sebagai admin
    }

    /** @test */
    public function admin_can_create_new_department()
    {
        $data = [
            'name' => 'Department of Computer Science',
            'head_department' => 'Dr. John Doe',
        ];

        $response = $this->actingAsAdmin()->post('/department/store', $data);
        $response->assertRedirect(); // Pastikan redirect berhasil setelah data disimpan

        // Pastikan data department ada di database
        $this->assertDatabaseHas('departments', [
            'name' => 'Department of Computer Science',
        ]);
    }

    /** @test */
    public function admin_can_edit_department()
    {
        $department = Department::first(); // Ambil data department yang ada
        $response = $this->actingAsAdmin()->post('/department/edit', ['iddept' => $department->id]);
        $response->assertStatus(200); // Pastikan halaman edit department berhasil dimuat
    }

    /** @test */
    public function admin_can_update_department()
    {
        $department = Department::first(); // Ambil department pertama

        $data = [
            'id' => $department->id,
            'name' => 'Updated Department Name',
            'head_department' => 'Dr. Jane Doe',
        ];

        $response = $this->actingAsAdmin()->post("/department/{$department->id}/update", $data);
        $response->assertRedirect(); // Pastikan redirect berhasil

        // Verifikasi perubahan data di database
        $this->assertDatabaseHas('departments', [
            'name' => 'Updated Department Name',
        ]);
    }

    /** @test */
    public function admin_can_delete_department()
    {
        // Buat department dummy tanpa student yang terhubung
        $department = \App\Models\Department::factory()->create();

        $user = \App\Models\User::factory()->create(['role' => 'user']);

        $response = $this->actingAs($user)->post("/department/{$department->id}/delete");

        $response->assertRedirect(); // pastikan redirect setelah delete berhasil
        $this->assertDatabaseMissing('departments', ['id' => $department->id]);
    }
}
