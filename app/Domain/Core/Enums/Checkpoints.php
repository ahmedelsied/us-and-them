<?php

namespace App\Domain\Core\Enums;

use Spatie\Enum\Laravel\Enum;

/**
 * @method static self application()
 * @method static self test()
 * @method static self result()
 * @method static self treatment()
 * @method static self development()
 * @method static self end()
 */
class Checkpoints extends Enum
{
    protected static function values(): array
    {
        return [
            'application'   =>  'CHECKPOINT_APPLICATION',
            'test'          =>  'CHECKPOINT_TEST',
            'result'        =>  'CHECKPOINT_RESULT',
            'treatment'     =>  'CHECKPOINT_TREATMENT',
            'development'   =>  'CHECKPOINT_DEVELOPMENT',
            'end'           =>  'CHECKPOINT_END'
        ];
    }
}