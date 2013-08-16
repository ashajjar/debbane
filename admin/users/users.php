<?php
include_once '../common/header.php';
if($_REQUEST['op']=='del'){
	$id=$_REQUEST['id'];
	$sql="DELETE FROM `user` WHERE `id`='$id'";
	if(mysql_query($sql)){
		echo "<script>showMessageBox('User was deleted successfully!');</script>";
	}
	else{
		echo "<script>showMessageBox('Failed to delete user!');</script>";
	}
}
$sql="SELECT * FROM `user` WHERE `username`!='admin';";
$result=mysql_query($sql);
$rows=mysql_num_rows($result);
?>
<h2>Users</h2>
<table width="100%">
	<tr>
		<td class="new">
			<form action="../includes/export.php" method="post">
				<input type="hidden" name="SQL" value="<?=$sql?>"/>
				<input type="hidden" name="outputFilename" value="<?="Users-".date("d-F-Y").".xls"?>"/>
				<input type="submit" name="submit" value="Export" style="border: 0;background-color: #fff"/>
				|&nbsp;
				<a href="newUser.php">New</a>
			</form>
		</td>
	</tr>
</table>
<table cellpadding="0" cellspacing="0" class="listing">
	<tr>
		<th width="500px">Username</th>
		<th width="300px">Last Login</th>
		<th width="200px">&nbsp;</th>
	</tr>
<?php
if($rows>0){
	$i=0;
	while ($i<$rows){
		$id=mysql_result($result, $i,"id");
		$username=mysql_result($result, $i,"username");
		$lastLogin=mysql_result($result, $i,"lastLogin");
		
		?>
			<tr>
				<td valign="top">&nbsp;<?=$username?></td>
				<td valign="top">&nbsp;<?=$lastLogin?></td>
				<td valign="top">
					<a href="editUser.php?id=<?=$id?>">Edit</a>&nbsp;|&nbsp;
					<a class="deleteObject" href="<?=$_SERVER['PHP_SELF']?>?op=del&id=<?=$id?>">Delete</a>
				</td>
			</tr>
		<?php
		$i++;
	}
}
?>
</table>
<?php
include_once '../common/footer.php';
?>