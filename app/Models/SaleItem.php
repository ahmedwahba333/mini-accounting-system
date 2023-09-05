<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'sales_id',
        'items_id',
        'quantity',
        'unit_price',
        'total_price',
    ];
    public function sales()
    {
        return $this->belongsTo(Sale::class);
    }
}
