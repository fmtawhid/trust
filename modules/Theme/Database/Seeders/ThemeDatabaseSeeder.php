<?php

namespace Modules\Theme\Database\Seeders;

use Illuminate\Database\Seeder;

class ThemeDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ThemeSeederTableSeeder::class);
    }
}
