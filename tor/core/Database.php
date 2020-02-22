<?php

namespace tor\core;

class Database {
    
    private $pdo_database_instance;
    
    private $pdo_host;
    
    private $pdo_db_name;
    
    private $pdo_user;
    
    private $pdo_password;

    private $pdo_charset;

    private $pdo_options;

    public function __construct( array $db_credentials = NULL )
    {
        
        $this->pdo_host     = ( $db_credentials ) ? 
            $db_credentials['host'] : 
            TOR_DB_HOST;

        $this->pdo_db_name  = ( $db_credentials ) ? 
            $db_credentials['db_name'] : 
            TOR_DB_NAME;

        $this->pdo_user     = ( $db_credentials ) ? 
            $db_credentials['user'] : 
            TOR_DB_USER;

        $this->pdo_password = ( $db_credentials ) ? 
            $db_credentials['password'] : 
            TOR_DB_PASS;

        $this->pdo_charset  = ( $db_credentials && isset ( $db_credentials['charset'] ) ) ? 
            $db_credentials['charset'] :  
            'utf8mb4';

        $pdo_options_default = [
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        $this->pdo_options  = ( $db_credentials && isset ( $db_credentials['options'] ) ) ? 
            $db_credentials['options'] : 
            $pdo_options_default;
 
        try {

            $this->pdo_database_instance = new \PDO(
                 "mysql:host=$this->pdo_host;dbname=$this->pdo_db_name;charset=$this->pdo_charset", 
                 $this->pdo_user, $this->pdo_password, $this->pdo_options 
            );

        } catch (\PDOException $e) {

            throw new \PDOException($e->getMessage(), (int)$e->getCode());

        }

    }

    public function getHost()
    {
        
        return $this->pdo_host;

    }
    public function getDBname()
    {
        
        return $this->pdo_db_name;

    }
    public function getUser()
    {
        
        return $this->pdo_user;

    }
    public function getPassword()
    {
        
        return $this->pdo_password;

    }
    public function getCharset()
    {
        
        return $this->pdo_charset;

    }
    public function getOptions()
    {
        
        return $this->pdo_options;

    }

    public function query( string $statement, array $values = NULL, int $default_return = NULL )
    {
        $stmt =  $this->pdo_database_instance->prepare( $statement );
     
        if ( $values ) { 

            foreach ( $values as $value_key => $value) {

                $stmt->bindParam(  $value_key, $value );

            }

        }
         
        $stmt_return = ( $default_return ) ?: \PDO::FETCH_ASSOC;

        $stmt->setFetchMode( $stmt_return );

        $stmt->execute();

        return $stmt->fetch();

    }

   
}