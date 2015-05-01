log-syslog
===============

[![Build Status](https://travis-ci.org/photon/log-syslog.svg?branch=master)](https://travis-ci.org/photon/log-syslog)

Syslog backend for photon

Quick start
-----------

1) Add the module in your project

    composer require "photon/log-syslog:dev-master"

or for a specific version

    composer require "photon/log-syslog:1.0.0"

2) Add the log backend in photon configuration

    'log_handlers' => array(
        '\photon\log\SyslogBackend',
    ),

3) Configure the backend

    'log_syslog' => array(
        'ident' => 'MyApp',
        'facility' => LOG_USER,
    ),

5) Enjoy !

