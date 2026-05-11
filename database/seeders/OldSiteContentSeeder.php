<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\Event;
use App\Models\Category;
use Illuminate\Support\Str;
use Carbon\Carbon;

class OldSiteContentSeeder extends Seeder
{
    public function run()
    {
        // Category for Blog
        $blogCategory = Category::firstOrCreate(['name' => 'Berita', 'type' => 'blog'], ['slug' => 'berita']);

        // Insert Old Blogs
        $blogs = [
            [
                'title' => 'Kursus Komputer Bidang Otomasi Perkantoran',
                'excerpt' => 'Selain layanan bimbingan belajar digital BISOLPIN juga membuka beberapa layanan kursus bagi masyarakat Indonesia khususnya...',
                'content' => '<p>Selain layanan bimbingan belajar digital BISOLPIN juga membuka beberapa layanan kursus bagi masyarakat Indonesia khususnya...</p>',
                'category_id' => $blogCategory->id,
                'author' => 'Admin Bisolpin',
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(10),
            ],
            [
                'title' => 'Bisolpin Menyediakan Layanan Khusus bernama Penasehat Akademik Siswa Oleh Kaka BISOLPIN',
                'excerpt' => '🎓 Penasehat Akademik SiswaMetode One Advisor One StudentOleh Kaka BISOLPIN🎯 MISIMeningkatkan kualitas pendidikan non f...',
                'content' => '<p>🎓 Penasehat Akademik SiswaMetode One Advisor One StudentOleh Kaka BISOLPIN🎯 MISIMeningkatkan kualitas pendidikan non f...</p>',
                'category_id' => $blogCategory->id,
                'author' => 'Admin Bisolpin',
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(5),
            ],
            [
                'title' => 'Kreator Indonesia diperkirakan sumbang 376 miliar dolar AS pada 2030',
                'excerpt' => 'Jakarta (ANTARA) - Kreator konten Indonesia pada 2030 diperkirakan memberikan kontribusi secara ekonomi mencapai 376 mil...',
                'content' => '<p>Jakarta (ANTARA) - Kreator konten Indonesia pada 2030 diperkirakan memberikan kontribusi secara ekonomi mencapai 376 mil...</p>',
                'category_id' => $blogCategory->id,
                'author' => 'Admin Bisolpin',
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(2),
            ]
        ];

        foreach ($blogs as $blog) {
            Article::create(array_merge($blog, ['slug' => Str::slug($blog['title'])]));
        }

        // Insert Old Events
        $events = [
            [
                'title' => 'Workshop Peningkatan Skill Dalam Bidang Komputer Dan Bisnis Digital',
                'description' => '<p>🔥 Kesempatan emas! 🚀Bingung Karena Susah Dapat Kerja Sebab Kurang Skill di Bidang Komputer?&nbsp;Kami Punya Solusinya...</p>',
                'event_date' => Carbon::now()->addDays(10),
                'location' => 'Online',
                'is_published' => true,
            ],
            [
                'title' => 'Workshop Pemanfaatan AI Bagi Guru Dalam Dunia Pendidikan',
                'description' => '<p>Sebagai wujud nyata kepedulian BISOLPIN terhadap dunia pendidikan maka pada tanggal 13 Februari 2026 akan mengadakan Wor...</p>',
                'event_date' => Carbon::now()->addDays(15),
                'location' => 'Online',
                'is_published' => true,
            ],
            [
                'title' => 'BISOLPIN mengadakan Try Out Dan Bimbingan Belajar Gratis',
                'description' => '<p>Dalam rangka menghadapi UTBK seleksi masuk Perguruan Tinggi Negeri (PTN) BISOLPIN mengadakan Try Out dan Bimbingan Belaj...</p>',
                'event_date' => Carbon::now()->addDays(20),
                'location' => 'Online',
                'is_published' => true,
            ],
            [
                'title' => 'Sosialisasi Bisolpin',
                'description' => '<p>Dalam rangka menyerap berbagai masukan dari siswa sebagai pengguna aplikasi bimbingan belajar digital maka sebelum kami...</p>',
                'event_date' => Carbon::now()->addDays(25),
                'location' => 'Online',
                'is_published' => true,
            ]
        ];

        foreach ($events as $event) {
            Event::create(array_merge($event, ['slug' => Str::slug($event['title'])]));
        }
    }
}
