<?php

namespace Database\Factories;

use Faker\Factory as FakerFactory;
use Faker\Generator;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeacherFactory extends Factory
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
            'name'=>$this->faker->name(),
            'secret'=>'123456'
        ];
    }

    /**
 * Indicate that the user is suspended.
 *
 * @return \Illuminate\Database\Eloquent\Factories\Factory
 */
public function upTheNameLol()
{
    return $this->state(function (array $attributes) {
        return [
            'name' => strtoupper($attributes['name']),
        ];
    });
}
}
