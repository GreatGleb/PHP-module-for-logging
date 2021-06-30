<?php

require __DIR__ . '/autoload.php';

use App\Controllers\LoggerFactory;
use App\Controllers\Logger;

function launchLogging(LoggerFactory $logger)
{
    $logger = $logger::build();

    $logger->log();
    $logger->logTo('file');
//    $logger->logToAll();
    var_dump($logger->setType('db'));
    $logger->send('It\'s Gleb!');
    var_dump($logger->getType());
}

try {
    launchLogging(new Logger());
} catch (\App\Exceptions\Core $e) {
    echo 'Возникло исключение приложения: ' . $e->getMessage();
} catch (PDOException $e) {
  echo 'Что-то не так с базой';
}
