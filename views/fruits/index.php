<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use app\models\Favorite;


$this->title = 'Fruits';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fruits-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    $form = ActiveForm::begin([
                'method' => 'get',
                'action' => ['fruits/index'],
                'options' => ['class' => 'form-inline'],
    ]);
    ?>
    <div class="form-group">
        <?= Html::textInput('name', Yii::$app->request->get('name'), ['class' => 'form-control', 'placeholder' => 'Name']) ?>
    </div>
    <div class="form-group">
    <?= Html::textInput('family', Yii::$app->request->get('family'), ['class' => 'form-control', 'placeholder' => 'Family']) ?>
    </div>
<?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end(); ?>

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Family</th>
                <th>Genus</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
<?php foreach ($fruits as $fruit): ?>
                <tr>
                    <td><?= Html::encode($fruit->name) ?></td>
                    <td><?= Html::encode($fruit->family) ?></td>
                    <td><?= Html::encode($fruit->genus) ?></td>
                    <td>
                        <?php if (!Favorite::find()->where(['user_id' => Yii::$app->user->id, 'fruit_id' => $fruit->id])->exists()): ?>
                            <?= Html::a('Add to favorites', ['fruits/add-favorite', 'id' => $fruit->id], ['class' => 'btn btn-success']) ?>
                        <?php else: ?>
        <?= Html::a('Remove from favorites', ['fruits/remove-favorite', 'id' => $fruit->id], ['class' => 'btn btn-danger']) ?>
                <?php endif; ?>
                    </td>
                </tr>
<?php endforeach; ?>
        </tbody>
    </table>

<?php echo LinkPager::widget(['pagination' => $pagination]) ?>
</div>
