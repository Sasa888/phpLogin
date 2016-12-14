<?php 
$page_title='Contact ';
 include('includes/header.html');
 ?>
<h2>Kontakt</h2>
<?php

// Check for form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	// Minimal form validation:
	if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['comments']) ) {
	
		// Create the body:
		$body = "Name: {$_POST['name']}\n\nComments: {$_POST['comments']}";

		// Make it no longer than 70 characters long:
		$body = wordwrap($body, 70);
	
		// Send the email:
		mail('sasa_jezdimirovic@yahoo.com', 'Contact Form Submission', $body, "From: {$_POST['email']}");

		// Print a message:
		echo '<p><em>Hvala sto ste me kontaktirali i potrudicu se da odgovorim sto je pre moguce.</em></p>';
		
		// Clear $_POST (so that the form's not sticky):
		$_POST = array();
	
	} else {
		echo '<p style="font-weight: bold; color: #C00">Molim vas popunite do kraja.</p>';
	}
	
} 


?>
<p>Ako osetite potrebu, slobodno me kontaktirajte</p><br><br>
<form action="" method="post" class="form-horizontal">
	<div class="container-fluid bg-grey">
  <h2 class="text-center">Kontakt</h2>
  <div class="row">
	    <div class="col-sm-5">
	      <p><span class="glyphicon glyphicon-map-marker"></span> Beograd</p>
	      <p><span class="glyphicon glyphicon-phone"></span> +38165 455-9118</p>
	      <p><span class="glyphicon glyphicon-envelope"></span> &nbsp sasa_jezdimirovic@yahoo.com</p> 
	    </div>
    <div class="col-sm-7">
      <div class="row">
        <div class="col-sm-4 form-group">
          <input class="form-control" id="name" name="name" placeholder="Ime" type="text" required>
        </div>
        <div class="col-sm-4 form-group">
          <input class="form-control" id="email" name="email" placeholder="Email" type="email" required>
        </div>
      </div>
      <textarea class="form-control" id="comments" name="comments" placeholder="Vasa Poruka" rows="5"></textarea><br>
      <div class="row">
        <div class="col-sm-12 form-group">
          <input type="submit" name="submit"  class="btn btn-success pull-right"  value="Poslati" />
        </div>
      </div> 
    </div>
  </div>
</div>










	<!-- <div class="form-group">
		<label class="control-label col-sm-2" for="name">Ime:</label> 
		<div class="col-sm-6">
			<input type="text" name="name" size="30" maxlength="60" class="form-control"  placeholder="Vase Ime"  value="<?php if (isset($_POST['name'])) echo $_POST['name']; ?>" />

		</div>
	</div>

	<div class="form-group">
		<label class="control-label col-sm-2" for="email">Email:</label> 
		<div class="col-sm-6">
			<input type="text" name="email" size="30" maxlength="60" class="form-control"  placeholder="Vas Email"  value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" required />

		</div>
	</div>

	<div class="form-group">
		<label class="control-label col-sm-2" for="comments">Poruka:</label> 
		<div class="col-sm-6">
			<textarea class="form-control" rows="5" placeholder="Vasa poruka"  id="comments" value="<?php if (isset($_POST['comments'])) echo $_POST['comments']; ?>"  /></textarea>

		</div>
	</div>

	<input type="submit" name="submit"  class="btn btn-success"  value="Poslati" /> -->
</form> <br><br>
<?php include('includes/footer.html');?>
</body>
</html>