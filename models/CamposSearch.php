<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Campos;

/**
 * CamposSearch represents the model behind the search form of `app\models\Campos`.
 */
class CamposSearch extends Campos
{

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'loc_campos','hec_tot_campos', 'hec_sem_campos'], 'integer'],
            [['nom_campos'], 'safe'],
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
    public $localidades;

    public function search($params)
    {
        $query = Campos::find();
        $query->leftJoin('localidades','localidades.id_loc = campos.loc_campos');

        // add conditions that should always apply here

//        $query->join(['JOIN', 'localidades', 'loc_campos = id_loc']);

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
            'id' => $this->id,
            'loc_campos' => $this->loc_campos,
            'hec_tot_campos' => $this->hec_tot_campos,
            'hec_sem_campos' => $this->hec_sem_campos,
        ]);

        $query->andFilterWhere(['like', 'nom_campos', $this->nom_campos]);

        return $dataProvider;
    }
}
