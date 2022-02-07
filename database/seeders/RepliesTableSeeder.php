<?php

namespace Database\Seeders;

use App\Models\Reply;
use Illuminate\Database\Seeder;

class RepliesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $r1 = [
            'user_id' => 1,
            'discussion_id' => 1,
            'content' => 'Duplexque isdem diebus acciderat malum, quod et Theophilum insontem atrox interceperat casus'
        ];
        $r2 = [
            'user_id' => 2,
            'discussion_id' => 2,
            'content' => 'et Serenianus dignus exsecratione cunctorum, innoxius, modo non reclamante publico vigore, discessit.'
        ];
        $r3 = [
            'user_id' => 3,
            'discussion_id' => 3,
            'content' => 'This text randomly generated (lorem ipsum) can be used in your layout (webdesign, websites, books, posters ...) for free. This text is entirely free of law.'
        ];
        $r4 = [
            'user_id' => 1,
            'discussion_id' => 2,
            'content' => 'Orientis vero limes in longum protentus et rectum ab Euphratis fluminis ripis ad usque supercilia porrigitur Nili, laeva Saracenis conterminans gentibus, dextra pelagi fragoribus patens'
        ];

        Reply::create($r1);
        Reply::create($r2);
        Reply::create($r3);
        Reply::create($r4);
    }
}
