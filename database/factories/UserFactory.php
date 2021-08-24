<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $sex = $this->faker->randomElement(['male', 'female']);
        $position = $this->faker->randomElement(['Admin', 'Employee']);
        $last_name = $this->faker->lastName;
        $password = $last_name."123";

        return [
            'first_name' => $this->faker->firstName,
            'middle_name' => $this->faker->lastName,
            'last_name' => $last_name,
            'position' => $position,
            'sex' => $sex,
            'email' => $this->faker->unique()->safeEmail(),
            'password' => $password, // password
        ];
    }

}
