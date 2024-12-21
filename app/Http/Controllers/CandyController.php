<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Candy;

class CandyController extends Controller
{
    public function index(){
        return view('index',[
            'candies' => Candy::where('is_active', 1)->get()
        ]);
    }
    public function candy($id){
        return view('candy',[
            'candy' => Candy::find($id)
        ]);
    }
}
