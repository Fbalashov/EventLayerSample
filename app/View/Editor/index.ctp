<html>
  <head>
    <title>CMSC435 Project 1</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="bootstrap/css/Ameliabootstrap.min.css" rel="stylesheet" media="screen">
	<link rel="stylesheet" href="bootstrap/css/leaflet.css" /> 
	<link rel="stylesheet" href="bootstrap/css/demo_table.css"/>

	<style type="text/css">	
		#map {
			width: 100%;
			height: 100%;
			min-height: 100%;
		}

		html, body {
			height: 100%;
		}
		
		select{
		        margin-bottom:5px;
		}

		.fill { 			
			height:92%;
			width:100%;
		}
		table{
		  color:#000000;

		}
		#brand{
			color:#FFFF00;
		}
		
		.leaflet-popup-content{
			color:#000000;			
		}
		
		.formElement{
			display:block;
			margin-bottom:5px;			
		}
		
		.dynamicTable{
		   width:90%;

}
	</style>	
  </head>  
  <body>
          <?php echo $this->Session->flash(); ?>
	  <nav class="navbar-wrapper navbar-default" role="navigation">
			<div class="container">
				  <!-- Brand and toggle get grouped for better mobile display -->
				  <div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					  <span class="sr-only"> Toggle navigation</span>
					  <span class="icon-bar"></span>
					  <span class="icon-bar"></span>
					  <span class="icon-bar"></span>
					</button>
					<strong id="brand" class="navbar-brand">TerpNavLite</strong>
				  </div>
		 
				  <!-- Collect the nav links, forms, and other content for toggling -->
				  <div class="collapse navbar-collapse">
					<ul class="nav navbar-nav">
					  <li class="active"><a href="#"><span class="glyphicon glyphicon-home"></span> Home</a></li>
					  <li><a href="Events/Download/"><span class="glyphicon glyphicon-download"></span> Download Event Data</a></li>	
					  <li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-info-sign"></span> Manage Events<b class="caret"></b></a>
						<ul class="dropdown-menu">
						  <li><a href="#" data-toggle="modal" data-target="#createEventModal"><span class="glyphicon glyphicon-plus"></span> Create Events</a></li>
						  <li><a href="#" data-toggle="modal" data-target="#editEventModal"><span class="glyphicon glyphicon-pencil"></span> Edit Events</a></li>
						  <li><a href="#" data-toggle="modal" data-target="#deleteEventModal"><span class="glyphicon glyphicon-trash"></span> Delete Events</a></li>
						</ul>						
					  </li>	
					  <li><a href="Editor/logout" class="btn btn-warning"><span class="glyphicon glyphicon-user"></span> Log Out</a></li>					  					  
					</ul>
					<form class="navbar-form navbar-right" role="search">					  
					  <a id="dynamicTableButton" class="btn btn-default" data-toggle="modal" data-target="#tableModal"><span class="glyphicon glyphicon-search"></span> Search for Events</a>
					</form>										
				  </div><!-- /.navbar-collapse -->
			</div>
		</nav>
		<!-- Create Event Modal -->
		<div class="modal fade" id="createEventModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Create Event</h4>
			  </div>
			  <div class="modal-body">
				  <h5>Input Event Data Below:</h5>
				  <form id="createEventFormData" method="post" action="Events/add" enctype="multipart/form-data">					
					  <input type="text" name="title" class="form-control formElement" placeholder="Event Title" required>
					  <label for="categList"> Choose Event Type</label>
					  <select id="categList" style="margin-bottom:5px;" name="event_type">
						<option value="sport">Sports</option>
						<option value="academic">Academics</option>
						<option value="entertainment">Entertainment</option>
						<option value="other">Other</option>
					  </select><br>
					  <label for="EventStartMonth">Start Date</label>
                                          <select name="data[start][month]" id="EventStartMonth">
                                                    <option value="01">January</option>
                                                    <option value="02">February</option>
                                                    <option value="03">March</option>
                                                    <option value="04">April</option>
                                                    <option value="05">May</option>
                                                    <option value="06">June</option>
                                                    <option value="07">July</option>
                                                    <option value="08">August</option>
                                                    <option value="09">September</option>
                                                    <option value="10">October</option>
                                                    <option value="11">November</option>
                                                    <option value="12">December</option>
                                                    </select>-<select name="data[start][day]" id="EventStartDay">
                                                    <option value="01">1</option>
                                                    <option value="02">2</option>
                                                    <option value="03">3</option>
                                                    <option value="04">4</option>
                                                    <option value="05">5</option>
                                                    <option value="06">6</option>
                                                    <option value="07">7</option>
                                                    <option value="08">8</option>
                                                    <option value="09">9</option>
                                                    <option value="10">10</option>
                                                    <option value="11">11</option>
                                                    <option value="12">12</option>
                                                    <option value="13">13</option>
                                                    <option value="14">14</option>
                                                    <option value="15">15</option>
                                                    <option value="16">16</option>
                                                    <option value="17">17</option>
                                                    <option value="18">18</option>
                                                    <option value="19">19</option>
                                                    <option value="20">20</option>
                                                    <option value="21">21</option>
                                                    <option value="22">22</option>
                                                    <option value="23">23</option>
                                                    <option value="24">24</option>
                                                    <option value="25">25</option>
                                                    <option value="26">26</option>
                                                    <option value="27">27</option>
                                                    <option value="28">28</option>
                                                    <option value="29">29</option>
                                                    <option value="30">30</option>
                                                    <option value="31">31</option>
                                                    </select>-<select name="data[start][year]" id="EventStartYear">
                                                    <option value="2034">2034</option>
                                                    <option value="2033">2033</option>
                                                    <option value="2032">2032</option>
                                                    <option value="2031">2031</option>
                                                    <option value="2030">2030</option>
                                                    <option value="2029">2029</option>
                                                    <option value="2028">2028</option>
                                                    <option value="2027">2027</option>
                                                    <option value="2026">2026</option>
                                                    <option value="2025">2025</option>
                                                    <option value="2024">2024</option>
                                                    <option value="2023">2023</option>
                                                    <option value="2022">2022</option>
                                                    <option value="2021">2021</option>
                                                    <option value="2020">2020</option>
                                                    <option value="2019">2019</option>
                                                    <option value="2018">2018</option>
                                                    <option value="2017">2017</option>
                                                    <option value="2016">2016</option>
                                                    <option value="2015">2015</option>
                                                    <option value="2014">2014</option>


                                                    </select>
					            <br>
					            <label for="EventStartHour">Start Time:
					            <select name="data[start][hour]" id="EventStartHour">
                                                    <option value="01">1</option>
                                                    <option value="02">2</option>
                                                    <option value="03">3</option>
                                                    <option value="04">4</option>
                                                    <option value="05">5</option>
                                                    <option value="06">6</option>
                                                    <option value="07">7</option>
                                                    <option value="08">8</option>
                                                    <option value="09">9</option>
                                                    <option value="10">10</option>
                                                    <option value="11">11</option>
                                                    <option value="12">12</option>
                                                    </select>:<select name="data[start][min]" id="EventStartMin">
                                                    <option value="00">00</option>
                                                    <option value="01">01</option>
                                                    <option value="02">02</option>
                                                    <option value="03">03</option>
                                                    <option value="04">04</option>
                                                    <option value="05">05</option>
                                                    <option value="06">06</option>
                                                    <option value="07">07</option>
                                                    <option value="08">08</option>
                                                    <option value="09">09</option>
                                                    <option value="10">10</option>
                                                    <option value="11">11</option>
                                                    <option value="12">12</option>
                                                    <option value="13">13</option>
                                                    <option value="14">14</option>
                                                    <option value="15">15</option>
                                                    <option value="16">16</option>
                                                    <option value="17">17</option>
                                                    <option value="18">18</option>
                                                    <option value="19">19</option>
                                                    <option value="20">20</option>
                                                    <option value="21">21</option>
                                                    <option value="22">22</option>
                                                    <option value="23">23</option>
                                                    <option value="24">24</option>
                                                    <option value="25">25</option>
                                                    <option value="26">26</option>
                                                    <option value="27">27</option>
                                                    <option value="28">28</option>
                                                    <option value="29">29</option>
                                                    <option value="30">30</option>
                                                    <option value="31">31</option>
                                                    <option value="32">32</option>
                                                    <option value="33">33</option>
                                                    <option value="34">34</option>
                                                    <option value="35">35</option>
                                                    <option value="36">36</option>
                                                    <option value="37">37</option>
                                                    <option value="38">38</option>
                                                    <option value="39">39</option>
                                                    <option value="40">40</option>
                                                    <option value="41">41</option>
                                                    <option value="42">42</option>
                                                    <option value="43">43</option>
                                                    <option value="44">44</option>
                                                    <option value="45">45</option>
                                                    <option value="46">46</option>
                                                    <option value="47">47</option>
                                                    <option value="48">48</option>
                                                    <option value="49">49</option>
                                                    <option value="50">50</option>
                                                    <option value="51">51</option>
                                                    <option value="52">52</option>
                                                    <option value="53">53</option>
                                                    <option value="54">54</option>
                                                    <option value="55">55</option>
                                                    <option value="56">56</option>
                                                    <option value="57">57</option>
                                                    <option value="58">58</option>
                                                    <option value="59">59</option>
                                                    </select> <select name="data[start][meridian]" id="EventStartMeridian">
                                                    <option value="am">am</option>
                                                    <option value="pm">pm</option>
                                                    </select>
					       <br>
                                               <label for="EventEndMonth">End Date</label><select name="data[end][month]" id="EventEndMonth">
                                                <option value="01">January</option>
                                                <option value="02">February</option>
                                                <option value="03">March</option>
                                                <option value="04">April</option>
                                                <option value="05">May</option>
                                                <option value="06">June</option>
                                                <option value="07">July</option>
                                                <option value="08">August</option>
                                                <option value="09">September</option>
                                                <option value="10">October</option>
                                                <option value="11">November</option>
                                                <option value="12">December</option>
                                                </select>-<select name="data[end][day]" id="EventEndDay">
                                                <option value="01">1</option>
                                                <option value="02">2</option>
                                                <option value="03">3</option>
                                                <option value="04">4</option>
                                                <option value="05">5</option>
                                                <option value="06">6</option>
                                                <option value="07">7</option>
                                                <option value="08">8</option>
                                                <option value="09">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                                <option value="13">13</option>
                                                <option value="14">14</option>
                                                <option value="15">15</option>
                                                <option value="16">16</option>
                                                <option value="17">17</option>
                                                <option value="18">18</option>
                                                <option value="19">19</option>
                                                <option value="20">20</option>
                                                <option value="21">21</option>
                                                <option value="22">22</option>
                                                <option value="23">23</option>
                                                <option value="24">24</option>
                                                <option value="25">25</option>
                                                <option value="26">26</option>
                                                <option value="27">27</option>
                                                <option value="28">28</option>
                                                <option value="29">29</option>
                                                <option value="30">30</option>
                                                <option value="31">31</option>
                                                </select>-<select name="data[end][year]" id="EventEndYear">
                                                <option value="2034">2034</option>
                                                <option value="2033">2033</option>
                                                <option value="2032">2032</option>
                                                <option value="2031">2031</option>
                                                <option value="2030">2030</option>
                                                <option value="2029">2029</option>
                                                <option value="2028">2028</option>
                                                <option value="2027">2027</option>
                                                <option value="2026">2026</option>
                                                <option value="2025">2025</option>
                                                <option value="2024">2024</option>
                                                <option value="2023">2023</option>
                                                <option value="2022">2022</option>
                                                <option value="2021">2021</option>
                                                <option value="2020">2020</option>
                                                <option value="2019">2019</option>
                                                <option value="2018">2018</option>
                                                <option value="2017">2017</option>
                                                <option value="2016">2016</option>
                                                <option value="2015">2015</option>
                                                <option value="2014">2014</option>


                                                </select><br>
					        <label for"EventEndHour">End Time</label>
                                                <select name="data[end][hour]" id="EventEndHour">
                                                <option value="01">1</option>
                                                <option value="02">2</option>
                                                <option value="03">3</option>
                                                <option value="04">4</option>
                                                <option value="05">5</option>
                                                <option value="06">6</option>
                                                <option value="07">7</option>
                                                <option value="08">8</option>
                                                <option value="09">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                                </select>:<select name="data[end][min]" id="EventEndMin">
                                                <option value="00">00</option>
                                                <option value="01">01</option>
                                                <option value="02">02</option>
                                                <option value="03">03</option>
                                                <option value="04">04</option>
                                                <option value="05">05</option>
                                                <option value="06">06</option>
                                                <option value="07">07</option>
                                                <option value="08">08</option>
                                                <option value="09">09</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                                <option value="13">13</option>
                                                <option value="14">14</option>
                                                <option value="15">15</option>
                                                <option value="16">16</option>
                                                <option value="17">17</option>
                                                <option value="18">18</option>
                                                <option value="19">19</option>
                                                <option value="20">20</option>
                                                <option value="21">21</option>
                                                <option value="22">22</option>
                                                <option value="23">23</option>
                                                <option value="24">24</option>
                                                <option value="25">25</option>
                                                <option value="26">26</option>
                                                <option value="27">27</option>
                                                <option value="28">28</option>
                                                <option value="29">29</option>
                                                <option value="30">30</option>
                                                <option value="31">31</option>
                                                <option value="32">32</option>
                                                <option value="33">33</option>
                                                <option value="34">34</option>
                                                <option value="35">35</option>
                                                <option value="36">36</option>
                                                <option value="37">37</option>
                                                <option value="38">38</option>
                                                <option value="39">39</option>
                                                <option value="40">40</option>
                                                <option value="41">41</option>
                                                <option value="42">42</option>
                                                <option value="43">43</option>
                                                <option value="44">44</option>
                                                <option value="45">45</option>
                                                <option value="46">46</option>
                                                <option value="47">47</option>
                                                <option value="48">48</option>
                                                <option value="49">49</option>
                                                <option value="50">50</option>
                                                <option value="51">51</option>
                                                <option value="52">52</option>
                                                <option value="53">53</option>
                                                <option value="54">54</option>
                                                <option value="55">55</option>
                                                <option value="56">56</option>
                                                <option value="57">57</option>
                                                <option value="58">58</option>
                                                <option value="59">59</option>
                                                </select> <select name="data[end][meridian]" id="EventEndMeridian">
                                                <option value="am">am</option>
                                                <option value="pm" selected="selected">pm</option>
                                                </select>
                                          <textarea name="description" class="form-control formElement" placeholder="Event Description" required></textarea>				  
					  <input type="url" name="link" class="form-control formElement" placeholder="Event Link(must start with http://)" required>
					  
					  <textarea name="location_details" class="form-control formElement" placeholder="Location Details" required></textarea>
					  <a class="btn btn-default" style="margin-bottom:5px;" id="getCoordinates">Select Location on Map <span id="locSelected"> </span></a>
					  <input id="createLat" type="text" name="lat" class="form-control formElement" placeholder="Latitude" required>
					  <input id="createLon" type="text" name="lon" class="form-control formElement" placeholder="Longitude" required>
					  <label for="picture"> Upload Picture: optional</label>
					  <input id="picture" type="file" name="data[picture]"/>									
					  <div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
						<input id="createEventSubmit" type="submit" class="btn btn-primary" value="Submit Event">
					  </div>
				  </form>
			  </div>
			  
			</div>
		  </div>
		</div>
		
		<!-- Edit Event Modal -->
		<div class="modal fade" id="editEventModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Edit Event</h4>
			  </div>
			  <div class="modal-body">
				To edit an event, click the event on the map and then click the edit link. Note: Only the creator of the event may edit the event.
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			  </div>
			</div>
		  </div>
		</div>
		
		<!-- Delete Event Modal -->
		<div class="modal fade" id="deleteEventModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Delete Event</h4>
			  </div>
			  <div id="createEventBody" class="modal-body">
				To delete an event, click the event on the map and then click the delete link. Note: Only the creator of the event may delete the event.
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>				
			  </div>
			</div>
		  </div>
		</div>

		<!-- Dynamic Table Modal -->
		<div class="modal fade" id="tableModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog dynamicTable">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Search for Events</h4>
			  </div>
			  <div class="modal-body dynamicTable" style="overflow:auto">
				<table cellpadding="0" cellspacing="0" border="0" class="display" id="dynamicTable"></table>
			  </div>			  
			</div>
		  </div>
		</div>
		
		<div class="container fill">          
             <div id="map">							
            </div>                      
        </div>
		
        
	<script src="bootstrap/js/leaflet.js"></script>
        <script src="bootstrap/js/Leaflet.MakiMarkers.js"></script>
        <script src="bootstrap/js/jquery.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
	<script src="bootstrap/js/jquery.dataTables.min.js"></script>
	<script>
	       
		/*$('#dynamicTableButton').click(function(){
			$("#tableModal").modal('show');
		});*/		
		
	
		//initialize map and table with all event data from the database
		var listenForMapClick = false;
		var clickedLat;
		var clickedLon;
		
		
		var map = L.map('map')
		osmTile = "http://tile.openstreetmap.org/{z}/{x}/{y}.png";
		osmCopyright = '&copy; <a href="http://openstreetmap.org/copyright">OpenStreetMap</a> contributors';
		osmLayer = new L.TileLayer(osmTile, { maxZoom: 22, attribution: osmCopyright } );
		map.addLayer(osmLayer);
		map.setView([38.986, -76.940], 16);
		
		
		//make json request to the database and loop through events to create marker for them
		var events = $.getJSON(
                "events/all",{},                          
                    function addPoints(eventsList){
                        var markersList = [];
						var tableData = [];
                        for (var i = 0; i<eventsList.length; i++){	
                            var event = eventsList[i].Event;                                            
							
							//create array for this marker's data and add to tableData
							tableData.push([event.title,event.event_type,event.start,event.end,event.description, event.location_details,event.point_of_contact]);
													

							//configure icon according to event type and time remaining
							var icon = L.MakiMarkers.icon({icon: typeToIcon(event.event_type), color: timeToColor(event.start), size: "m"});
							var marker = L.marker([event.lat,event.lon], {icon: icon});                                            
							var img = "";
							

													
							//add markers to the map							
                            markersList.push(marker.bindPopup(
								'<strong>'+ event.title +'</strong><br>' +
                                'Time: ' + event.start + ' - ' + event.end + '<br>' +
                                'Event Type: ' + event.event_type + '<br>' +
                                'Description: ' + event.description + '<br>' +
                                'Location Details: ' + event.location_details + '<br>' +		
                                'Point of Contact: ' + event.point_of_contact + (event.point_of_contact!=''?' (@umd.edu)':'')+'<br>' +
                                '<a href="' + event.link + '"> More Information <br>' +
                                (event.picture===""?'<br>':'<img style="height:50px; width:auto; max-width:150px;" src= "img/' + event.picture + '" alt="">') +
                                '<a href="Events/Download/' + event.id +'">Download Event</a> <br>' +
								'<a href="Events/edit/'+event.id+'" id="Event'+event.id+'" class="btn btn-default" onClick="editEvent()">Edit Event</a>' + '<br>' +
								'<form id="createEventFormData" method="post" action="Events/delete/'+event.id+'">' +
                                                                '<input type="submit" class="btn btn-primary" value="Delete Event">' +
                                                                '</form>' + '<br>' 
                            ));
                            L.layerGroup(markersList).addTo(map);   
			}				
							console.log(tableData);
							//create dynamic table for easier searching for data
							$('#dynamicTable').dataTable( {
								"aaData": tableData,
								"aoColumns": [
									{ "sTitle": "Title" },
									{ "sTitle": "Type" },									
									{ "sTitle": "Start-Time"},
									{ "sTitle": "End-Time"},
									{ "sTitle": "Description"},
									{ "sTitle": "Location Details"},
									{ "sTitle": "Point of Contact"}																	
								]								
							} ); 

								
                        			
                    }
			)
		
		
			function typeToIcon(type){
				if (type === "sport")
            		   return "pitch";
        		if (type === "academic")
            		   return "library";
		        if (type === "entertainment")
            		   return "theatre";
        		else
            		   return "marker";

    		}
	        function timeToColor(time){
		        var t = time.split(/[- :]/);
		        var date2 = new Date(t[0], t[1]-1, t[2], t[3], t[4], t[5]);
		        var date1 = new Date();
		        if (date2.getFullYear() > date1.getFullYear())
		            return "#000";
		        if (date2.getMonth() > date1.getMonth())
		            return "#000";
		        if (date2.getDate() > date1.getDate() +7)
		            return "#48b";
		        if (date2.getDate() > date1.getDate())
		            return "#b36";
		        else
		            return "#f00";
	        }
		
		
			function createEvent(title, type, start, end, description, picture, link, poc, loc_details, lat, lon){
				this.title = title;
				this.type = type;
				this.start = start;
				this.end = end;
				this.description = description;
				this.picture = picture;
				this.link = link;
				this.poc = poc;
				this.loc_details = loc_details;
				this.lat = lat;
				this.lon = lon;
			}
		
	    
			function onMapClick(e){							
				if(listenForMapClick){	
					console.log(e.latlng);
					clickedLat = e.latlng.lat;
					clickedLon = e.latlng.lng;														
					listenForMapClick=false;
					$("#createEventModal").modal('show');									
					$("#createLat").val(clickedLat+"");
					$("#createLon").val(clickedLon+"");
                                        $("#locSelected").addClass("glyphicon glyphicon-ok");
				}				
			}
		
			$("#getCoordinates").click(function(){
				listenForMapClick = true;
				$("#createEventModal").modal('hide');												
			});
			map.on('click',onMapClick);
		
		/*$("#createEventSubmit").click(function(){
				console.log($('#createEventFormData').serialize());
				$.ajax({
					type: "POST",
								url: "events/add",
								data: $('#createEventFormData').serialize(),
					success: function(msg){
							 $("#createEventBody").html("<h2>Success!</h2>")
							$("#createEventModal").modal('hide');
							//location.reload();
						 },
								error: function(){
					alert("Failure for Reason Unknown. Check your input values!");
					}
				});
		});*/
		
	</script>
  </body>
</html>
