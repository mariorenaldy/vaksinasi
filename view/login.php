<div id="form_container">
	<form method="POST" action="<?php echo route("/login"); ?>" enctype= "multipart/form-data">
		<h2 class=judulForm>Login</h2>

		<ul>

			<li>
				<label for="username">Username:</label>
				<div>
					<input id="username" name="username" type="text" maxlength="255"/> 
				</div> 
			</li>		
			
			<li>
				<label for="password">Password:</label>
				<div>
					<input id="password" name="password" type="password"/> 
				</div>
			</li>

			<li>
				<input id="submit" type="submit" name="submit" value="Login" />
			</li>
		</ul>
	</form>
</div>