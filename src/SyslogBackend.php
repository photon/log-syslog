<?php

namespace photon\log;
use \photon\config\Container as Conf;
use \photon\log\Log;

class SyslogBackend
{
    private static $isOpen = false;

    private static $photon2syslog = array(
        Log::ALL => LOG_DEBUG,
        Log::DEBUG => LOG_DEBUG,
        Log::INFO => LOG_INFO,
        Log::PERF => LOG_NOTICE,
        Log::EVENT => LOG_NOTICE,
        Log::WARN => LOG_WARNING,
        Log::ERROR => LOG_ERR,
        Log::FATAL => LOG_CRIT,
        Log::OFF => LOG_EMERG,
    );

    public static function write($stack)
    {
        if (self::$isOpen === false) {
            $default = array(
                'ident' => 'PhotonApp',
                'facility' => LOG_USER,
                'option' => LOG_CONS | LOG_NDELAY | LOG_PID
            );
            $conf = Conf::f('log_syslog', $default);
            $conf = array_merge($default, $conf);

            // Windows can log only in LOG_USER
            if (substr(PHP_OS, 0, 3) === 'WIN') {
                $conf['facility'] = LOG_USER;
            }

            $rc = openlog($conf['ident'], $conf['option'], $conf['facility']);
            if ($rc === true) {
                self::$isOpen = true;
            }
        }

        foreach ($stack as $elt) {
            $level = self::$photon2syslog[$elt[1]];

            if (is_array($elt[2]) || is_object($elt[2])) {
                $msg = json_encode($elt[2]);
            } else {
                $msg = $elt[2];
            }

            syslog($level, $msg);
        }

        return false;
    }
}

