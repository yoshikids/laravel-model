<?php

namespace Yoshikids\Laravel\Model\Database\Query\Grammars;

use Illuminate\Database\Query\Builder;

class MySqlGrammar extends \Illuminate\Database\Query\Grammars\MySqlGrammar
{
    /**
     * Compile an insert statement into SQL.
     *
     * @param Builder $query
     * @param array $values
     * @return string
     * @throws \Exception
     */
    public function compileInsert(Builder $query, array $values)
    {
        // Essentially we will force every insert to be treated as a batch insert which
        // simply makes creating the SQL easier for us since we can utilize the same
        // basic routine regardless of an amount of records given to us to insert.
        $table = $this->wrapTable($query->from);

        if (! is_array(reset($values))) {
            $values = [$values];
        }

        $columns = $this->columnize(array_keys(reset($values)));

        // We need to build a list of parameter place-holders of values that are bound
        // to the query. Each insert should have the exact same amount of parameter
        // bindings so we will loop through the record and parameterize them all.
        $parameters = collect($values)->map(function ($record) {
            return '('.$this->parameterize($record).')';
        })->implode(', ');

        $insert_option  = "";
        if ($query instanceof \Yoshikids\Laravel\Model\Database\Query\Builder)
        {
            if ($query->isInsertIgnore())
            {
                $insert_option  .= " ignore ";
            }
        }

        $SQL = "insert {$insert_option} into $table ($columns) values $parameters";

        return $SQL;
    }
}
