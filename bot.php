﻿﻿<?php 

ob_start();

$API_KEY = 'Token'; //توکن را ست کنید
//################################################################################################################################################//
define('API_KEY',$API_KEY);
function bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}
 function sendmessage($chat_id, $text, $model, $message_id){
	bot('sendMessage',[
	'chat_id'=>$chat_id,
	'text'=>$text,
	'parse_mode'=>$mode,
	'reply_to_message_id'=>$message_id
	]);
	}
	function sendaction($chat_id, $action){
	bot('sendchataction',[
	'chat_id'=>$chat_id,
	'action'=>$action
	]);
	}
	function Forward($KojaShe,$AzKoja,$KodomMSG){
    bot('ForwardMessage',[
        'chat_id'=>$KojaShe,
        'from_chat_id'=>$AzKoja,
        'message_id'=>$KodomMSG
    ]);
	}
    function save($filename,$TXTdata){
	$myfile = fopen($filename, "w") or die("Unable to open file!");
	fwrite($myfile, "$TXTdata");
	fclose($myfile);
	}
//################################################################################################################################################//
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$message_id = $message->message_id;
$chat_id = $message->chat->id;
$from_id = $message->from->id;
$text = $message->text;
$username = $update->message->from->username;
$type = $update->message->chat->type;
$newchatmemberu = $update->message->new_chat_member->username;
$forchaneel = json_decode(file_get_contents("https://api.telegram.org/bot$API_KEY/getChatMember?chat_id=@channel&user_id=".$from_id)); // ایدی کانالتون رو ست کنید
$tch = $forchaneel->result->status;

$get = file_get_contents("https://api.telegram.org/bot$API_KEY/getChatMember?chat_id=$chat_id&user_id=".$from_id);
$info = json_decode($get, true);
$rank = $info['result']['status'];

$data = json_decode(file_get_contents("../data/data.json"),true);
$config = json_decode(file_get_contents("../data/config.json"),true);
$sudo = id;//sudo id
$idbot = "";
$sudos = $config[admin][$from_id];
$social = $config[social];
$lange = $data[$chat_id][lange];
$link = $data[$chat_id][lock]["link"];
$tags = $data[$chat_id][lock][tags];
$bot = $data[$chat_id][lock][bot];
$spam = $data[$chat_id][lock][spam];
$english = $data[$chat_id][lock][english];
$farsi = $data[$chat_id][lock][farsi];
//####################################################################CONFIG##############################################################################//
if(!file_exists('../data/config.json')){
$config[admin][$sudo] = "sudo";
$config[social] = "
》Social Classic version 1
the best anti spam open source by php 
programming launguge in telegram.

》create by :
》@TuDlmDrde_RuLbmKhande《
》Admins《
》@@TuDlmDrde_RuLbmKhande《
》@@TuDlmDrde_RuLbmKhande《

》Special thanks to :
》alone team Members

》Our channel :
》@aloneteamm《

";
file_put_contents('../data/config.json',json_encode($config));
}
//####################################################################INCLUDE HA##########################################################################//
include "plug.php";
include "../plugins/manage.php";
//####################################################################DELET MASSEGE##########################################################################//
//link//
if(preg_match('/^(.*)([Hh]ttp|[Hh]ttps|t.me)(.*)|([Hh]ttp|[Hh]ttps|t.me)(.*)|(.*)([Hh]ttp|[Hh]ttps|t.me)|(.*)[Tt]elegram.me(.*)|[Tt]elegram.me(.*)|(.*)[Tt]elegram.me|(.*)[Tt].me(.*)|[Tt].me(.*)|(.*)[Tt].me/',$text) )
{    
	preg_match('/^(.*)([Hh]ttp|[Hh]ttps|t.me)(.*)|([Hh]ttp|[Hh]ttps|t.me)(.*)|(.*)([Hh]ttp|[Hh]ttps|t.me)|(.*)[Tt]elegram.me(.*)|[Tt]elegram.me(.*)|(.*)[Tt]elegram.me|(.*)[Tt].me(.*)|[Tt].me(.*)|(.*)[Tt].me/',$text,$match);
	if($rank != "creator" && $rank != "administrator")
	{
		if($link == "lock")
		{
			bot('deleteMessage',[
				'chat_id'=>$chat_id,
				'message_id'=>$message->message_id
			]);
		}
	}
}
if(preg_match("/^(.*)([Hh]ttp|[Hh]ttps|t.me)(.*)|([Hh]ttp|[Hh]ttps|t.me)(.*)|(.*)([Hh]ttp|[Hh]ttps|t.me)|(.*)[Tt]elegram.me(.*)|[Tt]elegram.me(.*)|(.*)[Tt]elegram.me|(.*)[Tt].me(.*)|[Tt].me(.*)|(.*)[Tt].me/",$update->message->caption))
{
	preg_match("/^(.*)([Hh]ttp|[Hh]ttps|t.me)(.*)|([Hh]ttp|[Hh]ttps|t.me)(.*)|(.*)([Hh]ttp|[Hh]ttps|t.me)|(.*)[Tt]elegram.me(.*)|[Tt]elegram.me(.*)|(.*)[Tt]elegram.me|(.*)[Tt].me(.*)|[Tt].me(.*)|(.*)[Tt].me/",$text,$match,$update->message->caption);
	if($rank != "creator" && $rank != "administrator")
	{   
		if($link == "lock" ){    
			bot('deleteMessage',[
				'chat_id'=>$chat_id,
				'message_id'=>$message->message_id
			]);
		}
	}
}
//tags//
if(preg_match("/^(.*)@|@(.*)|(.*)@(.*)/",$text))
{
	preg_match("/^(.*)@|@(.*)|(.*)@(.*)/",$text,$match);
	if($rank != "creator" && $rank != "administrator")
	{
		if ($tags == "lock")
		{
			bot('deleteMessage',[
				'chat_id'=>$chat_id,
				'message_id'=>$message->message_id
			]);
		}
	}
}
if(preg_match("/^(.*)@|@(.*)|(.*)@(.*)/",$update->message->caption))
{
	preg_match("/^(.*)@|@(.*)|(.*)@(.*)/",$text,$match,$update->message->caption);
	if($rank != "creator" && $rank != "administrator")
	{
		if ($tags == "lock")
		{
			bot('deleteMessage',[
				'chat_id'=>$chat_id,
				'message_id'=>$message->message_id
			]);
		}
	}
}

