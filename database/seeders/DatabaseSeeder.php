<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
		{
			Roles::factory()
			->times()
			->create();
		}

		{
			Newusers::factory()
			->times()
			->create();
		}
		
		{
			Groups::factory()
			->times()
			->create();
		}

		{
			Teams::factory()
			->times()
			->create();
		}

		{
			Projects::factory()
			->times()
			->create();
		}

		{
			Subprojects::factory()
			->times()
			->create();
		}

		{
			Regions::factory()
			->times()
			->create();
		}

		{
			Subregions::factory()
			->times()
			->create();
		}

		{
			Designations::factory()
			->times()
			->create();
		}
		{
			TeamStatus::factory()
			->times()
			->create();
		}
		{
			TeamleadersSeeder::factory()
			->times()
			->create();
		}
		{
			TeamdetailsSeeder::factory()
			->times()
			->create();
		}

		

		


    }
}
