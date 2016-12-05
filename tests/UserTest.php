<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;
use App\Survey;
use Carbon\Carbon;
use Faker\Factory as Faker;

class UserTest extends TestCase
{
  
    public function testUserHasSurvey()
    {
        $faker = Faker::create();
        $user = User::create(['name'=>str_random(20), 'email'=>$faker->email,'password'=>'password']);
        $survey = Survey::create(['user_id'=> $user->id, 'question_1_response' => 1, 'question_2_response' => 2, 'question_3_response' => 3, 'question_4_response' => 4,'time_taken'=> Carbon::now()]);

        $results = $user->surveys;

        $this->assertCount(1, $results);
    }

    public function testUserHasAverageSurvey($value='')
    {
      $faker = Faker::create();
      $user = User::create(['name'=>str_random(20), 'email'=>$faker->email,'password'=>'password']);
      $survey1 = Survey::create(['user_id'=> $user->id, 'question_1_response' => 1, 'question_2_response' => 2, 'question_3_response' => 3, 'question_4_response' => 4,'time_taken'=> Carbon::now()]);
      $survey2 = Survey::create(['user_id'=> $user->id, 'question_1_response' => 1, 'question_2_response' => 2, 'question_3_response' => 3, 'question_4_response' => 4,'time_taken'=> Carbon::now()]);
      $survey3 = Survey::create(['user_id'=> $user->id, 'question_1_response' => 1, 'question_2_response' => 2, 'question_3_response' => 3, 'question_4_response' => 4,'time_taken'=> Carbon::now()]);

      $expectedResults = ['question_1_response' => '1.0',
                          'question_2_response' => '2.0',
                          'question_3_response' => '3.0',
                          'question_4_response' => '4.0'];

      $this->assertEquals($expectedResults, $user->getSurveyAverages()->toArray());
    }
}
