<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
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
        return [
            'name' => fake()->name() , 
            'email' => fake()->unique()->safeEmail() , 
            'subject' => fake()->sentence(1), 
            'message' => fake()->paragraph(5), 
            'phone' => fake()->unique()->phoneNumber() , 
            'ip_address' => fake()->ipv4(), 
        ];
    }
}
