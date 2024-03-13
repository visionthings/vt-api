<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Contract;
use App\Models\ContractNumber;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use function Laravel\Prompts\password;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        ContractNumber::create([
             'contract_number'=>'1000',

        ]);

    // Create Super Admin

        $super_admin_role = Role::create(['name' => 'super_admin']);
        $super_admin_user = User::create([
            'name' => 'م. هتان عاشور',
            'email' => 'eng.hattanashour@gmail.com',
            'password' => 'admin123456',
            'email_verified' => 'yes'
        ]);

        $super_admin_user->addMediaFromUrl('https://i.ibb.co/jMft1z5/person.png')->toMediaCollection('admin');


        $super_admin_user->assignRole($super_admin_role);


    }
}
