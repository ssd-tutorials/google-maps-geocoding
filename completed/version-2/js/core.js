var mapObject = {
	postCode : null,
	idPostCode : 'post_code',
	idResult : 'result',
	idCanvas : 'map_canvas',
	idCanvasDisplay : 'map_canvas_display',
	lat : null,
	long : null,
	urlCall : '/mod/gg.php',
	urlSave : '/mod/save.php',
	call : function() {
		this.postCode = $('#' + this.idPostCode).val();
		if (this.postCode != '') {
			jQuery.getJSON(mapObject.urlCall, { pc : mapObject.postCode }, function(data) {
				mapObject.lat = data.results[0].geometry.location.lat;
				mapObject.long = data.results[0].geometry.location.lng;
				$('#' + mapObject.idResult).html(mapObject.lat + '<br />' + mapObject.long);
				jQuery.getScript('http://maps.google.com/maps/api/js?sensor=false&callback=mapObject.initialize');
			});
		}
	},
	initialize : function() {
		
		this.save();
		this.initializeDisplay();		
		
	},
	initializeDisplay : function() {
	
		var myLatlng = new google.maps.LatLng(this.lat, this.long);
		var myOptions = {
			zoom: 15,
			center: myLatlng,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		}
		
		$('#' + mapObject.idCanvas).fadeOut(300, function() {
			
			var map = new google.maps.Map(document.getElementById(mapObject.idCanvas), myOptions);
			
			var marker = new google.maps.Marker({
				position: myLatlng
			});
			
			marker.setMap(map);
			$(this).fadeIn(300);
			
		});
		
	},
	save : function() {
		jQuery.getJSON(mapObject.urlSave, { lat : mapObject.lat, long : mapObject.long });
	},
	display : function(trigger) {
		if (trigger.length > 0) {
			var latLong = $('#' + mapObject.idCanvas).attr('rel').split('=');
			if (latLong.length > 1) {
				mapObject.lat = latLong[0];
				mapObject.long = latLong[1];
				jQuery.getScript('http://maps.google.com/maps/api/js?sensor=false&callback=mapObject.initializeDisplay');
			}
		}
	}
};
$(function() {

	$('#form_map').submit(function() {
		mapObject.call();
		return false;
	});
	
	mapObject.display($('.display'));

});