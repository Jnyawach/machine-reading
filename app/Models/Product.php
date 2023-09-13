<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, Sluggable, SluggableScopeHelpers;
    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    protected $fillable=[
        'name','product_weight_id', 'product_type_id','status','user_id','description','product_sku'
    ];

    public function productWeight(){
        return $this->belongsTo(ProductWeight::class);
    }
    public function productType(){
        return $this->belongsTo(ProductType::class);
    }

    public function readings(){
        return $this->hasMany(Reading::class);
    }
}
