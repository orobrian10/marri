<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Campos]].
 *
 * @see Campos
 */
class CamposQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Campos[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Campos|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
