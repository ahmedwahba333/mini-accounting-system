<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'company',
        'cPerson',
        'address',
        'city',
        'state',
        'posCode',
        'country',
        'phone_number',
        'email',
    ];
    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
    public function setCreatedAtAttribute($value)
    {
        $this->attributes['created_at'] = Carbon::parse($value)->addHour();
    }
    use SoftDeletes;
}