if(preg_match("/^(.*)#|#(.*)|(.*)#(.*)/",$update->message->caption))
{
	preg_match("/^(.*)#|#(.*)|(.*)#(.*)/",$text,$match,$update->message->caption);
	if($rank != "creator" && $rank != "administrator")
	{
		if ($tags == "lock")
		{
			bot('deleteMessage',[
				'chat_id'=>$chat_id,
				'message_id'=>$message->message_id
			]);
		}
	}
}

if(preg_match("/^(.*)#|#(.*)|(.*)#(.*)/",$text))
{
	preg_match("/^(.*)#|#(.*)|(.*)#(.*)/",$text,$match);
	if($rank != "creator" && $rank != "administrator")
	{
		if ($tags == "lock")
		{
			bot('deleteMessage',[
				'chat_id'=>$chat_id,
				'message_id'=>$message->message_id
			]);
		}
	}
}

if(preg_match("/^(.*)a|a(.*)|(.*)b|b(.*)|(.*)c|c(.*)|(.*)d|d(.*)e|e(.*)|(.*)f|f(.*)|(.*)g|g(.*)|(.*)h|h(.*)|(.*)i|i(.*)|(.*)j|j(.*)|(.*)k|k(.*)|(.*)l|l(.*)|(.*)m|m(.*)|(.*)n|n(.*)|(.*)o|o(.*)|(.*)p|p(.*)|(.*)q|q(.*)|(.*)r|r(.*)|(.*)s|s(.*)|(.*)t|t(.*)|(.*)w|w(.*)|(.*)v|v(.*)|(.*)w|w(.*)|(.*)x|x(.*)|(.*)y|y(.*)|(.*)z|z(.*)(.*)A|A(.*)|(.*)B|B(.*)|(.*)C|C(.*)|(.*)D|D(.*)E|E(.*)|(.*)F|F(.*)|(.*)G|G(.*)|(.*)H|H(.*)|(.*)I|I(.*)|(.*)J|J(.*)|(.*)K|K(.*)|(.*)I|I(.*)|(.*)M|M(.*)|(.*)N|N(.*)|(.*)O|O(.*)|(.*)P|P(.*)|(.*)Q|Q(.*)|(.*)R|R(.*)|(.*)S|S(.*)|(.*)T|T(.*)|(.*)W|W(.*)|(.*)V|V(.*)|(.*)w|w(.*)|(.*)X|X(.*)|(.*)Y|Y(.*)|(.*)Z|Z(.*)/",$text))
{
	preg_match("/^(.*)a|a(.*)|(.*)b|b(.*)|(.*)c|c(.*)|(.*)d|d(.*)e|e(.*)|(.*)f|f(.*)|(.*)g|g(.*)|(.*)h|h(.*)|(.*)i|i(.*)|(.*)j|j(.*)|(.*)k|k(.*)|(.*)l|l(.*)|(.*)m|m(.*)|(.*)n|n(.*)|(.*)o|o(.*)|(.*)p|p(.*)|(.*)q|q(.*)|(.*)r|r(.*)|(.*)s|s(.*)|(.*)t|t(.*)|(.*)w|w(.*)|(.*)v|v(.*)|(.*)w|w(.*)|(.*)x|x(.*)|(.*)y|y(.*)|(.*)z|z(.*)(.*)A|A(.*)|(.*)B|B(.*)|(.*)C|C(.*)|(.*)D|D(.*)E|E(.*)|(.*)F|F(.*)|(.*)G|G(.*)|(.*)H|H(.*)|(.*)I|I(.*)|(.*)J|J(.*)|(.*)K|K(.*)|(.*)I|I(.*)|(.*)M|M(.*)|(.*)N|N(.*)|(.*)O|O(.*)|(.*)P|P(.*)|(.*)Q|Q(.*)|(.*)R|R(.*)|(.*)S|S(.*)|(.*)T|T(.*)|(.*)W|W(.*)|(.*)V|V(.*)|(.*)w|w(.*)|(.*)X|X(.*)|(.*)Y|Y(.*)|(.*)Z|Z(.*)/",$text,$match);
	if($rank != "creator" && $rank != "administrator")
	{
		if ($english == "lock")
		{
			bot('deleteMessage',[
				'chat_id'=>$chat_id,
				'message_id'=>$message->message_id
			]);
		}
	}
}


