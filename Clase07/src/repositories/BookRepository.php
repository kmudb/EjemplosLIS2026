<?php
// src/Repositories/BookRepository.php
require_once __DIR__ . '/../Database.php';
require_once __DIR__ . '/../Models/Book.php';

class BookRepository
{
    private PDO $db;
    public function __construct() { $this->db = Database::getConnection(); }

    public function all(): array
    {
        $stmt = $this->db->query(
            "SELECT b.*, a.name AS author_name
             FROM books b
             JOIN authors a ON a.id = b.author_id
             ORDER BY b.id DESC"
        );
        return $stmt->fetchAll();
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare(
            "SELECT b.*, a.name AS author_name
             FROM books b
             JOIN authors a ON a.id = b.author_id
             WHERE b.id = ?"
        );
        $stmt->execute([$id]);
        $r = $stmt->fetch();
        return $r ?: null;
    }

    public function create(Book $b): int
    {
        $stmt = $this->db->prepare("INSERT INTO books (author_id, title, year) VALUES (?, ?, ?)");
        $stmt->execute([$b->author_id, $b->title, $b->year]);
        return (int)$this->db->lastInsertId();
    }

    public function update(Book $b): bool
    {
        $stmt = $this->db->prepare("UPDATE books SET author_id = ?, title = ?, year = ? WHERE id = ?");
        return $stmt->execute([$b->author_id, $b->title, $b->year, $b->id]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM books WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function authorsForSelect(): array
    {
        $stmt = $this->db->query("SELECT id, name FROM authors ORDER BY name ASC");
        return $stmt->fetchAll();
    }
}
