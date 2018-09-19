<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Assesment Test for Web Developer v2</title>
	<style>
		#container{
			width:100%;
			height:100%;
		}
		#nav{
			width:100%;
			height:10%;
			float:left;
		}
		#search{
			width:100%;
			height:10%;
			float:left;
		}
		#show{
			width:100%;
			height:100%;
			float:left;
		}
		#nav a{
			margin:auto;
			text-align:center;
		}
		#mainWeather{
			width:100%;
			height:30%;
			float:left;
			background-color:green;
		}
		#secWeather{
			width:20%;
			height:15%;
			float:left;
			background-color:blue;
		}
		.center {
			margin: auto;
			width: 60%;
			border: 3px solid #73AD21;
			padding: 10px;
		}
		.center-form {
			margin: auto;
			width: 60%;
			padding: 10px;
		}
      #map {
        height: 100%;
      }
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #floating-panel {
        position: absolute;
        top: 10px;
        left: 25%;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
        text-align: center;
        font-family: 'Roboto','sans-serif';
        line-height: 30px;
        padding-left: 10px;
      }
      #floating-panel {
        position: absolute;
        top: 5px;
        left: 50%;
        margin-left: -180px;
        width: 350px;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
      }
      #latlng {
        width: 225px;
      }
	</style>
		

	<!-- CSS -->
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
	<link rel="stylesheet" href="<?php echo base_url('assetForHome/bootstrap/css/bootstrap.min.css')?>">
	<link rel="stylesheet" href="<?php echo base_url('assetForHome/font-awesome/css/font-awesome.min.css') ?>">
	<link rel="stylesheet" href="<?php echo base_url('assetForHome/css/form-elements.css') ?>">
	<link rel="stylesheet" href="<?php echo base_url('assetForHome/css/style.css') ?>">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="<?php echo base_url('assetForHome/bootstrap/js/bootstrap.min.js') ?>"></script>
	<script src="<?php echo base_url('assetForHome/js/jquery.backstretch.min.js') ?>" ></script>
	<script src="<?php echo base_url('assetForHome/js/scripts.js') ?>"></script>
	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCPc6yxbOd1dd3N7bWNWUzPKQgLNivirvY&callback=initMap"></script>
	<script>
	$(document).ready(function(){
	  $('#btnSubmit').on('click', function(){
		  var txtSearch = $('#txtSearch').val();
		  txtSearch = txtSearch.replace(/\s+/g, '-').toLowerCase();
		  if(txtSearch != "")
		  {
			$.ajax({
				type: "POST",
				url: "home/search",
				data: {text:txtSearch},
				dataType:"json",
				success: function (response) {
					console.log(response);
					$('#show').empty();
					if(response.length == 0)
					{
						$('#show').append('<p style="text-align:center;">City not found!</p>');
					}
					else
					{
						var listCity = '<p id="listCity" style="margin-auto;width:100%;padding:10px;text-align:center;"></p>';
					
						$('#show').append(listCity);
						
						var city = '';
						
						$.each(response, function(idx, response){
							city += ' - <a href="#" class="cityTitle" id="'+response.woeid+'">'+response.title+'</a><br>';
						});
						
						$('#listCity').append(city);
						
						$('.cityTitle').on('click', function(){
							var woeid = $(this).attr('id');
							var city = $(this).attr('text');
							$.ajax({
							  type: "POST",
							  url: "home/detail",
							  data: {woeid:woeid},
							  dataType:"json",
							  success: function (response) {
								  $("#show").empty();
								  var city = response.title;
								  var consolidated_weather = response.consolidated_weather;
								  var index = 0;
								  console.log(consolidated_weather);
								  $.each(consolidated_weather, function(idx, response_cw){
									  var description = '';
									  description += '<b style="color:white;"><u>'+city+'</u></b><br>';
									  description += '<b style="font-size:14px;color:yellow;">Date : '+response_cw.applicable_date+'</b><br>';
									  description += '<b style="font-size:14px;color:yellow;">'+response_cw.weather_state_name+'</b><br>';
									  description += '<b style="color:yellow;">Temp : '+parseInt(response_cw.the_temp,10)+' / '+parseInt(response_cw.max_temp,10)+'</b><br>';
									  description += '<b style="color:yellow;">Humidity : '+response_cw.humidity+'</b><br>';
									  description += '<b style="color:yellow;">Wind Speed : '+parseInt(response_cw.wind_speed,10)+'Mph</b><br>';
									  if(index==0)
										$("#show").append('<div class="mainWeather" style="width:100%;height:30%;float:left;"><p style="float: left;"><img style="margin-left:60%;" src="https://www.metaweather.com//static/img/weather/png/'+response_cw.weather_state_abbr+'.png" height="90%" width="30%"></p><p style="font-size:12px;">'+description+'</p></div><hr>');
									  else
										$("#show").append('<div class="secWeather" style="width:20%;height:40%;float:left;"><p style="float: left;margin:auto;"><img src="https://www.metaweather.com//static/img/weather/png/'+response_cw.weather_state_abbr+'.png" height="20%" width="20%"></p><p style="font-size:12px;">'+description+'</p></div>');
									  index++;
								  });
							  },
							  error: function (xhr, ajaxOptions, thrownError) {
							  alert(xhr.status);
							  alert(thrownError);
							  alert(xhr.responseText);
							  }
							});
						});
					}
					
				},
				error: function (xhr, ajaxOptions, thrownError) {
				alert(xhr.status);
				alert(thrownError);
				alert(xhr.responseText);
				}
			  });
		  }
		  else
		  {
			alert("Input a keyword!");
		  }
		  
	  });
	  
	});
	
	function showWeatherFromGoogle(city)
	{
		city = city.replace(/\s+/g, '-').toLowerCase();
		$.ajax({
		  type: "POST",
		  url: "home/detailGoogle",
		  data: {text:city},
		  dataType:"json",
		  success: function (response) {
			  $("#show").empty();
			  console.log(response);
			  var city = response.title;
			  var consolidated_weather = response.consolidated_weather;
			  var index = 0;
			  console.log(consolidated_weather);
			  $.each(consolidated_weather, function(idx, response_cw){
				  var description = '';
				  description += '<b style="color:white;"><u>'+city+'</u></b><br>';
				  description += '<b style="font-size:14px;color:yellow;">Date : '+response_cw.applicable_date+'</b><br>';
				  description += '<b style="font-size:14px;color:yellow;">'+response_cw.weather_state_name+'</b><br>';
				  description += '<b style="color:yellow;">Temp : '+parseInt(response_cw.the_temp,10)+' / '+parseInt(response_cw.max_temp,10)+'</b><br>';
				  description += '<b style="color:yellow;">Humidity : '+response_cw.humidity+'</b><br>';
				  description += '<b style="color:yellow;">Wind Speed : '+parseInt(response_cw.wind_speed,10)+'Mph</b><br>';
				  if(index==0)
					$("#show").append('<div class="mainWeather" style="width:100%;height:30%;float:left;"><p style="float: left;"><img style="margin-left:60%;" src="https://www.metaweather.com//static/img/weather/png/'+response_cw.weather_state_abbr+'.png" height="90%" width="30%"></p><p style="font-size:12px;">'+description+'</p></div><hr>');
				  else
					$("#show").append('<div class="secWeather" style="width:20%;height:40%;float:left;"><p style="float: left;margin:auto;"><img src="https://www.metaweather.com//static/img/weather/png/'+response_cw.weather_state_abbr+'.png" height="20%" width="20%"></p><p style="font-size:12px;">'+description+'</p></div>');
				  index++;
			  });
		  },
		  error: function (xhr, ajaxOptions, thrownError) {
		  alert(xhr.status);
		  alert(thrownError);
		  alert(xhr.responseText);
		  }
		});
	}
	
	function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 8,
          center: {lat: 40.731, lng: -73.997}
        });
        var geocoder = new google.maps.Geocoder;
        var infowindow = new google.maps.InfoWindow;

        document.getElementById('submit').addEventListener('click', function() {
          geocodeLatLng(geocoder, map, infowindow);
        });
      }

      function geocodeLatLng(geocoder, map, infowindow) {
        var input = document.getElementById('latlng').value;
        var latlngStr = input.split(',', 2);
        var latlng = {lat: parseFloat(latlngStr[0]), lng: parseFloat(latlngStr[1])};
        geocoder.geocode({'location': latlng}, function(results, status) {
          if (status === 'OK') {
            if (results[0]) {
              map.setZoom(11);
              var marker = new google.maps.Marker({
                position: latlng,
                map: map
              });
              infowindow.setContent(results[0].formatted_address);
			  showWeatherFromGoogle(results[0].address_components[5].long_name); //run function to show weather
              infowindow.open(map, marker);
            } else {
              window.alert('No results found');
            }
          } else {
            window.alert('Geocoder failed due to: ' + status);
          }
        });
      }
	</script>
</head>
<body>
	<div class="top-content" style="background-image:url('<?php echo base_url('bg.png');?>');">
		<div class="inner-bg">
			<div class="container">
				<div class="center">
					<p style="text-align:center;">
						<a href="<?php echo site_url('home');?>">Dashboard</a> - 
						<a href="<?php echo site_url('dkota');?>">Daftar Kota</a>
					</p>
				</div>
				<hr>
				<div id="search" class="center-form">
					<p style="text-align:center;"><input type="text" id="txtSearch" value="london"><input type="button" id="btnSubmit" value="submit"></p>
					
				</div>
				<div id="show">
				</div>
				<div>
					  <input id="latlng" type="text" value="40.714224,-73.961452">
					  <input id="submit" type="button" value="Reverse Geocode">
					</div>
					<div id="map"></div>
		</div>
	</div>
	
	
</body>
</html>