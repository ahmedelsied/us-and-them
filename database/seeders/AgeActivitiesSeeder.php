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
        for($i=0;$i<6;$i++){
            AgeActivity::create([
                'title'  =>  [
                    'en'    =>  'Age from '.$i.' to '.($i+1),
                    'ar'    =>  'العمر من '.$i.' إلى '.($i+1)
                ],
                'index' =>  $i
            ]);
        }
        echo 'Age Activities Created Successfully'.PHP_EOL;
    }
}
