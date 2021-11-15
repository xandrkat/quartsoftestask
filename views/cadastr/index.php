<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\CadastrSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cadastrs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cadastr-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Cadastr', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Update Cadastrs', ['update'], ['class' => 'btn btn-info']) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'cn:ntext',
            'status:boolean',
            'lat',
            'lng',

//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
