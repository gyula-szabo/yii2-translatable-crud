<?php

namespace h3tech\translatableCrud\controllers;

use h3tech\translatableCrud\search\TranslatableSearch;
use h3tech\crud\controllers\AbstractCRUDController;
use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;

class TranslatableCRUDController extends AbstractCRUDController
{
    protected static $searchModelClass = TranslatableSearch::class;
    protected static $translatedFields = [];
    protected static $translationModelClass;

    protected function canValidateModel(ActiveRecord $model)
    {
        $post = Yii::$app->request->post();
        /** @noinspection PhpUndefinedMethodInspection */
        return $model->load($post) && Model::loadMultiple($model->getVariationModels(), $post);
    }

    protected static function searchModelConfig()
    {
        return [
            'translationModel' => static::$translationModelClass,
            'translatedFields' => static::$translatedFields,
        ];
    }
}
