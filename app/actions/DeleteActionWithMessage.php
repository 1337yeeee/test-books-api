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
            throw new \RuntimeException("Не удалось удалить модель с ID $id.");
        }

        Yii::$app->response->statusCode = 200;

        return [
            'message' => "Книга с ID {$id} успешно удалена.",
        ];
    }
}
