<?php

namespace App\Service;

use Monolog\Formatter\LineFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class SearchLoggerService
{
    private Logger $logger;
    private const LOG_FILE = __DIR__."/../../search.log";
    public function __construct(){
        $this->logger = new Logger("search_logs");
        $output = "%datetime% / %message%\n";
        $formatter = new LineFormatter($output, "Y-m-d H:i:s", true, true);

        $handler = new StreamHandler(self::LOG_FILE, Logger::INFO);
        $handler->setFormatter($formatter);

        $this->logger->pushHandler($handler);
    }

    public function log($message){
        $this->logger->info($message);
    }
}

