<?php
	$json = file_get_contents('http://api.openweathermap.org/data/2.5/weather?lat=68.97917&lon=33.09251&appid=7ba48285477cdcc25ffc9f6ba67fbf87');
	file_put_contents('weather.json', $json);	
	$data = json_decode($json, true);
	$windDirectionDeg = $data['wind']['deg'];	
	switch (true) {
		case (($windDirectionDeg >= 337.5 && $windDirectionDeg < 360) || ($windDirectionDeg >= 0 && $windDirectionDeg < 22.5)):
			$windDirection = 'North';
			break;
		case ($windDirectionDeg >= 22.5 && $windDirectionDeg < 67.5):
			$windDirection = 'Northeast';
			break;
		case ($windDirectionDeg >= 67.5 && $windDirectionDeg < 112.5):
			$windDirection = 'East';
			break;
		case ($windDirectionDeg >= 112.5 && $windDirectionDeg < 157.5):
			$windDirection = 'Southeast';
			break;
		case ($windDirectionDeg >= 157.5 && $windDirectionDeg < 202.5):
			$windDirection = 'South';
			break;
		case ($windDirectionDeg >= 202.5 && $windDirectionDeg < 247.5):
			$windDirection = 'Southwest';
			break;
		case ($windDirectionDeg >= 247.5 && $windDirectionDeg < 292.5):
			$windDirection = 'West';
			break;
		case ($windDirectionDeg >= 292.5 && $windDirectionDeg < 337.5):
			$windDirection = 'Northwest';
			break;		
		default:			
			break;
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Home-work-1.4</title>
	<style type="text/css">

		body {
			font: 16px/1.6 Arial, sans-serif;
			color: #242424;
		}

		.weather-section {
			position:relative;	
			margin: 40px auto;				
		}

		.weather {
			max-width:320px;
			margin:0 auto;
			padding: 25px 5px 15px 5px;			
			background-color: #f9690e;
			border-radius: 5px;
		}
		.weather__top {
			padding: 0 5px 5px 5px; 			 
			border-bottom: 2px solid rgba(60, 60, 60, 0.6);
		}

		.weather-top__head {
			font: 700 26px Arial, sans-serif;
			color: #2e2e2e;
		}

		.weather-top__temp {
			font: 700 20px Arial, sans-serif;
			padding-top: 10px;
		}

		.weather-top__weather-description {
			padding-top: 10px;
		}

		.weather-table__cell {
			padding: 3px;
		}

		.weather-table__cell_right {
			padding-left: 5px;
		}

	</style>
</head>
<body>
	<section class="weather-section">
		<div class="weather">
			<div class="weather__top">		
				<div class="weather-top__head">Weather in <?= $data['name'] ?></div>				
				<div class="weather-top__temp"><img src=""><?= round($data['main']['temp'] - 273.15) . ' °C' ?></div>				
				<div class="weather-top__weather-description"><?= $data['weather'][0]['description'] ?></div>				
				<div class="weather-top__date"><?= date('H:i M j') ?></div>
			</div>
			<table class="weather__table">
				<tr>
					<td class="weather-table__cell">Wind</td>					
					<td class="weather-table__cell weather-table__cell_right"><?= $windDirection . ' ' . $data['wind']['speed'] . ' m/s' ?></td>
				</tr>
				<tr>
					<td class="weather-table__cell">Clouds</td>
					<td class="weather-table__cell weather-table__cell_right"><?= $data['clouds']['all'] . ' %' ?></td>
				</tr>
				<tr>
					<td class="weather-table__cell">Pressure</td>
					<td class="weather-table__cell weather-table__cell_right"><?= $data['main']['pressure'] . ' hpa' ?></td>
				</tr>
				<tr>
					<td class="weather-table__cell">Humidity</td>
					<td class="weather-table__cell weather-table__cell_right"><?= $data['main']['humidity'] . ' %' ?></td>
				</tr>
				<tr>
					<td class="weather-table__cell">Sunrise</td>
					<td class="weather-table__cell weather-table__cell_right"><?= date('H:i', $data['sys']['sunrise']) ?></td>
				</tr>
				<tr>
					<td class="weather-table__cell">Sunset</td>
					<td class="weather-table__cell weather-table__cell_right"><?= date('H:i', $data['sys']['sunset']) ?></td>
				</tr>
				<tr>
					<td class="weather-table__cell">Geo coords</td>
					<td class="weather-table__cell weather-table__cell_right"><?= $data['coord']['lon'] . ' ' . $data['coord']['lat'] ?></td>
				</tr>
			</table>		
		</div>
	</section>
</body>
</html>
