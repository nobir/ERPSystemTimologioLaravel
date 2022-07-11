<?php

namespace Database\Seeders;

use App\Models\Address;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(100)->create();

        // Need a user to login
        $user = new User();
        $user->verified = 1;
        $user->verify_email = 0;
        $user->username = 'nobir';
        $user->type = 1; // CEO
        $user->status = 0;
        $user->name = 'Nobir Hossain';
        $user->email = 'nobirhossain3360@gmail.com';
        $user->password = Crypt::encrypt('password');
        $user->salary = 80000.00;
        $user->hire_date = now();

        $address = new Address();
        $address->local_address = 'Uttara';
        $address->police_station = 'Uttara';
        $address->city = 'Dhaka';
        $address->country = 'Bangladesh';
        $address->zip_code = '1230';
        $address->save();

        $user->address_id = $address->id;
        $user->station_id = 10;
        $user->save();
    }
}
