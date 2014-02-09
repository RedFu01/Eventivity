function events() {
init();
function init(){
	initMap();
	$('.events .getEvents').click(getEvents);
	$('.create-event .save-event').click(createEvent);
}
var map;
var marker=[];
var geocoder= new google.maps.Geocoder();

function createEvent(){
var address= $('.create-event input[name=event-address]').val();
    geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {

		var eventPosition=  results[0].geometry.location;
		var eventData={
			name: $('.create-event input[name=event-name]').val(),
			description:$('.create-event input[name=event-description]').val(),
			lat: eventPosition.lat(),
			lng: eventPosition.lng(),
			id: 2,
		};
		var response=$.ajax({
			type: "POST",
			url: "http://fu.no-ip.biz/php/createEvent.php",
			data: eventData,
			crossDomain: true,
			dataType: "jsonp",
			cache: false,
		});
	response.success(function(data){
alert(data);
	});
      }else{

	  }
    });

}

function initMap() {
    var mapOptions = {
		center: new google.maps.LatLng(53.55203703079967, 9.985628128051758),
		zoom: 12,
		mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    map = new google.maps.Map(document.getElementById("map_canvas"),mapOptions);
}

function clearMarker() {
  for (var i = 0; i < marker.length; i++ ) {
    marker[i].setMap(null);
  }
  marker.length = 0;
}

function codeAddress(address) {

  }
 
function getEvents(){
	var data={
		lat:1.34,
		lng:2.56,
		hashes: new Array('fun','good')
	};
	var response=$.ajax({
		type: "POST",
		url: "http://fu.no-ip.biz/php/events.php",
		data: data,
		crossDomain: true,
		dataType: "jsonp",
		cache: false,
	});
	response.success(function(data){
	var l = data.length;
	clearMarker();
	for(var i=0; i<data.length;i++){
		marker.push(new google.maps.Marker({
			position: new google.maps.LatLng(data[i].lat, data[i].lng),
			animation: google.maps.Animation.DROP,
			map: map,
			title: data[i].name
  }));
		}
	});
}

}
$(document).ready(events);
