<?php

namespace common\search;

use h3tech\crud\models\SearchModel;
use Yii;
use yii\base\InvalidConfigException;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;
use yii\db\ActiveRecordInterface;

/**
 * @property ActiveRecord $translationModel
 */
class TranslatableSearch extends SearchModel
{
    /* @var ActiveRecord */
    private $_translationModel;
    public $translatedFields = [];

    /**
     * @return ActiveRecordInterface|Model model instance.
     * @throws InvalidConfigException on invalid configuration.
     * @throws \yii\base\InvalidConfigException
     */
    public function getTranslationModel()
    {
        if (!is_object($this->_translationModel) || $this->_translationModel instanceof \Closure) {
            $model = Yii::createObject($this->_translationModel);
            if (!$model instanceof Model) {
                throw new InvalidConfigException(
                    '`' . get_class($this) . '::$model` should be an instance of `' . Model::class
                    . '` or its DI compatible configuration.'
                );
            }
            $this->_translationModel = $model;
        }
        return $this->_translationModel;
    }

    /**
     * @param Model|ActiveRecordInterface|array|string|callable $model model instance or its DI compatible configuration.
     * @throws InvalidConfigException on invalid configuration.
     */
    public function setTranslationModel($model)
    {
        if (is_object($model)) {
            if (!$model instanceof ActiveRecordInterface && !$model instanceof \Closure) {
                throw new InvalidConfigException(
                    '`' . get_class($this) . '::$model` should be an instance of `' . Model::class
                    . '` or its DI compatible configuration.'
                );
            }
        }
        $this->_translationModel = $model;
    }

    public function customizeSearch(ActiveDataProvider $dataProvider, array $params)
    {
        foreach ($this->translatedFields as $field) {
            $sortExpression = $this->_translationModel::tableName() . '.' . $field;

            $dataProvider->sort->attributes[$field] = [
                'asc' => [$sortExpression => SORT_ASC],
                'desc' => [$sortExpression => SORT_DESC],
            ];
        }
    }

    public function rules()
    {
        return array_merge(parent::rules(), [['id', 'integer']]);
    }
}
