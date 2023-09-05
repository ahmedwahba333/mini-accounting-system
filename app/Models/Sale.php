<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Sale extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'sale_date',
        'status',
        'tax',
        'note',
        'discount',
        'ref_number',
        'quantity_items',
        'shipping_address',
        'shipping_price',
        'total_amount',
    ];
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function sale_items()
    {
        return $this->hasMany(SaleItem::class);
    }
    public function setCreatedAtAttribute($value)
    {
        $this->attributes['created_at'] = Carbon::parse($value)->addHour();
    }
    use SoftDeletes;
}
