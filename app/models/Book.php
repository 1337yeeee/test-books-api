<?php

namespace app\models;

use Yii;

/**
 * * This is the model class for table "books".
 *
 * @property int $id
 * @property string $title
 * @property int $author_id
 * @property int $pages
 * @property string $language
 * @property string $genre
 * @property string|null $description
 *
 * @property Author $author
 * 
 * @OA\Schema(
 *    schema="BookBase",
 *    type="object",
 *    title="BookBase",
 *    required={"title", "pages", "language", "genre"},
 *    @OA\Property(property="id", type="integer"),
 *    @OA\Property(property="title", type="string"),
 *    @OA\Property(property="pages", type="integer"),
 *    @OA\Property(property="language", type="string"),
 *    @OA\Property(property="genre", type="string"),
 *    @OA\Property(property="description", type="string")
 * )
 * 
 * @OA\Schema(
 *     schema="Book",
 *     allOf={
 *        @OA\Schema(ref="#/components/schemas/BookBase"),
 *        @OA\Schema(
 *            type="object",
 *            @OA\Property(property="author_id", type="integer")
 *        )
 *    }
 * )
 */
class Book extends \yii\db\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public function fields()
    {
        $fields = parent::fields();

        unset($fields['author_id']);
        $fields['author'] = function ($model) {
            return $model->author;
        };

        return $fields;
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'books';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'default', 'value' => null],
            [['title', 'author_id', 'pages', 'language', 'genre'], 'required'],
            [['author_id', 'pages'], 'default', 'value' => null],
            [['author_id', 'pages'], 'integer'],
            [['description'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['language', 'genre'], 'string', 'max' => 50],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => Author::class, 'targetAttribute' => ['author_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'author_id' => 'Author ID',
            'pages' => 'Pages',
            'language' => 'Language',
            'genre' => 'Genre',
            'description' => 'Description',
        ];
    }

    /**
     * Gets query for [[Author]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Author::class, ['id' => 'author_id']);
    }

}
