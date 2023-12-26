<?php

namespace Database\Factories;

use App\Models\Resume;
use Illuminate\Database\Eloquent\Factories\Factory;

class WorkFactory extends Factory
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
            'employer' => $this->faker->word(),
            'position' => $this->faker->word(),
            'type' => $this->faker->word(),
            'from' => $this->faker->numberBetween(1970, 2023),
            'to' => $this->faker->numberBetween($from, 2023),
            'description' => $this->faker->sentences(rand(1, 4), true),
        ];
    }
}
