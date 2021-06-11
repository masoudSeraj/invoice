<?php

namespace App\Models;

use App\Models\Invoices;
use App\Models\Products;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoices extends Model
{
    use HasFactory;

    protected $fillable = ['length', 'user_id','subtotal', 'total'];

    public function products(){

        return $this->belongsToMany(Products::class,"invoice_product", 'invoice_id', 'product_id')->withPivot('quantity');

    }


}
