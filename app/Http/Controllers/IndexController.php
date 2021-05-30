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
    	/*
    	{
		    "action" : "save",
		    "table_hdr" : "tx_hdr_billing",
		    "data_hdr" : [
		        {
		            "billing_name" : "wardah",
		            "billing_email" :"wardah@gmail.com",
		            "billing_phone" : "08573031111",
		            "billing_information" : "info",
		            "billing_address" : "SBY"
		        }
		    ],
		    "table_dtl" : "tx_dtl_billing",
		    "join_column_hdr" : "billing_id",
		    "join_column_dtl" :"dtl_hdr_id",
		    "data_dtl" : [
		        {
		        "dtl_product" :"Sabun",
		        "dtl_qty" : 1,
		        "dtl_price" : "2000"
		        },
		        {
		        "dtl_product" :"Shampo",
		        "dtl_qty" : 1,
		        "dtl_price" : "500"
		        }
		    ]
		}
    	*/
    	$table_hdr = $input["table_hdr"];
    	$table_dtl = $input["table_dtl"];
		$insert = \DB::table($table_hdr);
		$insert=$insert->insert($input["data_hdr"]);
		$list = \DB::table($table_hdr);
		
		if(!empty($table_dtl))
		{
			$data_dtl= $input["data_dtl"];
			$dtl_hdr_id = DB::table($table_hdr)->max($input["join_column_hdr"]);	
	    	$in_dtl=[];
	    	foreach($data_dtl as $dtl)
	    	{
				$dtl_hdr_id = DB::table($table_hdr)->max($input["join_column_hdr"]);
	    		$temp_in[$input["join_column_dtl"]]= $dtl_hdr_id;
	    		foreach ($dtl as $key => $value) {
	    			$temp_in[$key]=$value;
	    		}
	    		array_push($in_dtl, $temp_in);
				
	    	}
	    	$insert = \DB::table($table_dtl);
			$insert=$insert->insert($in_dtl);
			$list->join($table_dtl,$input["join_column_hdr"],"=",$input[join_column_dtl]);
    	}
    	
    	$list=$list->get();
		if($insert)
		{
			$data=["success"=>true,"message" => "Insert Success","list"=>$list];
		}
		else
		{
			$data=["success"=>false,"message" => "Insert Failed","list"=>$list];
		}
		return $data;
    }
    public function delete($input)
    {
    	/*
    	{
		    "action": "delete",
		    "table": "tx_product",
		    "where" :[
		        [
		            "product_id","=",2
		        ]
		    ]
		}
		*/
    	$table = $input["table"];
		$data = \DB::table($table);
    	if(!empty($input["where"]))
			$data->where($input["where"]);
		$data=$data->delete();
		$list = \DB::table($table)->get();
		if($data)
		{
			$result=["success"=>true,"message" => "Delete Success","list"=>$list];
		}
		else
		{
			$result=["success"=>false,"message" => "Delete Failed","list"=>$list];
		}
		return $result;
    }
    public function upload($input)
    {
    	/*
    	{
		   action:"upload",
		   image:"bsdafksafei9234ksafd"
		}
		*/
		//$result=$this->request->file('img')->store('apidocs');
		$folderPath = "/"; //letak foldernya kalo images/ berarti di folder public harus buat folder images 
		$image_base64 = base64_decode($input["image"]); //ini ngedecode base64 menjadi image lagi
		$file = $folderPath .$input["name"]. '.jpg'; //ini nama filenya ketika nanti disimpan
		file_put_contents($file, $image_base64); //menyimpan file image kedalam folder
		return $input;
    }

}
