<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'machine_create',
            ],
            [
                'id'    => 18,
                'title' => 'machine_edit',
            ],
            [
                'id'    => 19,
                'title' => 'machine_show',
            ],
            [
                'id'    => 20,
                'title' => 'machine_delete',
            ],
            [
                'id'    => 21,
                'title' => 'machine_access',
            ],
            [
                'id'    => 22,
                'title' => 'product_create',
            ],
            [
                'id'    => 23,
                'title' => 'product_edit',
            ],
            [
                'id'    => 24,
                'title' => 'product_show',
            ],
            [
                'id'    => 25,
                'title' => 'product_delete',
            ],
            [
                'id'    => 26,
                'title' => 'product_access',
            ],
            [
                'id'    => 27,
                'title' => 'operator_create',
            ],
            [
                'id'    => 28,
                'title' => 'operator_edit',
            ],
            [
                'id'    => 29,
                'title' => 'operator_show',
            ],
            [
                'id'    => 30,
                'title' => 'operator_delete',
            ],
            [
                'id'    => 31,
                'title' => 'operator_access',
            ],
            [
                'id'    => 32,
                'title' => 'production_access',
            ],
            [
                'id'    => 33,
                'title' => 'tape_access',
            ],
            [
                'id'    => 34,
                'title' => 'order_create',
            ],
            [
                'id'    => 35,
                'title' => 'order_edit',
            ],
            [
                'id'    => 36,
                'title' => 'order_show',
            ],
            [
                'id'    => 37,
                'title' => 'order_delete',
            ],
            [
                'id'    => 38,
                'title' => 'order_access',
            ],
            [
                'id'    => 39,
                'title' => 'order_detail_create',
            ],
            [
                'id'    => 40,
                'title' => 'order_detail_edit',
            ],
            [
                'id'    => 41,
                'title' => 'order_detail_show',
            ],
            [
                'id'    => 42,
                'title' => 'order_detail_delete',
            ],
            [
                'id'    => 43,
                'title' => 'order_detail_access',
            ],
            [
                'id'    => 44,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
