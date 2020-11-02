<?php
include_once("login.php");
if(isset($_GET['logout'])){
     
    //Simple exit message
    $fp = fopen("log.html", 'a');
    fwrite($fp, "<div class='msgln' style='color:red;'><i><b style='color:blue;'>پیام سیستم:</b> ". $_SESSION['name'] ." از چت روم خارج شد.</i><br></div>");
    fclose($fp);
     
    session_destroy();
    header("Location: index.php"); //Redirect the user
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>hackgm</title><meta http-equiv=content-type content="text/html; charset=utf-8"/><meta name=viewport content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0"><link rel="shortcut icon" type="image/x-icon" href="/110/design/defaulttheme/images/favicon.ico"><link rel=icon type="image/png" href="/110/design/defaulttheme/images/favicon.ico"/><meta name=Keywords content=""/><meta name=Description content=""/><meta name=robots content="noindex, nofollow"><meta name=copyright content="fata, cyberpolice.ir"><link rel=stylesheet type="text/css" href="/110/cache/compiledtemplates/389820f5aab5e3e38e5d5d1e3c25def8.css"/>
<link type="text/css" rel="stylesheet" href="style.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
<?php
if(!isset($_SESSION['name'])){
    loginForm();
}
else{
?>
<div id="wrapper">
  <div id="menu">
    <p class="welcome">chat room HACKGM<b><?php echo $_SESSION['name']; ?></b> خوش آمدید </p>
    <p class="logout"><a id="exit" href="#">خروج</a></p>
    <div style="clear:both"></div>
 <div style='display:none;'><li><a href='http://PicHaK.NeT/online-user'>کد نمایش افراد آنلاین</a></li></li></div>
<script type='text/JavaScript'>
var oulb= 'http://PicHaK.NeT/online-user/';
function CheckBrowser(){
if(navigator.appName == "Microsoft Internet Explorer")	{
document.write('<scrip'+'t src="'+oulb+'js/jquery.min.js"></s'+'cript><scrip'+'t src="'+oulb+'js/js.php?c=2&t=7"></s'+'cript>');return true;}document.write('<scrip'+'t src="'+oulb+'cod.php?c=2&t=7"></s'+'cript>');
return false; }</script>
<script type='text/JavaScript'>CheckBrowser()</script>

  </div>
  <div id="chatbox">
    <?php
if(file_exists("log.html") && filesize("log.html") > 0){
    $handle = fopen("log.html", "r");
    $contents = fread($handle, filesize("log.html"));
    fclose($handle);
     
    echo $contents;
}
?>
  </div>
  <form name="message" action="">
    <input name="usermsg" type="text" id="usermsg" size="120" />
    <input name="submitmsg" type="submit"  id="submitmsg" value="ارسال" />
  </form>
</div>
<br>
<small>&copy; چت روم<a href="http://T.ME/HACKGM"><strong>HACKGM</strong></a></small> 
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script> 
<script type="text/javascript">
	// jQuery Document
	$(document).ready(function(){
	});
	
	// jQuery Document
	$(document).ready(function(){
		//If user wants to end session
		$("#exit").click(function(){
			var exit = confirm("واقعاً می خواهید از چت روم خارج شوید؟");
			if(exit==true){window.location = 'index.php?logout=true';}		
		});
	});

	//If user submits the form
	$("#submitmsg").click(function(){	
		var clientmsg = $("#usermsg").val();
		$.post("post.php", {text: clientmsg});				
		$("#usermsg").attr("value", "");
		return false;
	});
	
	//Load the file containing the chat log
	function loadLog(){		

		$.ajax({
			url: "log.html",
			cache: false,
			success: function(html){		
				$("#chatbox").html(html); //Insert chat log into the #chatbox div				
		  	},
		});
	}

	//Load the file containing the chat log
	function loadLog(){		
		var oldscrollHeight = $("#chatbox").attr("scrollHeight") - 40; //Scroll height before the request
		$.ajax({
			url: "log.html",
			cache: false,
			success: function(html){		
				$("#chatbox").html(html); //Insert chat log into the #chatbox div	
				
				//Auto-scroll			
				var newscrollHeight = $("#chatbox").attr("scrollHeight") - 40; //Scroll height after the request
				if(newscrollHeight > oldscrollHeight){
					$("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
				}				
		  	},
		});
	}
		setInterval (loadLog, 2500);	//Reload file every 2500s ms
</script>
<?php
}
?>
</body>
</html>