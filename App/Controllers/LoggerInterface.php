<?php

namespace App\Controllers;

use App\Exceptions\Core;
use App\Exceptions\Db;
use App\MultiException;
use App\View;

interface LoggerInterface
{
    /**
     * Sends message to current logger.
     *
     * @param string $message
     *
     * @return void
     */
    public function send(string $message): void;
    /**
     * Sends message by selected logger.
     *
     * @param string $message
     * @param string $loggerType
     *
     * @return void
     */
    public function sendByLogger(string $message, string $loggerType): void;
    /**
     * Gets current logger type.
     *
     * @return string
     */
    public function getType(): string;
    /**
     * Sets current logger type.
     *
     * @param string $type
     */
    public function setType(string $type): void;
}