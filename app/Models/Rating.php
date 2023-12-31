<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    public $table = "rating";
    public $timestamps = false;
    protected $fillable = ['star','product_id','name','email','comment'];
}
