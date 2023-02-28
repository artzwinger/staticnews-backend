<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PDO;

class CreateDatabase extends Command
{
    protected $signature = 'make:database';

    public function handle()
    {
        $schemaName = config("database.connections.mysql.database");
        $host = config("database.connections.mysql.host");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $charset = config("database.connections.mysql.charset", 'utf8mb4');
        $collation = config("database.connections.mysql.collation", 'utf8mb4_unicode_ci');

        $dbh = new PDO("mysql:host={$host}", $username, $password);
        $query = "CREATE DATABASE IF NOT EXISTS $schemaName CHARACTER SET $charset COLLATE $collation;";
        var_dump($dbh->query($query));
        $dbh = null;
    }
}
