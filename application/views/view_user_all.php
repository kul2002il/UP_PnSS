<?php

function selectHTML($role)
{
	$list = [
		"",
		"superuser",
		"admin",
	];
	$out = "<select name='role'>";
	foreach ($list as $pin)
	{
		$select = "";
		if ($role === $pin)
		{
			$select = "selected";
		}
		$nameRole = $pin ? $pin : "user";
		$out .= "<option value='$pin' $select >$nameRole</option>";
	}
	$out .= "</select>";
	return $out;
}

$flagCanEdit = false;
if(isset($_SESSION["user"]) && in_array($_SESSION["user"]["role"], [
	"superuser",
]))
{
	$flagCanEdit = true;
}
?>
<h1>Портфолио</h1>
<p>
<table>
	<tr>
		<td>UserName</td>
		<td>роль</td>
	</tr>
	<?php
	foreach($data as $row) { ?>
		<tr>
			<td>
				<?=$row["login"]?>
			</td>
			<?php if(!$flagCanEdit) { ?>
				<td>
					<?=$row["role"]?>
				</td>
			<?php }else{ ?>
				<td>
					<form method="post">
						<input type="hidden" name="user" value="<?= $row["id"] ?>">
						<?= selectHTML($row["role"]) ?>
						<input type="submit" name="setRole" value=">">
					</form>
				</td>
			<?php } ?>
		</tr>
	<?php } ?>
</table>
</p>
