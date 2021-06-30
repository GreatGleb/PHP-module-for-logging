<?php

namespace App\Models;

use App\Model;

/**
 * Class User
 * @package App\Models
 *
 */
class Log extends Model
{
    const TABLE = 'logs';

    public $log;

    /**
     * Метод, возвращающий адрес e-mail
     * @deprecated
     * @return string Адрес электронной почты
     */
    public function getEmail()
    {
        return $this->email;
    }

}