<?php

namespace App\Http\Controllers;

use App\Ambient;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Scan;
use App\Sensor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class ScanController extends Controller
{

	/**
     * Instantiate a new ScanController instance.
     *
     * @return void
     */
	public function __construct()
	{
		$this->middleware('auth');
	}


	/**
	 * Display a listing of the scans.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(){
		$scans = Scan::where('date',Carbon::today())->orderBy('date','desc')->orderBy('time','desc')->paginate(30);
		return view('scans.index',['scans' => $scans]);
	}

	/**
	 * Display the specified scans by id_sensor
	 * @param  App\Sensor $idSensor [id of the sensor]
	 * @return Collection of App\Scan
	 */
	public function indexBySensor($idSensor = null){
		if($idSensor == null){
			$idSensor = Scan::first()->id_sensor;
		}
		$sensor = Sensor::findOrFail($idSensor);
		$scans = Scan::where('id_sensor',$idSensor)->orderBy('date','desc')->orderBy('time','desc')->paginate(50);

		$sensors = Sensor::all();
		return view('scans.indexBySensor',['scans' => $scans, 'selected_sensor' => $sensor, 'sensors' => $sensors]);
	}

	/**
	 * Display the specified scans by id_ambient
	 * @param  App\Ambient $idAmbient [id of the ambient]
	 * @return Collection of App\Scan
	 */
	public function indexByAmbient($idAmbient = null){
		if($idAmbient == null){	
			$idAmbient = Ambient::first()->id_ambient;
		}
		$scans = Scan::where('id_ambient',$idAmbient)->orderBy('date','desc')->orderBy('time','desc')->paginate(50);
		$ambients = Ambient::all();
		return view('scans.indexByAmbient',['scans' => $scans, 'selected_ambient' => Ambient::find($idAmbient), 'ambients' => $ambients]);
	}

	/**
	 * Display all the scans
	 * @return Collection of App\Scan
	 */
	public function indexAll(){
		$scans = Scan::orderBy('date','desc')->orderBy('time','desc')->paginate(30);
		return view('scans.indexAll',['scans' => $scans, 'initialDate' => null, 'endDate' => null]);
	}

	/**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $scan = Scan::findOrFail($id);
        return view('scans.show',['scan' => $scan]);
    }

	/**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    	if(Auth::user()->isAdmin()){
	        $scan = Scan::findOrFail($id);
	        $scan->delete();
	        return Redirect::to('admin/scan/all')->with('successMessage','A leitura foi excluida com sucesso do banco de dados.');
	    }else{
	    	return Redirect::back();
	    }
    }

    /**
     * Display scans by a specific interval of dates
     * @param  Request $request [Form request with initial and end dates]
     * @return App\Scan         [List of scans by specific dates]
     */
    public function getScansByDates(Request $request){
    	$initialDate = $request->input('initialDate');
    	$endDate = $request->input('endDate');
    	$initialDate = Carbon::parse($initialDate);
    	$endDate = Carbon::parse($endDate);
    	$scans = Scan::where('date','>=',$initialDate->format('Y-m-d'))
    			->where('date','<=',$endDate->format('Y-m-d'))
    			->orderBy('date','desc')
    			->orderBy('time','desc')
    			->paginate(30);
    	return view('scans.indexAll',['scans' => $scans, 'initialDate' => $request->input('initialDate'), 'endDate' => $request->input('endDate')]);
    }
}
