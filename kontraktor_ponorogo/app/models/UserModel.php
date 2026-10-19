<?php

require_once __DIR__ . '/../core/Model.php';

class UserModel extends Model
{
    protected string $table = 'users';

    public function findByEmail(string $email): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);
        $result = $stmt->fetch();
        return $result ?: null;
    }

    public function getAllUsers(): array
    {
        $stmt = $this->db->query("SELECT * FROM {$this->table} ORDER BY id ASC");
        return $stmt->fetchAll();
    }

    public function getUserById(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        $res = $stmt->fetch();
        return $res ?: null;
    }

    public function createUser(array $data): bool
    {
        $passwordHash = password_hash($data['password'], PASSWORD_BCRYPT);
        $stmt = $this->db->prepare("
            INSERT INTO {$this->table} (name, email, password_hash, role, status)
            VALUES (:name, :email, :password_hash, :role, :status)
        ");
        return $stmt->execute([
            'name' => $data['name'],
            'email' => $data['email'],
            'password_hash' => $passwordHash,
            'role' => $data['role'] ?? 'admin',
            'status' => $data['status'] ?? 'active',
        ]);
    }

    public function updateUser(int $id, array $data): bool
    {
        if (!empty($data['password'])) {
            $passwordHash = password_hash($data['password'], PASSWORD_BCRYPT);
            $stmt = $this->db->prepare("
                UPDATE {$this->table}
                SET name = :name, email = :email, password_hash = :password_hash, role = :role, status = :status
                WHERE id = :id
            ");
            return $stmt->execute([
                'id' => $id,
                'name' => $data['name'],
                'email' => $data['email'],
                'password_hash' => $passwordHash,
                'role' => $data['role'] ?? 'admin',
                'status' => $data['status'] ?? 'active',
            ]);
        } else {
            $stmt = $this->db->prepare("
                UPDATE {$this->table}
                SET name = :name, email = :email, role = :role, status = :status
                WHERE id = :id
            ");
            return $stmt->execute([
                'id' => $id,
                'name' => $data['name'],
                'email' => $data['email'],
                'role' => $data['role'] ?? 'admin',
                'status' => $data['status'] ?? 'active',
            ]);
        }
    }

    public function deleteUser(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}

