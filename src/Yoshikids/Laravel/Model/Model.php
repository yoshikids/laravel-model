<?php

namespace Yoshikids\Laravel\Model;

class Model extends \Reliese\Coders\Model\Model
{

    /**
     * @return array
     */
    public function getCasts()
    {
        $primary_keys   = $this->getPrimaryKey();
        if (is_array($primary_keys))
        {
            foreach ($primary_keys as $primary_key)
            {
                if (
                    array_key_exists($primary_key, $this->casts) &&
                    $this->autoincrement()
                ) {
                    unset($this->casts[$primary_key]);
                }
            }
        }
        else
        {
            if (
                array_key_exists($primary_keys, $this->casts) &&
                $this->autoincrement()
            ) {
                unset($this->casts[$primary_keys]);
            }
        }

        return $this->casts;
    }

    /**
     * @return string
     */
    public function getPrimaryKey()
    {
        $primaryKey = null;
        if (empty($this->primaryKeys->columns)) {
            throw new \Exception("No Primary Key. Please set to table. => {$this->getTable()}");
        }
        $count      = count($this->primaryKeys->columns);
        if ($count === 1)
        {
            $primaryKey = $this->primaryKeys->columns[0];
        }
        elseif ($count > 1)
        {
            $primaryKey = $this->primaryKeys->columns;
        }

        return $primaryKey;
    }

    /**
     * @return bool
     */
    public function hasCustomPrimaryKey()
    {
        $count          = count($this->primaryKeys->columns);
        $result         = false;
        if ($count > 1)
        {
            $result     = true;
        }
        elseif ($count === 1)
        {
            if ($this->getPrimaryKey() != $this->getDefaultPrimaryKeyField())
            {
                $result = true;
            }
        }

        return $result;
    }
}
