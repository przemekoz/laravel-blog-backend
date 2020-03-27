<?php

use App\ElementTagRelM2M;
use Illuminate\Database\Seeder;

class ElementTagMany2ManySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ElementTagRelM2M::truncate();

        for ($j = 0; $j < 5; $j++) {
            // And now, let's create a few element tag relation in our database:
            for ($i = 0; $i < 5; $i++) {
                ElementTagRelM2M::create([
                    'element_id' => $i + 1,
                    'elementtag_id' => $j + 1,
                ]);
            }
        }
        for ($j = 5; $j < 10; $j++) {
            for ($i = 0; $i < 5; $i++) {
                ElementTagRelM2M::create([
                    'element_id' => $i + 1,
                    'elementtag_id' => $j + 1,
                ]);
            }
        }
        for ($j = 10; $j < 15; $j++) {
            for ($i = 0; $i < 5; $i++) {
                ElementTagRelM2M::create([
                    'element_id' => $i + 1,
                    'elementtag_id' => $j + 1,
                ]);
            }
        }
    }
}
