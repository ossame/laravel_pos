<?php

namespace App\Models;


use App\Models\product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    use HasFactory;

    // Define the custom table name
    protected $table = 'invoice';

    protected $fillable = [
        'name',
        'date', 
        'client_name',
        'adresse'
        
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'invoice_id');
    }
}


