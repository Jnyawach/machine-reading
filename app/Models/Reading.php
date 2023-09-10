<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reading extends Model
{
    use HasFactory;

    protected $fillable=[
        'user_id',
        'product_id',
        'reading_entry',
        'automatic_count',
        'reading_count',
        'confirm_by_id',
        'confirmed_at',
        'shift_id',
        'confirm_status',
        'machine_id'

    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function confirmBy(){
        return $this->belongsTo(User::class,'confirm_by_id');
    }
    public function shift(){
        return $this->belongsTo(Shift::class);
    }

    public function machine(){
        return $this->belongsTo(Machine::class);
    }

}
