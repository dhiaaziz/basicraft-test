<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MemberController extends Controller
{
    //
    public function token(){
        return csrf_token();
    }

    public function index()
    {
        // dd('test_member');
        return view('members.index');
    }

    public function fetch()
    {
        $members = \App\Models\Member::all();
        // dd($members);
        return response()->json($members);
        // return view('members.index');
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $member = new \App\Models\Member();
        // $member = $request->all();
        $member->fullname = $request->fullname;
        $member->dob = $request->dob;
        $member->address = $request->address;
        $member->is_active = $request->is_active;
        $member->created = now();
        $member->updated = now();
        $member->save();
        return response()->json($member);
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $member = \App\Models\Member::where('id_member', $id)->first();
        $member->fullname = $request->fullname;
        $member->dob = $request->dob;
        $member->address = $request->address;
        $member->is_active = $request->is_active;
        $member->updated = now();
        $member->save();
        return response()->json($member);
    }

    public function destroy($id)
    {
        $member = \App\Models\Member::where('id_member', $id)->first();
        $member->delete();
        return response()->json($member);
    }
    
}
