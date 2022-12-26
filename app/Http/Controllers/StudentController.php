<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function index()
    {
        // $student = Student::all();
        // return view('student', ['studentList' => $student,]);

        // ===== Collection methods =====

        $nilai = [9, 8, 7, 6, 5, 4, 4, 3, 5, 1, 6, 1, 2, 7, 1, 8];

        // php biasa
        // 1. hitung jumlah nilai
        // 2. hitung brp byk nilai
        // 3. hitung nilai rata"

        // $countNilai = count($nilai);
        // $totalNilai = array_sum($nilai);
        // $nilaiRataRata = $totalNilai / $countNilai;

        // use Collection
        // 1. hitung rata"

        // $nilaiRataRata = collect($nilai)->avg();

        // dd($nilaiRataRata);

        // contains() = cek apakah sebuah array memiliki sesuatu - return boolean
        // $contain = collect($nilai)->contains(10);
        // $contain = collect($nilai)->contains(function ($value) {
        //     return $value < 6;
        // });
        // dd($contain);

        // diff() = compare collection a dan b (case sensitive) - return a yg gk ada di b
        // $restaurantA = ["burger", "pizza", "Swarma", "Taccos", "Burrito", "Sandwich", "Es teh"];
        // $restaurantB = ["sambel kentang", "ikan makarel", "Ayam geprek", "Pizza", "Burrito", "Swarma"];

        // $menuRestoA = collect($restaurantA)->diff($restaurantB);
        // $menuRestoB = collect($restaurantB)->diff($restaurantA);

        // dd($menuRestoB);

        // filter() = kyk filter pada umumnya, argumen nya ya callback - return array hasil filter
        // $filter = collect($nilai)->filter(function ($value) {
        //     return $value > 7;
        // });
        // dd($filter);

        // pluck() = ngambil semua data sesuai key yg kita mau
        // $biodata = [
        //     ['nama' => 'budi', 'umur' => 17,],
        //     ['nama' => 'ani', 'umur' => 16,],
        //     ['nama' => 'siti', 'umur' => 18,],
        //     ['nama' => 'rudi', 'umur' => 20,],
        // ];

        // $pluck = collect($biodata)->pluck('nama')->all();
        // dd($pluck);

        // map() = map ini mirip kyk map yg ada di javascript, kita nge iterate data, terus data nya mau diapain suka" kita
        // $nilaiKaliDua = [];
        // foreach ($nilai as $value) {
        //     array_push($nilaiKaliDua, $value * 2);
        // };

        // $nilaiKaliDua = collect($nilai)->map(function ($value, $key) {
        //     return $value * 2;
        // })->all();

        // dd($nilaiKaliDua);

        // ====== Perbandingan ======

        // query builder
        // $student = DB::table('students')->get();
        // DB::table('students')->insert([
        //     'name' => 'query builder',
        //     'gender' => 'L',
        //     'nis' => '020202020',
        //     'class_id' => 1,
        // ]);
        // DB::table('students')->where('id', 26)->update([
        //     'name' => 'query builder 2',
        //     'nis' => '010101010',
        //     'class_id' => '3',
        // ]);
        // DB::table('students')->where('id', 26)->delete();

        // eloquent
        // $student = Student::all();
        // Student::create([
        //     'name' => 'eloquent',
        //     'gender' => 'P',
        //     'nis' => '020202022',
        //     'class_id' => 2,
        // ]);
        // Student::find(27)->update([
        //     'name' => 'eloquent 2',
        //     'class_id' => 4,
        // ]);
        // Student::find(27)->delete();

        // dd($student);
    }
}
