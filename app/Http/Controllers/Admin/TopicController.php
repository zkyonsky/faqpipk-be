<?php

namespace App\Http\Controllers\Admin;

use App\Models\Topic;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TopicController extends Controller
{
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['permission:topics.index'])->only(['index']);
        $this->middleware(['permission:topics.create'])->only(['create', 'store']);
        $this->middleware(['permission:topics.edit'])->only(['edit', 'update']);
        $this->middleware(['permission:topics.delete'])->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topics = topic::latest()->when(request()->q, function($topics) {
            $topics = $topics->where('name', 'like', '%'. request()->q . '%');
        })->paginate(10);

        // $topics = Topic::addSelect(['category' => Category::select('name')
        //         ->whereColumn('id', 'topics.category_id')
        // ])->latest()->when(request()->q, function($topics) {
        //     $topics = $topics->where('name', 'like', '%'. request()->q . '%');
        // })->paginate(10);

        // dd($topics);

        return view('admin.topic.index', compact('topics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::latest()->get();
        return view('admin.topic.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'category_id'   => 'required',
            'name'       => 'required',
        ]);

        $topic = topic::create([
            'category_id' => $request->input('category_id'),
            'name'     => $request->input('name')  
        ]);

        if($topic){
            //redirect dengan pesan sukses
            return redirect()->route('admin.topic.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.topic.index')->with(['error' => 'Data Gagal Disimpan!']);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(topic $topic)
    {
        $categories = Category::latest()->get();
        return view('admin.topic.edit', compact('topic', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, topic $topic)
    {
        $this->validate($request,[
            'name'         => 'required|unique:topics,name,'.$topic->id,
            'category_id'   => 'required',
        ]);

            
        $topic = topic::findOrFail($topic->id);
            
        $topic->update([
            'name'       => $request->input('name'),
            'category_id' => $request->input('category_id'),
        ]);

     
        if($topic){
            //redirect dengan pesan sukses
            return redirect()->route('admin.topic.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.topic.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $topic = topic::findOrFail($id);
        $topic->delete();

        if($topic){
            return response()->json([
                'status' => 'success'
            ]);
        }else{
            return response()->json([
                'status' => 'error'
            ]);
        }
    }
}