<?php

namespace app\controllers;

use app\models\Books;

class ReportController extends \yii\web\Controller
{
    public function actionIndex()
    {
       $year = (int) \Yii::$app->request->get('year');
       $books = Books::getTopYearAuthirs($year);
       return $this->render('index', [
           "books" => $books
       ]);
    }

}
