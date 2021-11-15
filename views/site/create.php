<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Cadastr */

$this->title = 'Create Cadastr';
$this->params['breadcrumbs'][] = ['label' => 'Cadastrs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cadastr-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
