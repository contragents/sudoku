<?php

namespace classes;

/**
 * Helper for cli commands queue
 *
 * @author Mstyslav Bigunov <mstyslav.b@cudev.org>
 */
class CliQueue
{
    /**
     * @var string[]
     */
    protected static $commands = [];

    /**
     * Adds cli command for asynchronous execution
     * @param string $command
     * example CliQueue::addCommand("php index.php --task=Elasticsearch_Refresh_Establishments");
     */
    public static function addCommand($command)
    {
        self::$commands[] = $command;
    }

    public static function runCommand($command)
    {
        self::$commands[] = $command;
        self::runParallel();
    }

    public static function clearQueue()
    {
        self::$commands = [];
    }



    /**
     * Fires PARALLEL all cli commands
     */
    public static function runParallel()
    {
        $no_output_suffix = '> /dev/null 2>&1';

        foreach(self::$commands as $command) {
            $command = "nohup bash -c \"{$command}\" {$no_output_suffix} &";
            `{$command}`;
        }

        self::clearQueue();
    }


    /**
     * Fires all cli commands execution
     */
    public static function run()
    {
        $no_output_suffix = '> /dev/null 2>&1';
        $command = implode(" {$no_output_suffix} && ", self::$commands);
        $command .= $no_output_suffix;
        $command = "nohup bash -c \"{$command}\" {$no_output_suffix} &";
        `{$command}`;
        self::clearQueue();
    }
}
