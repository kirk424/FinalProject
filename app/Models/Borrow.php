<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Borrower.php
// Borrow.php
class Borrow extends Model {
    protected $fillable = ['book_id','borrower_id','borrowed_at','returned_at'];

    public function book() {
        return $this->belongsTo(Book::class);
    }

    public function borrower() {
        return $this->belongsTo(Borrower::class);
    }
}


