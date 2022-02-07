<?php

namespace Database\Seeders;

use App\Models\Channel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ChannelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $channels = ['Javascript','React js','Laravel 9'];

        foreach ($channels as $channel){
            Channel::create([
                'title' => $channel,
                'slug' => Str::slug($channel, '-')
            ]);
         }
    }
}
