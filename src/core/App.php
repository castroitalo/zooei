<?php 

declare(strict_types=1);

namespace src\core;

use PDO;

/**
 * Class App 
 * 
 * @package src\core
 */
class App 
{
    /**
     * App's database connection
     *
     * @var PDO
     */
    public PDO $databaseConnection;

    /**
     * App's router
     *
     * @var RouterCore
     */
    public RouterCore $router;

    /**
     * App's session
     *
     * @var SessionCore
     */
    public SessionCore $session;

    /**
     * App constructor
     */
    public function __construct()
    {
        $this->databaseConnection = DatabaseCore::getDatabaseConnection();
        $this->router = new RouterCore();
        $this->session = new SessionCore();
    }
}
