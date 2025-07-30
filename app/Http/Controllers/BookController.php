<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
use App\Enums\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    /**
     * Display a listing of the books.
     */
    public function index()
    {
        if (Auth::user()->role !== UserRole::ADMIN) {
            abort(403); // Forbidden
        }

        $books = Book::all();
        return view('livewire.manage-books', compact('books'));
    }

    /**
     * Show the form for creating a new book.
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created book in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'published_year' => 'required|digits:4|integer',
        ]);

        Book::create($request->all());

        return redirect()->back()->with('success', 'Book created successfully.');
    }

    /**
     * Show the form for editing the specified book.
     */
    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    /**
     * Update the specified book in storage.
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'published_year' => 'required|digits:4|integer',
        ]);

        $book->update($request->all());

        return redirect()->back()->with('success', 'Book updated successfully.');
    }

    /**
     * Remove the specified book from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->back()->with('success', 'Book deleted successfully.');
    }

    public function showAvailableBooks()
    {
        $books = Book::all();
        return view('user.borrow-books', compact('books'));
    }

    public function borrow(Book $book)
    {
        if (!$book->isAvailable()) {
            abort(403, 'Book is already borrowed.');
        }

        $book->borrowings()->create([
            'user_id' => auth()->id(),
            'borrowed_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Book borrowed successfully!');
    }

    public function return(Book $book)
    {
        $borrowing = $book->borrowings()
            ->where('user_id', auth()->id())
            ->whereNull('returned_at')
            ->latest()
            ->first();

        if (!$borrowing) {
            return redirect()->back()->with('error', 'You have not borrowed this book or it was already returned.');
        }

        $borrowing->update([
            'returned_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Book returned successfully!');
    }

    public function showReturnableBooks()
    {
        $borrowedBooks = Borrowing::with('book')
            ->where('user_id', auth()->id())
            ->whereNull('returned_at')
            ->latest()
            ->get();

        return view('user.return-books', compact('borrowedBooks'));
    }
}
