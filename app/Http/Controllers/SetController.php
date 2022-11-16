<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Set;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class SetController extends Controller
{
    public function showSets(){
        $data = Set::get();
        return view("/createSet", compact("data"));
    }

    public function createSet(Request $request){
        $name = $request->name;
        $description = $request->description;

        $newSet = new Set();
        $newSet->name = $name;
        $newSet->userID = Auth::id();
        $newSet->description = $description;
        $newSet->save();

        return redirect()->back()->with('success', 'new set created.');
    }

    public function editSet($id){
        $data = Set::where('id', '=', $id)->first();
        return view('/editSet', compact('data'));
    }

    public function updateSet(Request $request){
        $request->validate([
            'id' => 'required',
            'name' => 'required',
            'description' => 'required'
        ]);
        $id = $request->id;
        $name = $request->name;
        $description = $request->description;

        Set::where('id', '=', $id)->update([
            'name' => $name,
            'description' => $description
        ]);
        return dd($request);
        // return redirect('/create-set')->with('success', 'set updated.');
    }

    public function deleteSet($id){
        Set::where('id', '=', $id)->delete();
        return redirect('/create-set')->with('success', 'set deleted.');
    }
}
