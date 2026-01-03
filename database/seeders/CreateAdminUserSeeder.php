<?php
/**
 * @Author: Anwarul
 * @Date: 2025-11-17 15:25:04
 * @LastEditors: Anwarul
 * @LastEditTime: 2025-11-17 15:25:13
 * @Description: Innova IT
 */

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin',
                'user_type' => 'Admin',
                'role_id' => 1,
                'password' => bcrypt('123456')
            ]
        );

        $role = Role::firstOrCreate(['name' => 'Admin']);

        $permissions = Permission::pluck('id','id')->all();
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);
    }
}
