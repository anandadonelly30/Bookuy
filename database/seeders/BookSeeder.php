<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use App\Models\Seller;
use App\Models\Review;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing seeded books/reviews to avoid duplicates
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();
        DB::table('book_category')->truncate();
        Review::truncate();
        Book::truncate();
        Category::truncate();
        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();

        $seller = Seller::first() ?? Seller::create([
            'name' => 'Default Seller',
            'role' => 'Bookuy',
            'avatar' => null,
            'about' => 'Default seller for seeded books.',
        ]);

        $books = [
            [
                'title' => 'Fundamental Manajemen Proses Bisnis',
                'author' => 'Marlon Dumas',
                'price_buy' => 50000,
                'price_rent' => 20000,
                'cover' => 'fundamental-manajemen-proses-bisnis-marlon-dumas-001.jpg',
                'category' => 'Manajemen Proses Bisnis',
                'short_description' => 'Panduan komprehensif memahami konsep dasar manajemen proses bisnis.',
                'full_description' => 'Buku ini adalah panduan komprehensif untuk memahami konsep dasar dalam manajemen proses bisnis. Dikenal sebagai salah satu buku yang paling berpengaruh dalam bidang ini, Marlon Dumas memberikan pembaca pemahaman yang mendalam mengenai bagaimana mengelola proses bisnis secara efektif. Dengan berbagai contoh dan studi kasus, buku ini mengajarkan bagaimana merancang, menganalisis, dan mengoptimalkan proses-proses dalam suatu organisasi untuk meningkatkan efisiensi dan kinerja. Buku ini cocok bagi mahasiswa, praktisi, dan manajer yang ingin mendalami ilmu manajemen proses bisnis secara menyeluruh.',
            ],
            [
                'title' => 'Sistem Enterprise Terintegrasi',
                'author' => 'Mahmoudwafi, Ph.D',
                'price_buy' => 60000,
                'price_rent' => 25000,
                'cover' => 'sistem-enterprise-terintegrasi-mahmoudwafi-phd-002.jpg',
                'category' => 'Sistem Enterprise',
                'short_description' => 'Pendalaman ERP dari dasar hingga lanjut dengan studi kasus nyata.',
                'full_description' => 'Buku ini membahas secara mendalam mengenai Sistem Enterprise Terintegrasi (Enterprise Resource Planning/ERP). Menghadirkan panduan dari dasar hingga tingkat lanjut, buku ini membantu pembaca memahami pentingnya sistem ERP dalam mengelola sumber daya organisasi secara menyeluruh. Dengan teori yang solid dan studi kasus nyata, buku ini sangat berguna bagi para profesional yang terlibat dalam implementasi dan pengelolaan sistem ERP di berbagai sektor industri. Fokus utama buku ini adalah untuk membantu pembaca memahami tantangan dan manfaat dari mengintegrasikan berbagai fungsi bisnis dalam satu sistem terpusat.',
            ],
            [
                'title' => 'Analytics Playbook',
                'author' => 'Kim Taylor',
                'price_buy' => 55000,
                'price_rent' => 22000,
                'cover' => 'analytics-playbook-kim-taylor-003.jpg',
                'category' => 'Analitik Data',
                'short_description' => 'Strategi praktis analisis data untuk keputusan bisnis.',
                'full_description' => 'Buku ini adalah panduan praktis untuk memahami dan mengimplementasikan analisis data dalam bisnis. Kim Taylor memaparkan berbagai strategi dan teknik yang dapat digunakan untuk menganalisis data bisnis guna mendapatkan wawasan yang berguna bagi pengambilan keputusan. Dengan menggunakan pendekatan yang berbasis pada studi kasus dan aplikasi dunia nyata, buku ini membantu para profesional dalam bisnis memahami bagaimana mengumpulkan, menganalisis, dan menginterpretasikan data untuk meningkatkan hasil bisnis. Buku ini cocok bagi siapa saja yang tertarik untuk menguasai analitik data dalam konteks bisnis yang dinamis.',
            ],
            [
                'title' => 'Pengantar Pemrograman',
                'author' => 'Rina Paramita',
                'price_buy' => 45000,
                'price_rent' => 18000,
                'cover' => 'pengantar-pemrograman-rina-paramita-004.jpg',
                'category' => 'Pemrograman',
                'short_description' => 'Panduan dasar konsep dan logika pemrograman untuk pemula.',
                'full_description' => 'Buku ini adalah panduan dasar untuk mempelajari konsep-konsep dasar pemrograman komputer. Ditujukan untuk pemula, buku ini mengajarkan pembaca cara berpikir secara algoritmik dan menerapkan konsep-konsep dasar pemrograman dalam berbagai bahasa pemrograman. Dengan pendekatan yang mudah dipahami dan banyak latihan praktis, buku ini memungkinkan pembaca untuk membangun pondasi yang kuat dalam pemrograman. Buku ini sangat cocok untuk mahasiswa atau siapa saja yang ingin memulai karier di bidang pemrograman dan pengembangan perangkat lunak.',
            ],
        ];

        // Ensure categories table matches our books and attach pivot
        $categoryIds = [];
        foreach (collect($books)->pluck('category')->unique() as $catName) {
            $category = Category::create([
                'name' => $catName,
                'icon' => '📚',
            ]);
            $categoryIds[$catName] = $category->id;
        }

        foreach ($books as $data) {
            $book = Book::create([
                'seller_id' => $seller->id,
                'title' => $data['title'],
                'author' => $data['author'],
                'price_buy' => $data['price_buy'],
                'price_rent' => $data['price_rent'],
                'price' => $data['price_buy'],
                'cover' => $data['cover'],
                'cover_image_url' => 'images/books/' . $data['cover'],
                'short_description' => $data['short_description'],
                'full_description' => $data['full_description'],
                'address' => 'Surabaya',
                'condition' => 'Bekas',
                'category' => $data['category'],
                'pages' => null,
                'rating_average' => 0,
                'rating_count' => 0,
                'is_recommended' => true,
                'popularity_score' => 90,
            ]);

            if (isset($categoryIds[$data['category']])) {
                $book->categories()->sync([$categoryIds[$data['category']]]);
            }

            // Seed unique reviews per book (at least 3)
            $reviewSeeds = [
                'Fundamental Manajemen Proses Bisnis' => [
                    ['reviewer_name' => 'Andi', 'stars' => 5, 'comment' => 'Materi lengkap dan mudah diikuti.'],
                    ['reviewer_name' => 'Bunga', 'stars' => 4, 'comment' => 'Contoh kasusnya membantu memahami konsep.'],
                    ['reviewer_name' => 'Citra', 'stars' => 5, 'comment' => 'Rekomendasi untuk mahasiswa bisnis.'],
                ],
                'Sistem Enterprise Terintegrasi' => [
                    ['reviewer_name' => 'Dimas', 'stars' => 5, 'comment' => 'Bagus untuk memahami implementasi ERP.'],
                    ['reviewer_name' => 'Eka', 'stars' => 4, 'comment' => 'Studi kasusnya relevan dan up to date.'],
                    ['reviewer_name' => 'Fajar', 'stars' => 5, 'comment' => 'Penjelasan teknisnya cukup mendalam.'],
                ],
                'Analytics Playbook' => [
                    ['reviewer_name' => 'Gilang', 'stars' => 4, 'comment' => 'Banyak ide praktis untuk dashboard.'],
                    ['reviewer_name' => 'Hana', 'stars' => 5, 'comment' => 'Strategi analitiknya langsung bisa dipakai.'],
                    ['reviewer_name' => 'Iman', 'stars' => 4, 'comment' => 'Contoh datanya jelas dan ringkas.'],
                ],
                'Pengantar Pemrograman' => [
                    ['reviewer_name' => 'Joko', 'stars' => 5, 'comment' => 'Cocok untuk pemula, bahasanya ringan.'],
                    ['reviewer_name' => 'Kiki', 'stars' => 4, 'comment' => 'Latihan kodingnya membantu sekali.'],
                    ['reviewer_name' => 'Lina', 'stars' => 5, 'comment' => 'Struktur materinya bertahap dan rapi.'],
                ],
            ];

            foreach ($reviewSeeds[$data['title']] ?? [] as $seed) {
                Review::create(array_merge($seed, ['book_id' => $book->id]));
            }
        }
    }
}
