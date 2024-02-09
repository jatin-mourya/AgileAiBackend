<?php

namespace Database\Factories;

use App\Models\TeamStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeamStatusFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TeamStatus::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
           
			'teamstatus' => $this->faker->text()
        ];
    }
}
