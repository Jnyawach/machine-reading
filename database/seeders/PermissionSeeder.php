<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Schema::disableForeignKeyConstraints();
        Permission::truncate();
        Schema::enableForeignKeyConstraints();

        $permissions=[
            [
                'name'=>'products',
                'guard_name'=>'web'
            ],
            [
                'name'=>'machine',
                'guard_name'=>'web'
            ],
            [
                'name'=>'shifts',
                'guard_name'=>'web'
            ],
            [
                'name'=>'reading',
                'guard_name'=>'web'
            ],
        ];

        foreach ($permissions as $permission){
            Permission::create($permission);
        }
    }
}
