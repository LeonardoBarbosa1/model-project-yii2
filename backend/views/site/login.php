<?php

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

/**
 * @var $model \common\models\LoginForm
 */

$this->title = 'Login';
$modulePath = Yii::$app->controller->module->id;

$controller = Yii::$app->controller->id;

$filename = basename(Yii::$app->controller->view->viewFile, '.php');

?>
<div class="<?= $modulePath ?>-<?= $controller ?>-<?= $filename ?>">
<!--    <div class="card-body login-card-body">-->
        <h3 class="login-box-msg">Login</h3>

        <?php $form = ActiveForm::begin(['id' => 'login-form']) ?>

        <?= $form->field($model, 'email', [
            'options' => ['class' => 'form-group has-feedback'],
            'inputTemplate' => '{input}<div class="input-group-append"><div class="input-group-text"><span class="fas fa-envelope"></span></div></div>',
            'template' => '{beginWrapper}{input}{error}{endWrapper}',
            'wrapperOptions' => ['class' => 'input-group mb-3']
        ])->textInput([
            'placeholder' => $model->getAttributeLabel('email'),
            'type' => 'email',
            'autocomplete' => 'email',
        ]) ?>

        <?= $form->field($model, 'password', [
            'options' => ['class' => 'form-group has-feedback'],
            'inputTemplate' => '{input}<div class="input-group-append">
                            <span class="input-group-text" id="toggle-password" style="cursor: pointer;">
                                <span class="fas fa-eye" id="password-icon"></span>
                            </span>
                        </div>',
            'template' => '{beginWrapper}{input}{error}{endWrapper}',
            'wrapperOptions' => ['class' => 'input-group mb-3']
        ])
            ->label(false)
            ->passwordInput(['placeholder' => $model->getAttributeLabel('password'), 'id' => 'password-input']) ?>

        <div class="row">
            <div class="col-8">
                <?= $form->field($model, 'rememberMe')->checkbox([
                    'template' => '<div class="icheck-primary">{input}{label}</div>',
                    'labelOptions' => [
                        'class' => '',
                        'label' => 'Lembre de mim'
                    ],
                    'uncheck' => null
                ]) ?>
            </div>
            <div class="col-4">
                <?= Html::submitButton('Entrar', ['class' => 'btn btn-block btn-primary']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>

        <p class="mb-0">
            <?= Html::a('Cadastra-se', 'register', [
                'class' => 'btn btn-block btn-success'
            ]) ?>
        </p>
<!--    </div>-->
</div>


<script>
    // JavaScript para alternar a visibilidade da senha
    document.getElementById('toggle-password').addEventListener('click', function () {
        let passwordInput = document.getElementById('password-input');
        let passwordIcon = document.getElementById('password-icon');

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
</script>
