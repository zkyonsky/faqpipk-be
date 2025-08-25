<?php

namespace App\Http\Controllers\Admin;

use App\Models\Cluster;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClusterController extends Controller
{
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['permission:clusters.index'])->only(['index']);
        $this->middleware(['permission:clusters.create'])->only(['create', 'store']);
        $this->middleware(['permission:clusters.edit'])->only(['edit', 'update']);
        $this->middleware(['permission:clusters.delete'])->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clusters = Cluster::latest()->when(request()->q, function($clusters) {
            $clusters = $clusters->where('name', 'like', '%'. request()->q . '%');
        })->paginate(10);

        return view('admin.cluster.index', compact('clusters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cluster.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:clusters'
        ]);

        $Cluster = Cluster::create([
            'name' => $request->input('name')
        ]);

        if($Cluster){
            //redirect dengan pesan sukses
            return redirect()->route('admin.cluster.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.cluster.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Cluster $cluster)
    {
        return view('admin.cluster.edit', compact('cluster'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cluster $Cluster)
    {
        $this->validate($request, [
            'name' => 'required|unique:clusters,name,'.$Cluster->id
        ]);

        $Cluster = Cluster::findOrFail($Cluster->id);
        $Cluster->update([
            'name' => $request->input('name')
        ]);

        if($Cluster){
            //redirect dengan pesan sukses
            return redirect()->route('admin.cluster.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.cluster.index')->with(['error' => 'Data Gagal Diupdate!']);
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
        $Cluster = Cluster::findOrFail($id);
        $Cluster->delete();

        if($Cluster){
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