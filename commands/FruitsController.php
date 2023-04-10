<?php

namespace app\commands;

use Yii;
use yii\console\Controller;
use yii\helpers\Json;
use app\models\Fruit;

class FruitsController extends Controller
{
    public function actionFetch()
    {
        $url = 'https://fruityvice.com/api/fruit/all';
        $fruitsJson = file_get_contents($url);
        $fruitsArray = Json::decode($fruitsJson);

        foreach ($fruitsArray as $fruitData) {
            $fruit = new Fruit();
            $fruit->name = $fruitData['name'];
            $fruit->family = $fruitData['family'];
            $fruit->genus = $fruitData['genus'];
            $fruit->order = $fruitData['order'];
            $fruit->created_at = time();
            $fruit->save();
        }

        $this->sendEmail(); //turn this line off if mailer isn't enabled on your system
    }

    private function sendEmail()
    {
        $message = Yii::$app->mailer->compose()
            ->setTo('your_email_address@example.com')
            ->setFrom('no-reply@example.com')
            ->setSubject('Fruits fetched')
            ->setTextBody('All fruits have been fetched and saved to the database.');

        $message->send();
    }
}
