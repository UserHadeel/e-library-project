<?php


namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;

class BaseController extends Controller
{
    public function sendResponse($result ,$message){

        $response = [
          'seccess' => true,
          'data' => $result,
          'message'=> $message
        ];
        return response()->json($response , 200);
    }

    public function sendError($message){

        $response = [
            'seccess' => false,
            'data' => [],
            'message'=> $message
        ];

        return response()->json($response , 404);
    }

}
