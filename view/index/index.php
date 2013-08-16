<?php
session_start();
$_SESSION['__HISTORY']=null;
$_SESSION['__HISTORY']=array();
include_once '../common/header.php';
?>

		<div class="highlights">
		<?php 
		$sql="SELECT * FROM `highlight` WHERE `lang`='$lang' ORDER BY `id` DESC LIMIT 10";
		$result=mysql_query($sql);
		$rows=mysql_num_rows($result);
		if($rows>0){
			$i=0;
			while ($i<$rows){
				$link=mysql_result($result, $i,"link");
				$photo=mysql_result($result, $i,"photo");
				$photo=str_replace("..", "../../admin", $photo);
				echo "<img src='$photo' onclick=\"document.location='$link'\" />";
				$i++;
			}
		}
		?>
		</div>
		<div class="homeContents">
			<div class="catContainer">
				<div class="title"><?=_Main_Categories?></div>
				<?php 
				$sql ="SELECT * FROM `category` WHERE `PID`='0' AND `lang`='$lang' ORDER BY `id` DESC LIMIT 6;";
				$result=mysql_query($sql);
				$rows=mysql_num_rows($result);
				if($rows>0){
					$i=0;
					while ($i<$rows){
						$id=mysql_result($result, $i,"id");
						$name=mysql_result($result, $i,"name");
						$image=mysql_result($result, $i,"image");
						$image=str_replace("..", "../../admin", $image);
						?>
						<a href='../category/categories.php?PID=<?=$id?>' class='loadLink'>
							<div class="category">
								<img src="<?=$image?>" style="max-width: 150px;max-height: 150px"/>
							</div>
						</a>
						<?
						$i++;
					}
				}
				?>
			</div>
			<div class="newsContainer">
				<div class="newsTitle"><?=_Latest_News?></div>
				<?php 
				$sql ="SELECT * FROM `news` WHERE `lang`='$lang' ORDER BY `id` DESC LIMIT 3;";
				$result=mysql_query($sql);
				$rows=mysql_num_rows($result);
				if($rows>0){
					$i=0;
					while ($i<$rows){
						$id=mysql_result($result, $i,"id");
						$title=mysql_result($result, $i,"title");
						$brief=mysql_result($result, $i,"brief");
						$image=mysql_result($result, $i,"image");
						$date=mysql_result($result, $i,"date");
						$image=str_replace("..", "../../admin", $image);
						?>
						<div class="item">
							<div class="image">
								<img src="<?=$image?>" style="max-width: 70px;max-height: 70px"/>
							</div>
							<span class="title"><?=$title?></span><span class="date"> on <?=$date?></span>
							<p>
								<?=shortText($brief, 100)?> ...<a href="../news/viewNews.php?id=<?=$id?>" class='loadLink'><?=_read?></a>
							</p>
						</div>
						<?
						$i++;
					}
				}
				?>
				
				<a href="../news/news.php" class="moreNews loadLink"><?=_More_news?></a>
			</div>
			
			<div class="newsLetter">
				<div class="title"><?=_Newsletter?></div>
				<p><?=_newsletter_msg?></p>
				<form action="#" method="post">
					<table cellpadding="1" cellspacing="0" width="350px" border="0" align="<?=mainDir?>">
						<tr>
							<td colspan="2" align="<?=mainDir?>">
								<input type="text" name="name_nl" id="name_nl" value="<?=_nl_name?>"
								onblur="if(this.value=='')this.value='<?=_nl_name?>';"
								onfocus="if(this.value=='<?=_nl_name?>')this.value='';">
							</td>
						</tr>
						<tr>
							<td align="<?=mainDir?>">
								<input type="text" name="email_nl" id="email_nl" value="<?=_nl_email?>"
								onblur="if(this.value=='')this.value='<?=_nl_email?>';"
								onfocus="if(this.value=='<?=_nl_email?>')this.value='';">
								<input type="button" name="submit" id="newsLetterBtn" value="" />
							</td>
						</tr>
						<tr>
							<td colspan="2" align="<?=mainDir?>" style="font-size: 10px">
								<?=unsubscribe_note?>
							</td>
						</tr>
					</table>
				</form>
			</div>
			
			<div class="socialNetworks">
				<div class="title"><?=_Follow_us?></div>
				<p><?=_Follow_us_msg?></p>
				<img src="../includes/images/fb.png" class="first_img" />
				<img src="../includes/images/tw.png"/>
				<img src="../includes/images/li.png"/>
				<img src="../includes/images/soc4.png"/>
			</div>
		</div>
<?php
include_once '../common/footer.php';
?>