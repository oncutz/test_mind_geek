<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ArticleSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'body') ?>

    <?= $form->field($model, 'duration') ?>

    <?= $form->field($model, 'headline') ?>

    <?= $form->field($model, 'lastUpdated') ?>

    <?php // echo $form->field($model, 'quote') ?>

    <?php // echo $form->field($model, 'rating') ?>

    <?php // echo $form->field($model, 'skyGoId') ?>

    <?php // echo $form->field($model, 'skyGoUrl') ?>

    <?php // echo $form->field($model, 'sum') ?>

    <?php // echo $form->field($model, 'synopsis') ?>

    <?php // echo $form->field($model, 'url') ?>

    <?php // echo $form->field($model, 'year') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
