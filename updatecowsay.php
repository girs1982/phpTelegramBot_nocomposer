<?php
/**
 * Telegram Cowsay Bot Example.
 * Add @cowmooobot to try it!
 *
 * @author Gabriele Grillo <gabry.grillo@alice.it>
 * 
 * hook https://api.telegram.org/bot6044980010:AAFj9TqT2iYum6xdc7B_ex_hbqig8-OvcAw/setWebhook?url=https://gansta-paradise.com/T10-000/Bot/example-bot-master/TelegramBotPHP/bot%20examples/webhook/updatecowsay.php
 */
include 'Telegram.php';

// Set the bot TOKEN
$bot_token = '6044980010:AAFj9TqT2iYum6xdc7B_ex_hbqig8-OvcAw';
// Instances the class
$telegram = new Telegram($bot_token);

/* If you need to manually take some parameters
*  $result = $telegram->getData();
*  $text = $result["message"] ["text"];
*  $chat_id = $result["message"] ["chat"]["id"];
*/

// Take text and chat_id from the message
$text = $telegram->Text();
$chat_id = $telegram->ChatID();

if ($text == '/start') {
    $option = [["\xF0\x9F\x92\xA3"], ['Git', 'Credit']];
    // Create a permanent custom keyboard
    $keyb = $telegram->buildKeyBoard($option, $onetime = false);
    $content = ['chat_id' => $chat_id, 'reply_markup' => $keyb, 'text' => "Welcome to Gansta \xF0\x9F\x92\xA3\nPlease type /cowsay or click the Cow button !"];
    $telegram->sendMessage($content);
}
if ($text == '/cowsay' || $text == "\xF0\x9F\x92\xA3") {
    $randstring = rand().sha1(time());
    $cowurl = ' https://github.com/girs1982?tab=repositories'.$randstring;
    $content = ['chat_id' => $chat_id, 'text' => $cowurl];
    $telegram->sendMessage($content);
}
if ($text == '/credit' || $text == 'Credit') {
    $reply = " Telegram PHP API  https://github.com/girs1982?tab=repositories\nGansta-Girs api mod";
    $content = ['chat_id' => $chat_id, 'text' => $reply];
    $telegram->sendMessage($content);
}

if ($text == '/git' || $text == 'Git') {
    $reply = 'Check me on GitHub: https://github.com/girs1982?tab=repositories';
    $content = ['chat_id' => $chat_id, 'text' => $reply];
    $telegram->sendMessage($content);
}