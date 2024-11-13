<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = collect([
            [
                'title' => 'view dashboard', 
                'group' => 'dashboard',
            ],
            [
                'title' => 'create product category', 
                'group' => 'product category',
            ],
            [
                'title' => 'list product category', 
                'group' => 'product category',
            ],
            [
                'title' => 'view product category', 
                'group' => 'product category',
            ],
            [
                'title' => 'edit product category', 
                'group' => 'product category',
            ],
            [
                'title' => 'delete product category', 
                'group' => 'product category',
            ],
            [
                'title' => 'create product', 
                'group' => 'product',
            ],
            [
                'title' => 'list product', 
                'group' => 'product',
            ],
            [
                'title' => 'view product', 
                'group'=> 'product',
            ],
            [
                'title' => 'edit product', 
                'group' => 'product',
            ],
            [
                'title' => 'delete product', 
                'group' => 'product',
            ],
            [
                'title' => 'manage role', 
                'group' => 'role',
            ],
        ]);

        $permissions->each(function ($permission){
            Permission::create($permission);
        });
    }
}
