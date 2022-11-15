<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Card;
use Illuminate\Support\Facades\DB;



class CardController extends Controller
{
    
    public function showCards(){
        $data = Card::get();
        return view("/createCard", compact("data"));
    }

    public function createCard(Request $request){
        $question = $request->question;
        $answer = $request->answer;

        $newCard = new Card();
        $newCard->question = $question;
        $newCard->answer = $answer;
        $newCard->save();

        return redirect()->back()->with('success', 'new card created.');
    }
}