<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Acopios;

/**
 * AcopiosSearch represents the model behind the search form of `app\models\Acopios`.
 */
class AcopiosSearch extends Acopios
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_aco', 'cer_aco', 'lot_aco', 'sil_aco'], 'integer'],
            [['nom_aco','ubi_aco'], 'safe'],
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
        $query = Acopios::find()->joinWith('lugares');

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
            'id_aco' => $this->id_aco,
            'cer_aco' => $this->cer_aco,
            'lot_aco' => $this->lot_aco,
            'sil_aco' => $this->sil_aco,
        ]);

        $query->andFilterWhere(['like', 'nom_aco', $this->nom_aco]);
        $query->andFilterWhere(['like', 'acopios_lugares.nom_lug', $this->ubi_aco]);

        return $dataProvider;
    }
}
