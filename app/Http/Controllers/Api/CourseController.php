<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cluster;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
     /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $clusters = Cluster::all();
        return response()->json([
            "response" => [
                "status"    => 200,
                "message"   => "List Data Clusters"
            ],
            "data" => $clusters
        ], 200);
    }
   
    /**
     * show
     *
     * @param  mixed $courses
     * @return void
     */
    public function show($cluster_id)
    {
        $cluster = Cluster::where('id', $cluster_id)->get('name');
        $courses = Course::where('cluster_id', $cluster_id)->get();
        

        if($courses) {

            return response()->json([
                "response" => [
                    "status"    => 200,
                    "message"   => "Detail Data Course"
                ],
                "data" => [
                    "cluster" => $cluster,
                    "courses" => $courses             
                    ]
            ], 200);

        } else {

            return response()->json([
                "response" => [
                    "status"    => 404,
                    "message"   => "Data Course Tidak Ditemukan!"
                ],
                "data" => null
            ], 404);

        }
    }

}
