<?php

namespace app\controllers;

use yii\rest\ActiveController;
use yii\filters\ContentNegotiator;
use yii\web\Response;

/**
 * 
 * * @OA\PathItem(
 *     path="/authors"
 * )
 * 
 * @OA\Tag(
 *     name="Authors",
 *     description="Authors management"
 * )
 * 
 * @OA\Get(
 *     path="/authors",
 *     summary="List of authors",
 *     tags={"Authors"},
 *     @OA\Response(
 *         response=200,
 *         description="List of authors"
 *     )
 * )
 *
 * @OA\Post(
 *     path="/authors",
 *     summary="Create a new author",
 *     tags={"Authors"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/Author")
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Book created",
 *         @OA\JsonContent(ref="#/components/schemas/Author")
 *     )
 * )
 * 
 * @OA\Put(
 *     path="/authors",
 *     summary="Create a new author",
 *     tags={"Authors"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/Author")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Book updated",
 *         @OA\JsonContent(ref="#/components/schemas/Author")
 *     )
 * )
 */
class AuthorsController extends ActiveController
{
    public $modelClass = 'app\models\Author';
}
