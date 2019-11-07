<?php
require_once dirname(__FILE__).'/vendor/autoload.php';

// Import
use Telegram\Bot\Api;

// Global variable
$config   = require_once dirname(__FILE__).'/config.php';
$telegram = new Api($config['telegram']['token']);

// Add commands
$telegram->addCommands([
    Telegram\Bot\Commands\HelpCommand::class,
    Bot\Commands\WhoAmICommand::class,
]);

//
$useWebHook = $config['telegram']['web_hook'];

$update = $telegram->commandsHandler($useWebHook);
