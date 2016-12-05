<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
  protected $fillable = [
    'user_id','question_1_response', 'question_2_response', 'question_3_response', 'question_4_response', 'time_taken'
  ];


  /**
   * Returns the various survey questions to be used in Javascript
   *
   * @return string
   */
  public function questionOneContent()
  {
    return "How happy are you feeling today?";
  }

  public function questionTwoContent()
  {
    return "How well did you sleep last night?";
  }

  public function questionThreeContent()
  {
    return "How likely are you to see a friend today?";
  }

  public function questionFourContent()
  {
    return "How pleased are your with your diet today?";
  }

  /**
   * Returns the user that the survey belongs to
   *
   * @return object
   */
  public function user()
  {
    return $this->belongsTo('App\User');
  }
}
