<?php
/**
 *
 *
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Pages
 * @since         CakePHP(tm) v 0.10.0.1076
 */
?>
<!DOCTYPE html>
<html>
  <head>
    <title>CMSC435 Project 1</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="bootstrap/css/Ameliabootstrap.min.css" rel="stylesheet" media="screen">
	<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.2/leaflet.css" /> 
    <script src="http://malsup.github.com/jquery.form.js"></script> 

	<style type="text/css">	
		#map {
			width: 100%;
			height: 100%;
			min-height: 100%;
		}

		html, body {
			height: 100%;
		}

		.fill { 			
			height:92%;
			width:100%;
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
		
	</style>	
  </head>  
  <body>
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
					  <li><a class="btn btn-warning"><span class="glyphicon glyphicon-user"></span> Log In To Post Events</a></li>					  					  
					</ul>
					<form class="navbar-form navbar-right" role="search">
					  <div class="form-group">
						<input type="text" class="form-control" placeholder="Search Events"/>
					  </div>
					  <button type="submit" class="btn btn-default">Submit</button>
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
				  <h5>Input Event Data Below:****MUST BE LOGGED IN****</h5>
				  <form id="createEventFormData">					
					  <input type="text" name="title" class="form-control formElement" placeholder="Event Title"/>
					  <input type="text" name="starttime" class="form-control formElement" placeholder="Event Start Time"/>
					  <input type="text" name="endtime" class="form-control formElement" placeholder="Event End Time"/>
					  <input type="text" name="description" class="form-control formElement" placeholder="Event Description"/>				  
					  <input type="text" name="link" class="form-control formElement" placeholder="Event Link"/>
					  <input type="text" name="point_of_contact" class="form-control formElement" placeholder="Point of Contact"/>
					  <input type="text" name="location_details" class="form-control formElement" placeholder="Location Details"/>
					  <input type="text" name="lat" class="form-control formElement" placeholder="Latitude"/>
                                          <input type="text" name="lon" class="form-control formElement" placeholder="Longitude"/>
                                          <label for="picture"> Upload Picture: optional</label>
					  <input id="picture" type="file" name="picture" accept="image/*" class="form-control formElement"/>									
				  </form>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button id="createEventSubmit" type="button" class="btn btn-primary">Submit Event</button>
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
				...
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button type="button" class="btn btn-primary">Update Event</button>
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
				...
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button type="button" class="btn btn-primary">Delete Event</button>
			  </div>
			</div>
		  </div>
		</div>

		<div class="container fill">          
             <div id="map">							
            </div>                      
        </div>
	<script src="http://cdn.leafletjs.com/leaflet-0.7.2/leaflet.js"></script>
        <script src="Leaflet.MakiMarkers.js"></script>
    <script src="bootstrap/js/jquery.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
	<script>
		var map = L.map('map')
		osmTile = "http://tile.openstreetmap.org/{z}/{x}/{y}.png";
		osmCopyright = '&copy; <a href="http://openstreetmap.org/copyright">OpenStreetMap</a> contributors';
		osmLayer = new L.TileLayer(osmTile, { maxZoom: 22, attribution: osmCopyright } );
		map.addLayer(osmLayer);
		map.setView([38.986, -76.940], 16);
		
		var events = $.getJSON(
                "events/all",{},                          
                    function addPoints(eventsList){
                        var markersList = [];
                        for (var i = 0; i<eventsList.length; i++){	
                            var event = eventsList[i].Event;
			    var icon = L.MakiMarkers.icon({icon: typeToIcon(event.event_type), color: timeToColor(event.start), size: "m"});
			    var marker = L.marker([event.lat,event.lon], {icon: icon});                                            
                            markersList.push(marker.bindPopup('<strong>'+ event.title +'</strong><br>' +
                            //markersList.push(L.marker([event.lat,event.lon]).bindPopup('<strong>'+ event.title +'</strong><br>' +
                                'Time: ' + event.start + ' - ' + event.end + '<br>' +
                                'Event Type: ' + event.event_type + '<br>' +
                                'Description: ' + event.description + '<br>' +
                                'Location Details: ' + event.location_details + '<br>' +		
                                'Point of Contact: ' + event.point_of_contact + '<br>' +
                                '<a href="' + event.link + '"> More Information <br>' +
                                '<img style="height:50px; width:auto; max-width:150px;" src= "img/' + event.picture + '">   '
                                + '<a href="Events/Download/' + event.id +'">Download Event</a>' + '<br>' 
                            ));
                            L.layerGroup(markersList).addTo(map);   
                        }			
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
		
                $("#createEventSubmit").click(function(){
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
                });
		
	</script>
  </body>
</html>