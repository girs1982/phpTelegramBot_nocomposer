<?php

include 'Telegram.php';
///web hook ///https://api.telegram.org/bot6044980010:AAFj9TqT2iYum6xdc7B_ex_hbqig8-OvcAw/setWebhook?url=https://gansta-paradise.com/T10-000/Bot/example-bot-master/TelegramBotPHP/bot%20examples/webhook/update.php
$bot_token = '6044980010:AAFj9TqT2iYum6xdc7B_ex_hbqig8-OvcAw';
$telegram = new Telegram($bot_token);
//$SSLCERTIFICATEFILE='';
//$WEBHOOKUR='https://gansta-paradise.com/T10-000/Bot/example-bot-master/TelegramBotPHP/bot%20examples/webhook/update.php';
//$telegram->set_webhook($WEBHOOKURL, $SSLCERTIFICATEFILE);
$text = $telegram->Text();
$chat_id = $telegram->ChatID();
$data = $telegram->getData();
$callback_query = $telegram->Callback_Query();

if (isset($_GET['user_id']) && isset($_GET['inline']) && isset($_GET['score'])) {
    $content = ['user_id' => $_GET['user_id'], 'inline_message_id' => $_GET['inline'], 'score' => $_GET['score'], 'force' => 'false'];
    $reply = $telegram->setGameScore($content);
    echo $reply;

    return;
}
if (!empty($data['inline_query'])) {
    $query = $data['inline_query']['query'];

    if (strpos('gamename', $query) !== false) {
        $results = json_encode([['type' => 'game', 'id'=> '1', 'game_short_name' => 'game_short']]);
        $content = ['inline_query_id' => $data['inline_query']['id'], 'results' => $results];
        $reply = $telegram->answerInlineQuery($content);
    }
}

if (!empty($callback_query)) {
    $game_name = $data['callback_query']['game_short_name'];
    $user_id = $data['callback_query']['from']['id'];
    $inline_id = $data['callback_query']['inline_message_id'];

    $content = ['callback_query_id' => $telegram->Callback_ID(), 'url' => 'http://domain.com/gamefolder/?user_id='.$user_id.'&inline='.$inline_id];
    $telegram->answerCallbackQuery($content);
}

if ($text == '/start') {
    $content = ['chat_id' => $chat_id, 'text' => 'Welcome to Test GameBot !'];
    $telegram->sendMessage($content);
}