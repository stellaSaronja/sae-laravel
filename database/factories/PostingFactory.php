<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // == https://laravel.com/docs/8.x/database-testing#defining-model-factories

        // == https://github.com/fzaninotto/Faker

        return [

            'title' => $this->faker->unique()->catchPhrase,
            'content' => $this->faker->text,
            'is_published' => $this->faker->boolean(80),
            'like_count' => $this->faker->numberBetween(0, 10000),
            'dislike_count' => $this->faker->numberBetween(0, 20000),
            'created_at' => $this->faker->dateTimeBetween('-3 years', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('2020-04-03', '2022-02-07'),
        ];
    }
}
