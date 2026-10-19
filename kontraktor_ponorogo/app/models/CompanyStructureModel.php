<?php

require_once __DIR__ . '/../core/Model.php';

class CompanyStructureModel extends Model
{
    protected string $table = 'company_structures';

    public function __construct()
    {
        parent::__construct();
        $this->ensureTableAndDefaults();
    }

    private function ensureTableAndDefaults(): void
    {
        $sql = "CREATE TABLE IF NOT EXISTS company_structures (
            id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            position_key VARCHAR(50) NOT NULL UNIQUE,
            name VARCHAR(150) NOT NULL,
            role_title VARCHAR(150) NOT NULL,
            photo_path VARCHAR(255) DEFAULT NULL,
            sort_order INT UNSIGNED DEFAULT 0,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
        
        $this->query($sql);

        $countRes = $this->query("SELECT COUNT(*) as total FROM company_structures");
        if (empty($countRes) || (int)($countRes[0]['total'] ?? 0) === 0) {
            $defaults = [
                ['komisaris_1', 'RICHWANTY SETYA SARI', 'KOMISARIS', 1],
                ['komisaris_2', 'YANU VITA SARI', 'KOMISARIS', 2],
                ['direktur', 'DONY SAKTI DAMARA', 'DIREKTUR', 3],
                ['gm', 'RESTU OKTA YANO', 'GENERAL MANAGER', 4],
                ['pengawas', 'JOHANS MARCELINO', 'PENGAWAS LAPANGAN', 5],
                ['arsitek', 'SONI PUTRA', 'ARSITEK', 6],
                ['keuangan', 'LINDA KRISTIANA', 'KEUANGAN', 7],
                ['gudang', 'MUHAMMAD SUGIK', 'GUDANG', 8],
            ];

            foreach ($defaults as $row) {
                $this->query(
                    "INSERT INTO company_structures (position_key, name, role_title, sort_order) VALUES (?, ?, ?, ?)",
                    $row
                );
            }
        }
    }

    public function getAllAsMap(): array
    {
        $rows = $this->all('sort_order ASC');
        $map = [];
        foreach ($rows as $row) {
            $map[$row['position_key']] = $row;
        }
        return $map;
    }

    public function updateMember(string $positionKey, string $name, string $roleTitle, ?string $photoPath = null): void
    {
        if ($photoPath !== null && $photoPath !== '') {
            $this->query(
                "UPDATE company_structures SET name = ?, role_title = ?, photo_path = ? WHERE position_key = ?",
                [$name, $roleTitle, $photoPath, $positionKey]
            );
        } else {
            $this->query(
                "UPDATE company_structures SET name = ?, role_title = ? WHERE position_key = ?",
                [$name, $roleTitle, $positionKey]
            );
        }
    }
}
