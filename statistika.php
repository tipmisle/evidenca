<!DOCTYPE html>
<html>
<head>
	<title>Evidenca</title>
	<meta charset="UTF-8">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<link rel="stylesheet" href="css/main.css">


</head>
<body onload="currentDateTime()">
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
		<div class="row sections">
			<div class="col-md-4">
				<div class="inside">
					<h3>Porabljen denar (all time)</h3>
					<p id="all_time"></p>
				</div>
			</div>
			<div class="col-md-4">
				<div class="inside">
					<h3>Porabljen denar (ta mesec)</h3>
					<p id="current_month"></p>		
				</div>
			</div>
			<div class="col-md-4">
				<div class="inside">
					<h3>Najdražja kategorija</h3>
					<p id="expensivest_category"></p>
				</div>
			</div>
		</div>
		<div class="row">
				<div class="col-md-6 chart">
					<div class="inside">
						<canvas id="month"></canvas>
					</div>
				</div>
				<div class="col-md-6 chart">
					<div class="inside">
						<canvas id="resources"></canvas>
					</div>
				</div>
		</div>
	</div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
<script
  src="https://code.jquery.com/jquery-3.2.1.js"
  integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
  crossorigin="anonymous">  	
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script type="text/javascript">

	$.ajax({
        url: "php/graf.php",
        method: 'GET',
        success: function(res) {	
        		var znesek = [];
        		var mesec = [];

        		for(var i in res) {
        			znesek.push(res[i].znesek);
        			mesec.push(res[i].mesec);
        		}
			var chartdata = {
				labels: mesec,
				datasets : [
					{
						label: 'Porabljen denar za posamezni mesec',
						backgroundColor: 'rgba(200, 200, 200, 0.75)',
						borderColor: 'rgba(200, 200, 200, 0.75)',
						hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
						hoverBorderColor: 'rgba(200, 200, 200, 1)',
						data: znesek
					}
				]
			};

			var ctx = $("#month");

			var barGraph = new Chart(ctx, {
				type: 'bar',
				data: chartdata
			});
		},
		error: function(data) {
			console.log(data);
		}
    });
	$.ajax({
        url: "php/resources.php",
        method: 'GET',
        success: function(res) {	
        		var vrste = [];
        		var cene = [];

        		for(var i in res) {
        			vrste.push(res[i].vrsta);
        			cene.push(res[i].cena);
        		}
			var chartdata = {
				labels: vrste,
			    datasets: [{
			        data: cene,
			        backgroundColor: [
							'#13425C',
							'#10B292',
							'#F0B922',
							'#E3611B',
									        	
			        ]
			    }],
			};

			var ctx = $("#resources");

			var barGraph = new Chart(ctx, {
				type: 'doughnut',
				data: chartdata
			});
		}
    });
	$.ajax({
        url: "php/allTime.php",
        type: 'GET',
        success: function(res) {
            $('#all_time').html(res);
        	}
    });
	$.ajax({
        url: "php/currentMonth.php",
        type: 'GET',
        success: function(res) {
            $('#current_month').html(res);
        	}
    });
	$.ajax({
        url: "php/expensivestCategory.php",
        type: 'GET',
        success: function(res) {
            $('#expensivest_category').html(res);
        	}
    });     
</script>
<script type="text/javascript" src="js/basic.js"></script>

</html>
</html>