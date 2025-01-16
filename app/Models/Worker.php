<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'second_name',
        'surname',
        'phone'
    ];

    public function orders()
    {
        return $this->belongsToMany(Order::class)
            ->withPivot('amount')
            ->withTimestamps();
    }

    public function excludedOrderTypes()
    {
        return $this->belongsToMany(
            OrderType::class,
            'workers_ex_order_types',
            'worker_id',
            'order_type_id'
        )->withTimestamps();
    }
}