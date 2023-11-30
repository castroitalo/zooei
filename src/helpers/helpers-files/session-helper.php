<?php 

declare(strict_types=1);

use src\helpers\SessionManagerHelper;

/**
 * Get a session key value
 *
 * @param string $session_key
 * @return mixed
 */
function get_session_value(string $session_key): mixed
{
    return SessionManagerHelper::getSessionCoreInstance()->getSessionValue($session_key);
}

/**
 * Set a new session key
 *
 * @param string $session_key
 * @param string $session_value
 * @return void
 */
function set_session_key(string $session_key, string $session_value): void 
{
    SessionManagerHelper::getSessionCoreInstance()->setSessionValue($session_key, $session_value);
}

/**
 * Unset a existent session key
 *
 * @param string $session_key
 * @return void
 */
function unset_session_value(string $session_key): void 
{
    SessionManagerHelper::getSessionCoreInstance()->unsetSessionValue($session_key);
}

/**
 * Check if a session key exists
 *
 * @param string $session_key
 * @return boolean
 */
function has_session_key(string $session_key): bool
{
    return SessionManagerHelper::getSessionCoreInstance()->hasSessionKey($session_key);
}

/**
 * Check if disclaimer was accepted
 *
 * @return boolean
 */
function accept_dack(): string 
{
    return get_session_value("dack") === "yes" ? "invisible" : "visible";
}
