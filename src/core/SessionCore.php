<?php

declare(strict_types=1);

namespace src\core;

/**
 * Class SessionCore
 *
 * @package src\core
 */
final class SessionCore
{
    /**
     * Singleton SessionCore instance
     *
     * @var SessionCore|null
     */
    private static ?SessionCore $sessionCoreInstance = null;

    /**
     * SessionCore constructor
     */
    public function __construct()
    {
        if (empty(session_id())) {
            session_start();
        }
    }

    /**
     * Get a session value
     *
     * @param string $sessionKey
     * @return mixed
     */
    public function getSessionValue(string $sessionKey): mixed
    {
        return isset($_SESSION[$sessionKey]) ? $_SESSION[$sessionKey] : false;
    }

    /**
     * Set a new session value 
     * 
     * @param string $session_key
     * @param mixed $session_value
     * @return void
     */
    public function setSessionValue(string $session_key, mixed $session_value): void
    {
        $_SESSION[$session_key] = $session_value;
    }

    /**
     * Unset a value from $_SESSION
     *
     * @param string $session_key
     * @return void
     */
    public function unsetSessionValue(string $session_key): void 
    {
        unset($_SESSION[$session_key]);
    }

    /**
     * Check if the session has a key 
     *
     * @param string $session_key
     * @return bool
     */
    public function hasSessionKey(string $session_key): bool 
    {
        return isset($_SESSION[$session_key]);
    }

    /**
     * Get session as object
     *
     * @return object
     */
    public function getSession(): object
    {
        return (object)$_SESSION;
    }
    
    /**
     * Get current session id 
     *
     * @return string
     */
    public function getSessionId(): string
    {
        return session_id();
    }

    /**
     * Get the singletong SessionCore instance
     *
     * @return SessionCore
     */
    public static function getSessionCoreInstance(): SessionCore
    {
        if (is_null(self::$sessionCoreInstance)) {
            self::$sessionCoreInstance = new self();
        }

        return self::$sessionCoreInstance;
    }
}
