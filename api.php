<?php
require_once dirname(__FILE__).'/vendor/autoload.php';

// Import
use Telegram\Bot\Api;

// Refill
$_POST = json_decode(file_get_contents("php://input"), true);

// Helper
function getRequest($name) {
    $request = array_merge($_GET, $_POST);

    return $request[$name] ?? $request[$name];
}

// Global variables
$config   = require_once dirname(__FILE__).'/config.php';
$telegram = new Api($config['telegram']['token']);
$action   = getRequest('action');

// Flow
switch($action) {
    case 'send-message':
        sendMessage();
        break;
    default:
        echo "Unknown action";
        break;
}

// Action
function sendMessage() {
    $chatId  = getRequest('chatId');
    $message = getRequest('message');

    // TODO: send message to chatId with message

    echo json_encode([
        'ok'      => true,
        'message' => 'Message sent',
    ]);
}
