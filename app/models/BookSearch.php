<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class BookSearch extends Book
{
    const PAGE_SIZE = 20;

    public $search;
    public $author;

    public function rules()
    {
        return [
            [['search'], 'string'],
            [['author'], 'each', 'rule' => ['integer']],
        ];
    }

    public function search($params)
    {
        $query = Book::find()->with('author');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => self::PAGE_SIZE],
        ]);

        $this->load($params, '');
        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        if (!empty($this->search)) {
            $query->andWhere([
                'or',
                ['like', 'title', $this->search],
                ['like', 'description', $this->search],
            ]);
        }

        if (!empty($this->author)) {
            $query->andWhere(['author_id' => $this->author]);
        }

        return $dataProvider;
    }
}
