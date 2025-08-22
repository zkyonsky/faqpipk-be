<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    /**
     * index
     *
     * @return void
     */
       
    /**
     * show
     *
     * @param  mixed $slug
     * @return void
     */
    public function show($category_id)
    {
        $topic = Topic::where('category_id', $category_id)->get();
        $category = Category::where('id', $category_id)->get('name');

        if($topic) {

            return response()->json([
                "response" => [
                    "status"    => 200,
                    "message"   => "Detail Data Post"
                ],
                "data" => [
                    "category" => $category,
                    "topic" => $topic             
                    ]
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
