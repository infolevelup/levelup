<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Blog;
use Faker\Generator as Faker;

$factory->define(Blog::class, function (Faker $faker) {
    return [
        //
    ];
    

    /**
     * Define the model's default state.
     *
     * @return array
     */
    
        return [
            'title' => $this->faker->name,
            'slug' => $this->faker->name,
            'date'=>$this->faker->text,
            'description'=>$this->faker->text,
        ];

});
