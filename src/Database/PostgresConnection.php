<?php

namespace Aejnsn\LaravelPostgresify\Database;

use Aejnsn\LaravelPostgresify\Database\Schema\Builder as SchemaBuilder;
use Aejnsn\LaravelPostgresify\Database\Schema\Grammars\PostgresGrammar as AejnsnPostgresSchemaGrammar;
use Illuminate\Database\PostgresConnection as BasePostgresConnection;
use Illuminate\Database\Query\Processors\PostgresProcessor;

class PostgresConnection extends BasePostgresConnection
{

    public function getSchemaBuilder()
    {
        if (is_null($this->schemaGrammar)) {
            $this->useDefaultSchemaGrammar();
        }
        return new SchemaBuilder($this);
    }

    protected function getDefaultSchemaGrammar()
    {
        return $this->withTablePrefix(new AejnsnPostgresSchemaGrammar);
    }

    protected function getDefaultPostProcessor()
    {
    
        return new PostgresProcessor;
    }
}
