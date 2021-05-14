<h1>Вход</h1>
<form method="post">
	<table>
		<tr>
			<td>
				<label for="login">Логин</label>
			</td>
			<td>
				<input type="text" name="login" id="login" pattern="[a-zA-Z0-9_.!@]+" required>
			</td>
		</tr>
		<tr>
			<td>
				<label for="password">Пароль</label>
			</td>
			<td>
				<input type="password" name="password" id="password" pattern="[a-zA-Z0-9_.!@]{4,}" required>
			</td>
		</tr>
		<tr>
			<td>
				<a href="/user/register">Регистрация</a>
			</td>
			<td>
				<input type="submit" name="auth" value="Вход">
			</td>
		</tr>
	</table>
</form>
