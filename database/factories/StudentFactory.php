<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\Mentor;
use App\Models\Position;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Student::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'activity_id' => $this->faker->unique()->uuid,
            'nim' => $this->faker->unique()->numerify('########'),
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make('password'),
            'phone' => $this->faker->phoneNumber,
            'university' => 'Universitas Testing',
            'gender' => 'Laki-laki',
            'placement' => $this->faker->address,
            'photo' => null,
            'department_id' => Department::factory(), // atau isi dengan ID yg ada
            'position_id' => Position::factory(),
            'mentor_id' => Mentor::factory(),
        ];
    }
}
