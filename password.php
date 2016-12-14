<?php 

$page_title = 'Change Your Password';
include ('includes/header.html');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	require ('mysqliconnect.php'); // Connect to the db.
		
	$errors = array(); // Initialize an error array.
	
	// Check for an email address:
	if (empty($_POST['email'])) {
		$errors[] = 'You forgot to enter your email address.';
	} else {
		$e = mysqli_real_escape_string($dbc, trim($_POST['email']));
	}

	// Check for the current password:
	if (empty($_POST['pass'])) {
		$errors[] = 'You forgot to enter your current password.';
	} else {
		$p = mysqli_real_escape_string($dbc, trim($_POST['pass']));
	}

	// Check for a new password and match 
	// against the confirmed password:
	if (!empty($_POST['pass1'])) {
		if ($_POST['pass1'] != $_POST['pass2']) {
			$errors[] = 'Your new password did not match the confirmed password.';
		} else {
			$np = mysqli_real_escape_string($dbc, trim($_POST['pass1']));
		}
	} else {
		$errors[] = 'You forgot to enter your new password.';
	}
	
	if (empty($errors)) { // If everything's OK.

		// Check that they've entered the right email address/password combination:
		$q = "SELECT user_id FROM users WHERE (email='$e' AND pass=SHA1('$p') )";
		$r = @mysqli_query($dbc, $q);
		$num = @mysqli_num_rows($r);
		if ($num == 1) { // Match was made.
	
			// Get the user_id:
			$row = mysqli_fetch_array($r, MYSQLI_NUM);

			// Make the UPDATE query:
			$q = "UPDATE users SET pass=SHA1('$np') WHERE user_id=$row[0]";		
			$r = @mysqli_query($dbc, $q);
			
			if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.

				// Print a message.
				echo '<h1>Hvala</h1>
				<p>Vasa lozinka je promenjena</p><p><br /></p>';	

			} else { // If it did not run OK.

				// Public message:
				echo '<h1>System Error</h1>
				<p class="error">Vasa lozink ne moze trenutno biti promenjena zbog smetnji na serveru.</p>'; 
	
				// Debugging message:
				echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';
	
			}

			mysqli_close($dbc); // Close the database connection.

			
			include ('includes/footer.html'); 
			exit();
				
		} else { // Invalid email address/password combination.
			echo '<h1>Error!</h1>
			<p class="error">Email adresa i lozinka se ne poklapaju.</p>';
		}
		
	} else { // Ako nije u redu

		echo '<h2>Greska</h2>
		<p class="error">Moguce greske:<br />';
		foreach ($errors as $msg) { // Print each error.
			echo " * $msg *<br />\n";
		}
		echo '</p><p>Molimo pokusajte ponovo.</p><p><br /></p>';
	
	} // End of if (empty($errors)) IF.

	mysqli_close($dbc); 
		
} /*Kraj */
?>
<h2>Promena lozinke</h2><br><br>
<form action="password.php" method="post"  class="form-horizontal">

	
	<div class="form-group">
		<label class="control-label col-sm-2" for="email">Email adresa:</label> 
		<div class="col-sm-6">
			<input type="text" name="last_name" size="15" class="form-control"  placeholder="Email adresa"  value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>"></div>	
	</div>
	
	<div class="form-group">
		<label class="control-label col-sm-2" for="password">Trenutna lozinka:</label> 
		<div class="col-sm-6">
			<input type="password" name="pass" size="10" maxlength="20" class="form-control"  placeholder="Lozinka"  value="<?php if (isset($_POST['pass'])) echo $_POST['pass']; ?>"></div>	
	</div>

	<div class="form-group">
		<label class="control-label col-sm-2" for="password">Nova lozinka:</label> 
		<div class="col-sm-6">
			<input type="password" name="pass1" size="10" maxlength="20" class="form-control"  placeholder="Nova Lozinka"  value="<?php if (isset($_POST['pass1'])) echo $_POST['pass1']; ?>"></div>	
	</div>

	<div class="form-group">
		<label class="control-label col-sm-2" for="password">Potvrda lozinke:</label> 
		<div class="col-sm-6">
			<input type="password" name="pass2" size="10" maxlength="20" class="form-control"  placeholder="Potvrda Lozinke"  value="<?php if (isset($_POST['pass2'])) echo $_POST['pass2']; ?>"></div>	
	</div>


	<input type="submit" name="submit" class="btn btn-success" value="Potvrdi">
</form>
<?php include ('includes/footer.html'); ?>