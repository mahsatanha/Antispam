﻿﻿<?php 
//#######################################################################STA#########################################################################//
if($type == 'private')
if($tch != 'member' && $tch != 'creator' && $tch != 'administrator')
{
  SendMessage($chat_id,"سلام🌹
🔸جهت حمایت و استفاده از ربات ما و همچنین اطلاع از بروز رسانی ها در کانال زیر عضو شوید و سپس گزینه 
/start
را بزنید.↖️
ایدی کانال ما:
🆔 : @channel");
  }
elseif(($text == '/start' || $text == "/شروع")&& $type == "private")
{
	$user = file_get_contents('Member.txt');
    $members = explode("\n",$user);
	if (!in_array($chat_id, $members))
	{
	$fileO = fopen('Member.txt', "a");
	fwrite($fileO, "$from_id \n");
	fclose($fileO);
    }	
sendaction($chat_id,'typing');
bot('sendMessage',[
    'chat_id'=>$chat_id,
    'text'=>"سلام به ربات ضد لینک سوشال خوش امدید.من را در گروهتون اضافه کنید و از امکانات فوقالعاده ام بهره مند شوید. \n @channel",
    'parse_mode'=>'html',
	'reply_to_message_id'=>$message_id,
    'reply_markup'=>json_encode([
      'inline_keyboard'=>[
			  [
				['text'=>"افزودن من به گروه.",'url'=>"http://telegram.me/$idbotstartgroup=new"] // id bot bedon @
			  ]
			  ],'resize_keyboard'=>true
		])
  ]);
}  	
//#######################################################################START GROUP#########################################################################//
if ($text == "/add" || $text == "/اضافه")
{
	if($sudos == "sudo")
	{
		$gapid = file_get_contents('gaps.txt');
		$gapidlist = explode("\n", $gapid);
		if (!in_array($chat_id, $gapidlist))
		{
			$fileO = fopen('gaps.txt', "a");
			fwrite($fileO, "$chat_id \n");
			fclose($fileO);
			$data[$chat_id][lock]["link"] = "lock";
			$data[$chat_id][lock][tags] = "unlock";
			$data[$chat_id][lock][bot] = "unlock";
			$data[$chat_id][lock][english] = "unlock";
			$data[$chat_id][lock][farsi] = "unlock";
			$data[$chat_id][lange] = "en";
$textadd = "
♻️ Group has been added.
please send /help for getting help bot.
-_-_-_-_-_-_-_-
♻️ گروه اضافه شد.
برای دریافت راهنما کلمه /راهنما را بفرستید.
➖➖➖➖➖➖➖➖
🆔: @channel
🆔: @id1
";	
			sendmessage($chat_id,"$textadd","html",$message_id);
		}else{
			$textbod = "
》 gяøυρ łš αlяeαđч αđđeđ ‼️
〰〰〰〰〰〰〰〰
🗯The robot is already in the group, the robot was is no longer need to do not
➖➖➖➖➖➖➖➖
🆔:  @channel
🆔: @id1
";
			sendmessage($chat_id,"$textbod","html",$message_id);
		}
	}else{
		sendmessage($chat_id,"شما ادمین نیستید.","html",$message_id);
	}
}
//####################################################################SET LANGE##########################################################################//
//fa//

if ($text == "/setlang fa")
{
	$data[$chat_id][lange] = "fa";
	sendmessage($chat_id,"زبان به فارسی تغیر یافت \n @channel","html",$message_id);
}
//en//
if ($text == "/setlang en")
{
	$data[$chat_id][lange] = "en";
	sendmessage($chat_id,"seted languge to english. \n @channel","html",$message_id);
}
//######START MANAGE#######//
if($rank == "creator" or $rank == "administrator")
{
	if($type == "supergroup")
	{
		if (isset($text))
		{
			$lock = explode(' ',$text);
			$loc = $lock[0];
		    $lock = $lock[1];
			if($lange == "en")
            {
                $poster = "^$lock^ locked. \n _________________ \n🎭channel: @channel";
				$posterr = "^$lock^ unlocked. \n _________________ \n🎭channel: @channel";
            }else{
                $poster = "^$lock^ قفل شد \n _________________ \n🎭کانال ما: @channel ";
				$posterr = "^$lock^ باز شد \n _________________ \n🎭کانال ما: @channel";
            }
		    if($loc == "/lock")
		    {
		    	if($lock == "link" || $lock == "tags" || $lock == "bot" || $lock == "english" || $lock == "farsi")
		        {
			        $data[$chat_id][lock][$lock] = "lock";
			        sendmessage($chat_id,"$poster","html",$message_id);
		        }
			}
		    elseif($loc == "/unlock")
		    {
		    	if($lock == "link" || $lock == "tags" || $lock == "bot" || $lock == "english" || $lock == "farsi")
		        {
			        $data[$chat_id][lock][$lock] = "unlock";
			        sendmessage($chat_id,"$posterr","html",$message_id);
		        }
			}
			elseif($loc == "/قفل")
			{
				switch ($lock)
				{
					case"لینک":
						$data[$chat_id][lock]["link"] = "lock";
						sendmessage($chat_id,"$poster","html",$message_id);
					break;
					case"تگ":
						$data[$chat_id][lock][tags] = "lock";
						sendmessage($chat_id,"$poster","html",$message_id);	
					break;
					case"ربات":
						$data[$chat_id][lock][bot] = "lock";
						sendmessage($chat_id,"$poster","html",$message_id);	
					break;
					case"انگلیسی":
						$data[$chat_id][lock][english] = "lock";
						sendmessage($chat_id,"$poster","html",$message_id);	
					break;
					case"فارسی":
						$data[$chat_id][lock][farsi] = "lock";
						sendmessage($chat_id,"$poster","html",$message_id);	
					break;
				}
			}
			elseif($loc == "/بازکردن")
			{
				switch ($lock)
				{
					case"لینک":
						$data[$chat_id][lock]["link"] = "unlock";
						sendmessage($chat_id,"$posterr","html",$message_id);
					break;
					case"تگ":
						$data[$chat_id][lock][tags] = "unlock";
						sendmessage($chat_id,"$posterr","html",$message_id);	
					break;
					case"ربات":
						$data[$chat_id][lock][bot] = "unlock";
						sendmessage($chat_id,"$posterr","html",$message_id);	
					break;
					case"انگلیسی":
						$data[$chat_id][lock][english] = "unlock";
						sendmessage($chat_id,"$posterr","html",$message_id);	
					break;
					case"فارسی":
						$data[$chat_id][lock][farsi] = "unlock";
						sendmessage($chat_id,"$posterr","html",$message_id);	
					break;
				}
			}
		}
	}

if($text == "/social")
{
		sendmessage($chat_id,"$social","html",$message_id);
}
if($text == "/help")
{
		$texthelp = "
[/lock or /unlock]: {link , tags , bot , english , farsi}
[/قفل یا /بازکردن ]: {لینک  , تگ  , بات  , انگلیسی  , فارسی}
$social
";
	sendmessage($chat_id,"$texthelp","html",$message_id);
}
if($text == "/settings")
{
		$textsettings = "
link = $link
tag = $tags
bot	= $bot
english = $english
farsi = $farsi
";
		sendmessage($chat_id,"$textsettings","html",$message_id);
}
if($text == "/id")
{
		sendmessage($chat_id,"chat:$chat_id \n yourid: $from_id","html",$message_id);
}
}
if(file_exists("error_log"))unlink("error_log");
?>
