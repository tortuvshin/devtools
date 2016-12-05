<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;
use App\Survey;
use Carbon\Carbon;
use Faker\Factory as Faker;

class SurveyTest extends TestCase
{

    public function testHasQuestionContents()
    {
        $survey = new Survey;

        $this->assertEquals('How happy are you feeling today?', $survey->questionOneContent());
        $this->assertEquals('How well did you sleep last night?', $survey->questionTwoContent());
        $this->assertEquals('How likely are you to see a friend today?', $survey->questionThreeContent());
        $this->assertEquals('How pleased are your with your diet today?', $survey->questionFourContent());
    }

    public function testSurveyBelongsToUser()
    {
      $faker = Faker::create();
      $user = User::create(['name'=>str_random(20), 'email'=>$faker->email,'password'=>'password']);
      $survey = Survey::create(['user_id'=> $user->id, 'question_1_response' => 1, 'question_2_response' => 2, 'question_3_response' => 3, 'question_4_response' => 4,'time_taken'=> Carbon::now()]);

      $results = $survey->user->toArray();

      $this->assertEquals($user->toArray(), $results);
    }
}
