<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
class TestingController extends Controller
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

    public function main() {
      // "SELECT * FROM TX_HDR_USER WHERE USER_NAME = 'chalidade' ORDER BY user_id DESC";
      $user = \DB::table("tx_hdr_user")->get();
      return $user;
    }
	public function filter_user($filter,$id)
	{
		$user=(array) \DB::table("tx_hdr_user")->where($filter,$id)->first();
		return $user;
	}	
	public function create_user()
	{
		$input=$this->request->all();
		
		
		$cek=$this->filter_user("user_name",$input["username"]);
		if($cek)
		{
			return "Username sudah ada";
		}
		else
		{
			$data=[
			"user_name" => $input["username"],
			"user_password" => $input["password"]
			];
			$insert=\DB::table("tx_hdr_user")->insert($data);
			$userid=$this->filter_user("user_name",$input["username"])["user_id"];
			$data_dtl=[
			"dtl_hdr_id"		=> $userid,
			"dtl_user_email"	=> $input["email"],
			"dtl_user_address"	=> $input["address"],
			"dtl_user_phone"	=> $input["phone"]
			];
			
			$insert=\DB::table("tx_dtl_user")->insert($data_dtl);
			if($insert)
			{
				return "Insert Success";
			}
			else
			{
				return "Insert Failure";
			}
		}
		
		
		
	}

	public function create_billing()
	{
		$input=$this->request->all();
		
		$data=[
		"billing_name" 	=> $input["name"],
		"billing_email" => $input["email"],
		"billing_phone" => $input["phone"],
		"billing_information" => $input["information"],
		"billing_address" => $input["address"]
		];
		$insert=\DB::table("tx_hdr_billing")->insert($data);
		$billing_id = DB::table('tx_hdr_billing')->max('billing_id');
		foreach ($input["dtl"] as $dtl) {
			$data_dtl=[
			"dtl_hdr_id"		=> $billing_id,
			"dtl_product"		=> $dtl["product"],
			"dtl_qty"			=> $dtl["qty"],
			"dtl_price"			=> $dtl["price"]
			];
			
			$insert=\DB::table("tx_dtl_billing")->insert($data_dtl);
		}
		
		if($insert)
		{
			return "Insert Success";
		}
		else
		{
			return "Insert Failure";
		}
	}
    //
}