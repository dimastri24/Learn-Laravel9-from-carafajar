<?php

namespace Database\Seeders;

use App\Models\ClassRoom;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        ClassRoom::truncate();
        Schema::enableForeignKeyConstraints();

        // $data = [
        //     ['name' => "1A",],
        //     ['name' => "1B",],
        //     ['name' => "1C",],
        //     ['name' => "1D",],
        // ];

        // foreach ($data as $val) {
        //     ClassRoom::insert([
        //         'name' => $val['name'],
        //         'created_at' => Carbon::now(),
        //         'updated_at' => Carbon::now(),
        //     ]);
        // }

        $class1 = ClassRoom::create([
            'name' => '1A',
            'teacher_id' => 1,
        ]);
        $class2 = ClassRoom::create([
            'name' => '2A',
            'teacher_id' => 2,
        ]);
        $class3 = ClassRoom::create([
            'name' => '3A',
            'teacher_id' => 3,
        ]);
        $class4 = ClassRoom::create([
            'name' => '4A',
            'teacher_id' => 4,
        ]);
    }
}
