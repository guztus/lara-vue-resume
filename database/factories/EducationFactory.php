<?php

namespace Database\Factories;

use App\Models\Resume;
use Illuminate\Database\Eloquent\Factories\Factory;

class EducationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $from = $this->faker->numberBetween(1970, 2023);

        return [
            'resume_id' => Resume::factory(),
            'school' => $this->faker->word(),
            'faculty' => $this->faker->word(),
            'direction' => $this->faker->word(),
            'from' => $this->faker->numberBetween(1970, 2023),
            'to' => $this->faker->numberBetween($from, 2023),
            'level' => $this->faker->word(),
            'description' => $this->faker->sentences(rand(1, 4), true),
        ];
    }
}
