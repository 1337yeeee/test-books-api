<?php

namespace app\controllers;

use yii\rest\ActiveController;

use app\actions\DeleteActionWithMessage;

class BooksController extends ActiveController
{
    public $modelClass = 'app\models\Book';

    public function actions()
    {
        $actions = parent::actions();

        $actions['index']['prepareDataProvider'] = function () {
            $searchModel = new \app\models\BookSearch();
            return $searchModel->search(\Yii::$app->request->queryParams);
        };

        $actions['delete'] = [
            'class' => DeleteActionWithMessage::class,
            'modelClass' => $this->modelClass,
        ];

        return $actions;
    }
}
