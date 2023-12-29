<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'password' => Hash::make('123456'), // Ghi nhớ phải mã hóa mật khẩu
            'gender' => $this->faker->randomElement(['male', 'female']),
            'birthday' => $this->faker->date(),
            'phone_number' => $this->faker->regexify('[0-9]{10}'),
            'email' => $this->faker->unique()->safeEmail,
            'hometown' => $this->faker->city,
            'address' => $this->faker->address,
            'workplace' => $this->faker->company,
            'level_id' => $this->faker->numberBetween(1, 5),
            'remember_token' => Str::random(10),
            'email_verified_at' => now(), // Hoặc có thể để giá trị null
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
