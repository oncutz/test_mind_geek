<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "viewingWindow".
 *
 * @property int $id
 * @property string $article_id
 * @property string|null $startDate
 * @property string|null $wayToWatch
 * @property string|null $endDate
 * @property Article $article
 */
class ViewingWindow extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'viewingWindow';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['article_id'], 'required'],
            [['article_id', 'startDate', 'wayToWatch', 'endDate'], 'string', 'max' => 255],
            [['article_id'], 'exist', 'skipOnError' => true, 'targetClass' => Article::className(), 'targetAttribute' => ['article_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'article_id' => 'Article ID',
            'startDate' => 'Start Date',
            'wayToWatch' => 'Way To Watch',
            'endDate' => 'End Date'
        ];
    }

    /**
     * Gets query for [[Article]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArticle()
    {
        return $this->hasOne(Article::className(), ['id' => 'article_id']);
    }
}
