<?php

use Illuminate\Database\Seeder;
use App\UpskillCategory;

class UpskillCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['name' => 'Upskill', 'semester_id' => 1, 'description' => 'Kelas upskilling untuk pengembangan karir'],
            ['name' => 'Brainlabs', 'semester_id' => 1, 'description' => 'Kelas brainlabs untuk praktik langsung'],
        ];

        foreach ($categories as $category) {
            UpskillCategory::create($category);
        }
    }
}
