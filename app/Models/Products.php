<?php

namespace App\Models;

use App\Models\Invoices;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class products extends Model
{
    use HasFactory;
    protected $fillable = ['name','price'];

    public function invoices(){

        return $this->belongsToMany(Invoices::class, 'invoice_product', 'product_id', 'invoice_id')->withPivot('quantity');

    }
}
