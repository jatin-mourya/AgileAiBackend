<?php

namespace Database\Factories;

use App\Models\Newusers;
use Illuminate\Database\Eloquent\Factories\Factory;

class NewusersFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Newusers::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'firstname' => $this->faker->firstname,
            'middlename' => $this->faker->middlename,
            'lastname' => $this->faker->lastname,
            'mobile_no' => $this->faker->mobile_no,
            'email' => $this->faker->email,
            'username' => $this->faker->username,
            'password' => $this->faker->password,
            'conformpassword' => $this->faker->conformpassword,
            'date_of_birth' => $this->faker->date_of_birth,
            'pan_no' => $this->faker->pan_no,
            'qualification' => $this->faker->qualification,
            'marital_status' => $this->faker->marital_status,
            'joining_date' => $this->faker->joining_date,
            'experience_in_year' => $this->faker->experience_in_year,
            'last_package' => $this->faker->last_package,
			'roles' => $this->faker->text()
        ];
    }
}
