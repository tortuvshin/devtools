<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;
use Faker\Factory as Faker;

class PagesControllerTest extends TestCase
{

    public function testCanVisitLandingPage()
    {
        $this->visit('/')
             ->see('Welcome to Daily Mood Survey');
    }

    public function testCannotVisitSurveysPage()
    {
      $this->visit('/daily-surveys')
           ->dontsee('Log Out')
           ->see('Forgot Your Password?');
    }

    public function testCanVisitSurveysPage($value='')
    {
      $faker = Faker::create();
      $user = User::create(['name'=>str_random(20), 'email'=>$faker->email,'password'=>'password']);
      $this->be($user);

      $this->visit('/daily-surveys')
           ->see('Your Averages')
           ->see('Log Out');
    }
}
