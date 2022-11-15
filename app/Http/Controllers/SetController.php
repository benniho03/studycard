<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Set;
use Illuminate\Support\Facades\Auth;

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
}
