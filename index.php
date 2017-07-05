<!DOCTYPE html>
<html>
<head>
	<title>Evidenca</title>
	<meta charset="UTF-8">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">


</head>
<body onload="currentDateTime()">
<?php 
	include 'cfg/config.php';
	include 'include/pdo_connection.php'; 
?>
<div class="row">
	<div class="col-md-4 text-center">
		<h1>Evidenca</h1>
	</div>
	<div class="col-md-8">
	</div>
</div>
<div class="row">
	<div class="col-md-4">
	</div>
	<div class="col-md-4 text-center">
		<p class="text-info">Trenutni datum in čas:</p><p id="datumcas"></p>
	</div>
	<div class="col-md-4">
	</div>
</div>
<br>
<form id="obrazec" action="php/dodaj.php" method="post">
	<div class="row">
		<div class="col-md-4 text-center">
			<label>Vrsta stroška: </label>
			<select id="vrsta" class="form-control">
			  <option value="Hrana">Hrana</option>
			  <option value="Transport">Transport</option>
			  <option value="Luksuz">Luksuz</option>
			  <option value="Položnica">Položnica</option>
			</select>
		</div>
		<div class="col-md-4 text-center">
			<label>Datum stroška: </label>
			<input class="form-control" type="date" id="datum" name="datum" placeholder="dd-mm-yyyy" pattern="\d{1,2}-\d{1,2}-\d{4}"> 
		</div>
		<div class="col-md-4 text-center">
			<label>Znesek v €: </label>
			<input type="text" id="znesek" name="znesek" class="form-control">
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-md-4 text-center">
			<input type="submit" id="submitButton" class="btn btn-primary" name="submitButton" value="Dodaj">
		</div>
	</div>
</form>
<p class="text-danger" id="konec"></p>
<p class="text-info text-center">Dosedanji vnosi: </p>

<table class="table table-bordered" id="sedanjost">	
	<tr>
		<td><a href="#"><span class="glyphicon glyphicon-sort"></span></a></td>
	</tr>
</table>
	
</body>


<script
  src="https://code.jquery.com/jquery-3.2.1.js"
  integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
  crossorigin="anonymous">  	
</script>
<script type="text/javascript" src="js/basic.js"></script>
<script type='text/javascript'>
      //prikaz podatkov
      $.ajax({
        url: "php/prikaz_podatkov.php",
        type: 'GET',
        success: function(res) {
            $('#sedanjost').html(res);
        	}
    	});
    /* attach a submit handler to the form */
    $("#obrazec").submit(function(event) {

      /* stop form from submitting normally */
      event.preventDefault();

      /* get the action attribute from the <form action=""> element */
      var $form = $(this),
          url = $form.attr('action');

      /* Send the data using post with element id name and name2*/
      var posting = $.post(url, { vrsta_stroska: $('#vrsta').val(), datum: $('#datum').val(), znesek: $('#znesek').val() } );

      /* Alerts the results */
      posting.done(function(data) {
        $('#konec').html(data);
      });
      //prikaz podatkov
      $.ajax({
        url: "php/prikaz_podatkov.php",
        type: 'GET',
        success: function(res) {
            $('#sedanjost').html(res);
        	}
    	});	
    });
</script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</html>