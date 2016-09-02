<!DOCTYPE html>
<html>
    <head>
    <!--TITLE GOES HERE-->
        <title>Drop Deliveries</title>
        <link rel="SHORTCUT ICON" href="../images/icon.ico" />
        <link rel="icon" href="../images/icon.ico" type="image/ico" />
        <script type="text/javascript" src="../js/script.js"></script>
		<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAcCOWGTGXzTgjPzqLdU_4wCWS9j3YFmnY&callback=initMap"></script>
		<script type="text/javascript" src="../js/mapscript.js"></script>
        <meta charset="utf-8"/>
        <link href="../css/styles.css" rel="stylesheet" type="text/css"/>
		<link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'> <!--FONT LICENSE AND SOURCE https://www.google.com/fonts/specimen/Lobster -->
    </head>
    <body>
		<div id="back_nav">
            <div id="wrapper">
                 <?php include('../php/nav.php');
                    displayNav("");?>
				<div id="content_base">
					<div id="content">
						<div id="address_map_results">
							<div id="address_map_left_results">
							<div id="table_title">select a spot</div>
							<table div id="results_table">
<!-- 								<thead>
									<tr>
										<th><a>Wifi Hotspot Name</a></th>
										<th>Address</th>
										<th>Suburb</th>
									</tr>
								</thead> -->
								<tbody>
									<tr onclick="document.location = 'example.php';">
										<td>A</td>
										<td title="Name"><a href="example.php" id="A">7th Brigade Park, Chermside</a></td>
										<td title="Address">Delaware St</td>
										<td title="Suburb">Chermside,4032</td>
										<td>-27.37893</td>
										<td>153.04461</td>
										<td title="Average user rating"><span class="results_rating">5</span><span class="star">&#9733;</span></td>
									</tr>
									<tr>
										<td>B</td>
										<td title="Name"><a href="" id="B">Annerley Library Wifi</a></td>
										<td title="Address">450 Ipswich Road</td>
										<td title="Suburb">Annerley, 4103</td>
										<td>-27.50942285</td>
										<td>153.0333218</td>
										<td title="Average user rating"><span class="results_rating">4</span><span class="star">&#9733;</span></td>
									</tr>
									<tr>
										<td>C</td>
										<td title="Name"><a href="" id="C">Ashgrove Library Wifi</a></td>
										<td title="Address">87 Amarina Avenue</td>
										<td title="Suburb">Ashgrove, 4060</td>
										<td>-27.44394629</td>
										<td>152.9870981</td>
										<td title="Average user rating"><span class="results_rating">1</span><span class="star">&#9733;</span></td>
									</tr>
									<!-- -->
									<tr>
										<td>D</td>
										<td title="Name"><a href="" id="D">Garden City Library Wifi</a></td>
										<td title="Address">Garden City Shopping Centre, Corner Logan and Kessels Road</td>
										<td title="Suburb">Upper Mount Gravatt, 4122</td>
										<td>-27.56244221</td>
										<td>153.0809183</td>
										<td title="Average user rating"><span class="results_rating">3</span><span class="star">&#9733;</span></td>
									</tr>
									<tr>
										<td>E</td>
										<td title="Name"><a href="" id="E">Banyo Library Wifi</a></td>
										<td title="Address">284 St. Vincents Road</td>
										<td title="Suburb">Banyo, 4014</td>
										<td>-27.37396641</td>
										<td>153.0783234</td>
										<td title="Average user rating"><span class="results_rating">4</span><span class="star">&#9733;</span></td>
									</tr>
									<tr>
										<td>F</td>
										<td title="Name"><a href="" id="F">Booker Place Park</a></td>
										<td title="Address">Birkin Rd & Sugarwood St</td>
										<td title="Suburb">Bellbowrie</td>
										<td>-27.56353</td>
										<td>152.89372</td>
										<td title="Average user rating"><span class="results_rating">2</span><span class="star">&#9733;</span></td>
									</tr>
									<tr>
										<td>G</td>
										<td title="Name"><a href="" id="G">Bracken Ridge Library Wifi</a></td>
										<td title="Address">Corner Bracken and Barrett Street</td>
										<td title="Suburb">Bracken Ridge, 4017</td>
										<td>-27.31797261</td>
										<td>153.0378735</td>
										<td title="Average user rating"><span class="results_rating">4</span><span class="star">&#9733;</span></td>
									</tr>
									
								</tbody>
							</table>
							</div>
							<div id="address_map_right">
							</div>
						</div>
					
					</div>
				</div>
				
				<footer id="footer">
					<p>Ronald Grande &amp; Yannick Mansuy - CAB230 - 2016</p>
				</footer>
			</div>
		</div>
    </body>
</html>