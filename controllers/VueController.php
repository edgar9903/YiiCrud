<?php

namespace app\controllers;

use yii\web\Controller;

class VueController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }

    /**
     * Displays homepage and all vue.js pages
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
