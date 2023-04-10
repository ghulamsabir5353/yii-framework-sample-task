<?php

use yii\helpers\Html;

$this->title = 'Favorite Fruits';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="favorites-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Family</th>
                <th>Genus</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($fruits as $favorite): ?>
                <tr>
                    <td><?= Html::encode($favorite->fruit->name) ?></td>
                    <td><?= Html::encode($favorite->fruit->family) ?></td>
                    <td><?= Html::encode($favorite->fruit->genus) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
