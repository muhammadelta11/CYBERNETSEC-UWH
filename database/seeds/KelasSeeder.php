<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Sample classes data
        $kelasData = [
            [
                'name_kelas' => 'Introduction to Web Development',
                'description_kelas' => 'Pelajari dasar-dasar pengembangan web mulai dari HTML, CSS, hingga JavaScript. Kursus ini cocok untuk pemula yang ingin memulai karir di bidang web development.',
                'thumbnail' => 'storage/thumbnails/web-dev-intro.jpg',
                'type_kelas' => 0, // Gratis
                'harga' => 0,
                'modul' => 8,
                'modul_file' => 'storage/moduls/web-dev-intro.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_kelas' => 'Advanced React Development',
                'description_kelas' => 'Kuasai React.js dengan teknik-teknik advanced seperti Hooks, Context API, dan performance optimization. Cocok untuk developer yang sudah memiliki pengalaman dasar.',
                'thumbnail' => 'storage/thumbnails/react-advanced.jpg',
                'type_kelas' => 1, // Regular
                'harga' => 150000,
                'modul' => 12,
                'modul_file' => 'storage/moduls/react-advanced.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_kelas' => 'Python for Data Science',
                'description_kelas' => 'Pelajari Python untuk analisis data, machine learning, dan visualisasi data menggunakan library seperti Pandas, NumPy, dan Matplotlib.',
                'thumbnail' => 'storage/thumbnails/python-data-science.jpg',
                'type_kelas' => 2, // Premium
                'harga' => 300000,
                'modul' => 15,
                'modul_file' => 'storage/moduls/python-data-science.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_kelas' => 'UI/UX Design Fundamentals',
                'description_kelas' => 'Pelajari prinsip-prinsip desain interface dan user experience. Kursus ini mencakup wireframing, prototyping, dan design thinking.',
                'thumbnail' => 'storage/thumbnails/ui-ux-fundamentals.jpg',
                'type_kelas' => 1, // Regular
                'harga' => 200000,
                'modul' => 10,
                'modul_file' => 'storage/moduls/ui-ux-fundamentals.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_kelas' => 'Mobile App Development with Flutter',
                'description_kelas' => 'Bangun aplikasi mobile cross-platform menggunakan Flutter dan Dart. Pelajari dari dasar hingga membuat aplikasi yang siap dipublish.',
                'thumbnail' => 'storage/thumbnails/flutter-mobile.jpg',
                'type_kelas' => 2, // Premium
                'harga' => 350000,
                'modul' => 18,
                'modul_file' => 'storage/moduls/flutter-mobile.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_kelas' => 'Digital Marketing Strategy',
                'description_kelas' => 'Pelajari strategi pemasaran digital yang efektif, mulai dari SEO, social media marketing, hingga email marketing dan analytics.',
                'thumbnail' => 'storage/thumbnails/digital-marketing.jpg',
                'type_kelas' => 1, // Regular
                'harga' => 180000,
                'modul' => 9,
                'modul_file' => 'storage/moduls/digital-marketing.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_kelas' => 'Cybersecurity Basics',
                'description_kelas' => 'Pahami dasar-dasar keamanan siber, termasuk ethical hacking, network security, dan best practices untuk melindungi data.',
                'thumbnail' => 'storage/thumbnails/cybersecurity-basics.jpg',
                'type_kelas' => 0, // Gratis
                'harga' => 0,
                'modul' => 6,
                'modul_file' => 'storage/moduls/cybersecurity-basics.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_kelas' => 'Cloud Computing with AWS',
                'description_kelas' => 'Pelajari layanan cloud computing Amazon Web Services (AWS), termasuk EC2, S3, Lambda, dan arsitektur cloud yang scalable.',
                'thumbnail' => 'storage/thumbnails/aws-cloud.jpg',
                'type_kelas' => 2, // Premium
                'harga' => 400000,
                'modul' => 20,
                'modul_file' => 'storage/moduls/aws-cloud.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_kelas' => 'Business Intelligence & Analytics',
                'description_kelas' => 'Kuasai tools dan teknik business intelligence untuk mengubah data menjadi insights yang actionable menggunakan Power BI dan Tableau.',
                'thumbnail' => 'storage/thumbnails/bi-analytics.jpg',
                'type_kelas' => 2, // Premium
                'harga' => 320000,
                'modul' => 16,
                'modul_file' => 'storage/moduls/bi-analytics.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_kelas' => 'DevOps Fundamentals',
                'description_kelas' => 'Pelajari praktik DevOps termasuk CI/CD, containerization dengan Docker, dan orchestration dengan Kubernetes.',
                'thumbnail' => 'storage/thumbnails/devops-fundamentals.jpg',
                'type_kelas' => 1, // Regular
                'harga' => 250000,
                'modul' => 14,
                'modul_file' => 'storage/moduls/devops-fundamentals.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_kelas' => 'Machine Learning with Python',
                'description_kelas' => 'Implementasikan algoritma machine learning menggunakan scikit-learn, TensorFlow, dan PyTorch untuk berbagai kasus penggunaan.',
                'thumbnail' => 'storage/thumbnails/ml-python.jpg',
                'type_kelas' => 2, // Premium
                'harga' => 450000,
                'modul' => 22,
                'modul_file' => 'storage/moduls/ml-python.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_kelas' => 'iOS App Development with Swift',
                'description_kelas' => 'Bangun aplikasi iOS native menggunakan Swift dan SwiftUI. Pelajari dari interface design hingga App Store submission.',
                'thumbnail' => 'storage/thumbnails/ios-swift.jpg',
                'type_kelas' => 2, // Premium
                'harga' => 380000,
                'modul' => 19,
                'modul_file' => 'storage/moduls/ios-swift.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_kelas' => 'Database Design & Management',
                'description_kelas' => 'Pelajari desain database relational dan NoSQL, query optimization, dan database administration untuk berbagai DBMS.',
                'thumbnail' => 'storage/thumbnails/database-design.jpg',
                'type_kelas' => 1, // Regular
                'harga' => 220000,
                'modul' => 11,
                'modul_file' => 'storage/moduls/database-design.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_kelas' => 'Blockchain Technology',
                'description_kelas' => 'Pahami teknologi blockchain, smart contracts, dan cryptocurrency. Pelajari pengembangan decentralized applications (DApps).',
                'thumbnail' => 'storage/thumbnails/blockchain-tech.jpg',
                'type_kelas' => 1, // Regular
                'harga' => 280000,
                'modul' => 13,
                'modul_file' => 'storage/moduls/blockchain-tech.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_kelas' => 'Game Development with Unity',
                'description_kelas' => 'Buat game 2D dan 3D menggunakan Unity engine. Pelajari C# programming, physics, dan game design principles.',
                'thumbnail' => 'storage/thumbnails/unity-game-dev.jpg',
                'type_kelas' => 2, // Premium
                'harga' => 420000,
                'modul' => 21,
                'modul_file' => 'storage/moduls/unity-game-dev.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_kelas' => 'Project Management Professional',
                'description_kelas' => 'Pelajari metodologi project management seperti Agile, Scrum, dan PMP framework untuk mengelola proyek IT secara efektif.',
                'thumbnail' => 'storage/thumbnails/project-management.jpg',
                'type_kelas' => 1, // Regular
                'harga' => 190000,
                'modul' => 10,
                'modul_file' => 'storage/moduls/project-management.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_kelas' => 'Artificial Intelligence Ethics',
                'description_kelas' => 'Bahas isu-isu etika dalam pengembangan AI, bias dalam algoritma, dan dampak sosial teknologi AI terhadap masyarakat.',
                'thumbnail' => 'storage/thumbnails/ai-ethics.jpg',
                'type_kelas' => 0, // Gratis
                'harga' => 0,
                'modul' => 7,
                'modul_file' => 'storage/moduls/ai-ethics.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_kelas' => 'Full Stack Web Development Bootcamp',
                'description_kelas' => 'Program intensif pengembangan web full stack dari frontend hingga backend, termasuk deployment dan production-ready applications.',
                'thumbnail' => 'storage/thumbnails/fullstack-bootcamp.jpg',
                'type_kelas' => 3, // Program Upskill
                'harga' => 500000,
                'modul' => 25,
                'modul_file' => 'storage/moduls/fullstack-bootcamp.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_kelas' => 'Internet of Things (IoT) Development',
                'description_kelas' => 'Pelajari pengembangan IoT menggunakan Arduino, Raspberry Pi, dan platform cloud IoT untuk membuat smart devices.',
                'thumbnail' => 'storage/thumbnails/iot-development.jpg',
                'type_kelas' => 2, // Premium
                'harga' => 360000,
                'modul' => 17,
                'modul_file' => 'storage/moduls/iot-development.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_kelas' => 'Agile Software Development',
                'description_kelas' => 'Implementasikan metodologi Agile dalam pengembangan software, termasuk Scrum, Kanban, dan continuous improvement practices.',
                'thumbnail' => 'storage/thumbnails/agile-development.jpg',
                'type_kelas' => 1, // Regular
                'harga' => 160000,
                'modul' => 8,
                'modul_file' => 'storage/moduls/agile-development.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insert data into kelas table
        DB::table('kelas')->insert($kelasData);
    }
}
