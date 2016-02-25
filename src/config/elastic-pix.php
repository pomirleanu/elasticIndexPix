<?php
/**
 * User: pomir
 * Date: 2/24/2016
 * Time: 5:38 PM
 */

use Elasticsearch\ClientBuilder;

return
    [
        /*
         * Specify the host(s) where elasticsearch is running.
         *
         * Can be use like this if HTTP Basic Authentication is enabled.
         *
         * $hosts = [
         *      'http://user:pass@localhost:9200',       // HTTP Basic Authentication
         *      'http://user2:pass2@other-host.com:9200' // Different credentials on different host
         *  ];
         *
         */
        'hosts' =>
            [
                '5.9.93.180:9200',
            ],

        /*
         * Specify the number of retries for elasticsearch.
         */
        'retries' => 3,

        /*
         * Specify the path where Elasticsearch will write it's logs.
         */
        'logPath' => storage_path() . DIRECTORY_SEPARATOR.'logs'.DIRECTORY_SEPARATOR.'elasticsearch.log',

        /*
         * Specify how verbose the logging must be
         * Possible values are listed here
         * https://github.com/Seldaek/monolog/blob/master/src/Monolog/Logger.php
         *
         */
        'logLevel' => 200,

        /**
         * Handler
         *
         * $defaultHandler = ClientBuilder::defaultHandler();
         * $singleHandler  = ClientBuilder::singleHandler();
         * $multiHandler   = ClientBuilder::multiHandler();
         * $customHandler  = new MyCustomHandler();
         */
        'handler' => 'ClientBuilder::defaultHandler()',

        /*
         * The name of the index elasticsearch will write to.
         */
        'defaultIndexName' => 'main'
    ];
