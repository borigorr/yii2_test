<?php

namespace app\controllers;

use app\models\Subscribers;
use Yii;

class SubscribeController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $subscribe = new Subscribers();
        if ($subscribe->load(Yii::$app->request->post()) && $subscribe->validate()) {
            $subscribe->save();
        }
    }

}
