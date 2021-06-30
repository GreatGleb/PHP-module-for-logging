<?php

namespace App\Controllers;

class Logger extends LoggerFactory implements LoggerInterface
{
    public $config;

    public function __construct()
    {
        $this->config = parse_ini_file(realpath("App\Config\config.ini"));
    }

    /**
     * Sends a log message to the default logger.
     */
    public function log()
    {
        $message = $this->generateRandomString();
        $this->send($message);
    }

    /**
     * Sends a log message to a special logger.
     *
     * @param string $type
     */
    public function logTo(string $type)
    {
        $message = $this->generateRandomString();
        $this->sendByLogger($message, $type);
    }

    /**
     * Sends a log message to all loggers.
     */
    public function logToAll()
    {
        $types = ['email', 'file', 'db'];
        foreach ($types as $type) {
            $message = $this->generateRandomString();
            $this->sendByLogger($message, $type);
        }
    }

    /**
     * Generate random string.
     *
     * @param int $length
     *
     * @return string
     */
    function generateRandomString($length = 24) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /**
     * Sends message to current logger.
     *
     * @param string $message
     *
     * @return void
     */
    public function send(string $message): void
    {
        $logger = $this->config['currentTypeOfLogging'];
        $this->sendByLogger($message, $logger);
    }

    /**
     * Sends message by selected logger.
     *
     * @param string $message
     * @param string $loggerType
     *
     * @return void
     */
    public function sendByLogger(string $message, string $loggerType): void
    {
        if($loggerType == 'email') {
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers[] = 'To: <' . $config['email'] . '>';

            mail($this->config['email'], 'Logging', $message, implode("\r\n", $headers));
        } else if($loggerType == 'file') {
            $log = "[" . date("Y-m-d H:i:s") . "] " . $message . "\n";
            file_put_contents('./App/Logs/log_'.date("Y.m.d").'.log', $log, FILE_APPEND);
        } else if($loggerType == 'db') {
            $log = new \App\Models\Log();
            $log->log = $message;
            $log->insert();
        }

        echo "\"" . $message . "\" was sent via " . $this->config['currentTypeOfLogging'] . "<br>\n";
    }

    /**
     * Gets current logger type.
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->config['currentTypeOfLogging'];
    }
    /**
     * Sets current logger type.
     *
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->config['currentTypeOfLogging'] = $type;
    }
}