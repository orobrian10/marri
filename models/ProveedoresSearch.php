<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Proveedores;

/**
 * ProveedoresSearch represents the model behind the search form of `app\models\Proveedores`.
 */
class ProveedoresSearch extends Proveedores
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_pro', 'tel_pro',], 'integer'],
            [['nom_pro', 'loc_pro'], 'safe'],
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
        $query = Proveedores::find()->joinWith('localidades');

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
            'id_pro' => $this->id_pro,
            'tel_pro' => $this->tel_pro,
            'loc_pro' => $this->loc_pro
        ]);

        $query->andFilterWhere(['like', 'nom_pro', $this->nom_pro]);

        return $dataProvider;
    }
}
