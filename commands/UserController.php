<?php

namespace app\commands;

use app\models\User;
use yii\console\Controller;


class UserController extends Controller
{

    public function actionCreateUser(string $email, string $username, string $password): void
    {
        $user = User::createUser($email, $username, $password);
        echo $user->id;
    }
}
