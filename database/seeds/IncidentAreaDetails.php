<?php

use Illuminate\Database\Seeder;
use App\Models\Zone;
use App\Models\Ward;
use App\Models\Location;
use App\Models\Building;
use App\Models\Tenant;

class IncidentAreaDetails extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Zone::truncate();
        Ward::truncate();
        Location::truncate();
        Building::truncate();
        Tenant::truncate();

        $zone_arr = [
                array(
                    "name" => "Zone 1"
                ),
                array(
                    "name" => "Zone 2"
                ),
                array(
                    "name" => "Zone 3"
                ),
                array(
                    "name" => "Zone 4"
                ),
                array(
                    "name" => "Zone 5"
                )
            ];

        $zone_arrs = Zone::all();
        if(count($zone_arrs) === 0){
            $inserted_zone_arrs = Zone::insert($zone_arr);
        }else{
            foreach($zone_arr as $zone_arrs_key => $zone_arrs_val){
                $get_zone = Zone::where('name', $zone_arrs_val['name'])->get();
                if(count($get_zone) === 0){
                    $inserted_zone_arr = Zone::create($zone_arrs_val);
                }
            }
        }
        $zone_arrs = Zone::all();
        
        if(count($zone_arrs) > 0){
            $i = 1;
            foreach($zone_arrs as $zone_arrs_val){
                $wards[] = array(
                    "zone_id" => $zone_arrs_val->id,
                    "name" => "Z".$zone_arrs_val->id."W".$i,
                );
                $i++;
                $wards[] = array(
                    "zone_id" => $zone_arrs_val->id,
                    "name" => "Z".$zone_arrs_val->id."W".$i,
                );
                $i++;
                $wards[] = array(
                    "zone_id" => $zone_arrs_val->id,
                    "name" => "Z".$zone_arrs_val->id."W".$i,
                );
                $i++;
            }

            $inserted_ward_arrs = Ward::insert($wards);
        }

        $wards = Ward::all();
        if(count($wards) > 0){
            $j = 1;
            foreach($wards as $wards_key => $wards_val){
                $location[] = array(
                    "ward_id" => $wards_val->id,
                    "name" => "W".$wards_val->id."Loc".$j
                );
                $j++;
                $location[] = array(
                    "ward_id" => $wards_val->id,
                    "name" => "W".$wards_val->id."Loc".$j
                );
                $j++;
            }
            $inserted_loc_arrs = Location::insert($location);
        }

        $locations = Location::all();

        if(count($locations) > 0){
            $i = 1;
            foreach($locations as $locations_key => $locations_val){
                $building[] = array(
                    "location_id" => $locations_val->id,
                    "ward_id" => $locations_val->ward_id,
                    "name" => "W".$locations_val->ward_id."Loc".$locations_val->id."B".$i
                );
                $i++;
                $building[] = array(
                    "location_id" => $locations_val->id,
                    "ward_id" => $locations_val->ward_id,
                    "name" => "W".$locations_val->ward_id."Loc".$locations_val->id."B".$i
                );
                $i++;
                $building[] = array(
                    "location_id" => $locations_val->id,
                    "ward_id" => $locations_val->ward_id,
                    "name" => "W".$locations_val->ward_id."Loc".$locations_val->id."B".$i
                );
                $i++;
                $building[] = array(
                    "location_id" => $locations_val->id,
                    "ward_id" => $locations_val->ward_id,
                    "name" => "W".$locations_val->ward_id."Loc".$locations_val->id."B".$i
                );
                $i++;
                $building[] = array(
                    "location_id" => $locations_val->id,
                    "ward_id" => $locations_val->ward_id,
                    "name" => "W".$locations_val->ward_id."Loc".$locations_val->id."B".$i
                );
                $i++;
            }
            $inserted_building_arrs = Building::insert($building);
        }

        $buildings = Building::all();

        if(count($buildings) > 0){
            $i = 1;
            foreach($buildings as $buildings_key => $buildings_val){
                $tenant[] = array(
                    "building_id" => $buildings_val->id,
                    "flat_no" => $buildings_val->id
                );
                $i++;
                $tenant[] = array(
                    "building_id" => $buildings_val->id,
                    "flat_no" => "B".$buildings_val->id."R".$i
                );
                $i++;
                $tenant[] = array(
                    "building_id" => $buildings_val->id,
                    "flat_no" => "B".$buildings_val->id."R".$i
                );
                $i++;
                $tenant[] = array(
                    "building_id" => $buildings_val->id,
                    "flat_no" => "B".$buildings_val->id."R".$i
                );
                $i++;
                $tenant[] = array(
                    "building_id" => $buildings_val->id,
                    "flat_no" => "B".$buildings_val->id."R".$i
                );
                $i++;
                $tenant[] = array(
                    "building_id" => $buildings_val->id,
                    "flat_no" => "B".$buildings_val->id."R".$i
                );
                $i++;
                $tenant[] = array(
                    "building_id" => $buildings_val->id,
                    "flat_no" => "B".$buildings_val->id."R".$i
                );
                $i++;
                $tenant[] = array(
                    "building_id" => $buildings_val->id,
                    "flat_no" => "B".$buildings_val->id."R".$i
                );
                $i++;
                $tenant[] = array(
                    "building_id" => $buildings_val->id,
                    "flat_no" => "B".$buildings_val->id."R".$i
                );
                $i++;
                $tenant[] = array(
                    "building_id" => $buildings_val->id,
                    "flat_no" => "B".$buildings_val->id."R".$i
                );
                $i++;
            }
            $inserted_tenant_arrs = Tenant::insert($tenant);
        }

    }
}
