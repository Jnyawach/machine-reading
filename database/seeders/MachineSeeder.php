<?php

namespace Database\Seeders;

use App\Enums\StatusEnum;
use App\Models\Machine;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class MachineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $machines=[
            'Machine One',
            'Machine Two'
        ];

        Schema::disableForeignKeyConstraints();
        Machine::truncate();
        Schema::enableForeignKeyConstraints();

        foreach ($machines as $machine){
            Machine::create([
                'name'=>$machine,
                'status'=>StatusEnum::Enabled->value,
                'product_type_id'=>1
            ]);
        }
    }
}