if(preg_match("/^(.*)س|س(.*)|(.*)ح|ح(.*)|(.*)ا|ا(.*)|(.*)س|(.*)س|س(.*)|(.*)ب|ب(.*)|(.*)ت|ت(.*)|(.*)ج|ج(.*)|(.*)چ|چ(.*)|(.*)خ|خ(.*)|(.*)د|د(.*)|(.*)ر|ر(.*)|(.*)ش|ش(.*)|(.*)ع|ع(.*)|(.*)ف|ف(.*)|(.*)ک|ک(.*)|(.*)ل|ل(.*)|(.*)م|م(.*)|(.*)ن|ن(.*)|(.*)و|و(.*)|(.*)ه|ه(.*)|(.*)ی|ی(.*)|(.*)ز|ز(.*)/",$text))
{
	preg_match("/^(.*)س|س(.*)|(.*)ح|ح(.*)|(.*)ا|ا(.*)|(.*)س|(.*)س|س(.*)|(.*)ب|ب(.*)|(.*)ت|ت(.*)|(.*)ج|ج(.*)|(.*)چ|چ(.*)|(.*)خ|خ(.*)|(.*)د|د(.*)|(.*)ر|ر(.*)|(.*)ش|ش(.*)|(.*)ع|ع(.*)|(.*)ف|ف(.*)|(.*)ک|ک(.*)|(.*)ل|ل(.*)|(.*)م|م(.*)|(.*)ن|ن(.*)|(.*)و|و(.*)|(.*)ه|ه(.*)|(.*)ی|ی(.*)|(.*)ز|ز(.*)/",$text,$match);
	if($rank != "creator" && $rank != "administrator")
	{
		if ($farsi == "lock")
		{
			bot('deleteMessage',[
				'chat_id'=>$chat_id,
				'message_id'=>$message->message_id
			]);
		}
	}
}

if($bot == "lock" )
{ 
	if (preg_match('/^(.*)([Bb][Oo][Tt])/s',$newchatmemberu) && $newchatmemberu != "$idbot")
	{
		bot('kickChatMember',[
			'chat_id'=>$chat_id,
			'user_id'=>$update->message->new_chat_member->id
		]);
	}
}
//####################################################################save settings##########################################################################//
file_put_contents('../data/data.json',json_encode($data));
if(file_exists("error_log"))unlink("error_log");
?>
