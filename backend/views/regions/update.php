<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model board\entities\Regions */

$this->title = 'Update Regions: ' . $region->name;
$this->params['breadcrumbs'][] = ['label' => 'Regions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $region->name, 'url' => ['view', 'id' => $region->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="regions-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $region,
    ]) ?>

</div>
