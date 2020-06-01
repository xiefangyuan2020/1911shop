<form action="/add" method="POST"><!-- 斜杠加不加都可以 -->
	@csrf
	<table>
		<tr>
			<td>用户名</td>
			<td>
				<input type="text" name="name">
			</td>
		</tr>
		<tr>
			<td>密码</td>
			<td>
				<input type="password" name="pwd">
			</td>
		</tr>
		<tr>
			<td></td>
			<td>
				<!-- <input type="submit" value="提交"> -->
				<button>提交</button>
			</td>
		</tr>
	</table>
</form>