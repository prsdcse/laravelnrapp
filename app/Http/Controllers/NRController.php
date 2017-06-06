<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use GuzzleHttp\Client;


class NRController extends Controller
{
    public function index() {

		$apikey = "689169d9f6d582b62b94139ad92284a850e8e120e5aabef";
		
		//Specify an existing New Relic app name OR app ID
		$app_name = "laravelnrapp";
		$app_id = "20273781";
		
		$dep_description = "This is your app id deployment";
		$dep_change = "This is a change log entry";
		$dep_user = "This is the user entry";
		$dep_rev = "This is a version number";
		
		//compose the data string for curl
		
		$dep_dat = "deployment[app_name]=".$app_name;

		$dep_dat = $dep_dat."&deployment[app_id]=".$app_id;
		$dep_dat = $dep_dat."&deployment[description]=".$dep_description;
		$dep_dat = $dep_dat."&deployment[changelog]=".$dep_change;
		$dep_dat = $dep_dat."&deployment[user]=".$dep_user;
		$dep_dat = $dep_dat."&deployment[revision]=".$dep_rev;
		
		//There should be no changes necessary beyond this point
		//these lines are commented
		//deployment url at New Relic
		//$url = "https://api.newrelic.com/deployments.xml";
		$url = "https://api.newrelic.com/v2/applications/".$app_id."/deployments.json";
		
		//Create header info
		//$header = array("X-Api-Key:".$apikey);
		
		$client = new Client();
		$response = $client->get($url, [
			'headers' => [
				'X-Api-Key' => $apikey,
			], 
			'body' => $dep_dat]);
		
		$contents = $response->getBody()->getContents();
		$deployments = json_decode($contents);
		return view('action', compact('deployments'));
    }
    
    public function create() {
    	return view('create');
    }
    
    public function store(Request $request) {
    	$apikey = "689169d9f6d582b62b94139ad92284a850e8e120e5aabef";
		
		//Specify an existing New Relic app name OR app ID
		$app_name = "laravelnrapp";
		$app_id = "20273781";
		
		//compose the data string for curl
		if($request) {
			$dep_dat = '{"deployment":{"revision": "'.$request->input('revision').'","changelog": "'.$request->input('changelog').'","description": "'.$request->input('description').'","user": "'.$request->input('user').'"}}';
			//$deployment_data = json_decode($dep_dat);	
			//There should be no changes necessary beyond this point
			
			//deployment url at New Relic
			//$url = "https://api.newrelic.com/deployments.xml";
			$url = "https://api.newrelic.com/v2/applications/".$app_id."/deployments.json";
			
			//Create header info
			$header = array("X-Api-Key:".$apikey, "Content-Type: application/json");
			
			$ch = curl_init();

			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $dep_dat);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
			
			// in real life you should use something like:
			// curl_setopt($ch, CURLOPT_POSTFIELDS, 
			//          http_build_query(array('postvar1' => 'value1')));
			
			// receive server response ...
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			
			$server_output = curl_exec ($ch);
			
			curl_close ($ch);				
    	}
    	return redirect('/');
    }
    
    public function delete(Request $request) {
    	$apikey = "c6fea4ac7656934f83d0efb326a28369";
		
		//Specify an existing New Relic app name OR app ID
		$app_name = "laravelnrapp";
		$app_id = "20273781";
    	if($request){
    		$url = "https://api.newrelic.com/v2/applications/".$app_id."/deployments/".$request->input('id').".json";
    		$header = array("X-Api-Key:".$apikey);
    		$client = new Client();
			$response = $client->request('DELETE', $url, [
				'headers' => [
					'X-Api-Key' => $apikey,
				]]);
    	}
    	return redirect('/');
    }
}
