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
        return [
            'firstname' => $this->faker->firstname,
            'middlename' => $this->faker->middlename,
            'lastname' => $this->faker->lastname,
            'mobile_no' => $this->faker->mobile_no,
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'date_of_birth' => $this->faker->date_of_birth,
            'pan_no' => $this->faker->pan_no,
            'qualification' => $this->faker->qualification,
            'marital_status' => $this->faker->marital_status,
            'joining_date' => $this->faker->joining_date,
            'experience_in_year' => $this->faker->experience_in_year,
            'last_package' => $this->faker->last_package,
			'designation' => $this->faker->text(),
            'remember_token' => $this->faker->remember_token,
            'permanant_address' => $this->faker->permanant_address,
            'current_address' => $this->faker->current_address,
            'home_contactno' => $this->faker->home_contactno,
            'resignation_date' => $this->faker->resignation_date,
            'status_id' => $this->faker->status_id,
            'experience_in_months' => $this->faker->experience_in_months,
            'privious_companyprivious_company_contactname_name' => $this->faker->privious_company_contactname,
            'privious_company_contact' => $this->faker->privious_company_contact,
            'source' => $this->faker->source,
            'source_by' => $this->faker->source_by,
            'remark_by_HR'=> $this->faker->remark_by_HR
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
