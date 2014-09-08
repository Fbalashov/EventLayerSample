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
    <link rel="stylesheet" href="bootstrap/css/leaflet.css" /> 
    <link rel="stylesheet" href="bootstrap/css/demo_table.css" />

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

  	    .dynamicTable{

	        width:90%;
	}


    </style>																					 </style> 
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
					  <li><?php echo $this->Html->link(
                                                        '<span class="glyphicon glyphicon-user"></span> Log In To Post Events',
                                                        array('controller' => 'Editor', 'action' => 'index'),
                                                        array('class' => 'btn btn-warning', 'escape' => false)
                                                        );
                                          ?>					  					  
					</ul>
					<form class="navbar-form navbar-right" role="search">					  
					  <a id="dynamicTableButton" class="btn btn-default" data-toggle="modal" data-target="#tableModal"><span class="glyphicon glyphicon-search"></span> Search for Events</a>
					</form>										
				  </div><!-- /.navbar-collapse -->
			</div>
		</nav>
		

		<!-- Dynamic Table Modal -->
		<div class="modal fade" id="tableModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog dynamicTable">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Search for Events</h4>
			  </div>
			  <div class="modal-body dynamicTable" style="overflow:auto;">
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
        <script src="bootstrap/js/jquery.js"></script>
        <script src="bootstrap/js/Leaflet.MakiMarkers.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
	<script src="bootstrap/js/jquery.dataTables.min.js"></script>
	<script>
		
		/*$('#dynamicTableButton').click(function(){
			$("#tableModal").modal('show');
		});*/		
		
		var listenForMapClick = false;
		var clickedLat;
		var clickedLon;
		
		
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
						var tableData = [];
                        for (var i = 0; i<eventsList.length; i++){	
                            var event = eventsList[i].Event;                                            
							
							//create array for this marker's data and add to tableData
							tableData.push([event.title,event.event_type,event.start,event.end,event.description, event.location_details,event.point_of_contact]);
													

							//configure icon according to event type and time remaining
							var icon = L.MakiMarkers.icon({icon: typeToIcon(event.event_type), color: timeToColor(event.start), size: "m"});
							var marker = L.marker([event.lat,event.lon], {icon: icon});                                            
													
							//add markers to the map							
                            markersList.push(marker.bindPopup('<strong>'+ event.title +'</strong><br>' +
                                'Time: ' + event.start + ' - ' + event.end + '<br>' +
                                'Event Type: ' + event.event_type + '<br>' +
                                'Description: ' + event.description + '<br>' +
                                'Location Details: ' + event.location_details + '<br>' +		
                                'Point of Contact: ' + event.point_of_contact + (event.point_of_contact!=''?' (@umd.edu)':'')+'<br>' +
                                '<a href="' + event.link + '"> More Information <br>' +
                                (event.picture===""? '<br>':'<img style="height:50px; width:auto; max-width:150px;" src= "img/' + event.picture + '">')
                                + '<a href="Events/Download/' + event.id +'">Download Event</a>' + '<br>' 
                            ));
                            L.layerGroup(markersList).addTo(map);   
			}				
							
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