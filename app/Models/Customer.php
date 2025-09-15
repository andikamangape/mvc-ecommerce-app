<?php
namespace App\Models;

use App\Core\Database;
use PDO;

class Customer
{
    public static function all(): array
    {
        $pdo = Database::connect();
        $stmt = $pdo->query("SELECT id, full_name, email, phone, country FROM customers");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // contoh method lain (findById) menggunakan prepared statement:
    public static function find(int $id): ?array
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("SELECT * FROM customers WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ?: null;
    }

    public static function create(string $full_name, string $email, string $phone, string $country): bool {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("INSERT INTO customers (full_name, email, phone, country) VALUES (:full_name, :email, :phone, :country)");
        return $stmt->execute([
            'full_name' => $full_name,
            'email' => $email,
            'phone' => $phone,
            'country' => $country
        ]);
    }
}
