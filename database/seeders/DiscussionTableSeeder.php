<?php

namespace Database\Seeders;

use App\Models\Discussion;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DiscussionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $t1 = 'oauth laravel passport';
        $t2= 'pagination vue js with laravel';
        $t3='react js front end developer';
        $t4= 'laravel error database log error';

        $d1 = [
            'title'=>$t1,
            'content'=> 'We previously reported the isolation of five strains of a thermophilic gliding organism. These strains are described here as a new genus and species',
            'channel_id'=>1,
            'user_id'=>2,
            'slug'=>Str::slug($t1, '-')
        ];
        $d2 = [
            'title'=>$t2,
            'content'=> 'he isolates can be readily distinguished from other thermophilic gliding bacteria as they are apparently unicellular aerobic filaments that grow optimally at 60°C',
            'channel_id'=>2,
            'user_id'=>1,
            'slug'=>Str::slug($t2, '-')
        ];
        $d3= [
            'title'=>$t3,
            'content'=> 'Their cell walls are similar in ultrastructure to those of gram-negative cells, but they are susceptible to penicillin',
            'channel_id'=>3,
            'user_id'=>3,
            'slug'=>Str::slug($t3, '-')
        ];
        $d4 = [
            'title'=>$t4,
            'content'=> 'Our isolates can be grown on a fully defined medium containing amino acids. Oxidation-versus-fermentation tests indicate that deamination takes place.',
            'channel_id'=>2,
            'user_id'=>1,
            'slug'=>Str::slug($t4, '-')
        ];

        Discussion::create($d1);
        Discussion::create($d2);
        Discussion::create($d3);
        Discussion::create($d4);

    }
}
