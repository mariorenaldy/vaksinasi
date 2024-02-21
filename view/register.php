<div id="form_container">
	<form method="POST" action="<?php echo route("/register"); ?>" enctype= "multipart/form-data">
		<h2 class=judulForm>Register</h2>

		<ul>

			<li>
				<label for="username">Username:</label>
				<div>
					<input id="username" name="username" type="text" maxlength="255"/> 
				</div> 
			</li>		

			<li>
				<label for="role">Role:</label>
				<div>
					<select name="role" id="role">
						<option value="admin">Admin</option>
						<option value="pimpinan">Pimpinan</option>
						<option value="petugas">Petugas</option>
					</select> 
				</div> 
			</li>		
			
			<li>
				<label for="password">Password:</label>
				<div>
					<input id="password" name="password" type="password"/> 
				</div>
			</li>

			<li>
				<input id="submit" type="submit" name="submit" value="Register" />
			</li>
		</ul>
	</form>
</div>