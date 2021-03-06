<?php

use Illuminate\Database\Seeder;

use App\Model\Vehicle;

class VehicleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$vehicles = [

['name' => '86 2.0 A/T'],
['name' => '86 2.0 A/T (WHITE PEARL)'],
['name' => '86 2.0 AERO A/T'],
['name' => '86 2.0 AERO A/T (WHITE PEARL)'],
['name' => '86 2.0 AERO M/T'],
['name' => '86 2.0 AERO M/T (WHITE PEARL)'],
['name' => '86 2.0 M/T'],
['name' => '86 2.0 M/T (WHITE PEARL)'],
['name' => 'ALPHARD 2.4 GAS A/T'],
['name' => 'ALPHARD 2.4 GAS A/T (WHITE PEARL)'],
['name' => 'ALPHARD 3.5 GAS A/T'],
['name' => 'ALPHARD 3.5 GAS A/T (WHITE PEARL)'],
['name' => 'ALTIS 1.6E M/T'],
['name' => 'ALTIS 1.6G A/T'],
['name' => 'ALTIS 1.6G M/T'],
['name' => 'ALTIS 1.6V A/T (PEARL)'],
['name' => 'ALTIS 1.6V A/T (STD)'],
['name' => 'ALTIS 2.0V A/T (PEARL)'],
['name' => 'ALTIS 2.0V A/T (STD)'],
['name' => 'AVANZA 1.3 E A/T'],
['name' => 'AVANZA 1.3 E M/T'],
['name' => 'AVANZA 1.3 J M/T'],
['name' => 'AVANZA 1.5 G A/T'],
['name' => 'AVANZA 1.5 G M/T'],
['name' => 'AVANZA 1.5 VELOZ A/T'],
['name' => 'CAMRY 2.5 G A/T'],
['name' => 'CAMRY 2.5 G A/T (WHITE PEARL)'],
['name' => 'CAMRY 2.5 S A/T'],
['name' => 'CAMRY 2.5 S A/T (WHITE PEARL)'],
['name' => 'CAMRY 2.5 V A/T'],
['name' => 'CAMRY 2.5 V A/T (WHITE PEARL)'],
['name' => 'CAMRY 3.5 V6 A/T'],
['name' => 'CAMRY 3.5 V6 A/T (WHITE PEARL)'],
['name' => 'COASTER 30 - SEATER DSL M/T'],
['name' => 'FORTUNER 4X2 2.4 G DSL A/T'],
['name' => 'FORTUNER 4X2 2.4 G DSL MT'],
['name' => 'FORTUNER 4X2 2.4 TRD DSL A/T'],
['name' => 'FORTUNER 4X2 2.4 TRD DSL A/T (W. PEARL)'],
['name' => 'FORTUNER 4X2 2.4 V DSL A/T'],
['name' => 'FORTUNER 4X2 2.4 V DSL A/T (W.PEARL)'],
['name' => 'FORTUNER 4X2 2.5 G DSL A/T'],
['name' => 'FORTUNER 4X2 2.5 G DSL MT'],
['name' => 'FORTUNER 4X2 2.5 V DSL A/T'],
['name' => 'FORTUNER 4X2 2.5 V DSL A/T (W.PEARL)'],
['name' => 'FORTUNER 4X2 2.7 G GAS A/T'],
['name' => 'FORTUNER 4X4  3.0 V DSL A/T'],
['name' => 'FORTUNER 4X4  3.0 V DSL A/T (W.PEARL)'],
['name' => 'FORTUNER 4X4 2.8 V DSL A/T'],
['name' => 'FORTUNER 4X4 2.8 V DSL A/T (W.PEARL)'],
['name' => 'HIACE 2.5 A/T MONOTONE'],
['name' => 'HIACE 2.5 M/T MONOTONE'],
['name' => 'HIACE COMMUTER 2.5 M/T'],
['name' => 'HIACE COMMUTER 3.0 M/T'],
['name' => 'HIACE GL GRANDIA 2-TONE'],
['name' => 'HIACE GL GRANDIA 2-TONE'],
['name' => 'HIACE GL GRANDIA 3.0 A/T 2-TONE'],
['name' => 'HIACE GL GRANDIA 3.0 A/T MONOTONE'],
['name' => 'HIACE GL GRANDIA 3.0 M/T 2-TONE'],
['name' => 'HIACE GL GRANDIA 3.0 M/T MONOTONE'],
['name' => 'HIACE SUPER GRANDIA 2.5 A/T (FABRIC) 2-TONE'],
['name' => 'HIACE SUPER GRANDIA 2.5 A/T (FABRIC) MONOTONE'],
['name' => 'HIACE SUPER GRANDIA 2.5 A/T 2-TONE'],
['name' => 'HIACE SUPER GRANDIA 2.5 A/T MONOTONE'],
['name' => 'HIACE SUPER GRANDIA 3.0 A/T FABRIC 2-TONE'],
['name' => 'HIACE SUPER GRANDIA 3.0 A/T FABRIC MONOTONE'],
['name' => 'HIACE SUPER GRANDIA 3.0 A/T LEATHER 2-TONE'],
['name' => 'HIACE SUPER GRANDIA 3.0 A/T LEATHER MONOTONE'],
['name' => 'HIACE SUPER GRANDIA 3.0 A/T LXV'],
['name' => 'HIACE SUPER GRANDIA 3.0 A/T LXV (WHITE PEARL)'],
['name' => 'HILUX 4 X 2 2.4 CONQUEST DSL A/T'],
['name' => 'HILUX 4 X 2 2.4 CONQUEST DSL M/T'],
['name' => 'HILUX 4 X 2 2.4 E DSL M/T'],
['name' => 'HILUX 4 X 2 2.4 G DSL A/T'],
['name' => 'HILUX 4 X 2 2.4 G DSL M/T'],
['name' => 'HILUX 4 X 2 2.4 J DSL M/T'],
['name' => 'HILUX 4 X 2 2.5 E DSL M/T'],
['name' => 'HILUX 4 X 2 2.5 G DSL A/T'],
['name' => 'HILUX 4 X 2 2.5 G DSL M/T'],
['name' => 'HILUX 4 X 2 2.5 J DSL M/T'],
['name' => 'HILUX 4 X 2 CAB & CHASSIS'],
['name' => 'HILUX 4 X 4  3.0 G DSL A/T'],
['name' => 'HILUX 4 X 4  3.0 G DSL M/T'],
['name' => 'HILUX 4 X 4 2.4 E DSL M/T'],
['name' => 'HILUX 4 X 4 2.8 CONQUEST DSL A/T'],
['name' => 'HILUX 4 X 4 2.8 CONQUEST DSL M/T'],
['name' => 'HILUX 4 X 4 2.8 G DSL A/T'],
['name' => 'HILUX 4 X 4 2.8 G DSL M/T'],
['name' => 'HILUX HSPU W/O RR A/C'],
['name' => 'HILUX HSPU WITH RR A/C'],
['name' => 'INNOVA 2.0 E GAS A/T'],
['name' => 'INNOVA 2.0 E GAS M/T'],
['name' => 'INNOVA 2.0 G GAS A/T'],
['name' => 'INNOVA 2.0 G GAS A/T (WP)'],
['name' => 'INNOVA 2.0 G GAS M/T'],
['name' => 'INNOVA 2.0 G GAS M/T (WP)'],
['name' => 'INNOVA 2.0 J GAS M/T'],
['name' => 'INNOVA 2.0 V GAS A/T'],
['name' => 'INNOVA 2.0 V GAS A/T (WP)'],
['name' => 'INNOVA 2.5 E DSL A/T'],
['name' => 'INNOVA 2.5 E DSL M/T'],
['name' => 'INNOVA 2.5 G DSL A/T'],
['name' => 'INNOVA 2.5 G DSL A/T (WP)'],
['name' => 'INNOVA 2.5 G DSL M/T'],
['name' => 'INNOVA 2.5 G DSL M/T (WP)'],
['name' => 'INNOVA 2.5 J DSL M/T'],
['name' => 'INNOVA 2.5 V DSL A/T'],
['name' => 'INNOVA 2.5 V DSL A/T (WP)'],
['name' => 'INNOVA 2.8 E DSL A/T'],
['name' => 'INNOVA 2.8 E DSL M/T'],
['name' => 'INNOVA 2.8 G DSL A/T'],
['name' => 'INNOVA 2.8 G DSL A/T (WP)'],
['name' => 'INNOVA 2.8 G DSL M/T'],
['name' => 'INNOVA 2.8 G DSL M/T (WP)'],
['name' => 'INNOVA 2.8 J DSL M/T'],
['name' => 'INNOVA 2.8 TOURING SPORT A/T'],
['name' => 'INNOVA 2.8 TOURING SPORT M/T'],
['name' => 'INNOVA 2.8 V DSL A/T'],
['name' => 'INNOVA 2.8 V DSL A/T (WP)'],
['name' => 'LAND CRUISER FJ CRUISER 4.0L V6'],
['name' => 'LAND CRUISER LC200 4.5 DSL A/T  (12 MC)'],
['name' => 'LAND CRUISER LC200 4.5 DSL A/T WP (12 MC)'],
['name' => 'LAND CRUISER LC200 PREMIUM 4.5 DSL A/T'],
['name' => 'LAND CRUISER LC200 PREMIUM 4.5 DSL A/T WP'],
['name' => 'LAND CRUISER PRADO 3.0 A/T'],
['name' => 'LAND CRUISER PRADO 3.0 A/T WP'],
['name' => 'LAND CRUISER PRADO 3.0 M/T'],
['name' => 'LAND CRUISER PRADO 3.0 M/T WP'],
['name' => 'LAND CRUISER PRADO 4.0L V6'],
['name' => 'LAND CRUISER PRADO 4.0L V6 WP'],
['name' => 'LEXUS CT200H 1.8L HYBRID'],
['name' => 'LEXUS CT200H 1.8L HYBRID F-SPORT'],
['name' => 'LEXUS CT200H CT200H'],
['name' => 'LEXUS CT200H CT200H SPORT'],
['name' => 'LEXUS ES 350 3.5L V6'],
['name' => 'LEXUS GS 350 3.5L V6 F-SPORT'],
['name' => 'LEXUS GS 351 3.5L V6'],
['name' => 'LEXUS GS 450H 3.5L V6 HYBRID'],
['name' => 'LEXUS GS F 5.0L V8'],
['name' => 'LEXUS GX 460 4.6L V8'],
['name' => 'LEXUS IS 300C 3.0L V6 CONVERTIBLE'],
['name' => 'LEXUS IS 350 3.5L V6'],
['name' => 'LEXUS IS 350 3.5L V6 F-SPORT'],
['name' => 'LEXUS IS 351 3.5L V6'],
['name' => 'LEXUS LC500 5.0L V8'],
['name' => 'LEXUS LS 460  4.6L 4 -SEATER'],
['name' => 'LEXUS LS 461 4.6L 5-SEATER'],
['name' => 'LEXUS LS500 3.5L 4 -SEATER'],
['name' => 'LEXUS LS500 3.5L 5-SEATER'],
['name' => 'LEXUS LS500H 3.5L 4 -SEATER'],
['name' => 'LEXUS LS500H 3.5L 5-SEATER'],
['name' => 'LEXUS LS600H 5.0L 4 -SEATER'],
['name' => 'LEXUS LS600H 5.0L 5-SEATER'],
['name' => 'LEXUS LX 570 5.7L V8'],
['name' => 'LEXUS RC 350 3.5L V6'],
['name' => 'LEXUS RC-F 5.0L V8'],
['name' => 'LEXUS RC-F CARBON PACKAGE 5.0L V8'],
['name' => 'LEXUS RX 350 3.5L V6 FULL OPT'],
['name' => 'LEXUS RX 350 3.5L V6 PREMIER'],
['name' => 'LEXUS RX 351 3.5L V6'],
['name' => 'LEXUS RX 450H 3.5L V6 HYBRID'],
['name' => 'PREVIA 2.4 GAS A/T'],
['name' => 'PREVIA 2.4 GAS A/T (WHITE PEARL)'],
['name' => 'PREVIA 2.4 Q GAS A/T'],
['name' => 'PREVIA 2.4 Q GAS A/T (WHITE PEARL)'],
['name' => 'PRIUS 1.8 HYBRID'],
['name' => 'PRIUS 1.8 HYBRID (WHITE PEARL)'],
['name' => 'PRIUS-C FULL OPT'],
['name' => 'PRIUS-C FULL OPT (WP)'],
['name' => 'PRIUS-C STD'],
['name' => 'PRIUS-C STD (WP)'],
['name' => 'RAV4 4X2 2.5 ACTIVE'],
['name' => 'RAV4 4X2 2.5 ACTIVE (W. PEARL)'],
['name' => 'RAV4 4X2 2.5 ACTIVE+'],
['name' => 'RAV4 4X2 2.5 ACTIVE+ (W. PEARL)'],
['name' => 'RAV4 4X2 2.5 FULL OPTION GAS A/T'],
['name' => 'RAV4 4X2 2.5 FULL OPTION GAS A/T (W. PEARL)'],
['name' => 'RAV4 4X2 2.5 GAS A/T'],
['name' => 'RAV4 4X2 2.5 GAS A/T (W. PEARL)'],
['name' => 'RAV4 4X2 2.5 PREMIUM'],
['name' => 'RAV4 4X2 2.5 PREMIUM (W. PEARL)'],
['name' => 'RAV4 4X4  2.5 GAS A/T'],
['name' => 'RAV4 4X4  2.5 GAS A/T (W. PEARL)'],
['name' => 'RAV4 4X4 2.5 PREMIUM'],
['name' => 'RAV4 4X4 2.5 PREMIUM (W. PEARL)'],
['name' => 'RUSH 1.5 E A/T'],
['name' => 'RUSH 1.5 E M/T'],
['name' => 'RUSH 1.5 G A/T'],
['name' => 'TOYOTA COASTER 29 - SEATER DSL M/T'],
['name' => 'VIOS 1.3 BASE MT'],
['name' => 'VIOS 1.3 E A/T'],
['name' => 'VIOS 1.3 E M/T'],
['name' => 'VIOS 1.3 E+ A/T'],
['name' => 'VIOS 1.3 E+ M/T'],
['name' => 'VIOS 1.3 J M/T'],
['name' => 'VIOS 1.5 G A/T'],
['name' => 'VIOS 1.5 G A/T (WHITE PEARL)'],
['name' => 'VIOS 1.5 G M/T'],
['name' => 'VIOS 1.5 G M/T (WHITE PEARL)'],
['name' => 'VIOS 1.5 G+ A/T'],
['name' => 'VIOS 1.5 G+ A/T (WHITE PEARL)'],
['name' => 'WIGO 1.0 E M/T'],
['name' => 'WIGO 1.0 G A/T'],
['name' => 'WIGO 1.0 G M/T'],
['name' => 'YARIS 1.3 E A/T'],
['name' => 'YARIS 1.3 E M/T'],
['name' => 'YARIS 1.5 A/T'],
['name' => 'YARIS 1.5 M/T'],
['name' => 'YARIS 1.5 S A/T'],


        ];

        foreach ($vehicles as $vehicle) {
		    $model = new Vehicle($vehicle);
		    $model->save();
		}
    
    }
}
