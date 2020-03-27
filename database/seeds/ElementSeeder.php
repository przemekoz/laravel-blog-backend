<?php

use App\Element;
use Illuminate\Database\Seeder;

class ElementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Let's truncate our existing records to start from scratch.
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Element::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $faker = \Faker\Factory::create();

        // And now, let's create a few elements in our database:
        for ($i = 0; $i < 50; $i++) {
            Element::create([
                'title' => $faker->sentence,
                'description' => $faker->paragraph,
            ]);
        }
    }
}
