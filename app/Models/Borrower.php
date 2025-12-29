<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Borrower.php
class Borrower extends Model {
    protected $fillable = ['name','email','phone'];

    public function borrows() {
        return $this->hasMany(Borrow::class);
    }
}
