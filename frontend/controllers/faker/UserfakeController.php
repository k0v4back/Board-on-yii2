<?php

namespace frontend\controllers\faker;

use board\entities\Advert;
use Faker\Factory;
use yii\web\Controller;
use board\entities\User;

class UserfakeController extends Controller
{
    public function actionUsers()
    {
        $faker = Factory::create();
        for($i = 0; $i < 100; $i++){

            if($i % 2 == 0){
                $result = 0;
            }else{
                $result = 10;
            }
//            User::fakerCreate($faker->name, $faker->email, $faker->password, $result);
            $user = new User();
            $user->username = $faker->name;
            $user->email = $faker->email;
            $user->password = $faker->password;
            $user->status = $result;
            $user->auth_key = \Yii::$app->security->generateRandomString();
            $user->save();

            echo $i;

        }

    }

    public function actionAdvert()
    {
        $faker = Factory::create();
        for($i = 0; $i < 100; $i++){

            $advert = new Advert();
            $advert->category_id = 48;
            $advert->user_id = 10;
            $advert->status = rand(0, 3);
            $advert->created_at = time();
            $advert->expired_at = time() * 0.2;
            $advert->region_id = rand(1, 100);
            $advert->title = $faker->title;
            $advert->price = rand(1, 10000);;
            $advert->address = $faker->address;
            $advert->content = $faker->text(1000);
            $advert->save();
            echo $i;
        }

    }
}