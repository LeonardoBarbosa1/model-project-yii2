<?php

use common\models\User;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\bootstrap4\ActiveForm */
?>
<!--style="border-radius: 20px"-->
<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'email')->textInput([
                'maxlength' => true,
            ]) ?>
        </div>


        <div class="col-md-6">
            <?= $form->field($model, 'username')->textInput([
                'maxlength' => true,
            ]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'type')->widget(\kartik\select2\Select2::class, [
                'data' => User::typeValues(),
                'options' => [
                    'placeholder' => 'Selecione um tipo...',
                ],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'password_user')->passwordInput() ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'confirm_password')->passwordInput() ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Salvar', ['class' => 'btn btn-success ']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
