<?php

namespace app\controllers;

use app\models\Cadastr;
use yii\helpers\Json;
use yii\web\Controller;

class SiteController extends Controller
{


    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $cads = '[';
        $models = Cadastr::findAll(['status' => 1]);
        foreach ($models as $i => $model) {
            $cad['id'] = $model->id;
            $cad['label'] = $model->cn;
            $cad['lat'] = $model->lat;
            $cad['lng'] = $model->lng;
            if ((count($models) - 1) === $i) {
                $cads  .= Json::encode($cad);
            } else {
                $cads  .= Json::encode($cad).',';
            }
        }
        $cads .= ']';
        return $this->render('index', ['cads' => $cads]);
    }

}
