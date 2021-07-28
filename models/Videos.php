<?php

namespace app\models;

use Yii;
use app\models\Alternatives;

/**
 * This is the model class for table "videos".
 *
 * @property int $id
 * @property string $article_id
 * @property string|null $title
 * @property string|null $type
 * @property string|null $url
 *
 * @property Article $article
 */
class Videos extends \yii\db\ActiveRecord
{
    public $alternatives;

    public function fields()
    {
        return ['id'];
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'videos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['article_id'], 'required'],
            [['article_id', 'title', 'type', 'url'], 'string', 'max' => 255],
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
            'title' => 'Title',
            'type' => 'Type',
            'url' => 'Url',
        ];
    }

    /**
     * Gets query for [[Article]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTheAlternatives()
    {
        return $this->hasMany(Alternatives::className(), ['video_id' => 'id']);
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        if($insert) {
            foreach($this->alternatives as $item) {
                $item['video_id'] = $this->id;
                $alternative = new Alternatives();
                $alternative->load($item, '');
                $alternative->save();
            }
        }

    
    }
}
