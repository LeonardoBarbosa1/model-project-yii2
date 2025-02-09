<?php

use common\models\User;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Usuários', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <p>
                        <?= Html::a('Atualizar', ['user/update', 'id' => $model->id], [
                            'class' => 'btn btn-primary',
                        ]) ?>
                        <?= Html::a('Excluir', ['user/delete', 'id' => $model->id], [
                            'class' => 'btn btn-danger',
                            'data-method' => 'post',
                            'data-confirm' => 'Tem certeza que deseja excluir esse usuário?'
                        ]) ?>
                    </p>
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'email:email',
                            'username',
                            'name',
                            [
                                'attribute' => 'type',
                                'value' => User::typeValues($model->type),
                            ],
                            [
                                'attribute' => 'created_at',
                                'format' => 'date',
                            ],
                        ],
                    ]) ?>
                </div>
                <!--.col-md-12-->
            </div>
            <!--.row-->
        </div>
        <!--.card-body-->
    </div>
    <!--.card-->
</div>