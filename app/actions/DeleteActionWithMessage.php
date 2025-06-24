<?php

namespace app\actions;

use Yii;
use yii\rest\DeleteAction;
use yii\web\NotFoundHttpException;

class DeleteActionWithMessage extends DeleteAction
{
    public function run($id)
    {
        $model = $this->findModel($id);

        if (!$model->delete()) {
            throw new \RuntimeException(Yii::t('app', 'Failed to delete {model}.', [
                'model' => $this->getModelName($model),
            ]));
        }

        Yii::$app->response->statusCode = 200;

        return [
            'message' => Yii::t('app', '{model} has been successfully deleted.', [
                'model' => $this->getModelName($model),
            ]),
        ];
    }

    protected function getModelName($model)
    {
        $class = (new \ReflectionClass($model))->getShortName();
        $translatedClass = Yii::t('app', $class);

        $title = null;
        if (isset($model->title)) {
            $title = $model->title;
        } elseif (isset($model->name)) {
            $title = $model->name;
        }

        if ($title !== null) {
            return "{$translatedClass} \"{$title}\"";
        }

        return $translatedClass;
    }
}
