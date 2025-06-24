<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "authors".
 *
 * @property int $id
 * @property string $name
 * @property int|null $birth_year
 * @property string|null $country
 *
 * @property Books[] $books
 * 
 * @OA\Schema(
 *     schema="Author",
 *     type="object",
 *     title="Author",
 *     required={"name", "birth_year", "country"},
 *     @OA\Property(property="id", type="integer"),
 *     @OA\Property(property="name", type="string"),
 *     @OA\Property(property="birth_year", type="integer"),
 *     @OA\Property(property="country", type="string")
 * )
 */
class Author extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'authors';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['birth_year', 'country'], 'default', 'value' => null],
            [['name'], 'required'],
            [['birth_year'], 'default', 'value' => null],
            [['birth_year'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['country'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'birth_year' => 'Birth Year',
            'country' => 'Country',
        ];
    }

    /**
     * Gets query for [[Books]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBooks()
    {
        return $this->hasMany(Books::class, ['author_id' => 'id']);
    }

}
