<?php
// src/Controllers/AuthorController.php
require_once __DIR__ . '/../Repositories/AuthorRepository.php';

class AuthorController
{
    private AuthorRepository $repo;

    public function __construct() { $this->repo = new AuthorRepository(); }

    public function index()
    {
        $authors = $this->repo->all();
        render('authors/list', compact('authors'));
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? null;

            if (trim($name) === '') {
                $error = "El nombre es obligatorio.";
                return render('authors/form', compact('error'));
            }

            $a = new Author(null, $name, $email);
            $id = $this->repo->create($a);
            redirect('?controller=authors&action=index');
        } else {
            render('authors/form');
        }
    }

    public function edit()
    {
        $id = (int)($_GET['id'] ?? 0);
        $author = $this->repo->find($id);
        if (!$author) return notFound();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $author->name = $_POST['name'] ?? $author->name;
            $author->email = $_POST['email'] ?? $author->email;
            $this->repo->update($author);
            redirect('?controller=authors&action=index');
        } else {
            render('authors/form', compact('author'));
        }
    }

    public function delete()
    {
        $id = (int)($_GET['id'] ?? 0);
        try {
            $this->repo->delete($id);
            redirect('?controller=authors&action=index');
        } catch (Throwable $e) {
            $error = "No se puede eliminar: posiblemente tiene libros asociados.";
            $authors = $this->repo->all();
            render('authors/list', compact('authors', 'error'));
        }
    }
}