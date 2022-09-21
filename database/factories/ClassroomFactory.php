<?php

namespace Database\Factories;

// use Dotenv\Util\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ClassroomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            // 'teacher_id'=>1,
            'type_id'=>1,
            'name'=>"classroom".Str::random(10),
            'date'=>now()->addDays(2)->format('Y/m/d'),
            'time_start'=>now()->addHours(2)->toTimeString(),
            'time_end'=>now()->addHours(2)->toTimeString(),
    
        ];
    }
}
