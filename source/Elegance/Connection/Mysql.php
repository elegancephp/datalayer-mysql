<?php

namespace Elegance\Connection;

use Elegance\Cif;
use Elegance\Connection\Mysql\MysqlMapTrait;
use Elegance\Connection\Mysql\MysqlConfigTrait;
use Elegance\Connection\Mysql\MysqlExecuteQueryTrait;
use Elegance\Connection\Mysql\MysqlExecuteSchemeQueryTrait;
use Elegance\Datalayer\Connection;

class Mysql extends Connection
{
    use MysqlMapTrait;
    use MysqlConfigTrait;
    use MysqlExecuteQueryTrait;
    use MysqlExecuteSchemeQueryTrait;

    /** Inicializa a conexão */
    protected function load()
    {
        $this->data['host'] = $this->data['host'] ?? env(strtoupper("DB_{$this->datalayer}_HOST"));
        $this->data['data'] = $this->data['data'] ?? env(strtoupper("DB_{$this->datalayer}_DATA"));
        $this->data['user'] = $this->data['user'] ?? env(strtoupper("DB_{$this->datalayer}_USER"));
        $this->data['pass'] = $this->data['pass'] ?? env(strtoupper("DB_{$this->datalayer}_PASS"));

        foreach ($this->data as $name => $value)
            $this->data[$name] = Cif::off($value);

        $this->instancePDO = [
            "mysql:host={$this->data['host']};dbname={$this->data['data']};charset=utf8",
            $this->data['user'],
            $this->data['pass']
        ];
    }
}
