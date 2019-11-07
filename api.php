<?php
require_once dirname(__FILE__).'/vendor/autoload.php';

// Import
use Telegram\Bot\Api;

// Refill
$_POST = json_decode(file_get_contents("php://input"), true) ?? [];

// Helper
function getRequest($name) {
    $request = array_merge($_GET, $_POST);

    return $request[$name] ?? "";
}

// Global variables
$config   = require_once dirname(__FILE__).'/config.php';
$telegram = new Api($config['telegram']['token']);
$action   = getRequest('action');

// Flow
switch($action) {
    case 'send-message':
        sendMessage($telegram);
        break;
    case 'set-web-hook':
        setWebHook($telegram, $config);
        break;
    case 'remove-web-hook':
        removeWebHook($telegram);
        break;
    default:
        echo "Unknown action";
        break;
}

// Action
function sendMessage($telegram) {
    $chatId  = getRequest('chatId');
    $message = getRequest('message');

    $telegram->sendMessage([
        'chat_id' => $chatId,
        'text'    => $message,
    ]);

    echo json_encode([
        'ok'      => true,
        'message' => 'Message sent',
    ]);
}

function setWebHook($telegram, $config) {
    $response = $telegram->setWebhook([
        'url' => $config['telegram']['webhook']['url']
    ]);

    echo $response === true ? "OK" : "Error!";
}

function removeWebHook($telegram) {
    $response = $telegram->removeWebHook();

    echo $response === true ? "OK" : "Error!";
}
