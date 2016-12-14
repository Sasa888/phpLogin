<?php 

	$page_title = 'Calculator';
	include('includes/header.html');


	if($_SERVER['REQUEST_METHOD'] == 'POST'){

		if(isset($_POST['distance'] , $_POST['gallon_price'] , $_POST['efficiency'])  && is_numeric($_POST['distance']) && is_numeric($_POST['efficiency'])  ){

			$litara = $_POST['distance'] / $_POST['efficiency'];
			$dinara = $litara * $_POST['gallon_price'];
			$sati = $_POST['distance'] / 120 ;

			echo '<h2>Prosecna potrosnja</h2><p>Ukupan iznos novca posle predjenih ' .  $_POST['distance'] . ' km, prosek potrosnje ' .  $_POST['efficiency']  . ' km po litru i predjenih ' . $_POST['gallon_price']  . ' RSD per litar,  je otprilike ' .  number_format($dinara ,2)  . ' RSD. Ako vozite prosecnom brzinom od 120 km na sat, trebace vam ukupno  ' . number_format($sati,  2) . ' sati. </p>';
			

		}/* kraj if uslova*/ else {

			echo'<h1>Greska!</h1>
			<p class="error">Molim vas unesite trazena polja za distancu, cenu i predjene km.</p>';
		}
	}/* Kraj server request metod*/

 ?>
	<h2>Kalkulator Potrosnje Goriva</h2>
	<br><br>
	<form action="calculator.php" method="post" class="form-horizontal">
		

		<div class="form-group">
		<label class="control-label col-sm-2" for="distance">Distance in km:</label> 
			<div class="col-sm-6">
			 	 <input type="text" name="distance" class="form-control" placeholder="Distanca">
			</div>	
		</div>

		 <div class="form-group">  
		 <label class="control-label col-sm-2" for="price">Cena po Litru:</label>
    			<div class=" col-sm-6">
      				<div class="checkbox">
       					 <label><input type="checkbox" name="gallon_price" value="130"> 130 rsd</label>
       					 <label><input type="checkbox" name="gallon_price" value="140"> 140 rsd</label>
       					 <label><input type="checkbox" name="gallon_price" value="150"> 150 rsd</label>
						
     				 </div>
   			 </div>
 		 </div>
		

		<div class="form-group">
      			<label class="control-label col-sm-2" for="consumption">Potrosnja goriva:</label> 
      				<div class="col-sm-6">
	     				 <select class="form-control" id="sel1" name="efficiency">
	     				   	<option value="7">6L -  Odlicno</option>
						<option value="9">9L - Malo vise</option>
						<option value="12">12L - Mnogo</option>
						<option value="20">15L - Suvise</option>
	  				    </select>	
     				 </div>
     				 <br><br> <br>
			 <input type="submit" name="submit" class="btn btn-success" value="Izracunaj">
	</form>
 <?php 
 	include('includes/footer.html');
  ?>