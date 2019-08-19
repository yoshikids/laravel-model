<?php

namespace Yoshikids\Laravel\Console;

use Illuminate\Contracts\Config\Repository;
use Yoshikids\Laravel\Model\Factory;
use Reliese\Coders\Console\CodeModelsCommand;

class Models extends CodeModelsCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'yoshikids:models
                            {--s|schema= : The name of the MySQL database}
                            {--c|connection= : The name of the connection}
                            {--t|table= : The name of the table}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse connection schema into models.';

    /**
     * Create a new command instance.
     *
     * @param Factory $models
     * @param \Illuminate\Contracts\Config\Repository $config
     */
    public function __construct(Factory $models, Repository $config)
    {
        \Reliese\Meta\MySql\Column::$mappings = [
            'string' => ['varchar', 'text', 'string', 'char', 'enum', 'tinytext', 'mediumtext', 'longtext'],
            'date' => ['datetime', 'year', 'date', 'time', 'timestamp'],
            'int' => ['bigint', 'int', 'integer', 'tinyint', 'smallint', 'mediumint'],
            'float' => ['float', 'decimal', 'numeric', 'dec', 'fixed', 'double', 'real', 'double precision'],
//        'boolean' => ['longblob', 'blob', 'bit'],
            'boolean' => ['bit'],
        ];

        parent::__construct($models, $config);
        $this->models = $models;
        $this->config = $config;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        parent::handle();
    }
}
