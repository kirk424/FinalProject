<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Borrow;
use App\Models\Book;



class BorrowController extends Controller
{
    public function index() {
        return view('borrows.index', [
            'borrows' => Borrow::with(['book','borrower'])->get()
        ]);
    }

    public function store(Request $request) {
        Borrow::create([
            'book_id' => $request->book_id,
            'borrower_id' => $request->borrower_id,
            'borrowed_at' => now()
        ]);

        Book::where('id', $request->book_id)->decrement('quantity');
        return back();
    }

    public function return(Borrow $borrow) {
        $borrow->update(['returned_at' => now()]);
        $borrow->book->increment('quantity');
        return back();
    }
}
