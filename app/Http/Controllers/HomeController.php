<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $questions_sc = Question::where('type', 'single_choice_opinion_Scale')->get();
        $questions_mc = Question::where('type', 'multiple_choice')->get();

        return view('admin', [
            'questions_sc' => $questions_sc,
            'questions_mc' => $questions_mc
        ]);
    }
}
