<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "books".
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
 */
class Book extends \yii\db\ActiveRecord
{

    public function beforeValidate()
    {
        \Yii::info('ATTRIBUTES: ' . print_r($this->attributes, true), 'app\debug');
        return parent::beforeValidate();
    }

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
