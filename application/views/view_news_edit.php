<h1><?=$data["title"]?></h1>
<form enctype="multipart/form-data" method="post">
	<table>
		<tr>
			<td></td>
			<td>
				<input type="submit" name="deleteNews" value="Удалить">
			</td>
		</tr>
		<tr>
			<td>
				<label for="title">Заголовок</label>
			</td>
			<td>
				<input type="text" name="title" id="title" required
				value="<?=$data["title"]?>">
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
			<td>
				<label for="image">Картинка</label>
			</td>
			<td>
				<input type="file" name="image" id="image" accept="image/*">
			</td>
		</tr>
		<tr>
			<td></td>
			<td>
				<input type="submit" name="editNews" value="Сохранить">
			</td>
		</tr>
	</table>
</form>
