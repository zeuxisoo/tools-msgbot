<?php
namespace Bot\Commands;

use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;

class WhoAmICommand extends Command {

    /**
     * @var string Command Name
     */
    protected $name = "whoami";

    /**
     * @var string Command Description
     */
    protected $description = "Get your chat id";

    /**
     * @inheritdoc
     */
    public function handle() {
        // Update the chat status to typing...
        $this->replyWithChatAction(['action' => Actions::TYPING]);

        // Get update message
        $message = $this->getUpdate()->getMessage();
        $from    = $message->get('from');   // from user
        $chat    = $message->get('chat');   // current chat

        $username = $from->username;
        $chatId   = $chat->id;

        // Reply with the commands list
        $this->replyWithMessage([
            'text' => sprintf("Hello, Here is your information\n\nUsername: %s\nCurrent Chat id: %s\n", $username, $chatId)
        ]);
    }
}
