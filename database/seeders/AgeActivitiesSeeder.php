<?php

namespace Database\Seeders;

use App\Domain\Assessment\Models\AgeActivity;
use Illuminate\Database\Seeder;

class AgeActivitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0;$i<5;$i++){
            AgeActivity::create([
                'title'  =>  [
                    'en'    =>  'Age from '.($i+1).' to '.($i+2),
                    'ar'    =>  'العمر من '.($i+1).' إلى '.($i+2)
                ],
                'index' =>  $i
            ]);
        }
        echo 'Age Activities Created Successfully'.PHP_EOL;
    }
}
