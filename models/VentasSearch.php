<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Ventas;

/**
 * VentasSearch represents the model behind the search form of `app\models\Ventas`.
 */
class VentasSearch extends Ventas
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_ven'], 'integer'],
            [['fec_ven', 'cer_ven', 'des_ven'], 'safe'],
            [['kgs_ven', 'pkg_ven', 'pto_ven'], 'number'],
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
        $query = Ventas::find()->joinWith('cerVen')->joinWith('desVen');

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
            'id_ven' => $this->id_ven,
            'fec_ven' => $this->fec_ven,
            'kgs_ven' => $this->kgs_ven,
            'pkg_ven' => $this->pkg_ven,
            'pto_ven' => $this->pto_ven,
        ]);

        $query->andFilterWhere(['like', 'cereales.nom_cer', $this->cer_ven]);
        $query->andFilterWhere(['like', 'acopios.nom_aco', $this->des_ven]);

        return $dataProvider;
    }
}
