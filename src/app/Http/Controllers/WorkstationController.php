<?php

namespace App\Http\Controllers;

use App\Workstation;
use Illuminate\Http\Request;

class WorkstationController extends Controller
{
    public function index()
    {
        $workstations = Workstation::all();

        return view('workstations/index', [
            'workstations' => $workstations,
        ]);
    }

    public function create()
    {
        return view('workstations/create');
    }

    public function store(Request $request)
    {
        $known_hosts = [
            'wm1.orlen.pl' => [
                'cpu' => 4,
                'ram' => 8,
                'hdd' => 200
            ],
        ];

        $db_workstation = Workstation::where('fqdn', $request->input('hostname'))->first();
        $static_workstation = null;

        if(array_key_exists($request->input('hostname'), $known_hosts))
            $static_workstation = $known_hosts[$request->input('hostname')];
        
        $destination_id = -1;
        
        if($db_workstation != null) {
           
            $destination_id = $db_workstation->id;

        } else if ($static_workstation != null) {

            $workstation = new Workstation();
            $workstation->FQDN = $request->input('hostname');
            $workstation->fill( $static_workstation );
            $workstation->save();
            
            $destination_id = $workstation->id;
        }

        $destination = action('WorkstationController@invalidHost');

        if($destination_id > 0)
            $destination = action('WorkstationController@show', ['workstation' => $destination_id]);

        return response()->view('workstations/store', [
            'destination_id' => $destination_id,
            'hostname' => $request->input('hostname'),
        ])->header("Refresh", "5;url=".$destination);
    }

    public function show(Workstation $workstation)
    {
        return view('workstations/show', [
            'workstation' => $workstation,
        ]);
    }

    public function edit(Workstation $workstation)
    {
        // TODO: Remove
    }

    public function update(Request $request, Workstation $workstation)
    {
        // TODO: Remove
    }

    public function destroy(Workstation $workstation)
    {
        // TODO
    }

    public function invalidHost(){
        return view('workstations/invalid');
    }

    public function postJSON(Request $request){
        $workstation = new Workstation();
        $workstation->FQDN = $request->input('fqdn');

        // Parameters
        foreach(Workstation::params() as $param => $options){

            if(!$request->has($param)) continue;

            $value = $request->input($param);

            if($options['type'] == 'number')
                $value = round(str_replace(',', '.', $value));
            
            $workstation->setAttribute($param, $value);

        }

        $workstation->save();

        return;
    }
}
