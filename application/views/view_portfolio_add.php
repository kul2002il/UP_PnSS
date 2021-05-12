<h1>Добавнелие нового проекта</h1>
<form method="post">
	<table>
		<tr>
			<td>
				<label for="login">Год</label>
			</td>
			<td>
				<input type="number" name="year" id="year" required
				pattern="\d\d\d\d">
			</td>
		</tr>
		<tr>
			<td>
				<label for="site">URL</label>
			</td>
			<td>
				<input type="text" name="site" id="site" required
				pattern="(http://|https://)?([0-9a-zA-Zа-яА-ЯёЁ]+\.){1,2}[0-9a-zA-Zа-яА-ЯёЁ]{2,6}/?">
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
			<td></td>
			<td>
				<input type="submit" name="addProject" value="Добавить">
			</td>
		</tr>
	</table>
</form>
