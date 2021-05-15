<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

class TestingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function main() {
      // "SELECT * FROM TX_HDR_USER WHERE USER_NAME = 'chalidade' ORDER BY user_id DESC";
      $user = \DB::table("tx_hdr_user")->get();
      return $user;
    }
	public function filter_user($id)
	{
		$user=(array) \DB::table("tx_hdr_user")->where("user_id",$id)->first();
		return $user;
	}
	public function create_user()
	{
		$input=$this->request->all();
		$data=[
		"user_name" => $input["user_name"],
		"user_password"	=> base64_encode($input["user_password"])
		];
		$user=\DB::table("tx_hdr_user")->where("user_name",$input["user_name"])->count();	
	}
    //
}