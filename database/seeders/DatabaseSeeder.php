<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use App\Models\ContactMessage;
use App\Models\Product;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedAdmin();
        $this->seedUsers();

        $this->seedCategories();

        // Kosongkan produk sesuai permintaan (tidak ada produk dummy)
        Product::query()->delete();

        $this->seedArticles();
        $this->seedTestimonials();
        $this->seedContactMessages();
    }

    protected function seedAdmin(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@nusadeterminan.co.id'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('password'),
                'role' => User::ROLE_ADMIN,
            ]
        );
    }

    protected function seedUsers(): void
    {
        User::updateOrCreate(
            ['email' => 'user@nusadeterminan.co.id'],
            [
                'name' => 'Konten Editor',
                'password' => Hash::make('password'),
                'role' => User::ROLE_USER,
            ]
        );

        User::updateOrCreate(
            ['email' => config('company.guest_email')],
            [
                'name' => 'Tamu',
                'password' => null,
                'role' => User::ROLE_GUEST,
            ]
        );
    }

    /**
     * @return array<string, Category>
     */
    protected function seedCategories(): array
    {
        $rows = [
            [
                'name' => 'Metal Finishing',
                'slug' => 'metal-finishing',
                'theme' => 'metal',
                'lang_id' => 'Metal Finishing',
                'lang_en' => 'Metal Finishing',
                'description' => 'Solusi kimia untuk perawatan permukaan logam (metal treatment), pelapisan, dan perlindungan anti-karat.',
                'image' => null,
            ],
            [
                'name' => 'Institutional Product',
                'slug' => 'institutional',
                'theme' => 'institutional',
                'lang_id' => 'Institutional Product',
                'lang_en' => 'Institutional Products',
                'description' => 'Produk kebersihan rumah tangga & institusi seperti sabun cuci tangan, sabun lantai, pembersih toilet, pembersih kaca, dan sabun cuci piring.',
                'image' => null,
            ],
            [
                'name' => 'Laundry',
                'slug' => 'laundry',
                'theme' => 'laundry',
                'lang_id' => 'Laundry',
                'lang_en' => 'Laundry',
                'description' => 'Deterjen profesional, pelembut pakaian, dan produk perawatan cucian berkualitas tinggi.',
                'image' => null,
            ],
        ];

        $categories = [];

        foreach ($rows as $row) {
            $categories[$row['slug']] = Category::updateOrCreate(
                ['slug' => $row['slug']],
                $row
            );
        }

        return $categories;
    }

    protected function seedArticles(): void
    {
        $rows = [
            [
                'title' => 'Pentingnya Metal Finishing dalam Industri Modern',
                'slug' => 'choosing-the-right-degreaser-for-metal-finishing',
                'excerpt' => 'Pemilihan produk metal treatment yang tepat berpengaruh langsung pada daya rekat lapisan dan ketahanan karat jangka panjang.',
                'content' => "Persiapan permukaan yang tepat adalah fondasi dari setiap hasil akhir logam yang tahan lama. Dalam artikel ini kami membahas tahapan perawatan permukaan logam terhadap kontaminan umum seperti minyak dan kotoran industri.\n\nKami juga membahas titik kontrol praktis untuk menjaga proses produksi tetap stabil dari waktu ke waktu.",
                'author' => 'Tim Teknis',
                'published_at' => now()->subDays(21),
                'is_published' => true,
            ],
            [
                'title' => 'Tips Menjaga Kebersihan Rumah & Fasilitas dengan Produk Tepat',
                'slug' => 'best-practices-for-hospital-grade-disinfection',
                'excerpt' => 'Penggunaan sabun dan pembersih yang tepat memastikan kebersihan serta higienitas ruangan setiap hari.',
                'content' => "Kebersihan lingkungan rumah dan fasilitas umum sangat bergantung pada pemilihan produk pembersih harian seperti sabun cuci tangan, pembersih lantai, pembersih kaca, dan pembersih toilet.\n\nDengan takaran pemakaian yang tepat, kebersihan tetap optimal sekaligus hemat biaya.",
                'author' => 'Tim Teknis',
                'published_at' => now()->subDays(12),
                'is_published' => true,
            ],
            [
                'title' => 'Cara Merawat Pakaian & Efisiensi Pencucian Laundry',
                'slug' => 'reducing-cost-per-kilogram-in-commercial-laundry',
                'excerpt' => 'Penyesuaian takaran deterjen dan pelembut pakaian dapat menjaga kualitas serat kain sekaligus menghemat biaya.',
                'content' => "Proses pencucian yang efektif membutuhkan keseimbangan antara daya bersih deterjen dan kelembutan pelembut pakaian.\n\nKami membagikan panduan praktis merawat cucian agar tetap bersih, harum, dan serat kain lebih awet.",
                'author' => 'Tim Teknis',
                'published_at' => now()->subDays(4),
                'is_published' => true,
            ],
        ];

        foreach ($rows as $row) {
            Article::updateOrCreate(['slug' => $row['slug']], $row);
        }
    }

    protected function seedTestimonials(): void
    {
        $rows = [
            [
                'name' => 'Budi Santoso',
                'company' => 'PT Logam Presisi Indonesia',
                'content' => 'Produk Metal Finishing yang kami gunakan memberikan hasil perawatan permukaan logam yang jauh lebih konsisten. Dukungan teknisnya sangat responsif.',
                'rating' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'dr. Ratna Puspita',
                'company' => 'RS Harapan Sehat',
                'content' => 'Produk pembersih lantai, kaca, dan sabun cuci tangannya efektif serta nyaman digunakan setiap hari.',
                'rating' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'Andi Wijaya',
                'company' => 'Bersih Cemerlang Laundry',
                'content' => 'Biaya pencucian per kilogram menjadi lebih efisien dan hasil cucian jauh lebih harum serta lembut.',
                'rating' => 5,
                'is_active' => true,
            ],
        ];

        foreach ($rows as $row) {
            Testimonial::updateOrCreate(
                ['name' => $row['name'], 'company' => $row['company']],
                $row
            );
        }
    }

    protected function seedContactMessages(): void
    {
        $rows = [
            [
                'name' => 'Rudi Hartono',
                'email' => 'rudi.hartono@example.com',
                'phone' => '+62 812 3456 7890',
                'subject' => 'Permintaan informasi produk',
                'message' => 'Selamat siang, kami tertarik dengan katalog produk Anda untuk kebutuhan rutin kami. Mohon informasi lebih lanjut.',
                'is_read' => false,
            ],
        ];

        foreach ($rows as $row) {
            ContactMessage::updateOrCreate(
                ['email' => $row['email'], 'subject' => $row['subject']],
                $row
            );
        }
    }
}
