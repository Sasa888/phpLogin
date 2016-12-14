<?php 
$page_title='Register';
include('includes/header.html');

if($_SERVER['REQUEST_METHOD'] == 'POST'){


	require ('mysqliconnect.php');


	$errors = array();

	if(empty($_POST['first_name'])){
		$errors[] = 'Zaboravili ste da upisete vase Ime.';
	}else {
		$fn = mysqli_real_escape_string($dbc, trim($_POST['first_name']));
	}


	if(empty($_POST['last_name'])){
		$errors[] = 'Zaboravili ste da upisete vase Prezime.';
	}else {
		$ln =mysqli_real_escape_string($dbc, trim($_POST['last_name']));
	}

	if(empty($_POST['email'])){
		$errors[] = 'Zaboravili ste da upisete vas Email.';
	}else {
		$e = mysqli_real_escape_string($dbc,trim($_POST['email']));
	}

	if(!empty($_POST['pass1'])){
		if($_POST['pass1']  != $_POST['pass2']){
			$errors[] = 'Lozinke se ne poklapaju.';
		}else{
			$p =mysqli_real_escape_string($dbc, trim($_POST['pass1']));
		}

	}/*  kraj if empty*/ else {

		$errors[] = 'Zaboravili ste da upisete vasu lozinku.';
	}

/* Ako je sve u redu i nema gresaka */

	if(empty($errors)) {

		
	$q = "INSERT INTO users (first_name , last_name , email , pass, registration_date) VALUES ('$fn', '$ln' , '$e', SHA1('$p') , NOW())";
	$r = @mysqli_query($dbc, $q);

	if($r){
		echo '<h1>Cestitamo</h1>
		<p>Sada ste registrovani. Sajt je u toku izrade, budite strpljivi :)</p><p><br></p>';
	}else {
		echo '<h1>System error</h1>
		<p class="error">Ne mozete biti registrovani. U pitanju je sistemska greska koje ce sto pre biti otklonjena. Hvala </p>';


		echo '<p>' . mysqli_error($dbc) . '<br><br> Query : ' . $q . '</p>';
	} /* kraj uslova za if $r*/


	include('includes/footer.html');
	exit();

	} /* kraj if empty errors*/ else {


		echo '<h1>Greska! </h1>
		<p class="error">U pitanju su greske: <br><br>';
		foreach ($errors as $msg) {
			echo " * $msg  * <br>\n";
		}
		echo '</p><h4>Molimo vas pokusajte ponovo. </h4><p><br></p>';
	}

	mysqli_close($dbc);
} /* Kraj $_SERVER if  uslova */

 ?>

 <h2>Registracija</h2><br>

 <form action="register.php" method="post" class="form-horizontal">

	<div class="form-group">
		<label class="control-label col-sm-2" for="first_name">Ime:</label> 
		<div class="col-sm-6">
		<input type="text" name="first_name" size="15" maxlength="20" class="form-control" placeholder="Vase Ime" value="<?php  if (isset($_POST['first_name'])) echo $_POST['first_name']; ?>"></div>	
	</div>


	<div class="form-group">
		<label class="control-label col-sm-2" for="last_name">Prezime:</label> 
		<div class="col-sm-6">
		<input type="text" name="last_name" size="15" class="form-control"  placeholder="Vase Prezime"  value="<?php  if (isset($_POST['last_name'])) echo $_POST['last_name']; ?>"></div>	
	</div>

	<div class="form-group">
		<label class="control-label col-sm-2" for="email">Email:</label> 
		<div class="col-sm-6">
		 <input type="text" name="email" size="20" maxlength="60" class="form-control"  placeholder="Vas Email"  value="<?php  if (isset($_POST['email'])) echo $_POST['email']; ?>" require></div>	
	</div>


	<div class="form-group">
		<label class="control-label col-sm-2" for="password">Lozinka:</label> 
		<div class="col-sm-6">
		  <input type="password" name="pass1" size="10" maxlength="20" class="form-control"  placeholder="Vasa Lozinka" value="<?php  if (isset($_POST['pass1'])) echo $_POST['pass1']; ?>"></div>	
	</div>

	<div class="form-group">
		<label class="control-label col-sm-2" for="password">Potvrdi Lozinku:</label> 
		<div class="col-sm-6">
		 <input type="password" name="pass2" size="10" maxlength="20" class="form-control"  placeholder="Potvrdi Lozinku"  value="<?php  if (isset($_POST['pass2'])) echo $_POST['pass2']; ?>"></div>	
	</div>
			<br><br>

			 <input type="submit" name="submit" class="btn btn-success" value="Potvrdi">

 </form>
 <br><br>

 <?php  include('includes/footer.html') ;?>