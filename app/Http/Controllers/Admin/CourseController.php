<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course;
use App\Models\Cluster;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CourseController extends Controller
{
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['permission:courses.index'])->only(['index']);
        $this->middleware(['permission:courses.create'])->only(['create', 'store']);
        $this->middleware(['permission:courses.edit'])->only(['edit', 'update']);
        $this->middleware(['permission:courses.delete'])->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = course::latest()->when(request()->q, function($courses) {
            $courses = $courses->where('name', 'like', '%'. request()->q . '%');
        })->paginate(10);

        return view('admin.course.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clusters = Cluster::latest()->get();
        return view('admin.course.create', compact('clusters'));
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
            'cluster_id'   => 'required',
            'name'       => 'required',
            'address'       => 'required',
        ]);

        $course = course::create([
            'cluster_id' => $request->input('cluster_id'),
            'name'     => $request->input('name'),  
            'address'     => $request->input('address')  
        ]);

        if($course){
            //redirect dengan pesan sukses
            return redirect()->route('admin.course.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.course.index')->with(['error' => 'Data Gagal Disimpan!']);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(course $course)
    {
        $clusters = Cluster::latest()->get();
        return view('admin.course.edit', compact('course', 'clusters'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, course $course)
    {
        $this->validate($request,[
            'name'         => 'required|unique:courses,name,'.$course->id,
            'cluster_id'   => 'required',
            'address'   => 'required',
        ]);

            
        $course = course::findOrFail($course->id);
            
        $course->update([
            'name'       => $request->input('name'),
            'cluster_id' => $request->input('cluster_id'),
            'address' => $request->input('address'),
        ]);

     
        if($course){
            //redirect dengan pesan sukses
            return redirect()->route('admin.course.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.course.index')->with(['error' => 'Data Gagal Diupdate!']);
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
        $course = course::findOrFail($id);
        $course->delete();

        if($course){
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