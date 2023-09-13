<?php

namespace Database\Seeders;

use App\Enums\MeasurementUnitEnum;
use App\Enums\StatusEnum;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\ProductWeight;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class DemoDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //test user
        $userNew=[
            'name'=>'joshua',
            'email'=>'reading@test',
            'password'=>12345678
        ];
        //product weights
        $productWeights=[
            [
                'weight'=>2,
                'measurement_unit'=>MeasurementUnitEnum::Kgs->value,
                'packaging_quantity'=>12
            ],
            [
                'weight'=>1,
                'measurement_unit'=>MeasurementUnitEnum::Kgs->value,
                'packaging_quantity'=>24
            ],
            [
                'weight'=>0.5,
                'measurement_unit'=>MeasurementUnitEnum::Kgs->value,
                'packaging_quantity'=>24
            ]
        ];
        //product types
        $productTypes=[
            [
                'name'=>'Wheat',
                'description'=>'This is a wheat product',
                'products'=>[
                    [
                      'name'=> 'Baba lao all purpose',
                        'product_weight_id'=>1,
                        'product_sku'=>'DGRT46'
                    ],
                    [
                        'name'=> 'Baba lao all purpose',
                        'product_weight_id'=>2,
                        'product_sku'=>'DGRT465'
                    ],
                    [
                        'name'=> 'Baba lao all purpose',
                        'product_weight_id'=>3,
                        'product_sku'=>'DGRT56'
                    ]
                ]

            ],
            [
                'name'=>'Maize',
                'description'=>'This is a maize Product',
                'products'=>[
                    [
                        'name'=> 'Baba lao maize',
                        'product_weight_id'=>1,
                        'product_sku'=>'DGRT36'
                    ],
                    [
                        'name'=> 'Baba lao all maize',
                        'product_weight_id'=>2,
                        'product_sku'=>'DGRT466'
                    ],

                ]
            ]
        ];

        Schema::disableForeignKeyConstraints();
        ProductType::truncate();
        ProductWeight::truncate();
        Product::truncate();
        User::truncate();
        Schema::enableForeignKeyConstraints();

        //test user
        $user=User::create([
            'name'=>$userNew['name'],
            'email'=>$userNew['email'],
            'password'=>Hash::make($userNew['password']),
            'email_verified'=>true
        ]);

        //create product weights
        foreach ($productWeights as $weight){
            ProductWeight::create([
                'weight'=>$weight['weight'],
                'measurement_unit'=>$weight['measurement_unit'],
                'packaging_quantity'=>$weight['packaging_quantity'],

            ]);
        }

        //create products and types

        foreach ($productTypes as $type){
            $newType=ProductType::create([
                'name'=>$type['name'],
                'description'=>$type['description'],
                'status'=>StatusEnum::Enabled->value
            ]);
            foreach ($type['products'] as $product){
                Product::create([
                    'name'=>$product['name'],
                    'product_weight_id'=>$product['product_weight_id'],
                    'user_id'=>$user->id,
                    'status'=>StatusEnum::Enabled->value,
                    'product_type_id'=>$newType->id,
                    'product_sku'=>$product['product_sku']
                ]);
            }
        }
    }
}
