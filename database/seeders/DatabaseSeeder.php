<?php

namespace Database\Seeders;

use App\Models\CameraPrice;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Super Admin

        $super_admin_role = Role::create(['name' => 'super_admin']);
        $super_admin_user = User::create([
            'name' => 'م. هتان عاشور',
            'email' => 'eng.hattanashour@gmail.com',
            'password' => 'admin123456',
            'phone' => '01234567'

        ]);

        $super_admin_user->addMedia(public_path('images/eng.hattan.png'))->toMediaCollection('admin');
        $super_admin_user->assignRole($super_admin_role);

        // Set initial camera prices
        CameraPrice::create(['from' => 0, 'to' => 0, 'price' => 50]);
        CameraPrice::create(['from' => 1, 'to' => 4, 'price' => 499]);
        CameraPrice::create(['from' => 5, 'to' => 16, 'price' => 999]);
        CameraPrice::create(['from' => 17, 'to' => 32, 'price' => 1499]);
        CameraPrice::create(['from' => 33, 'to' => 64, 'price' => 1999]);
    }
}
