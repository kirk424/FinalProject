<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Borrower;

class BorrowerController extends Controller
{
    public function index() {
        return view('borrowers.index', [
            // Change from all() to paginate()
            'borrowers' => Borrower::paginate(10) // Show 10 borrowers per page
        ]);
    }

    public function create() {
        return view('borrowers.create');
    }

    public function store(Request $request) {
        // Add validation for better data integrity
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:borrowers,email',
            'phone' => 'required|string|max:20',
        ]);
        
        Borrower::create($validated);
        
        return redirect()->route('borrowers.index')
            ->with('success', 'Borrower added successfully!');
    }

    public function destroy(Borrower $borrower) {
        $borrower->delete();
        return redirect()->route('borrowers.index')
            ->with('success', 'Borrower deleted successfully!');
    }
    
    // Optional: Add edit and update methods
    public function edit(Borrower $borrower) {
        return view('borrowers.edit', compact('borrower'));
    }
    
    public function update(Request $request, Borrower $borrower) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:borrowers,email,' . $borrower->id,
            'phone' => 'required|string|max:20',
        ]);
        
        $borrower->update($validated);
        
        return redirect()->route('borrowers.index')
            ->with('success', 'Borrower updated successfully!');
    }
}