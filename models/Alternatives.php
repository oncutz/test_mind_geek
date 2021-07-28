<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "alternatives".
 * @property int $id
 * @property int $video_id
 * @property string|null $quality
 * @property string|null $url
 *
 * @property Videos $video
 */
class Alternatives extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'alternatives';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['video_id'], 'required'],
            [['video_id'], 'integer'],
            [['quality', 'url'], 'string', 'max' => 255],
            [['video_id'], 'exist', 'skipOnError' => true, 'targetClass' => Videos::className(), 'targetAttribute' => ['video_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'video_id' => 'Video ID',
            'quality' => 'Quality',
            'url' => 'Url',
        ];
    }

    /**
     * Gets query for [[Video]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVideo()
    {
        return $this->hasOne(Videos::className(), ['id' => 'video_id']);
    }
}
