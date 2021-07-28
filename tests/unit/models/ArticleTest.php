<?php

namespace tests\unit\models;

use app\models\Article;


class ArticleTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    public $tester;

    public function testArticleModel()
    {
        $model = new Article();

        $model->attributes = [
            'name' => 'Tester',
            'email' => 'tester@example.com',
            'subject' => 'very important letter subject',
            'body' => 'body of current message',
            'verifyCode' => 'testme',
        ];

        expect_not($model->save());

    }
}
