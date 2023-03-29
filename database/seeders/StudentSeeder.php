<?php

namespace Database\Seeders;

use App\Models\Student;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Support\Arr;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Schema::disableForeignKeyConstraints();
        // Student::truncate();
        // Schema::enableForeignKeyConstraints();

        // Manual
        // $data = [
        //     [
        //         'name' => "Aiu",
        //         'gender' => "P",
        //         'nis' => "1001001",
        //         'class_id' => 1,
        //     ],
        //     [
        //         'name' => "Budi",
        //         'gender' => "L",
        //         'nis' => "1001002",
        //         'class_id' => 2,
        //     ],
        //     [
        //         'name' => "Siti",
        //         'gender' => "P",
        //         'nis' => "1001003",
        //         'class_id' => 3,
        //     ],
        //     [
        //         'name' => "Tono",
        //         'gender' => "L",
        //         'nis' => "1001004",
        //         'class_id' => 2,
        //     ],
        // ];

        // foreach ($data as $val) {
        //     Student::insert([
        //         'name' => $val['name'],
        //         'gender' => $val['gender'],
        //         'nis' => $val['nis'],
        //         'class_id' => $val['class_id'],
        //         'created_at' => Carbon::now(),
        //         'updated_at' => Carbon::now(),
        //     ]);
        // }

        // Pakai Factory
        // Student::factory()->count(5000)->create();

        $faker = Faker::create('id_ID');
        for ($i = 0; $i < 10000; $i++) {
            $data[] = [
                'name' => $faker->name(),
                'gender' => Arr::random(['L', 'P']),
                'nis' => mt_rand(0000001, 9999999),
                'class_id' => Arr::random([1, 2, 3, 4]),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        foreach (array_chunk($data, 10000) as $item) {
            Student::insert($item);
        }
    }
}
