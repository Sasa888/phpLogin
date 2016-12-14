<?php

$page_title = 'Edit a User';
include ('includes/header.html');
echo '<h2>Ispravite nalog</h2> <br><br>';

// Check for a valid user ID, through GET or POST:
if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) { // From view_users.php
	$id = $_GET['id'];
} elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) { // Form submission.
	$id = $_POST['id'];
} else { // No valid ID, kill the script.
	echo '<p class="error">This page has been accessed in error.</p>';
	include ('includes/footer.html'); 
	exit();
}

require ('mysqliconnect.php'); 

// Check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$errors = array();
	
	// Check for a first name:
	if (empty($_POST['first_name'])) {
		$errors[] = 'Zaboravili ste Ime.';
	} else {
		$fn = mysqli_real_escape_string($dbc, trim($_POST['first_name']));
	}
	
	// Check for a last name:
	if (empty($_POST['last_name'])) {
		$errors[] = 'Zaboravili ste prezime.';
	} else {
		$ln = mysqli_real_escape_string($dbc, trim($_POST['last_name']));
	}

	// Check for an email address:
	if (empty($_POST['email'])) {
		$errors[] = 'Zaboravili ste vas Email.';
	} else {
		$e = mysqli_real_escape_string($dbc, trim($_POST['email']));
	}
	
	if (empty($errors)) { 
	
		
		$q = "SELECT user_id FROM users WHERE email='$e' AND user_id != $id";
		$r = @mysqli_query($dbc, $q);
		if (mysqli_num_rows($r) == 0) {

			// Make the query:
			$q = "UPDATE users SET first_name='$fn', last_name='$ln', email='$e' WHERE user_id=$id LIMIT 1";
			$r = @mysqli_query ($dbc, $q);
			if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.

				// Print a message:
				echo '<p>Korisnik je ispravljen.</p>';	
				
			} else { // If it did not run OK.
				echo '<p class="error">Korisnik ne moze da se ispravi zbog sistemske greske. Izvinjavamo se na neprijatnosti i potrudicemo da ispravimo sto je pre moguce</p>'; // Public message.
				echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $q . '</p>'; // Debugging message.
			}
				
		} else { // Already registered.
			echo '<p class="error">Vec je neko prijavljen s ovom email adresom.</p>';
		}
		
	} else { 

		echo '<p class="error">Moguce greske:<br />';
		foreach ($errors as $msg) { 
			echo " * $msg * <br />\n";
		}
		echo '</p><p>Molimo vas pokusajte ponovo.</p>';
	
	} // End of if (empty($errors)) IF.

} // End of submit conditional.


$q = "SELECT first_name, last_name, email FROM users WHERE user_id=$id";		
$r = @mysqli_query ($dbc, $q);

if (mysqli_num_rows($r) == 1) { 

	
	$row = mysqli_fetch_array ($r, MYSQLI_NUM);
	
	// Create the form:
	echo '<form action="edit_user.php" method="post" class="form-horizontal">

	<div class="form-group">
		<label class="control-label col-sm-2" for="first_name">Ime:</label> 
		<div class="col-sm-6">
		<input type="text" name="first_name" size="15" maxlength="20" class="form-control" placeholder="Vase Ime" value="'. $row[0] . '"></div>	
	</div>

	<div class="form-group">
		<label class="control-label col-sm-2" for="last_name">Prezime:</label> 
		<div class="col-sm-6">
			<input type="text" name="last_name" size="15" class="form-control"  placeholder="Vase Prezime"  value="' . $row[1] .'">
		</div>	
	</div>

	<div class="form-group">
		<label class="control-label col-sm-2" for="email">Email:</label> 
		<div class="col-sm-6">
		 <input type="text" name="email" size="20" maxlength="60" class="form-control"  placeholder="Vas Email"  value="' . $row[2] . '" require></div>	
	</div>
	<input type="submit" name="submit"  class="btn btn-success" value="Submit" />

	<input type="hidden" name="id" value="' . $id . '" />
</form>';

} else { // Not a valid user ID.
	echo '<p class="error">This page has been accessed in error.</p>';
}

mysqli_close($dbc);
		
include ('includes/footer.html');
?>

<!-- // <p>Ime: <input type="text" name="first_name" size="15" maxlength="15" value="' . $row[0] . '" /></p>

// <p>Prezime: <input type="text" name="last_name" size="15" maxlength="30" value="' . $row[1] . '" /></p>

// <p>Email Adresa: <input type="text" name="email" size="20" maxlength="60" value="' . $row[2] . '"  /> </p> -->
