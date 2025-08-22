<?php

namespace App\Http\Controllers\Admin;

use App\Models\Problem;
use App\Models\Topic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

class problemController extends Controller
{
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['permission:problems.index'])->only(['index']);
        $this->middleware(['permission:problems.create'])->only(['create', 'store']);
        $this->middleware(['permission:problems.edit'])->only(['edit', 'update']);
        $this->middleware(['permission:problems.delete'])->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $problems = problem::latest()->when(request()->q, function($problems) {
            $problems = $problems->where('title', 'like', '%'. request()->q . '%');
        })->paginate(10);

        return view('admin.problem.index', compact('problems'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $topics = Topic::latest()->get();

        $topics = Topic::addSelect(['category' => Category::select('name')
                ->whereColumn('id', 'topics.category_id')
        ])->latest()->get();

        // dd($topics);

        return view('admin.problem.create', compact('topics'));
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
            'name'         => 'required|unique:problems',
            'topic_id'   => 'required',
            'solution'       => 'required',
        ]);

        $problem = problem::create([
            'name'       => $request->input('name'),
            'topic_id' => $request->input('topic_id'),
            'solution'     => $request->input('solution'),
            'additional'     => $request->input('additional')    
        ]);

        if($problem){
            //redirect dengan pesan sukses
            return redirect()->route('admin.problem.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.problem.index')->with(['error' => 'Data Gagal Disimpan!']);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(problem $problem)
    {
        $topics = Topic::addSelect(['category' => Category::select('name')
                ->whereColumn('id', 'topics.category_id')
        ])->latest()->get();
        
        return view('admin.problem.edit', compact('problem', 'topics'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, problem $problem)
    {
        $this->validate($request,[
            'name'         => 'required|unique:problems,name,'.$problem->id,
            'topic_id'   => 'required',
            'solution'       => 'required',
        ]);
        
        $problem = problem::findOrFail($problem->id);
        $problem->update([
            'name'       => $request->input('name'),
            'topic_id' => $request->input('topic_id'),
            'solution'     => $request->input('solution'),
            'additional'     => $request->input('additional')    
        ]);
    
        if($problem){
            //redirect dengan pesan sukses
            return redirect()->route('admin.problem.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.problem.index')->with(['error' => 'Data Gagal Diupdate!']);
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
        $problem = problem::findOrFail($id);
        $problem->delete();

        if($problem){
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
