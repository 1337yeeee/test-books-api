<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use light\swagger\SwaggerApiAction;
use light\swagger\SwaggerAction;

class SwaggerController extends Controller
{
    /**
     * @inheritDoc
     */
    public function actions()
    {
        return [
            'index' => [
                'class' => SwaggerAction::class,
                'restUrl' => Yii::$app->urlManager->createUrl(['swagger/json']),
            ],
            'json' => [
                'class' => SwaggerApiAction::class,
                // по умолчанию сканируются все контроллеры
                'scanDir' => [
                    Yii::getAlias('@app/controllers'),
                    Yii::getAlias('@app/models'),
                ],
            ],
        ];
    }
}
