<?php

namespace app\models;

use Yii;
use linslin\yii2\curl\Curl;
use app\models\CardImages;
use app\models\Cast;
use app\models\Directors;
use app\models\Genres;
use app\models\ArtImages;
use app\models\ViewingWindow;
use app\models\Alternatives;
use app\models\Videos;

/**
 * This is the model class for table "article".
 *
 * @property string $id
 * @property string|null $body
 * @property string|null $cert
 * @property string|null $class
 * @property int|null $duration
 * @property string|null $headline
 * @property string|null $lastUpdated
 * @property string|null $quote
 * @property int|null $rating
 * @property string|null $skyGoId
 * @property string|null $skyGoUrl
 * @property string|null $sum
 * @property string|null $synopsis
 * @property string|null $url
 * @property string|null $year
 */
class Article extends \yii\db\ActiveRecord
{
    public $cardImages;
    public $artImages;
    public $cast;
    public $directors;
    public $genres;
    public $videos;
    public $viewingWindow;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['body', 'quote', 'skyGoUrl', 'synopsis', 'url', 'cert', 'class'], 'string'],
            [['duration', 'rating'], 'integer'],
            [['id', 'headline', 'lastUpdated', 'skyGoId', 'sum', 'year', 'cert', 'class'], 'string', 'max' => 255],
            [['id'], 'unique']
            
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'body' => 'Body',
            'duration' => 'Duration',
            'headline' => 'Headline',
            'lastUpdated' => 'Last Updated',
            'quote' => 'Quote',
            'rating' => 'Rating',
            'skyGoId' => 'Sky Go ID',
            'skyGoUrl' => 'Sky Go Url',
            'sum' => 'Sum',
            'synopsis' => 'Synopsis',
            'url' => 'Url',
            'year' => 'Year',
        ];
    }

    public function getTheCardImages()
    {
        return $this->hasMany(CardImages::className(), ['article_id' => 'id']);
    }

    public function getTheCast()
    {
        return $this->hasMany(Cast::className(), ['article_id' => 'id']);
    }

    public function getTheDirectors()
    {
        return $this->hasMany(Directors::className(), ['article_id' => 'id']);
    }

    public function getTheGenres()
    {
        return $this->hasMany(Genres::className(), ['article_id' => 'id']);
    }

    public function getTheArtImages()
    {
        return $this->hasMany(ArtImages::className(), ['article_id' => 'id']);
    }

    public function getTheVideos()
    {
        return $this->hasMany(Videos::className(), ['article_id' => 'id']);
    }

    public function getTheWindow()
    {
        return $this->hasMany(ViewingWindow::className(), ['article_id' => 'id']);
    }

    public function loadDependencies($data)
    {
        $this->cardImages    = $data['cardImages'];
        $this->artImages     = $data['keyArtImages'];
        $this->cast          = $data['cast'];
        $this->directors     = $data['directors'];
        $this->genres        = isset($data['genres']) ? $data['genres'] : [];
        $this->videos        = isset($data['videos']) ? $data['videos'] : [];
         
        $this->viewingWindow = isset($data['viewingWindow']) ? $data['viewingWindow'] : [];

        return true;
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        if($insert) {
            foreach($this->cardImages as $item) {
                $item['article_id'] = $this->id;
                $cardImages         = new CardImages();
                $cardImages->load($item, '');
                $cardImages->save();
            }

            foreach($this->cast as $item) {
                $item['article_id'] = $this->id;
                $cast               = new Cast();
                $cast->load($item, '');
                $cast->save();
            }

            foreach($this->directors as $item) {
                $item['article_id'] = $this->id;
                $director           = new Directors();
                $director->load($item, '');
                $director->save();
            }
            
            foreach($this->genres as $item) {
                $data['article_id'] = $this->id;
                $data['name']       = $item;
                $genre              = new Genres();
                $genre->load($data, '');
                $genre->save();
            }

            foreach($this->artImages as $item) {
                $item['article_id'] = $this->id;
                $artImage           = new ArtImages();
                $artImage->load($item, '');
                $artImage->save();
            }

            foreach($this->videos as $item) {
                $item['article_id']  = $this->id;
                $video               = new Videos();
                $video->alternatives = isset($item['alternatives']) ? $item['alternatives'] : [];
                $video->load($item, ''); 
                $video->save();
            }

            $this->viewingWindow['article_id']  = $this->id;
            $window = new ViewingWindow();
            $window->load($this->viewingWindow, ''); 
            $window->save();

        }

    }

}
