<?php

namespace app\controllers;

use yii\rest\ActiveController;
use yii\filters\ContentNegotiator;
use yii\web\Response;

class AuthorsController extends ActiveController
{
    public $modelClass = 'app\models\Author';
}
