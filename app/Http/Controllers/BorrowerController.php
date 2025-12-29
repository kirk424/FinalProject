<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Borrower; 



class BorrowerController extends Controller
{
    public function index() {
        return view('borrowers.index', [
            'borrowers' => Borrower::all()
        ]);
    }

    public function create() {
        return view('borrowers.create');
    }

    public function store(Request $request) {
        Borrower::create($request->all());
        return redirect()->route('borrowers.index');
    }

    public function destroy(Borrower $borrower) {
        $borrower->delete();
        return redirect()->route('borrowers.index');
    }
}
