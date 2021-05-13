<h1>Добавнелие новой новости</h1>
<form enctype="multipart/form-data" method="post">
	<table>
		<tr>
			<td>
				<label for="title">Заголовок</label>
			</td>
			<td>
				<input type="text" name="title" id="title" required>
			</td>
		</tr>
		<tr>
			<td>
				<label for="description">Описание</label>
			</td>
			<td>
				<textarea name="description" id="description" required
				rows="8" cols="80"></textarea>
			</td>
		</tr>
		<tr>
			<td>
				<label for="image">Картинка</label>
			</td>
			<td>
				<input type="file" name="image" id="image" required accept="image/*">
			</td>
		</tr>
		<tr>
			<td></td>
			<td>
				<input type="submit" name="addNews" value="Добавить">
			</td>
		</tr>
	</table>
</form>
