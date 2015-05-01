<?php

use \photon\log\Log;

class LogSyslogTest extends \photon\test\TestCase
{

    public function testLog()
    {
        Log::setLevel('ALL');
        Log::info('PHPUnit is running');
        Log::info('All looks good !');
    }
}
