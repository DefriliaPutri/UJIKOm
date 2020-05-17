<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class OutletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        $this->middleware(function($request, $next){
            if(Gate::allows('manage-outlets')) return $next($request);
            abort(403, 'Anda tidak memiliki cukup hak akses');
            });
           
    }
    public function index(Request $request)
    {
        $outlets = \App\Outlet::paginate(10);

        $Keyword = $request->get('nama');

        if($Keyword){
            $outlets = \App\Outlet::where("nama", "LIKE", "%filterKeyword%")->paginate(10);
        }

        return view('outlets.index', ['outlets' => $outlets]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("outlets.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {



        $new_outlet = new \App\Outlet;
        $new_outlet->nama = $request->get('nama');
        $new_outlet->alamat = $request->get('alamat');
        $new_outlet->tlp = $request->get('tlp');
        $new_outlet->save();
           
        return redirect()->route('outlets.index')->with('status', 'Outlet successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $outlet_to_edit = \App\Outlet::findOrFail($id);

        return view('outlets.edit', ['outlet' => $outlet_to_edit]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $outlet = \App\Outlet::findOrFail($id);

        $outlet->nama = $request->get('nama');
        $outlet->alamat = $request->get('alamat');
        $outlet->tlp = $request->get('tlp');
        $outlet->save();

        return redirect()->route('outlets.index')->with('status', 'Outlet successfully update');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $outlet = \App\Outlet::findOrFail($id);

        $outlet->delete();

        return redirect()->route('outlets.index')
        ->with('status', 'outlet successfully moved to trash');
        //$outlet = \App\Outlet::findOrFail($id);
        //$outlet->delete();
        //return redirect()->route('outlets.index')->with('status', 'Outlet successfully delete');

    }

    public function trash()
    {
        $deleted_outlet = \App\Outlet::onlyTrashed()->paginate(10);

        return view('outlets.trash', ['outlets' => $deleted_outlet]);
    }

    public function restore($id)
    {
        $outlet = \App\Outlet::withTrashed()->findOrFail($id);
        if($outlet->trashed()){
        $outlet->restore();
        } else {
        return redirect()->route('outlets.index')->with('status', 'outlet is not in trash');
        }
        return redirect()->route('outlets.index')->with('status', 'outlet successfully restored');
    }
    
    public function deletePermanent($id)
    {
        $outlet = \App\Outlet::withTrashed()->findOrFail($id);
        if(!$outlet->trashed()){
        return redirect()->route('outlets.index')->with('status', 'Can not delete permanent active category');

        } else {
        $category->forceDelete();
        }

        return redirect()->route('outlets.index')->with('status', 'Category permanently deleted');
    }

    public function ajaxSearch(Request $request)
    {
        $keyword = $request->get('q');
       $outlets = \App\Outlet::where("nama", "LIKE", "%$keyword%")->get();
        return $outlets;
       }
}