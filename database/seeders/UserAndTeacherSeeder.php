<?php

namespace Database\Seeders;

use App\Models\Teacher;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserAndTeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_admin = User::create([
            'name' => 'admin',
            'email' => 'admin@email.com',
            'role_id' => 1,
            'password' => '$2y$10$NuH2RwLJ30IEVbdVJyopMeEtcQFUSaeQTfMfbKJwwb2rxt/p.BUOq', // rahasia123 | using bycrypt
        ]);
        $user_teacher = User::create([
            'name' => 'teacher',
            'email' => 'teacher@email.com',
            'role_id' => 2,
            'password' => '$2y$10$NuH2RwLJ30IEVbdVJyopMeEtcQFUSaeQTfMfbKJwwb2rxt/p.BUOq', // rahasia123 | using bycrypt
        ]);
        $user_student = User::create([
            'name' => 'student',
            'email' => 'student@email.com',
            'role_id' => 3,
            'password' => '$2y$10$NuH2RwLJ30IEVbdVJyopMeEtcQFUSaeQTfMfbKJwwb2rxt/p.BUOq', // rahasia123 | using bycrypt
        ]);

        $faker = Factory::create();
        for ($i = 0; $i < 10; $i++) {
            Teacher::create([
                'name' => $faker->name(),
            ]);
        }
    }
}
