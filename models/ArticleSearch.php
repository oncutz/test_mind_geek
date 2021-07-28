<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Article;

/**
 * ArticleSearch represents the model behind the search form of `app\models\Article`.
 */
class ArticleSearch extends Article
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'body', 'headline', 'lastUpdated', 'quote', 'skyGoId', 'skyGoUrl', 'sum', 'synopsis', 'url', 'year'], 'safe'],
            [['duration', 'rating'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Article::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'duration' => $this->duration,
            'rating' => $this->rating,
        ]);

        $query->andFilterWhere(['like', 'id', $this->id])
            ->andFilterWhere(['like', 'body', $this->body])
            ->andFilterWhere(['like', 'headline', $this->headline])
            ->andFilterWhere(['like', 'lastUpdated', $this->lastUpdated])
            ->andFilterWhere(['like', 'quote', $this->quote])
            ->andFilterWhere(['like', 'skyGoId', $this->skyGoId])
            ->andFilterWhere(['like', 'skyGoUrl', $this->skyGoUrl])
            ->andFilterWhere(['like', 'sum', $this->sum])
            ->andFilterWhere(['like', 'synopsis', $this->synopsis])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'year', $this->year]);

        return $dataProvider;
    }
}
