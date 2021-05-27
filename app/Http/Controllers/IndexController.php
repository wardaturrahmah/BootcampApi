<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class IndexController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request=$request;
    }

	public function main()
	{
		$input=$this->request->json()->all();
		$action =$input["action"];
		return $this->$action($input);
	}
	public function list($input)
	{
		/*
		{
		    "action": "list",
		    "table": "tx_hdr_user",
		    "where" :[
		        [
		            "user_password","like","%123%"
		        ],
		        [
		            "user_name","like","%a%"
		        ]
		    ],
		    "first" : "true",
		    "join" : ["tx_dtl_user","tx_hdr_user.user_id","=","tx_dtl_user.dtl_hdr_id"]
		}
		isian json
		*/
		$table = $input["table"];

		$data = \DB::table($table);
		if(!empty($input["where"]))
			$data->where($input["where"]);
		if(!empty($input["select"]))
			$data->select($input["select"]);
		if(!empty($input["join"]))
		{
			$join=$input["join"];
			$data->join($join[0],$join[1],$join[2],$join[3]);
		}
		
		if(isset($input["first"]) && $input["first"]=="true")
			$data=(array)$data->first();
		else
			$data=$data->get();
		//$data=$data->pluck("user_name");

		$result["count"]=count($data);
		$result["data"]=$data;
		return $result;
	}
    //
    public function save($input)
    {
    	$data_hdr=$input["data_hdr"];
    	//print_r($data_hdr);
    	$data_dtl= $input["data_dtl"];
    	//print_r($data_dtl);
    	foreach($data_dtl as $dtl)
    	{
    		foreach ($dtl as $key => $value) {
    			# code...
    			//echo $key;
    		}
    	}
    	/*
    	$table_hdr = $input["table_hdr"];
		$insert = \DB::table($table_hdr);
		$insert=$insert->insert($input["data_hdr"]);

		if($insert)
		{
			return "Insert Success";
		}
		else
		{
			return "Insert Failure";
		}
		*/
    }
}
