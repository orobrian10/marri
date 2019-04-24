<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Variedades]].
 *
 * @see Variedades
 */
class VariedadesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Variedades[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Variedades|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
