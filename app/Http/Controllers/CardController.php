<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Card;
use App\Models\Set;
use Illuminate\Support\Facades\DB;



class CardController extends Controller
{
    
    public function getCardsData(){
        $data = [
            "cards" => Card::get(),
            "sets" => Set::get()
        ];
        return view("/createCard", compact("data"));
    }

    public function createCard(Request $request){
        $request->validate([
            'question' => 'required',
            'answer' => 'required',
            'set' => 'required'
        ]);
        $question = $request->question;
        $answer = $request->answer;
        $set = $request->set;

        $newCard = new Card();
        $newCard->question = $question;
        $newCard->answer = $answer;
        $newCard->step = 1;
        $newCard->setID = DB::table('sets')->where('name', '=', $set)->value('id');
        $newCard->save();

        return redirect()->back()->with('success', 'new card created.');
    }

    public function editCard($id){
        $cardInfo = Card::where('cardID', '=', $id)->first();
        $sets = Set::get();
        $data = [
            'card' => $cardInfo,
            'sets' => $sets
        ];
        return view('/editCard', compact('data'));
    }

    public function updateCard(Request $request){
        $request->validate([
            'id' => 'required',
            'question' => 'required',
            'answer' => 'required',
            'set' => 'required'
        ]);
        $id = $request->id;
        $question = $request->question;
        $answer = $request->answer;
        $set = $request->set;
        $setID = DB::table('sets')->where('name', '=', $set)->value('id');

        Card::where('cardID', '=', $id)->update([
            'question' => $question,
            'answer' => $answer,
            'setID' => $setID
        ]);

        return redirect('/create-card')->with('success', 'card updated.');
    }
    
    public function deleteCard($id){
        Card::where('cardID', '=', $id)->delete();
        return redirect('/create-card')->with('success', 'card deleted.');
    }

    //AJAX

    public function fetchCards(Request $request){
        $setID = DB::table('sets')->where('name', '=', $request->set)->value('id'); // gets ID of set name
        $cards = Card::where('setID', '=', $setID)->where('step', '<=', 3)->get();
        return response($cards);
    }

    public function startWelcomePage(){
        $data = [
            "sets" => Set::get(),
            "cars" => Card::Get()
        ];
        return view("home", compact("data"));
    }

    public function incrementStep(Request $request){
        $request->validate([
            'id' => 'required',
        ]);
        $id = $request->id;
        $question = $request->question;
        $answer = $request->answer;
        $setID = $request->setID;
        $step = Card::where('cardID', '=', $id)->value('step');

        Card::where('cardID', '=', $id)->update([
            'question' => $question,
            'answer' => $answer,
            'setID' => $setID,
            'step' => $step +1
        ]);

        return response('worked');
    }

}