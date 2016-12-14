<?php 

	$page_title = 'View the Current Users';
	include('includes/header.html');

	echo '<h2>Registrovani korisnici</h2><br>';

	require_once ('mysqliconnect.php');



	$q = "SELECT last_name,first_name , DATE_FORMAT(registration_date, '%M %d , %Y') AS dr, user_id FROM users ORDER BY registration_date ASC";

	$r = @mysqli_query($dbc, $q);

	$num = mysqli_num_rows($r);

	if($num > 0){

		echo "<p>Trenutno je  <b>$num</b> registrovanih korisnika. </p><br>";


		echo '<table align="center" cellspacing="3" cellpadding="3" width="75%">
	<tr>
		<td align="left"><b>Edit</b></td>
		<td align="left"><b>Delete</b></td>
		<td align="left"><b>Last Name</b></td>
		<td align="left"><b>First Name</b></td>
		<td align="left"><b>Date Registered</b></td>
	</tr>
';

	while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
		echo '<tr>
			<td align="left"><a href="edit_user.php?id=' . $row['user_id'] . '">Edit</a></td>
			<td align="left"><a href="delete_user.php?id=' . $row['user_id'] . '">Delete</a></td>
			<td align="left">' . $row['last_name'] . '</td>
			<td align="left">' . $row['first_name'] . '</td>
			<td align="left">' . $row['dr'] . '</td>
		</tr>
		';
	}

	echo '</table><br><br>';
	mysqli_free_result($r);


	}else{

		echo '<p class="error">There are currently no registered users.</p>';

	}

	mysqli_close($dbc);

	

	include('includes/footer.html');

 ?>