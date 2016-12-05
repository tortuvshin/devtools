<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Survey;

class PagesController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function index()
  {
    return view('pages.index');
  }

  public function newSurvey()
  {
    return view('pages.new_survey');
  }

  public function show($id)
  {
    $survey = Survey::find($id);
    if($survey->user != \Auth::user()){
      return redirect()->action('PagesController@index');
    };

    return view('pages.show');
  }
}
