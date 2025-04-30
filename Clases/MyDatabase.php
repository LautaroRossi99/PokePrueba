<?php

class MyDatabase
{

    private $connection;
    public function __construct()
    {
        $config = parse_ini_file("config.ini");

        $this->connection = new mysqli(
            $config['host'],
            $config['user'],
            $config['pass'],
            $config['db']);
    }

    public function __destruct(){
        $this->connection->close();
    }

    public function query($sql){
        $datos = $this->connection->query($sql);

        return $datos->fetch_all(MYSQLI_ASSOC);
    }
}