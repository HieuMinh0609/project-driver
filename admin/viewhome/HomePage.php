<?php include '../includes/FooterHeader/header.php'?>
 
 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


<div class="container-fluid">
		<div class="row">
			 
			<div class="link_header">
				<i class="glyphicon glyphicon-hand-right"></i>
				<a href="HomePage.php">Home</a>
				 
			</div>
		
		</div>
	 
		
	 
		<br>
		<div class="row">
			<div class="col-md-6">
						<div id="columnchart_values" style="width: 900px; height: 300px;"></div>

			</div>
			<div class="col-md-6">
				 		<div id="columnchart_monney" style="width: 900px; height: 300px;"></div>

			</div>
		</div>
		<br><br><br><br><br><br>
		<div class="row">
			 
			<div class="col-md-12">
				 		<div id="columnchart_count_year" style="width: 900px;height: 300px; margin-left: 320px;"></div>

			</div>
		</div>
<br><br>
	</div>
<?php 
	require("../../lib/controls.php");
	require_once("../../lib/db.php");
	require("../../lib/BillService.php");

	$timenow = date('Y-m-d H:i:s');
	$month = date("m",strtotime($timenow));
	$year = date("Y",strtotime($timenow));

	$conn = db_connect();

	$hotfood =  CountTypeChart($conn,1,$month,$year);
	$fastfood =  CountTypeChart($conn,2,$month,$year);
	$drink =  CountTypeChart($conn,3,$month,$year);

  checkNull3($hotfood,$fastfood, $drink );
 

	db_close($conn);


	$conn = db_connect();
	
	$sumMoney1 =  CountTypeMoneyOf3Year($conn,$month,$year);
	$sumMoney2 =  CountTypeMoneyOf3Year($conn,$month-1,$year);
	$sumMoney3 =  CountTypeMoneyOf3Year($conn,$month-2,$year);

  checkNull3($sumMoney1,$sumMoney2, $sumMoney3 );
	db_close($conn);


	$conn = db_connect();
	
	 
	$hotfood_in_year =  CountTypeChartInYear($conn,1,$year);
	$fastfood_in_year =  CountTypeChartInYear($conn,2,$year);
	$drink_in_year =  CountTypeChartInYear($conn,3,$year);

  checkNull3($hotfood_in_year,$fastfood_in_year, $drink_in_year );
	db_close($conn);


?>
<script type="text/javascript">
	google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart1);
    function drawChart1() {
      var data = google.visualization.arrayToDataTable([
        ["Element", "Density", { role: "style" } ],
        ["Food Hot", <?=$hotfood?>, "#b87333"],
        ["Food Fast", <?=$fastfood ?>, "silver"],
        ["Drinks",<?=$drink ?>, "gold"]
        
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "Statistics on <?= $month ?> month in  <?= $year ?> year",
        width: 600,
        height: 400,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
      chart.draw(view, options);
  }

google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart2);
   function drawChart2() {
      var data = google.visualization.arrayToDataTable([
        ["Element", " VND ", { role: "style" } ],
        ["Tháng này", <?=$sumMoney1?>, "#b87333"],
        ["Tháng trước", <?=$sumMoney2 ?>, "silver"],
        ["2 Tháng trước",<?=$sumMoney3 ?>, "gold"]
        
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "Statistics revenue in  3 month nearest",
        width: 600,
        height: 400,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart_Monney = new google.visualization.ColumnChart(document.getElementById("columnchart_monney"));
      chart_Monney.draw(view, options);
  }

   google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart3);

      function drawChart3() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Số Lượng bán mỗi năm'],
          ['Hot Food',      <?=$hotfood_in_year?>],
          ['Fast Food',       <?=$fastfood_in_year?>],
          ['Drink',   <?=$drink_in_year?>]
          
        ]);

        var options = {
          title: 'Count product sell in <?=$year?>'
        };

        var chart_count = new google.visualization.PieChart(document.getElementById('columnchart_count_year'));

        chart_count.draw(data, options);
      }

</script>
<?php include '../includes/FooterHeader/footer.php'?>