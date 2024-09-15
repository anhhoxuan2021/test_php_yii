<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var app\models\RegisterForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\authclient\widgets\AuthChoice;

$this->title = 'Register';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-register">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-5">

            <?php $form = ActiveForm::begin([
                'method' => 'post',
                'action' => ['/site/register'],
                'id' => 'register-form',
                'fieldConfig' => [
                    'template' => "{label}\n{input}\n{error}",
                    'labelOptions' => ['class' => 'col-lg-7 col-form-label mr-lg-3'],
                    'inputOptions' => ['class' => 'col-lg-3 form-control'],
                    'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
                ],
            ]); ?>

            <?= $form->field($model, 'fullName')->textInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'userNameOrEmail')->textInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'password')->passwordInput() ?>
            <?= $form->field($model, 'confirmPassword')->passwordInput() ?>
            <div class="form-group">
                <div>
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'Submit']) ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
