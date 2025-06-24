<?php

namespace app\controllers;

use yii\rest\ActiveController;
use app\actions\DeleteActionWithMessage;

/**
 * @OA\Info(
 *     title="Books API",
 *     version="1.0",
 *     description="Books API documentation",
 * )
 * 
 * @OA\Tag(
 *     name="Books",
 *     description="Управление книгами"
 * )
 * 
 * @OA\Get(
 *     path="/books",
 *     summary="Список книг",
 *     tags={"Books"},
 *     @OA\Parameter(
 *         name="search",
 *         in="query",
 *         description="Поиск по названию и описанию",
 *         required=false,
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Parameter(
 *         name="author",
 *         in="query",
 *         description="ID авторов (массив)",
 *         required=false,
 *         @OA\Schema(
 *             type="array",
 *             @OA\Items(type="integer")
 *         ),
 *         style="form",
 *         explode=true
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Список книг",
 *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/BookSearch"))
 *     )
 * )
 * 
 * @OA\Post(
 *     path="/books",
 *     summary="Создание новой книги",
 *     tags={"Books"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/Book")
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Книга создана",
 *         @OA\JsonContent(ref="#/components/schemas/BookSearch")
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Ошибка валидации"
 *     )
 * )
 * 
 * @OA\Put(
 *     path="/books/{id}",
 *     summary="Обновление книги",
 *     tags={"Books"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/Book")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Книга обновлена",
 *         @OA\JsonContent(ref="#/components/schemas/BookSearch")
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Книга не найдена"
 *     )
 * )
 * 
 * @OA\Delete(
 *     path="/books/{id}",
 *     summary="Удаление книги",
 *     tags={"Books"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Книга удалена",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Книга New Book была успешно удалена.")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Книга не найдена"
 *     )
 * )
 * 
 */
class BooksController extends ActiveController
{
    public $modelClass = 'app\models\Book';

    /**
     * @inheritDoc
     */
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
