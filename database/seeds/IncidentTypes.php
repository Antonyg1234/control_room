<?php

use Illuminate\Database\Seeder;
use App\Models\IncidentType;

class IncidentTypes extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        IncidentType::truncate();

        $incident_type_arr = [
            array(
                "name" => "Fire",
                "description" => ""
            ),
            array(
                "name" => "Building Collapsed",
                "description" => ""
            ),
            array(
                "name" => "Plumbing",
                "description" => ""
            ),
        ];

        $incident_type_arrs = IncidentType::all();
        if(count($incident_type_arrs) === 0){
            $incident_type_arrs = IncidentType::insert($incident_type_arr);
        }else{
            foreach($incident_type_arr as $incident_type_arrs_key => $incident_type_arrs_val){
                $get_incident_types = IncidentType::where('name', $incident_type_arrs_val['name'])->get();
                if(count($get_incident_types) === 0){
                    $inserted_incident_type_arr = IncidentType::create($incident_type_arrs_val);
                }
            }
        }
    }
}
