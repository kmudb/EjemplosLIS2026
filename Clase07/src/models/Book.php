<?php
// src/Models/Book.php
class Book
{
    public ?int $id;
    public int $author_id;
    public string $title;
    public ?int $year;

    public function __construct(?int $id, int $author_id, string $title, ?int $year)
    {
        $this->id = $id;
        $this->author_id = $author_id;
        $this->title = trim($title);
        $this->year = $year;
    }
}