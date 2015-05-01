<?php

return array(
    // Register the log backend
    'log_handlers' => array(
        '\photon\log\SyslogBackend',
    ),

    // Configure the log backend
    'log_syslog' => array(
        'ident' => 'TestApp',
        'facility' => LOG_USER,
    ),
);
