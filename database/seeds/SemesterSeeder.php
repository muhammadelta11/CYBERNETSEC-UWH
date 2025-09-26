<?php

use Illuminate\Database\Seeder;
use App\Semester;

class SemesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $semesters = [
            ['name' => 'Semester 1', 'description' => 'Semester pertama'],
            ['name' => 'Semester 2', 'description' => 'Semester kedua'],
            ['name' => 'Semester 3', 'description' => 'Semester ketiga'],
            ['name' => 'Semester 4', 'description' => 'Semester keempat'],
            ['name' => 'Semester 5', 'description' => 'Semester kelima'],
            ['name' => 'Semester 6', 'description' => 'Semester keenam'],
            ['name' => 'Semester 7', 'description' => 'Semester ketujuh'],
            ['name' => 'Semester 8', 'description' => 'Semester kedelapan'],
        ];

        foreach ($semesters as $semester) {
            Semester::create($semester);
        }
    }
}
