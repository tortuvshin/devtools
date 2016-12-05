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
    return "ЦАХИМ ХУУДАС ХИЙЛГЭЖ БАЙСАН ЭСЭХ?";
  }

  public function questionTwoContent()
  {
    return "БАЙГУУЛЛАГЫН ДИЗАЙН БРЭНДБҮҮК БАЙГАА ЭСЭХ?";
  }

  public function questionThreeContent()
  {
    return "АГУУЛГА БАЙГАА ЭСЭХ?";
  }

  public function questionFourContent()
  {
    return "ДОМАЙН АВСАН ЭСЭХ?";
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
