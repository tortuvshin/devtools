<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;
use App\Survey;
use Carbon\Carbon;
use Faker\Factory as Faker;

class SurveysControllerTest extends TestCase
{

    public function testCanGetSurveyShow()
    {
      $faker = Faker::create();
      $user = User::create(['name'=>str_random(20), 'email'=>$faker->email,'password'=>'password']);
      $this->be($user);

      $survey1 = Survey::create(['user_id'=> $user->id, 'question_1_response' => 1, 'question_2_response' => 2, 'question_3_response' => 3, 'question_4_response' => 4,'time_taken'=> Carbon::now()]);

      $this->get("surveys/{$survey1->id}")
            ->seeJson(['id' => $survey1->id]);
    }

    public function testCanGetSurveyIndex()
    {
      $faker = Faker::create();
      $user = User::create(['name'=>str_random(20), 'email'=>$faker->email,'password'=>'password']);
      $this->be($user);

      $survey1 = Survey::create(['user_id'=> $user->id, 'question_1_response' => 1, 'question_2_response' => 2, 'question_3_response' => 3, 'question_4_response' => 4,'time_taken'=> Carbon::now()]);
      $survey2 = Survey::create(['user_id'=> $user->id, 'question_1_response' => 1, 'question_2_response' => 2, 'question_3_response' => 3, 'question_4_response' => 4,'time_taken'=> Carbon::now()]);
      $survey3 = Survey::create(['user_id'=> $user->id, 'question_1_response' => 1, 'question_2_response' => 2, 'question_3_response' => 3, 'question_4_response' => 4,'time_taken'=> Carbon::now()]);

      $expectedResults = ['question_1_response' => '1.0',
                          'question_2_response' => '2.0',
                          'question_3_response' => '3.0',
                          'question_4_response' => '4.0'];

      $this->get("surveys")
            ->seeJson($expectedResults);
    }

    public function testCanGetSurveynew()
    {
      $faker = Faker::create();
      $user = User::create(['name'=>str_random(20), 'email'=>$faker->email,'password'=>'password']);
      $this->be($user);

      $this->get("surveys/new")
            ->seeJson(["question_1" => "How happy are you feeling today?"]);
    }
}
