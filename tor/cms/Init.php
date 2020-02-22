<?php

namespace tor\cms;

class Init {

    protected $database_instance;
    
    protected $context;

    public function __construct()
    {

        $this->database_instance = new \tor\core\Database();
 
        $this->context = new \tor\cms\Context();

    }

    public function run()
    {  

        // Check if exist db structure
        if ( !$this->checkInstallation() ) 
            $this->makeInstallation();

        $page_context = $this->context->getPageContext();
        
        // Check and return if is frontend context...
        if ( $page_context == TOR_BACKEND )  
            return new \tor\cms\Backend();

        // ... Or backend
        return new \tor\cms\Frontend();

    }

    public function checkInstallation()
    {
        
        $table_name = $this->database_instance->getDBname();

        $is_db_empty = $this->database_instance->query("SELECT COUNT(DISTINCT `table_name`) FROM `information_schema`.`columns` WHERE `table_schema` = '$table_name'", NULL, \PDO::FETCH_NUM );
        
        return $is_db_empty[0];

    }

    public function makeInstallation()
    { 
        
        include ( TOR_CMS_CORE_PATH . '/views/installer/index.php');

        if( isset ( $_POST['submit'] ) ) { 

            $tables_tor_admin = [ 
                'admin_pages' =>  
                    "CREATE TABLE tor_admin_pages ( id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    url_slug VARCHAR(255) NOT NULL,
                    title VARCHAR(255) NOT NULL,
                    view VARCHAR(255),
                    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                )",
                'admin_pages_login' => 
                    "INSERT INTO `tor_admin_pages` ( `url_slug`, `title`, `view`, `reg_date`) VALUES ( '/tor-admin', 'Admin', 'admin.php', current_timestamp())",
                    "INSERT INTO `tor_admin_pages` ( `url_slug`, `title`, `view`, `reg_date`) VALUES ( '/tor-login', 'Login', 'login.php', current_timestamp())",
                'public_pages'  =>  
                    "CREATE TABLE tor_public_pages ( id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    url_slug VARCHAR(255) NOT NULL,
                    title VARCHAR(255) NOT NULL,
                    template VARCHAR(255),
                    parent_id INT(11), 
                    lang VARCHAR(10),
                    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                )",
                'public_pages_home' => 
                    "INSERT INTO `tor_public_pages` ( `url_slug`, `title`, `template`, `parent_id`,`lang`, `reg_date`) VALUES ( '/', 'Home', '',NULL, '', current_timestamp())",
            ];
            
            foreach ( $tables_tor_admin as $k => $table_tor_admin ) {
                
                $query_tables = $this->database_instance->query( $table_tor_admin );

                echo "<p>Creando tabla...$k</p>";

                usleep(500000);

                flush();

                ob_flush(); 

            }

            echo '<p>Proceso finalizado con exito...Refresca tu navegador.</p>';

        }

        include ( TOR_CMS_CORE_PATH . '/views/installer/footer.php');

    } 

}