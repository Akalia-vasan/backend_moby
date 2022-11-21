<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Code;
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
        $digit = floor($request->digits);
        $consignment_data = [];
        for($i=1;$i<=$digit;$i++)
        {
            $consignment_data[] =['unique_code' => $this->random_strings(7)];
         
        }

        Code::insert($consignment_data);
        $data = [
            'time' => intval(microtime(true) - floor(LUMEN_START)),
            'status' => 200,
        ];
       return response()->json($data);
    }

    private function random_strings($length) {
       
        return bin2hex(random_bytes($length));
    }
}