<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Code;
use DB;
use Illuminate\Support\Str;
class CodeController extends Controller
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

    public function create(Request $request)
    {
        $digit = intval($request->digits);
        $data = [];
        $i = 1; 
        while ($i<=$digit){ 
	        $data[] =['unique_code' => $this->getCode(7)];
            $i++;
        }
        DB::beginTransaction();
        $temp = array_unique(array_column($data, 'unique_code'));
        $unique_arr = array_intersect_key($data, $temp);
        $consignment_data = array_chunk($data, 5000);
        foreach ($consignment_data as $key => $consignment) {
            Code::insert($consignment);
        }
        DB::commit();
        $data = [
            'time' => intval(microtime(true) - floor(LUMEN_START)),
            'status' => 200,
        ];
       return response()->json($data);
    }

    private function getCode($length)
    {
        $bytes= random_bytes($length);
        return str_replace(['/','+','='],['','',''],base64_encode($bytes));
    }
}
