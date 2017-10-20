<!DOCTYPE html>
<html>
<head>
	<title>Evidenca</title>
	<meta charset="UTF-8">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<link rel="stylesheet" href="css/main.css">


</head>
	<body onload="currentDateTime()">
	<div class="alert alert-danger">
		<p>Functions are disabled for showcase purposes.</p>
	</div>
	<?php 
		include 'cfg/config.php';
		include 'include/pdo_connection.php'; 
	?>
	<nav class="navbar navbar-inverse">
	  <div class="container">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
		  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		  </button>
		  <a class="navbar-brand" href="index.php">Evidenca</a>
		</div>

		  <div class="nav navbar-nav navbar-left">
			<ul class="nav navbar-nav">
				<li class="active"><a href="index.php">Domov</a></li>
				<li><a href="statistika.php">Statistika</a></li>
			  </ul>
		  </div>
		  <div class="nav navbar-nav navbar-right">
			<p class="text-info datum">Trenutni datum in čas:</p>
			<p class="datumcas" id="datumcas"></p>
		  </div>
		</div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>
	<div class="container">
		<div class="col-lg-8">
			<p class="text-info heading">Stroški za tekoči mesec: </p>
			<div class="podatki">
				<ul>
					<li id="vrstaSort">
						<span class="glyphicon glyphicon-sort"></span>
					</li>
					<li id="datumSort">
						<span class="glyphicon glyphicon-sort"></span>
					</li>
					<li id="cenaSort">
						<span class="glyphicon glyphicon-sort"></span>
					</li>
					<li id="opisSort">
						<span class="glyphicon glyphicon-sort"></span>
					</li>
				</ul>
				<table class="table table-bordered" id="sedanjost">
				</table>
			</div>
			<div class="row">
				<div class="col-md-4 text-center">
					<a class="btn btn-primary" href="statistika.php" role="button">Statistika</a>
				</div>
			</div>
		</div>
		<div class="col-lg-4">
			<form id="obrazec" action="php/dodaj.php" method="POST">
				<div class="row">
					<div class="form-group">
						<label for="vrsta">Vrsta stroška:</label>
						<select id="vrsta" class="form-control">
						  <option value="Hrana">Hrana</option>
						  <option value="Transport">Transport</option>
						  <option value="Luksuz">Luksuz</option>
						  <option value="Položnica">Položnica</option>
						</select>
					</div>					
					<div class="form-group">
						<label for="datum">Datum stroška:</label>
						<input class="form-control" type="date" id="datum" name="datum" placeholder="dd-mm-yyyy" pattern="\d{1,2}-\d{1,2}-\d{4}"> 
					</div>					
					<div class="form-group">
						<label for="znesek">Znesek v €:</label>
						<input type="number" min="1" id="znesek" name="znesek" class="form-control" placeholder="Npr: 50"  required>
					</div>					
					<div class="form-group">
						<label for="opis">Dodaten opis stroška:</label>
						<input type="text" id="opis" name="opis" class="form-control" placeholder="Neobvezno">
					</div>								
					<div class="form-group">
						<input type="submit" id="submitButton" class="btn btn-primary" name="submitButton" value="Dodaj">
						<input type="reset" id="restButton" class="btn btn-danger" name="submitButton" value="Počisti">
					</div>		

				</div>
			</form>
		</div>
	</div>
</body>

			<p class="text-danger" id="konec"></p>

<script
  src="https://code.jquery.com/jquery-3.2.1.js"
  integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
  crossorigin="anonymous">  	
</script>

<script type='text/javascript'>
	//s to funkcijo ohranimo event listenerje, ki se drugače pri spremenjenih elementih odstranijo
/*	$(document).ready(function(){
		$('body').on('click','.odstrani',function(){
			  var idVnosa = $(this).attr('id');
			  $.ajax({
				url: "php/odstrani_vnos.php",
				type: 'POST',
				data: { id: idVnosa },
				success: function (res) {
					$('#'+idVnosa).fadeOut();
				}
				});
			})
		});*/

	//funkcija za odstranitev vnosa
/*	$(function(){
			$('.odstrani').click(function(){
				var idVnosa = $(this).attr('id');
			  $.ajax({
				url: "php/odstrani_vnos.php",
				type: 'POST',
				data: { id: idVnosa },
				success: function (res) {
					$('#'+idVnosa).parent().parent().fadeOut();
				}
				});
			})
		});
*/
	//simbolična vrednost za določitev razvrščanja navzgor ali navzdol
	var ascdesc = 1;
	//funkcija za sortiranje vnosov po datumu
	$("#datumSort").click(function() {		
	  $.ajax({
		url: "php/sortirajDatum.php",
		type: 'POST',
		data : { status : ascdesc },
		success: function(res) {
				$('#sedanjost').html(res);
				if (ascdesc == 1) {
					ascdesc++;
				} else {
					ascdesc--;
				}
			}
		});
	});
	//funkcija za sortiranje vnosov po ceni
	$("#cenaSort").click(function() {		
	  $.ajax({
		url: "php/sortirajCeno.php",
		type: 'POST',
		data : { status : ascdesc },
		success: function(res) {
				$('#sedanjost').html(res);
				if (ascdesc == 1) {
					ascdesc++;
				} else {
					ascdesc--;
				}
			}
		});
	});

	//funkcija za sortiranje vnosov po opisu
	$("#opisSort").click(function() {		
	  $.ajax({
		url: "php/sortirajOpis.php",
		type: 'POST',
		data : { status : ascdesc },
		success: function(res) {
				$('#sedanjost').html(res);
				if (ascdesc == 1) {
					ascdesc++;
				} else {
					ascdesc--;
				}
			}
		});
	});

	//funkcija za sortiranje vnosov po vrsti stroška
	$("#vrstaSort").click(function() {		
	  $.ajax({
		url: "php/sortirajVrsta.php",
		type: 'POST',
		data : { status : ascdesc },
		success: function(res) {
				$('#sedanjost').html(res);
				if (ascdesc == 1) {
					ascdesc++;
				} else {
					ascdesc--;
				}
			}
		});
	});

	//prikaz podatkov ko se stran zažene
	$.ajax({
	  url: "php/prikaz_podatkov.php",
	  type: 'GET',
	  success: function(res) {
			$('#sedanjost').html(res);
		}
	});

	//funkcija za dodajanje vnosa v bazo
	$("#obrazec").submit(function(event) {

	  //preprečimo normalno izvršitev obrazca
	  event.preventDefault();

/*	  var $form = $(this),
		  url = $form.attr('action');

	  //tukaj pošljemo podatke
	  var posting = $.post(url, { vrsta_stroska: $('#vrsta').val(), datum: $('#datum').val(), znesek: $('#znesek').val(), opis: $('#opis').val() } );

	  //tukaj pokažemo rezultate
	  posting.done(function(data) {
		//zapolnimo mini div data z sporočilom, ki ga vrne dodaj.php
		$('#konec').html(data);
		//prikaz podatkov iz prikaz_podatkov.php
		$.ajax({
		url: "php/prikaz_podatkov.php",
		type: 'GET',
		success: function(res) {
			$('#sedanjost').html(res);
			}
		});	
	  });*/
	});
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script type="text/javascript" src="js/basic.js"></script>
</html>

