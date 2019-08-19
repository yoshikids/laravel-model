<?php

namespace Yoshikids\Laravel\Model\Database\Query;

use Illuminate\Database\ConnectionInterface;
use Illuminate\Database\Query\Grammars\Grammar;
use Illuminate\Database\Query\Processors\Processor;

class Builder extends \Illuminate\Database\Query\Builder
{
    const DEFAULT_PAGE              = 1;
    const DEFAULT_LIMIT             = 20;

    protected $insertIgnore         = false;

    public function __construct(ConnectionInterface $connection, Grammar $grammar = null, Processor $processor = null)
    {
        parent::__construct($connection, $grammar, $processor);
    }

    /**
     * @param bool $value
     */
    public function setInsertIgnore($value = true)
    {
        $this->insertIgnore = $value;
    }

    /**
     * @return bool
     */
    public function isInsertIgnore()
    {
        return $this->insertIgnore;
    }
}
