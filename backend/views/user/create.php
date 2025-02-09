<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Cadastro';
$this->params['breadcrumbs'][] = ['label' => 'Usuários', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <?= $this->render('_form', [
                'model' => $model
            ]) ?>
        </div>
        <!--.card-body-->
    </div>
    <!--.card-->
</div>