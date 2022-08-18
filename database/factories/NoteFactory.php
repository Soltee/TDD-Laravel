<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Note>
 */
class NoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $user = Arr::random(User::indRandomOrder()->pluck('id')->toArray());
        return [
            'user_id'    => $user,
            'title'      => $this->faker()->unique()->title,
            'description' => $this->faker()->sentence(300)
        ];
    }
}
