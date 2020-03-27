<?php

use App\ElementTag;
use Illuminate\Database\Seeder;

class ElementTagSeeder extends Seeder
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
        ElementTag::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $faker = \Faker\Factory::create();

        // And now, let's create a few element tag in our database:
        for ($i = 0; $i < 20; $i++) {
            ElementTag::create([
                'title' => $faker->word,
            ]);
        }
    }
}
