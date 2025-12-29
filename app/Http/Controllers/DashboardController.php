<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use App\Models\Borrower;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'totalBooks'      => Book::count(),
            'totalBorrowers'  => Borrower::count(),
            'borrowedBooks'   => Borrow::whereNull('returned_at')->count(),
            'availableBooks' => Book::sum('quantity'),
        ]);
    }
}
