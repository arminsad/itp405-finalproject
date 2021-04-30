<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Food;

class Favorite extends Model
{
    use HasFactory;

    protected $fillable = ['food_id'];

    public function food()
    {
        return $this->belongsTo(Food::class);
    }
}
