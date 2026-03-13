<?php
// src/Controllers/BookController.php
require_once __DIR__ . '/../Repositories/BookRepository.php';
require_once __DIR__ . '/../Repositories/AuthorRepository.php';
require_once __DIR__ . '/../Models/Book.php';

class BookController
{
    private BookRepository $repo;
    private AuthorRepository $authorRepo;

    public function __construct()
    {
        $this->repo = new BookRepository();
        $this->authorRepo = new AuthorRepository();
    }

    public function index()
    {
        $books = $this->repo->all();
        render('books/list', compact('books'));
    }

    public function create()
    {
        $authors = $this->repo->authorsForSelect();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $author_id = (int)($_POST['author_id'] ?? 0);
            $title = $_POST['title'] ?? '';
            $year = $_POST['year'] !== '' ? (int)$_POST['year'] : null;

            if ($author_id <= 0 || trim($title) === '') {
                $error = "Autor y título son obligatorios.";
                return render('books/form', compact('authors', 'error'));
            }

            $b = new Book(null, $author_id, $title, $year);
            $this->repo->create($b);
            redirect('?controller=books&action=index');
        } else {
            render('books/form', compact('authors'));
        }
    }

    public function edit()
    {
        $id = (int)($_GET['id'] ?? 0);
        $book = $this->repo->find($id);
        if (!$book) return notFound();

        $authors = $this->repo->authorsForSelect();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $author_id = (int)($_POST['author_id'] ?? $book['author_id']);
            $title = $_POST['title'] ?? $book['title'];
            $year = $_POST['year'] !== '' ? (int)$_POST['year'] : null;

            $b = new Book($id, $author_id, $title, $year);
            $this->repo->update($b);
            redirect('?controller=books&action=index');
        } else {
            render('books/form', compact('book', 'authors'));
        }
    }

    public function delete()
    {
        $id = (int)($_GET['id'] ?? 0);
        $this->repo->delete($id);
        redirect('?controller=books&action=index');
    }
}