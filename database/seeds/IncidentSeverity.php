<?php

use Illuminate\Database\Seeder;
use App\Models\Severity;

class IncidentSeverity extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Severity::truncate();

        $incident_severity_arr = [
            array(
                "name" => "Critical"
            ),
            array(
                "name" => "Normal"
            ),
            array(
                "name" => "Minor"
            ),
        ];

        $incident_severity_arrs = Severity::all();
        if(count($incident_severity_arrs) === 0){
            $incident_severity_arrs = Severity::insert($incident_severity_arr);
        }else{
            foreach($incident_severity_arr as $incident_severity_arrs_key => $incident_severity_arrs_val){
                $get_incident_severity = Severity::where('name', $incident_severity_arrs_val['name'])->get();
                if(count($get_incident_severity) === 0){
                    $inserted_incident_severity_arr = Severity::create($incident_severity_arrs_val);
                }
            }
        }
    }
}
