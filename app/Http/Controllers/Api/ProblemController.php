<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Problem;
use Illuminate\Http\Request;

class ProblemController extends Controller
{
    public function show($topic_id)
    {
        $problem = Problem::where('topic_id', $topic_id)->get();

        if($problem) {

            return response()->json([
                "response" => [
                    "status"    => 200,
                    "message"   => "Detail Data Topic"
                ],
                "data" =>  $problem             
            ], 200);

        } else {

            return response()->json([
                "response" => [
                    "status"    => 404,
                    "message"   => "Data Post Tidak Ditemukan!"
                ],
                "data" => null
            ], 404);

        }
    }
}
