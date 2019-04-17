<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Localidades]].
 *
 * @see Localidades
 */
class LocalidadesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Localidades[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Localidades|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
