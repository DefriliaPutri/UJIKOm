<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index(Request $request)
    {
        $member = \App\Member::paginate(10);

        $filterKeyword = $request->get('nama');

        if($filterKeyword){
            $member = \App\Member::where("nama", "LIKE", "%filterKeyword%")->paginate(10);
        }

        return view('members.index', ['members' => $member]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("members.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $new_member = new \App\Member;
        $new_member->nama = $request->get('nama');
        $new_member->alamat = $request->get('alamat');
        $new_member->jenis_kelamin = $request->get('jenis_kelamin');
        $new_member->no_telp = $request->get('no_telp');
        $new_member->save();
           
        return redirect()->route('members.index')->with('status', 'Outlet successfully created');
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
        $member_to_edit = \App\Member::findOrFail($id);

        return view('members.edit', ['member' => $member_to_edit]);
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
        $member = \App\Member::findOrFail($id);

        $member->nama = $request->get('nama');
        $member->alamat = $request->get('alamat');
        $member->jenis_kelamin = $request->get('jenis_kelamin');
        $member->no_telp = $request->get('no_telp');
        $member->save();

        return redirect()->route('members.index')->with('status', 'Outlet successfully created');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $member = \App\Member::findOrFail($id);

        $member->delete();

        return redirect()->route('members.index')->with('status', 'member succsessfully moved to trash');
    }

    public function trash()
    {
        $deleted_member = \App\Member::onlyTrashed()->paginate(10);

        return view('members.trash', ['member' => $deleted_member]);
    }

    public function restore($id)
    {
        $member = \App\Member::withTrashed()->findOrFail($id);

        if($member->trashed()){
            $member->restore();
         } else {
            return redirect()->route('members.index')->with('status', 
            'Member is not in trash');        
            }
        
            return redirect()->route('members.index')->with('status', 
            'Member successfully restored');
        
    }

    public function deletePermanent($id)
    {
        $member = \App\Member::withTrashed()->findOrFail($id);
        if(!$member->trashed()){
        return redirect()->route('members.index')->with('status', 'Can not delete permanent active Member');

        } else {
        $member->forceDelete();
        }

        return redirect()->route('members.index')->with('status', 'Member permanently deleted');
    }

    public function ajaxSearch(Request $request)
    {
        $keyword = $request->get('q');
       $member = \App\Member::where("nama", "LIKE", "%$keyword%")->get();
        return $member;
       }
}
