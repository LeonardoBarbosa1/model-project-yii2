<?php
/* @var $content string */

use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Modal;

?>
<div class="content-wrapper">
    <?= Modal::widget([
        'id' => 'modal',
        'options' => [
            'tabindex' => false,
            'data-keyboard' => false,
            'data-backdrop' => 'static',
        ]
    ]) ?>

    <?= Modal::widget([
        'id' => 'modal-large',
        'size' => Modal::SIZE_LARGE,
        'options' => [
            'tabindex' => false,
            'data-keyboard' => false,
            'data-backdrop' => 'static',
        ]
    ]) ?>

    <?= Modal::widget([
        'id' => 'modal-small',
        'size' => Modal::SIZE_SMALL,
        'options' => [
            'tabindex' => false,
            'data-keyboard' => false,
            'data-backdrop' => 'static',
        ]
    ]) ?>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <?php if (Yii::$app->session->hasFlash('success')): ?>
            <div class="alert alert-success alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button" style="color: black">×</button>
                <?= is_array(Yii::$app->session->getFlash('success')) ? implode(', ', Yii::$app->session->getFlash('success')) : Yii::$app->session->getFlash('success') ?>
            </div>
        <?php endif; ?>

        <?php if (Yii::$app->session->hasFlash('error')): ?>
            <div class="alert alert-danger alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button" style="color: black">×</button>
                <h4><i class="icon fa fa-times"></i>Error!</h4>
                <?= is_array(Yii::$app->session->getFlash('error')) ? implode(', ', Yii::$app->session->getFlash('error')) : Yii::$app->session->getFlash('error') ?>
            </div>
        <?php endif; ?>
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">
                        <?php
                        if (!is_null($this->title)) {
                            echo \yii\helpers\Html::encode($this->title);
                        } else {
                            echo \yii\helpers\Inflector::camelize($this->context->id);
                        }
                        ?>
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <?php
                    echo Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        'options' => [
                            'class' => 'breadcrumb float-sm-right'
                        ]
                    ]);
                    ?>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <?= $content ?><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>