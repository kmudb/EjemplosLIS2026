<?php
// src/Models/Author.php
class Author
{
    public ?int $id;
    public string $name;
    public ?string $email;

    public function __construct(?int $id, string $name, ?string $email)
    {
        $this->id = $id;
        $this->name = trim($name);
        $this->email = $email ? trim($email) : null;
    }
}