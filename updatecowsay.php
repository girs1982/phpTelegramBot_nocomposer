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
$mo='loh';
// Set the bot TOKEN
$bot_token = '6044980010:AAFj9TqT2iYum6xdc7B_ex_hbqig8-OvcAw';
// Instances the class
$telegram = new Telegram($bot_token);
$bo;
/* If you need to manually take some parameters
*  $result = $telegram->getData();
*  $text = $result["message"] ["text"];
*  $chat_id = $result["message"] ["chat"]["id"];
*/

// Take text and chat_id from the message
$text = $telegram->Text();
$chat_id = $telegram->ChatID();

if($chat_id=='-1001859431864'){$mo='noloh';}

$callback_query = $telegram->Callback_Query();
if (!empty($callback_query)) {
    $bo=$telegram->Callback_Data();
    if($bo=='como'){$reply =  'Group id is: '.$chat_id;}
    else{
    $reply = 'Callback value '.$telegram->Callback_Data();
    }
    $content = ['chat_id' => $telegram->Callback_ChatID(), 'text' => $reply];
    $telegram->sendMessage($content);

    $content = ['callback_query_id' => $telegram->Callback_ID(), 'text' => $reply, 'show_alert' => false];
    $telegram->answerCallbackQuery($content);
}

if ($text == '/start') {
  //  $option = [["\xF0\x9F\x92\xA3"], ['Git', 'Credit']];
    $option = array( array( $telegram->buildInlineKeyboardButton("\xF0\x9F\x92\xA3", $url="http://google.it"),$telegram->buildInlineKeyboardButton($text="Gansta","","como","gansta") ) );

    // Create a permanent custom keyboard
    //$keyb = $telegram->buildKeyBoard($option);
    $reply2 = "Callback data value".$telegram->Callback_Data();
  $keyb = $telegram->buildInlineKeyBoard($option);

    $content = ['chat_id' => $chat_id, 'reply_markup' =>$keyb, 'text' => "Welcome to Gansta \xF0\x9F\x92\xA3\nPlease type /gansta say or click the Gansta button !".$mo.$reply2];
    $telegram->sendMessage($content);
}
if ($text == '/gansta' || $text == "\xF0\x9F\x92\xA3") {
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