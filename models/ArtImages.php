<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "artImages".
 * @property int $id
 * @property string $article_id
 * @property string|null $url
 * @property int|null $h
 * @property int|null $w
 *
 * @property Article $article
 */
class ArtImages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'artImages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['article_id'], 'required'],
            [['h', 'w'], 'integer'],
            [['article_id', 'url'], 'string', 'max' => 255],
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
            'url' => 'Url',
            'h' => 'H',
            'w' => 'W',
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
