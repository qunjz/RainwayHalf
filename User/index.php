<?php
include "../global.php";

$uid = $user['id'];
$cdusername = $mysqli->real_escape_string(strip_tags(stripslashes($_POST['cdusername'])));

if($usr['Admin'] == "true"){
	if($_POST["duser"]){
		$mysqli->query("DELETE FROM `accounts` WHERE `id` ='$uID'");
			die("<META http-equiv=refresh content=1;URL=/Settings/>");
		}
		if($_POST["cdusername"]){
			$mysqli->query("UPDATE `accounts` SET `username` = '[ Content Deleted ]' WHERE `id` = '$uID'");
				die("<META http-equiv=refresh content=1;URL=/User/");
		}	
	}
		if($_POST["sblurb"]){
			$mysqli->query("UPDATE `accounts` SET `description`= '[ Content Deleted ]' WHERE `id` = '$uID'");
				die("<META http-equiv=refresh content=1;URL=/User/");
				}


$getid = $_GET['id'];
	if(!$getid){
		if($logged){
			$getid = $usr['id'];
	}
		}
	$userquery = $mysqli->query("SELECT * FROM `accounts` WHERE `id`='$getid'");
		$user = $userquery->fetch_array();
			if($logged) {
				$uid = $usr['id'];
?>		
<body>
	<div class="lander">
	
	
		<?php
			if(!$user){
				die("<h2>Um...</h2><p>Is this your imaginary friend? I can't find this user somehow...</p>");
			}
			if($user['banned'] == "1"){
				die ("<h2>Oh no!</h2><p>Looks like this user has been banned from Rainway! Go make more friends with other users instead. This user sure was a trouble maker, for us to ban him.");
			}
			echo "<h1>" . $user['Username'] . "</h1>";
		?>
			<span style="float:left;margin-right:10px;">								<iframe allowtransparency scrolling="no" frameborder="no" src="/core/character.php?id=<?=$user['id']?>" width="200" height="225"></iframe></span>	
				<span style="float:left;text-align:left;width:300px;min-height:200px;max-height:400px;">
						<?php if ($user['online'] == "true") { 
						echo('
							Status: <font color="green">Online</font><br />
						');
						}
							else {
								echo('
								Status: <font color="red">Offline</font><br />
								');
							}
		?>			
						Position: <?php if($user['Admin'] == 'true'){
							echo "<font color=red>Administrator</font>";
								}else if($user['forumMod'] == '1'){
									echo '<b style=""><font color="#ff9900">Forum Moderator</font></b>';
										}else if($user['imageMod'] == '1'){
											echo '<b style=""><font color="#6fa8dc">Image Moderator</font></b>';
												}else if($user['globalMod'] == '1'){
													echo '<b style=""><font color="#00ff00">Global Moderator</font></b>';
														}else{
															echo '<b><font color="#3d85c6">Member</font></b>';
															}
		                                
		                     
											 		
				?>
					<hr style="border:1.5px solid #ccc;">
						<?php
						  $description = $user['description'];
						  if($description == ""){
						      echo"This user doesn't have a description.";
						  }else{
						      echo $description;
						  }
						?>
					<hr style="border:1.5px solid #ccc;"><br />
						<?php if($usr['powerAdmin'] == "true") {
							echo '<form method="post" action=""><input type="submit" value="Delete User" name="duser" class="btn"><input type="submit" class="btn" value="Block Username" name="cdusername"><input type="submit" class="btn" value="Scrub Blurb" name="sblurb"></form>';
	}
						?>
			<?php
			}
			?>
			<form method="post" action="/Inbox/Compose.php?id=<?php echo $user['id']; ?>"><input type="submit" class="btn" value="Message <?php echo $user['username']; ?>" name="msg"></form>
			
			</div>

		<?php include "../footer.php"; ?>