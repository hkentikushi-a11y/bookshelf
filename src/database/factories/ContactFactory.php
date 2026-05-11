<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Contact>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tel1 = $this->faker->numerify('0##');
        $tel2 = $this->faker->numerify('####');
        $tel3 = $this->faker->numerify('####');

        return [
            'category_id' => $this->faker->numberBetween(1, 5),
            'first_name'  => $this->faker->lastName(),
            'last_name'   => $this->faker->firstName(),
            'gender'      => $this->faker->numberBetween(1, 3),
            'email'       => $this->faker->unique()->safeEmail(),
            'tel'         => $tel1 . $tel2 . $tel3,
            'address'     => $this->faker->address(),
            'building'    => $this->faker->optional()->secondaryAddress(),
            'detail'      => $this->faker->realText(100),
        ];
    }
}
