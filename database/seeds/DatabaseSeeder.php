<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
        $table = new \App\Http\Models\SalesDetails();
        // Create a Faker object
        $faker = Faker\Factory::create();

        // Create 5 sentences
        foreach( range(1, 850) as $item )
        {
            $table->create([
                'SalesID' => 118,
                'SupplierID' => rand(1, 1000),
                'ProductID' => rand(1, 1000) ,
                'Commision' => rand(1, 250) ,
                'Weight' => rand(1, 250) ,
                'WeightType' => rand(0, 1) ,
                'Quantity' => rand(1, 250) ,
                'ProductPrice' => rand(1, 250) ,
                'Total' => rand(150, 750) ,
                'Carrying' => rand(1, 250) ,

            ]);
        }
    }

}
/*
 *
Title with 3 words
            'title' => $faker->sentence(3),
 *
Content with 4 sentences
            'content' => $faker->paragraph(4),
 *
Date between now and two weeks earlier
            'created_at' => $faker->dateTimeBetween('now', '+14 days')

*/