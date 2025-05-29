<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Book;

class ManageBooks extends Component
{
    public function render()
    {
        $books = Book::with('borrowings')->get();
        return view('livewire.manage-books', compact('books'));
    }
}
