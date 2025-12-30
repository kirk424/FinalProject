<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Borrow;
use App\Models\Book;
use App\Models\Borrower;
use Carbon\Carbon;

class BorrowController extends Controller
{
    public function index() {
        return view('borrows.index', [
            'borrows' => Borrow::with(['book', 'borrower'])->latest()->paginate(10),
            'borrowers' => Borrower::all(),
            'availableBooks' => Book::where('quantity', '>', 0)->get(),
            'activeBorrows' => Borrow::whereNull('returned_at')->count()
        ]);
    }

    public function store(Request $request) {
        // Validate the request
        $validated = $request->validate([
            'book_id' => 'required|exists:books,id',
            'borrower_id' => 'required|exists:borrowers,id',
        ]);

        // Check if book is available
        $book = Book::findOrFail($request->book_id);
        
        if ($book->quantity <= 0) {
            return back()->with('error', 'This book is currently out of stock.');
        }

        // Create borrow record with server's current time
        Borrow::create([
            'book_id' => $request->book_id,
            'borrower_id' => $request->borrower_id,
            'borrowed_at' => Carbon::now() // Uses server's time
        ]);

        // Decrease book quantity
        $book->decrement('quantity');

        return back()->with('success', 'Book borrowed successfully!');
    }

    public function return(Borrow $borrow) {
        // Check if already returned
        if ($borrow->returned_at) {
            return back()->with('error', 'This book has already been returned.');
        }

        // Update borrow record with server's current time
        $borrow->update(['returned_at' => Carbon::now()]);

        // Increase book quantity
        $borrow->book->increment('quantity');

        return back()->with('success', 'Book returned successfully!');
    }

    // Optional: Add destroy method for deleting records
    public function destroy(Borrow $borrow) {
        // If book hasn't been returned, restore quantity
        if (!$borrow->returned_at) {
            $borrow->book->increment('quantity');
        }
        
        $borrow->delete();
        
        return back()->with('success', 'Borrow record deleted successfully!');
    }
}