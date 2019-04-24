<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Cereales;

/**
 * CerealesSearch represents the model behind the search form of `app\models\Cereales`.
 */
class CerealesSearch extends Cereales
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_cer'], 'integer'],
            [['nom_cer'], 'safe'],
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
        $query = Cereales::find();

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
            'id_cer' => $this->id_cer,
        ]);

        $query->andFilterWhere(['like', 'nom_cer', $this->nom_cer]);

        return $dataProvider;
    }
}
