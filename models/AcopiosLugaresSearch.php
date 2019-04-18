<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AcopiosLugares;

/**
 * AcopiosLugaresSearch represents the model behind the search form of `app\models\AcopiosLugares`.
 */
class AcopiosLugaresSearch extends AcopiosLugares
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_lug'], 'integer'],
            [['nom_lug'], 'safe'],
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
        $query = AcopiosLugares::find();

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
            'id_lug' => $this->id_lug,
        ]);

        $query->andFilterWhere(['like', 'nom_lug', $this->nom_lug]);

        return $dataProvider;
    }
}
