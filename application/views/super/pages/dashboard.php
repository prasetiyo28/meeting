 <div class="container-fluid">

 	<!-- Page Heading -->
 	<div class="d-sm-flex align-items-center justify-content-between mb-4">
 		<h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
 		<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
 	</div>



 	<!-- Content Row -->
 	<div class="row">

 		<!-- Content Column -->
 		<div class="col-lg-12 mb-4">

 			<!-- Project Card Example -->
 			<div class="card shadow mb-4">
 				<div class="card-header py-3">
 					<h6 class="m-0 font-weight-bold text-primary">Welcome</h6>
 				</div>
 				<div class="card-body">
 					<h1>Hai Super Admin, Semangat ! </h1>
 				</div>


 				<center>
 					
 					<h4>Grafik 5 Mitra Terbanyak Booking </h4>
 				</center>

 				<canvas id="myChart"></canvas>
 			</div>


 		</div>

 	</div>
 </div>

 <?php 	$nama = ''; $jumlah = '';foreach ($grafik as $x) {
 	$nama = $nama .'"'.$x->nama_mitra.'",';
 	$jumlah = $jumlah.$x->jumlah.',';
 } ?>

 <script>
 	var ctx = document.getElementById("myChart").getContext('2d');
 	var myChart = new Chart(ctx, {
 		type: 'bar',
 		data: {
 			labels: [<?php echo $nama; ?>],
 			datasets: [{
 				label: '# of Votes',
 				data: [<?php echo $jumlah ?>],
 				backgroundColor: [
 				'rgba(255, 99, 132, 0.2)',
 				'rgba(54, 162, 235, 0.2)',
 				],
 				borderColor: [
 				'rgba(255,99,132,1)',
 				'rgba(54, 162, 235, 1)',
 				],
 				borderWidth: 1
 			}]
 		},
 		options: {
 			scales: {
 				yAxes: [{
 					ticks: {
 						beginAtZero:true
 					}
 				}]
 			}
 		}
 	});
 </script>