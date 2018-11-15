<?php

namespace frontend\controllers\faker;

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
}