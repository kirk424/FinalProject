<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Book.php
class Book extends Model {
    protected $fillable = ['title','author','isbn','quantity'];

    public function borrows() {
        return $this->hasMany(Borrow::class);
    }
}

