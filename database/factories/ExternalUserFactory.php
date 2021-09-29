<?php

namespace Database\Factories;

use App\Models\ExternalUser;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


class ExternalUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ExternalUser::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'full_name' => $this->faker->name(),
            'address' => Str::random(100),
            'contact_no' =>  $this->faker->numerify('###-#######'),
            'profile_image' => 'avetar.jpg',
        ];
    }
}
