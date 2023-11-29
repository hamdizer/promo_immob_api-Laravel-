<?php

namespace Database\Seeders;

use App\Models\Administrator;
use App\Models\Agency;
use App\Models\Announcement;
use App\Models\Client;
use App\Models\Contract;
use App\Models\Corporate;
use App\Models\Invoice;
use App\Models\RequestAgencyAccount;
use App\Models\RequestClientAccount;
use App\Models\Reservation;
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
        Client::factory(10)->create();
        Administrator::factory(10)->create();
        Agency::factory(10)->create();
        Corporate::factory(10)->create();
        Contract::factory(10)->create();
        Announcement::factory(10)->create();
        Reservation::factory(10)->create();
        RequestClientAccount::factory(10)->create();
        RequestAgencyAccount::factory(10)->create();

        Invoice::factory(10)->create();
        /*$this->call([
            ClientSeeder::class,
            AdministratorSeeder::class
        ]);*/
    }
}
