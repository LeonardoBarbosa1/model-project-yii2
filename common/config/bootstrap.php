<?php

use kartik\export\ExportMenu;
use kartik\grid\DataColumn;
use kartik\grid\EditableColumn;
use kartik\widgets\Select2;

Yii::setAlias('common', dirname(__DIR__));
Yii::setAlias('frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('api', dirname(dirname(__DIR__)) . '/api');
Yii::setAlias('console', dirname(dirname(__DIR__)) . '/console');

Yii::$container->set(\kartik\grid\ActionColumn::class, [
    'width' => '150px',
    'viewOptions' => [
        'class' => 'btn btn-default btn-sm',
    ],
    'updateOptions' => [
        'class' => 'btn btn-primary btn-sm',
    ],
    'deleteOptions' => [
        'class' => 'btn btn-danger btn-sm',
    ],
]);
Yii::$container->set(\kartik\grid\GridView::class, [
    'hover' => true,
    'pager' => [
        'firstPageLabel' => '««',
        'lastPageLabel' => '»»',
    ],
]);
Yii::$container->set(DataColumn::class, [
    'hAlign' => \kartik\grid\GridView::ALIGN_CENTER,
    'vAlign' => \kartik\grid\GridView::ALIGN_MIDDLE,
]);
Yii::$container->set(EditableColumn::class, [
    'hAlign' => \kartik\grid\GridView::ALIGN_CENTER,
    'vAlign' => \kartik\grid\GridView::ALIGN_MIDDLE,
]);
Yii::$container->set(ExportMenu::class, [
    'target' => ExportMenu::TARGET_BLANK,
    'fontAwesome' => true,
]);
Yii::$container->set(Select2::class, [
    'theme' => Select2::THEME_KRAJEE_BS4,
]);
