<?php

namespace Database\Factories;

use Faker\Factory as Faker;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

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
    public function definition()
    {
        $faker = Faker::create('id_ID');

        return [
            'name' => $faker->name(),
            'gender' => Arr::random(['L', 'P']),
            'nis' => mt_rand(0000001, 9999999),
            // 'nis' => $faker->numerify('10101####'),
            'class_id' => Arr::random([1, 2, 3, 4]),
        ];
    }
}
