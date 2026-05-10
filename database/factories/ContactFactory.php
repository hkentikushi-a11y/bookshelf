<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    public function definition(): array
    {
        $tel1 = $this->faker->numerify('0##');
        $tel2 = $this->faker->numerify('####');
        $tel3 = $this->faker->numerify('####');

        return [
            'category_id' => Category::inRandomOrder()->first()->id ?? 1,
            'first_name'  => $this->faker->firstName(),
            'last_name'   => $this->faker->lastName(),
            'gender'      => $this->faker->numberBetween(1, 3),
            'email'       => $this->faker->unique()->safeEmail(),
            'tel'         => $tel1 . '-' . $tel2 . '-' . $tel3,
            'address'     => $this->faker->address(),
            'building'    => $this->faker->optional()->secondaryAddress(),
            'detail'      => $this->faker->realText(80),
        ];
    }
}
