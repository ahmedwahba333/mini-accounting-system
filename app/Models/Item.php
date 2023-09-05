<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'details','currency', 'price'];
    public function sale_items()
    {
        return $this->belongsToMany(SaleItem::class);
    }
    public function setCreatedAtAttribute($value)
    {
        $this->attributes['created_at'] = Carbon::parse($value)->addHour();
    }
    use SoftDeletes;
}
