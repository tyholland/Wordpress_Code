<?php     

$path = '/home/saddy/public_html/wp-load.php';
require_once($path);

session_start();    

$ref = $_GET['ref'];
$id = $_GET['id'];
$show = $_GET['show'];
$addy = $wpdb->get_row( $wpdb->prepare("SELECT ID FROM randomID WHERE reference = '".$ref."' ") );
$person = $wpdb->get_row( $wpdb->prepare("SELECT secretAddy FROM account WHERE ID = '".$addy->ID."' ") );
$me = $wpdb->get_row( $wpdb->prepare("SELECT secretAddy FROM account WHERE ID = '".$_SESSION['secretID']."' ") );

?>
<html>
<head>
<title>Secret Addy Chat</title> 
<script type="text/javascript" src="<?php bloginfo( 'template_directory' ); ?>/jquery.js"></script>  
<script type="text/javascript" src="<?php bloginfo( 'template_directory' ); ?>/functions.js"></script>  
</head>
<style type="text/css">
body {
  font:12px arial;
  background: url('http://secretaddy.com/wp-content/themes/secretAddy/images/heart.jpg') no-repeat;
}
 
#panel {
  border:1px solid #cccccc; 
  height:430px; 
  width:500px;
  padding:5px;
}
 
#title {
  margin-bottom:5px;
}
 
#screen {
  width:498px; 
  height:300px; 
  border:1px solid #cccccc;
  margin-bottom:5px;
  overflow-x:hidden;
  overflow-y:auto;
}
 
#input {
  float:left; 
  margin-right:5px;
}
 
#user {
  border:1px solid #cccccc; 
  width:150px;
}
 
#message {
  height:80px; 
  width:345px; 
  border:1px solid #cccccc;
}
</style>
<body>
<script type="text/javascript">
 process = setInterval("getMessage()", 1000);
</script>
<div id="panel"> 
  <div id="title">
    <input type="hidden" name="user1" id="user1" value="<?php echo $me->secretAddy; ?>">
    <input type="hidden" name="user2" id="user2" value="<?php echo $person->secretAddy; ?>"> 
    <input type="hidden" name="empty" id="empty" value="qwaszx">      
    <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
    <form method="get" action="/wp-content/themes/secretAddy/route.php">
      <input type="hidden" name="user" value="<?php echo $me->secretAddy; ?>"> 
      <input type="hidden" name="chatID" value="<?php echo $id; ?>">
      <input type="hidden" name="logoff" value="chat_off">
      <b>Secret Addy Chat:</b> <input type="submit" value="Sign Off" />
    </form>
  </div>
  <div id="screen"></div>
  <div>
    <div id="input">
      <textarea name="message" id="message" style="resize: none;"></textarea>
    </div>
    <div>
      <input type="button" name="post" value="Enter" onClick="javascript:chat();" />
      <?php 
      if ( $show == 1)
      {
			echo '<br />
		  		<input type="button" id="receive" value="Receive Message" onClick="javascript:message();" style="width: 130px;" />';
      }
      else
      {
      		echo '';
      }
      ?>
    </div>
  </div> 
</div>
</body>
</html>
