<?php

namespace App\Controllers;

use App\Controllers\Logger;

abstract class LoggerFactory
{
    public static function build()
    {
        return new Logger();
    }

    /**
     * Sends a log message to the default logger.
     */
    abstract public function log();

    /**
     * Sends a log message to a special logger.
     *
     * @param string $type
     */
    abstract public function logTo(string $type);

    /**
     * Sends a log message to all loggers.
     */
    abstract public function logToAll();
}