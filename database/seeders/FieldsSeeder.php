<?php

namespace Database\Seeders;

use App\Domain\Assessment\Models\AgeActivity;
use App\Domain\Assessment\Models\Field;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FieldsSeeder extends Seeder
{
    private $fields = [
        [
            'name'  =>  [
                'en'    =>  'motion field',
                'ar'    =>  'المجال الحركي'
            ],
            'age_activity_id'   =>  null
        ],
        [
            'name'  =>  [
                'en'    =>  'self help',
                'ar'    =>  'المساعدة الذاتية'
            ],
            'age_activity_id'   =>  null
        ],
        [
            'name'  =>  [
                'en'    =>  'social contact',
                'ar'    =>  'المخالطة الاجتماعية'
            ],
            'age_activity_id'   =>  null
        ],
        [
            'name'  =>  [
                'en'    =>  'Cognitive field',
                'ar'    =>  'المجال المعرفي'
            ],
            'age_activity_id'   =>  null
        ],
        [
            'name'  =>  [
                'en'    =>  'linguistic field',
                'ar'    =>  'المجال اللغوي'
            ],
            'age_activity_id'   =>  null
        ],

    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ageActivities = AgeActivity::all();
        foreach($ageActivities as $index => $ageActivity){
            foreach($this->fields as $field){
                $ageActivity->fields()->create([
                    'name'  =>  [
                        'en'    =>  $field['name']['en'],
                        'ar'    =>  $field['name']['ar']
                    ]
                ]);
            }

        }
    }
}
