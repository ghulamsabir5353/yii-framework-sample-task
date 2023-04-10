<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\data\Pagination;
use app\models\Fruit;
use app\models\Favorite;
use app\models\FruitSearch;


class FruitsController extends Controller
{
    public function actionIndex()
    {
        $query = Fruit::find();

        $name = Yii::$app->request->get('name');
        if ($name) {
            $query->andWhere(['like', 'name', $name]);
        }

        $family = Yii::$app->request->get('family');
        if ($family) {
            $query->andWhere(['like', 'family', $family]);
        }

        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query->count(),
        ]);

        $fruits = $query->orderBy('name')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index', [
            'fruits' => $fruits,
            'pagination' => $pagination,
        ]);
    }

    public function actionFavorites()
    {
        $user_id = Yii::$app->user->id;

        $query = Favorite::find()->where(['user_id' => $user_id]);

        $fruits = $query->with('fruit')->all();

        return $this->render('favorites', [
            'fruits' => $fruits,
        ]);
    }

    public function actionAddFavorite($id)
    {
        $user_id = Yii::$app->user->id;

        $favorite = new Favorite([
            'user_id' => $user_id,
            'fruit_id' => $id,
        ]);

        if ($favorite->save()) {
            Yii::$app->session->setFlash('success', 'Added to favorites!');
        } else {
            Yii::$app->session->setFlash('error', 'Failed to add to favorites!');
        }

        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionRemoveFavorite($id)
    {
        $user_id = Yii::$app->user->id;

        $favorite = Favorite::findOne(['user_id' => $user_id, 'fruit_id' => $id]);

        if ($favorite && $favorite->delete()) {
            Yii::$app->session->setFlash('success', 'Removed from favorites!');
        } else {
            Yii::$app->session->setFlash('error', 'Failed to remove from favorites!');
        }

        return $this->redirect(Yii::$app->request->referrer);
    }
}