<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Movimientos;

/**
 * MovimientosSearch represents the model behind the search form of `app\models\Movimientos`.
 */
class MovimientosSearch extends Movimientos
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_mov', 'fec_cos', 'can_mov', 'car_mov'], 'integer'],
            [['cer_mov','des_mov','ori_mov', 'cos_mov'], 'safe'],
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
        $query = Movimientos::find()->joinWith('cereales')->joinWith('acopios')->joinWith('localidades');

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
            'id_mov' => $this->id_mov,
            'fec_cos' => $this->fec_cos,
            'can_mov' => $this->can_mov,
            'car_mov' => $this->car_mov,
        ]);

        $query->andFilterWhere(['like', 'cereales.nom_cer', $this->cer_mov]);
        $query->andFilterWhere(['like', 'acopios.nom_aco', $this->des_mov]);
        $query->andFilterWhere(['like', 'localidades.nom_loc', $this->ori_mov]);
        $query->andFilterWhere(['like', 'cos_mov', $this->cos_mov]);

        return $dataProvider;
    }
}
