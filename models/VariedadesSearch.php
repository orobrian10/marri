<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Variedades;

/**
 * VariedadesSearch represents the model behind the search form of `app\models\Variedades`.
 */
class VariedadesSearch extends Variedades
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_var','cer_var'], 'integer'],
            [['des_var'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Variedades::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_var' => $this->id_var,
        ]);

        $query->andFilterWhere(['like', 'des_var', $this->des_var]);

        return $dataProvider;
    }
}
