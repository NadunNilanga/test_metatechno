<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ExternalUser;

class ExternalUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ExternalUser::factory()
            ->count(1000)
            ->create();
    }
}
