<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Food;

class Ingredient extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function foods()
    {
        return $this->belongsToMany(Food::class)->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
