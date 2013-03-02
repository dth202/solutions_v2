<style type="text/css">
#login_box {
	margin-top:30px;
	width:450px;
	height:250px;
	background-color:#EEE;
	margin-bottom:30px;
	border:1px solid #666;
}

#login_box p {
	width:88%;
	font-size:22px;
	font-family:"Lucida Sans Unicode", "Lucida Grande", sans-serif;
	padding-bottom:10px;
}
</style>
<?php
$failed = false;
$url = $_SERVER['REQUEST_URI'];
$url = explode("=", $url);
$url = $url[1];
if ($url == "failed") {
	$failed = true;
}
?>
		      <div
				<?php 
                
                    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
                        echo 'style="display:none"';
                      }
                    
                ?>>
                  <div align="center">
                    <div id="login_box" class="round shadow">
                        <p>Login</p>
                        <p style="font-size:10px;">Login to start editing and changing site content. If you are having problems email <a href="mailto:webmaster@awdoffice.com">support@intuitiveits.com</a></p>
                        
                        <form class="round" style="background-color:#EEE; width:90%; padding:10px 0px 10px 0px;" action="./../includes/sign_in.php" method="post" name="login" id="login">
                        <table style="font-family:Tahoma, Geneva, sans-serif; font-size:14px; border:none; background-color:transparent;">
                          <tr>
                          	<td>Email or Tech ID: </td>
                          	<td><input name="username" type="text" id="username" style="width:119px;" /></td>
                          </tr>
                          <tr>
                          	<td>Password: </td>
                          	<td><input name="password" type="password" id="pass" size="20" style="width:119px;" /></td>
                          </tr>
                        </table>
                        <div style="font-family:Verdana, Geneva, sans-serif; font-size:9px; color:#F00; <?php if (!$failed) { echo 'display:none;'; } ?>">
                            Last Attempt Failed
                        </div>
                        <div align="center"; style="padding-left:140px; padding-top:10px;"><input name="Submit" type="submit" id="submit" value="Login" style="width:85px;" /></div>
                        </form>
                        <script type="text/javascript">document.login.username.focus();</script>
                    </div>
                  </div>
                </div>
                <div <?php
                
                    if (!isset($_SESSION['logged_in']) && !$_SESSION['logged_in']) {
                        echo 'style="display:none;"';
                    } else {
                        echo 'style="padding:20px 100px 0px 100px;"';
                    }
                ?> align="center">
                    <h4>Already Signed In</h4>
                    <p>Your already logged in, if you would like to log in as somebody else click sign out at the top.</p>
                </div>