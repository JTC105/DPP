<?php

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
        $this->call(RolesTableSeeder::class);
        $this->call(DealerInfoTableSeeder::class);
        $this->call(PolicyTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(FormTemplateTableSeeder::class);
        $this->call(BookingGuidelineSeeder::class);
        $this->call(VehicleTableSeeder::class);
        $this->call(OutoftownTableSeeder::class);
        $this->call(CustomFieldRefTableSeeder::class);
        $this->call(CustomFieldTableSeeder::class);
        $this->call(TFSPHSignatoryDetailTableSeeder::class);
        

        $this->call(TFSPHSignatoriesTableSeeder::class);
        $this->call(FeesCustomTableSeeder::class);
        $this->call(PNCMFeesDealerRefTableSeeder::class);
        
        $this->call(PNCMFeesRetailTable1TableSeeder::class);
        $this->call(PNCMFeesRetailTable2TableSeeder::class);
        $this->call(PNCMFeesRetailTable3TableSeeder::class);

        $this->call(RegFeeTwoPartyTableSeeder::class);
        $this->call(RegFeeThreePartyTableSeeder::class);

        // $this->call(CityMunTableSeeder::class); // by sets (5 sets)

    }
}
