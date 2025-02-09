<?php

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Atualizar usuário: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Perfil', 'url' => ['user/profile', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <?=$this->render('_form-profile', [
                        'model' => $model
                    ]) ?>
                </div>
            </div>
        </div>
        <!--.card-body-->
    </div>
    <!--.card-->
</div>