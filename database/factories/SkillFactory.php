<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Skill>
 */
class SkillFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'years_of_experience' => $this->faker->numberBetween(0, 10),
            'rating' => $this->faker->domainWord(),
            'employee_id' => function() {
                return Employee::factory()->create()->id;
            },
        ];
    }
}
