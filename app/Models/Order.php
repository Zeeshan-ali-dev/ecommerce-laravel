<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    
    public $timestamps = true;


    protected $fillable = ['user_id', 'products', 'total', 'status'];
}
