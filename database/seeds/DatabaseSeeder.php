<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        // companies 150
        factory(App\Company::class, 80)->create();

        // personen 150
        factory(App\Person::class, 70)->create();

    }
}
