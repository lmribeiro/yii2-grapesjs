<?php

use thecodeholic\yii2grapesjs\widgets\GrapesjsInputWidget;
use thecodeholic\yii2grapesjs\widgets\GrapesjsWidget;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

Yii::$app->fs->addPlugin(new League\Flysystem\Plugin\ListPaths());
Yii::$app->fs->addPlugin(new League\Flysystem\Plugin\ListFiles());

$paths = array_map(function ($path) {
    return '/files/' . $path;
}, Yii::$app->fs->listPaths());
echo '<pre>';
var_dump($paths);
echo '</pre>';
/* @var $this yii\web\View */
/* @var $model thecodeholic\yii2grapesjs\models\Content */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="content-form">


    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-lg-11 col-md-10 col-xs-9">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-1 col-md-2 col-xs-3">
            <div class="form-group">
                <label for="">&nbsp;</label>
                <?= Html::submitButton('Save', ['class' => 'btn btn-block btn-success']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
    <?php if (!$model->isNewRecord): ?>
        <?php echo GrapesjsWidget::widget([
            'clientOptions' => [
                'storageManager' => [
                    'id' => '',
                    'type' => 'remote',
                    'stepsBeforeSave' => 1,
                    'urlStore' => "/grapesjs/save?id=$model->id",
                    'urlLoad' => "/grapesjs/get?id=$model->id",
                ],
                'assetManager' => [
                    'assets' => $paths,
                    'upload' => "/grapesjs/upload"
                ]
            ]
        ]) ?>
    <?php endif; ?>

</div>
