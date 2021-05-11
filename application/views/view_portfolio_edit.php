<h1><?=$data["site"]?></h1>
<form method="post">
	<table>
		<tr>
			<td></td>
			<td>
				<input type="submit" name="deleteProject" value="Удалить">
			</td>
		</tr>
		<tr>
			<td>
				<label for="login">Год</label>
			</td>
			<td>
				<input type="number" name="year" id="year" required
				pattern="\d\d\d\d"
				value="<?=$data["year"]?>">
			</td>
		</tr>
		<tr>
			<td>
				<label for="site">URL</label>
			</td>
			<td>
				<input type="text" name="site" id="site" required
				pattern="(http://|https://)?([0-9a-zA-Zа-яА-ЯёЁ]+\.){1,2}[0-9a-zA-Zа-яА-ЯёЁ]{2,6}/?"
				value="<?=$data["site"]?>">
			</td>
		</tr>
		<tr>
			<td>
				<label for="description">Описание</label>
			</td>
			<td>
				<textarea name="description" id="description" required
				rows="8" cols="80"><?=$data["description"]?></textarea>
			</td>
		</tr>
		<tr>
			<td></td>
			<td>
				<input type="submit" name="editProject" value="Сохранить">
			</td>
		</tr>
	</table>
</form>
