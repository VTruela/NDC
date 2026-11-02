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

        $categories = $this->seedCategories();
        $this->seedProducts($categories);
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

    /**
     * Akun contoh tambahan: seorang pengelola konten dan akun tamu bersama.
     */
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
                'description' => 'Chemical solutions for surface treatment, plating, and corrosion protection for metal substrates.',
                'image' => null,
            ],
            [
                'name' => 'Institutional Cleaning',
                'slug' => 'institutional',
                'theme' => 'institutional',
                'lang_id' => 'Pembersih Institusional',
                'lang_en' => 'Institutional Cleaning',
                'description' => 'Complete cleaning solutions for hospitals, hotels, offices, and commercial facilities.',
                'image' => null,
            ],
            [
                'name' => 'Laundry',
                'slug' => 'laundry',
                'theme' => 'laundry',
                'lang_id' => 'Laundry',
                'lang_en' => 'Laundry',
                'description' => 'Professional detergents, softeners, and boosters for commercial and industrial laundries.',
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

    /**
     * @param  array<string, Category>  $categories
     */
    protected function seedProducts(array $categories): void
    {
        $rows = [
            // Metal Finishing
            [
                'category' => 'metal-finishing',
                'name' => 'NDC Rust Converter',
                'slug' => 'ndc-rust-converter',
                'short_description' => 'Converts rust into a stable, paintable surface in a single application.',
                'description' => 'NDC Rust Converter penetrates and chemically transforms iron oxide into an inert, protective layer. It is ideal for maintenance and repair work where sandblasting is impractical, allowing primers and topcoats to adhere firmly on previously rusted steel surfaces.',
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'category' => 'metal-finishing',
                'name' => 'NDC Degreaser HD',
                'slug' => 'ndc-degreaser-hd',
                'short_description' => 'Heavy-duty alkaline degreaser for ferrous and non-ferrous metals.',
                'description' => 'A high-performance alkaline degreaser engineered to remove oils, greases, and drawing compounds from metal surfaces prior to plating or painting. The formulation is free from silicates and promotes superior adhesion for subsequent finishing processes.',
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'category' => 'metal-finishing',
                'name' => 'NDC Zinc Brightener',
                'slug' => 'ndc-zinc-brightener',
                'short_description' => 'Additive for brilliant and uniform zinc electroplating.',
                'description' => 'A proprietary brightener system for acid zinc and alkaline zinc plating, providing high throwing power, wide current density tolerance, and outstanding brightness across recessed areas.',
                'is_featured' => false,
                'is_active' => true,
            ],

            // Institutional
            [
                'category' => 'institutional',
                'name' => 'NDC Floor Cleaner Pro',
                'slug' => 'ndc-floor-cleaner-pro',
                'short_description' => 'Neutral floor cleaner for daily maintenance of commercial facilities.',
                'description' => 'A pH-neutral, low-foam floor cleaner designed for routine maintenance of vinyl, ceramic, and sealed stone flooring. It leaves no dulling residue and is compatible with automatic scrubbers.',
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'category' => 'institutional',
                'name' => 'NDC Hospital Disinfectant',
                'slug' => 'ndc-hospital-disinfectant',
                'short_description' => 'Broad-spectrum disinfectant safe for healthcare environments.',
                'description' => 'A quaternary ammonium based disinfectant that is effective against a broad spectrum of bacteria, viruses, and fungi. It is non-corrosive, low odor, and suitable for hospitals, clinics, and food-handling areas.',
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'category' => 'institutional',
                'name' => 'NDC Glass Shine',
                'slug' => 'ndc-glass-shine',
                'short_description' => 'Streak-free glass and mirror cleaning concentrate.',
                'description' => 'A concentrated glass cleaner that delivers fast-drying, streak-free results on windows, mirrors, and display cases. Dilutes economically for high-volume facility use.',
                'is_featured' => false,
                'is_active' => true,
            ],

            // Laundry
            [
                'category' => 'laundry',
                'name' => 'NDC Laundry Detergent Elite',
                'slug' => 'ndc-laundry-detergent-elite',
                'short_description' => 'High-efficiency detergent for industrial laundry machines.',
                'description' => 'A high-efficiency detergent formulated for commercial tunnel washers and washer-extractors. It lifts heavy soil loads at low temperatures and rinses cleanly, extending textile life.',
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'category' => 'laundry',
                'name' => 'NDC Fabric Softener Soft',
                'slug' => 'ndc-fabric-softener-soft',
                'short_description' => 'Cationic softener for a fresh, comfortable finish.',
                'description' => 'A concentrated cationic softener that imparts lasting softness, reduces static, and leaves a pleasant fresh fragrance on linen, towels, and uniforms.',
                'is_featured' => false,
                'is_active' => true,
            ],
            [
                'category' => 'laundry',
                'name' => 'NDC Chlorine Booster',
                'slug' => 'ndc-chlorine-booster',
                'short_description' => 'Oxygen-based bleach booster for stain removal and whitening.',
                'description' => 'An oxygen-based booster for the removal of stubborn stains and the maintenance of whiteness in white textiles. It is chlorine-free, fabric-safe, and effective at moderate temperatures.',
                'is_featured' => false,
                'is_active' => true,
            ],
        ];

        foreach ($rows as $row) {
            $category = $categories[$row['category']];
            unset($row['category']);

            Product::updateOrCreate(
                ['slug' => $row['slug']],
                $row + ['category_id' => $category->id]
            );
        }
    }

    protected function seedArticles(): void
    {
        $rows = [
            [
                'title' => 'Choosing the Right Degreaser for Metal Finishing',
                'slug' => 'choosing-the-right-degreaser-for-metal-finishing',
                'excerpt' => 'Selecting the correct degreaser directly impacts coating adhesion and long-term corrosion resistance.',
                'content' => "Proper surface preparation is the foundation of any durable metal finish. In this article we review the key differences between alkaline, solvent, and emulsifiable degreasers, and how each performs against common contaminants such as drawing oils, cutting fluids, and shop dirt.\n\nWe also cover practical control points, including concentration titration, bath temperature, and rinse quality, that keep your process stable from shift to shift.",
                'author' => 'Technical Team',
                'published_at' => now()->subDays(21),
                'is_published' => true,
            ],
            [
                'title' => 'Best Practices for Hospital-Grade Disinfection',
                'slug' => 'best-practices-for-hospital-grade-disinfection',
                'excerpt' => 'Consistent protocol and correct dilution are the pillars of effective healthcare disinfection.',
                'content' => "Healthcare-associated infections remain a serious concern. This article outlines a practical disinfection protocol for hospitals and clinics, from touch-point frequency to contact time and staff training.\n\nWe explain how to dilute concentrated disinfectants accurately and how to document compliance for accreditation audits.",
                'author' => 'Technical Team',
                'published_at' => now()->subDays(12),
                'is_published' => true,
            ],
            [
                'title' => 'Reducing Cost per Kilogram in Commercial Laundry',
                'slug' => 'reducing-cost-per-kilogram-in-commercial-laundry',
                'excerpt' => 'Small adjustments in chemistry and process can meaningfully lower your cost per kilogram washed.',
                'content' => "Commercial laundries face constant pressure on utility and chemical costs. In this article we examine how detergent dosing, water hardness control, and load scheduling interact to influence your total cost.\n\nWe present a simple framework to audit your wash formulas and identify savings without compromising hygiene or textile life.",
                'author' => 'Technical Team',
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
                'content' => 'The degreaser and brightener system from NDC gave us a noticeably more consistent plating line. Technical support is responsive and genuinely helpful.',
                'rating' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'dr. Ratna Puspita',
                'company' => 'RS Harapan Sehat',
                'content' => 'Their hospital disinfectant is effective, low odor, and safe for use around patients. Dosing guidance made implementation straightforward.',
                'rating' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'Andi Wijaya',
                'company' => 'Bersih Cemerlang Laundry',
                'content' => 'Our cost per kilogram dropped and the linen comes out fresher and softer. Their team helped us rebalance our wash formulas.',
                'rating' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'Siti Marlina',
                'company' => 'Hotel Grand Nusantara',
                'content' => 'The floor cleaner and glass shine products have become standard in our housekeeping team. Reliable quality every delivery.',
                'rating' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Hendra Gunawan',
                'company' => 'CV Baja Perkasa',
                'content' => 'The rust converter saved us time on rework. It primes a solid foundation before topcoating and holds up well outdoors.',
                'rating' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'Maria Kusuma',
                'company' => 'Klinik Sehat Bersama',
                'content' => 'Professional service from inquiry to delivery. The product documentation clearly explains dilution and safety requirements.',
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
                'subject' => 'Permintaan penawaran degreaser',
                'message' => 'Selamat siang, kami tertarik dengan produk degreaser untuk lini produksi kami. Mohon informasi harga dan ketersediaan untuk kebutuhan bulanan.',
                'is_read' => false,
            ],
            [
                'name' => 'Linda Setiawan',
                'email' => 'linda.setiawan@example.com',
                'phone' => '+62 813 9876 5432',
                'subject' => 'Kerjasama distributor',
                'message' => 'Halo, kami ingin menjajaki kemungkinan menjadi distributor produk Anda untuk wilayah Surabaya. Mohon dihubungi untuk diskusi lebih lanjut.',
                'is_read' => true,
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
