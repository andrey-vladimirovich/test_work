<?php
declare(strict_types=1);

namespace Orba\RandomCat\Logger;

use Magento\Framework\Logger\Handler\Base;

class Handler extends Base
{
    /**
     * Logging level
     *
     * @var int
     */
    protected $loggerType = Logger::ERROR;

    /**
     * File name
     *
     * @var string
     */
    protected $fileName = '/var/log/orba.txt';
}
