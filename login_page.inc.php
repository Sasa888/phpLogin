<?php 
$page_title = 'Login';
include('includes/header.html');


if(isset($errors)  && !empty($errors)){

	echo '<h1>Error!</h1>
	<p class="error">The following errors occured: <br>';

	foreach ($errors as $msg){
		echo "- $msg<br>\n";
	}
	echo '</p><p>Please try again.</p>';
}

 ?>
 <h2>Login</h2>
 <form action="login.php" method="post" class="form-horizontal">

	<div class="form-group">
		<label class="control-label col-sm-2" for="email">Email Adresa:</label> 
		<div class="col-sm-6">
		 	<input type="text" name="email" size="20" maxlength="60"  class="form-control" placeholder="Vas Email">
		</div>	
	</div>

	<div class="form-group">
		<label class="control-label col-sm-2" for="password"> Password:</label> 
		<div class="col-sm-6">
		 	 <input type="password" name="pass" size="20" maxlength="20"  class="form-control" placeholder="Vasa Lozinka">
		</div>	
	</div>

	<label class="control-label col-sm-2" for="password"><a href="password.php"> Promena Lozinke </a></label> <br><br>
	
	<!-- <p><b><a href="password.php">Change your Password</a></b></p>
 -->
	 <input type="submit" name="submit" class="btn btn-success" value="Potvrdi">

 </form>

 <br><br>
 <?php include('includes/footer.html'); ?>