<?php

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

/**
 * @var $model \common\models\User
 */

$modulePath = Yii::$app->controller->module->id;

$controller = Yii::$app->controller->id;

$filename = basename(Yii::$app->controller->view->viewFile, '.php');

?>
<div class="<?= $modulePath ?>-<?= $controller ?>-<?= $filename ?>">
<!--    <div class="card-body login-card-body">-->
        <h3 class="login-box-msg">Cadastro</h3>

        <?php $form = ActiveForm::begin(['id' => 'login-form']) ?>

        <div class="row">
            <div class="col-md-12">
                <?= $form->field($model, 'name')->label(false)->textInput([
                    'autocomplete' => 'name',
                    'placeholder' => $model->getAttributeLabel('name')
                ]) ?>
            </div>
        </div>
        <!---->
        <!--        <div class="row">-->
        <!--            <div class="col-md-12">-->
        <!--                --><?php //= $form->field($model, 'username')->label(false)->textInput(['placeholder' => $model->getAttributeLabel('username')]) ?>
        <!--            </div>-->
        <!--        </div>-->

        <div class="row">
            <div class="col-md-12">
                <?= $form->field($model, 'email', [
                    'options' => ['class' => 'form-group has-feedback'],
                    'inputTemplate' => '{input}<div class="input-group-append"><div class="input-group-text"><span class="fas fa-envelope"></span></div></div>',
                    'template' => '{beginWrapper}{input}{error}{endWrapper}',
                    'wrapperOptions' => ['class' => 'input-group mb-3']
                ])->textInput(['placeholder' => $model->getAttributeLabel('email')]) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <?= $form->field($model, 'password_user', [
                    'options' => ['class' => 'form-group has-feedback'],
                    'inputTemplate' => '{input}<div class="input-group-append">
                                    <span class="input-group-text" id="toggle-password-user" style="cursor: pointer;">
                                        <span class="fas fa-eye" id="password-user-icon"></span>
                                    </span>
                                </div>',
                    'template' => '{beginWrapper}{input}{error}{endWrapper}',
                    'wrapperOptions' => ['class' => 'input-group mb-3']
                ])->passwordInput(['placeholder' => $model->getAttributeLabel('password_user'), 'id' => 'password-user-input']) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <?= $form->field($model, 'confirm_password', [
                    'options' => ['class' => 'form-group has-feedback'],
                    'inputTemplate' => '{input}<div class="input-group-append">
                                    <span class="input-group-text" id="toggle-confirm-password" style="cursor: pointer;">
                                        <span class="fas fa-eye" id="confirm-password-icon"></span>
                                    </span>
                                </div>',
                    'template' => '{beginWrapper}{input}{error}{endWrapper}',
                    'wrapperOptions' => ['class' => 'input-group mb-3']
                ])->passwordInput(['placeholder' => 'Confirme sua senha', 'id' => 'confirm-password-input']) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-8">
                <p class="mb-0" >
                    <?= Html::a('Login', '/', [
                            'class' => 'btn btn-primary',
                    ]) ?>
                </p>
            </div>
            <div class="col-4">
                <?= Html::submitButton('Cadastrar', ['class' => 'btn btn-block btn-success']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>

</div>

<script>
    // JavaScript para alternar a visibilidade da senha
    document.getElementById('toggle-password-user').addEventListener('click', function () {
        var passwordInput = document.getElementById('password-user-input');
        var passwordIcon = document.getElementById('password-user-icon');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            passwordIcon.classList.remove('fa-eye');
            passwordIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            passwordIcon.classList.remove('fa-eye-slash');
            passwordIcon.classList.add('fa-eye');
        }
    });

    document.getElementById('toggle-confirm-password').addEventListener('click', function () {
        var confirmPasswordInput = document.getElementById('confirm-password-input');
        var confirmPasswordIcon = document.getElementById('confirm-password-icon');

        if (confirmPasswordInput.type === 'password') {
            confirmPasswordInput.type = 'text';
            confirmPasswordIcon.classList.remove('fa-eye');
            confirmPasswordIcon.classList.add('fa-eye-slash');
        } else {
            confirmPasswordInput.type = 'password';
            confirmPasswordIcon.classList.remove('fa-eye-slash');
            confirmPasswordIcon.classList.add('fa-eye');
        }
    });
</script>