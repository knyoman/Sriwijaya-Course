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
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'username' => fake()->userName(),
            'nama' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'kata_sandi' => static::$password ??= Hash::make('password123'),
            'peran' => fake()->randomElement(['pelajar', 'pengajar', 'admin']),
            'alamat' => fake()->address(),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * State untuk pelajar
     */
    public function pelajar(): static
    {
        return $this->state(fn(array $attributes) => [
            'peran' => 'pelajar',
        ]);
    }

    /**
     * State untuk pengajar
     */
    public function pengajar(): static
    {
        return $this->state(fn(array $attributes) => [
            'peran' => 'pengajar',
        ]);
    }

    /**
     * State untuk admin
     */
    public function admin(): static
    {
        return $this->state(fn(array $attributes) => [
            'peran' => 'admin',
        ]);
    }
}
