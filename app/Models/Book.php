<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
   protected $fillable = ['title', 'author', 'published_year'];

   public function borrowings()
   {
      return $this->hasMany(\App\Models\Borrowing::class);
   }

   public function isAvailable()
   {
      return !$this->borrowings()->whereNull('returned_at')->exists();
   }
}
