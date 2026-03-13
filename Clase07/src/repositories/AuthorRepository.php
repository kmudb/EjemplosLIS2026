<?php
// src/Repositories/AuthorRepository.php
require_once __DIR__ . '/../Database.php';
require_once __DIR__ . '/../Models/Author.php';

class AuthorRepository
{
    private PDO $db;
    public function __construct() { $this->db = Database::getConnection(); }

    public function all(): array
    {
        $stmt = $this->db->query("SELECT * FROM authors ORDER BY id DESC");
        $rows = $stmt->fetchAll();
        return array_map(fn($r) => new Author($r['id'], $r['name'], $r['email']), $rows);
    }

    public function find(int $id): ?Author
    {
        $stmt = $this->db->prepare("SELECT * FROM authors WHERE id = ?");
        $stmt->execute([$id]);
        $r = $stmt->fetch();
        return $r ? new Author($r['id'], $r['name'], $r['email']) : null;
    }

    public function create(Author $a): int
    {
        $stmt = $this->db->prepare("INSERT INTO authors (name, email) VALUES (?, ?)");
        $stmt->execute([$a->name, $a->email]);
        return (int)$this->db->lastInsertId();
    }

    public function update(Author $a): bool
    {
        $stmt = $this->db->prepare("UPDATE authors SET name = ?, email = ? WHERE id = ?");
        return $stmt->execute([$a->name, $a->email, $a->id]);
    }

    public function delete(int $id): bool
    {
        // Evitar borrar si tiene libros asociados (ON DELETE RESTRICT ya lo cubre, pero mostramos mensaje)
        $stmt = $this->db->prepare("DELETE FROM authors WHERE id = ?");
        return $stmt->execute([$id]);
    }
}