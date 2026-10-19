<?php

require_once __DIR__ . '/../core/Model.php';

class TestimonialModel extends Model
{
    protected string $table = 'testimonials';

    public function __construct()
    {
        parent::__construct();
        $this->ensureTableAndDefaults();
    }

    private function ensureTableAndDefaults(): void
    {
        $sql = "CREATE TABLE IF NOT EXISTS testimonials (
            id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            client_name VARCHAR(120) NOT NULL,
            company_name VARCHAR(150) DEFAULT NULL,
            message TEXT NOT NULL,
            rating TINYINT UNSIGNED DEFAULT 5,
            is_active TINYINT(1) DEFAULT 1,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

        try {
            $this->query($sql);
            $countRes = $this->query("SELECT COUNT(*) as total FROM testimonials");
            if (empty($countRes) || (int)($countRes[0]['total'] ?? 0) === 0) {
                $defaults = $this->getFallbackTestimonials();
                foreach ($defaults as $row) {
                    $this->query(
                        "INSERT INTO testimonials (client_name, company_name, message, rating, is_active) VALUES (?, ?, ?, ?, 1)",
                        [$row['client_name'], $row['company_name'], $row['message'], $row['rating']]
                    );
                }
            }
        } catch (\Throwable $e) {
            // ignore exception
        }
    }

    public function getActiveTestimonials(): array
    {
        try {
            $sql = "SELECT * FROM {$this->table} WHERE is_active = 1 ORDER BY id DESC";
            $results = $this->query($sql);
            if (!empty($results)) {
                return $results;
            }
        } catch (\Throwable $e) {
            // Fallback if query fails
        }

        return $this->getFallbackTestimonials();
    }

    public function getFallbackTestimonials(): array
    {
        return [
            [
                'client_name' => 'H. Ahmad Subarkah',
                'company_name' => 'Pemilik Villa Asri Ponorogo',
                'message' => 'PT Graha Lestari menyelesaikan pembangunan rumah villa keluarga kami tepat waktu dengan hasil sangat rapi. Transparansi anggaran dan pengawasannya luar biasa profesional.',
                'rating' => 5,
            ],
            [
                'client_name' => 'Dra. Endang Rahayu',
                'company_name' => 'Pemilik Ruko Komersial',
                'message' => 'Renovasi gedung usaha kami berjalan sesuai jadwal tanpa hambatan. Timnya komunikatif, material sesuai spesifikasi, dan hasilnya sangat memuaskan.',
                'rating' => 5,
            ],
            [
                'client_name' => 'Bpk. Hendra Wijaya',
                'company_name' => 'Penghuni Townhouse Premium',
                'message' => 'Kualitas konstruksi dan finishing bangunan sangat kokoh & estetik. PT Graha Lestari terbukti menjadi kontraktor properti paling terpercaya di Ponorogo.',
                'rating' => 5,
            ]
        ];
    }
}
