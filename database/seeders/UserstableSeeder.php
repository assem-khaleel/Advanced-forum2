<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\URL;

class UserstableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=> 'assem al jimzawi',
            'password'=> bcrypt('0000123assem'),
            'email'=>'assem.cs.90@gmail.com',
            'admin'=>1,
            'avatar'=>asset('avatars/avatar.jpeg')
        ]);
        User::create([
            'name'=> 'Admin',
            'password'=> bcrypt('0000123assem'),
            'email'=>'admin@gmail.com',
            'avatar'=>asset('avatars/dddd.jpg')
        ]);
        User::create([
            'name'=> 'hani',
            'password'=> bcrypt('0000123assem'),
            'email'=>'hani@gmail.com',
            'avatar'=>asset('avatars/sss.png')
        ]);
    }
}
