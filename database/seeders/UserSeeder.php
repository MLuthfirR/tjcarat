<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pass = Str::random(32);
        $admin = User::create([
            'company_name' => 'PT Benua Laut Lepas',
            'company_phone_number' => '087809432148',
            'company_address' => 'Jalan Test',
            'uuid' => Uuid::uuid4()->toString(),
            'pic_name' => 'BLL',
            'pic_title' => 'Admin',
            'npwp' => '000000000000',
            'email' => 'bll@gmail.com',
            'password' => bcrypt($pass),
            'active' => True,
            'verified' => True,
        ]);
        $admin->assignRole('admin');
        $this->command->info('Admin pass:');
        $this->command->info($pass);
    }
}
