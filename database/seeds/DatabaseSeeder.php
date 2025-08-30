<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Create default settings if none exist
        if (\App\Setting::count() === 0) {
            \App\Setting::create([
                'about' => '<p>Selamat datang di platform e-learning kami. Platform ini dirancang untuk membantu Anda belajar secara online dengan mudah dan fleksibel. Kami menyediakan berbagai kelas dengan materi yang mudah dipahami dan berbentuk video untuk memaksimalkan pengalaman belajar Anda.</p><p>Dengan fitur-fitur yang lengkap, Anda dapat belajar kapan saja dan di mana saja sesuai dengan jadwal Anda.</p>',
                'harga' => 50000
            ]);
        }
    }
}
