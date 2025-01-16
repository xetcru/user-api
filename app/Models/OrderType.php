<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderType extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    
    protected $fillable = ['name'];

    public function orders()
    {
        return $this->hasMany(Order::class, 'type_id');
    }

    public function excludedByWorkers()
    {
        return $this->belongsToMany(
            Worker::class,
            'workers_ex_order_types',
            'order_type_id',
            'worker_id'
        )->withTimestamps();
    }
}