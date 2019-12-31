# Tools MsgBot

Simple tools for testing tg bot message

## Usage

Download the composer

	curl https://getcomposer.org/composer.phar -o composer.phar

Install the vendors

	php composer.phar install    

Edit the config file

	cp config.php.example config.php
	vim config.php
	
## Config

1. Get the token from telegram	
2. Set the webhook enable when using in production mode
3. Set the webhook url to your full domain url when webhook is enabled

## Action

1. Enable webhook on bot

		api.php?action=set-web-hook
		
2. Remove webhhok on bot

		api.php?action=remove-web-hook