<?php 

declare(strict_types=1);

namespace src\helpers;

use src\core\SessionCore;

/**
 * Class SessionManagerHelper
 * 
 * @package src\helpers
 */
class SessionManagerHelper
{
    /**
     * SessionCore instance
     *
     * @var SessionCore|null
     */
    private static ?SessionCore $sessionCoreInstance = null;

    /**
     * Get an instance of session core if didn't exists
     *
     * @return SessionCore
     */
    public static function getSessionCoreInstance(): SessionCore
    {
        if (is_null(self::$sessionCoreInstance)) {
            self::$sessionCoreInstance = new SessionCore();
        }

        return self::$sessionCoreInstance;
    }
}
