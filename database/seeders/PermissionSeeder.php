<?php
/**
 * @Author: Anwarul
 * @Date: 2026-01-05 17:21:38
 * @LastEditors: Anwarul
 * @LastEditTime: 2026-01-07 15:33:08
 * @Description: Innova IT
 */

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        // ... Some Truncate Query
        DB::table('permissions')->truncate();
        Schema::enableForeignKeyConstraints();

        $permissions = array(
            array('name' => 'dashboard','guard_name' => 'web'),
            array('name' => 'users.index','guard_name' => 'web'),
            array('name' => 'users.show','guard_name' => 'web'),
            array('name' => 'users.edit','guard_name' => 'web'),
            array('name' => 'users.create','guard_name' => 'web'),
            array('name' => 'users.store','guard_name' => 'web'),
            array('name' => 'users.update','guard_name' => 'web',),
            array('name' => 'users.destroy','guard_name' => 'web'),

            array('name' => 'roles.index','guard_name' => 'web'),
            array('name' => 'roles.edit','guard_name' => 'web'),
            array('name' => 'roles.create','guard_name' => 'web'),
            array('name' => 'roles.show','guard_name' => 'web'),
            array('name' => 'roles.store','guard_name' => 'web'),
            array('name' => 'roles.update','guard_name' => 'web'),
            array('name' => 'roles.destroy','guard_name' => 'web'),

            array('name' => 'permissions.index','guard_name' => 'web'),
            array('name' => 'permissions.edit','guard_name' => 'web'),
            array('name' => 'permissions.create','guard_name' => 'web'),
            array('name' => 'permissions.show','guard_name' => 'web'),
            array('name' => 'permissions.store','guard_name' => 'web'),
            array('name' => 'permissions.update','guard_name' => 'web'),
            array('name' => 'permissions.destroy','guard_name' => 'web'),


            array('name' => 'setting.index','guard_name' => 'web'),
            array('name' => 'setting.edit','guard_name' => 'web'),
            array('name' => 'setting.create','guard_name' => 'web'),
            array('name' => 'setting.show','guard_name' => 'web'),
            array('name' => 'setting.store','guard_name' => 'web'),
            array('name' => 'setting.update','guard_name' => 'web'),
            array('name' => 'setting.destroy','guard_name' => 'web'),

            array('name' => 'division.index','guard_name' => 'web'),
            array('name' => 'division.store','guard_name' => 'web'),
            array('name' => 'division.update','guard_name' => 'web'),
            array('name' => 'division.destroy','guard_name' => 'web'),

            array('name' => 'district.index','guard_name' => 'web'),
            array('name' => 'district.store','guard_name' => 'web'),
            array('name' => 'district.update','guard_name' => 'web'),
            array('name' => 'district.destroy','guard_name' => 'web'),

            array('name' => 'thana.index','guard_name' => 'web'),
            array('name' => 'thana.store','guard_name' => 'web'),
            array('name' => 'thana.update','guard_name' => 'web'),
            array('name' => 'thana.destroy','guard_name' => 'web'),

            array('name' => 'course.index','guard_name' => 'web'),
            array('name' => 'course.edit','guard_name' => 'web'),
            array('name' => 'course.create','guard_name' => 'web'),
            array('name' => 'course.show','guard_name' => 'web'),
            array('name' => 'course.store','guard_name' => 'web'),
            array('name' => 'course.update','guard_name' => 'web'),
            array('name' => 'course.destroy','guard_name' => 'web'),

            array('name' => 'book.index','guard_name' => 'web'),
            array('name' => 'book.create','guard_name' => 'web'),
            array('name' => 'book.store','guard_name' => 'web'),
            array('name' => 'book.show','guard_name' => 'web'),
            array('name' => 'book.edit','guard_name' => 'web'),
            array('name' => 'book.update','guard_name' => 'web'),
            array('name' => 'book.destroy','guard_name' => 'web'),

            array('name' => 'book_file.index','guard_name' => 'web'),
            array('name' => 'book_file.create','guard_name' => 'web'),
            array('name' => 'book_file.store','guard_name' => 'web'),
            array('name' => 'book_file.show','guard_name' => 'web'),
            array('name' => 'book_file.edit','guard_name' => 'web'),
            array('name' => 'book_file.update','guard_name' => 'web'),
            array('name' => 'book_file.destroy','guard_name' => 'web'),
            array('name' => 'module.store','guard_name' => 'web'),
            array('name' => 'module.update','guard_name' => 'web'),
            array('name' => 'module.destroy','guard_name' => 'web'),

            array('name' => 'lessions.index','guard_name' => 'web'),
            array('name' => 'lessions.store','guard_name' => 'web'),
            array('name' => 'lessions.update','guard_name' => 'web'),
            array('name' => 'lessions.destroy','guard_name' => 'web'),

            array('name' => 'book_qr_code.index','guard_name' => 'web'),
            array('name' => 'book_qr_code.store','guard_name' => 'web'),
            array('name' => 'book_qr_code.print','guard_name' => 'web'),
            array('name' => 'book_qr_code.destroy','guard_name' => 'web'),

        );

        DB::table('permissions')->insert($permissions);
    }
}
