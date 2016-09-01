function getKml(e) {

			var xmlHttp = new XMLHttpRequest();
			console.log(event.target.value);
			sport = encodeURIComponent(event.target.dataset.value);
			console.log("fithalt.php?sport="+ sport);
			xmlHttp.open("GET", "fithalt.php?sport="+ sport, true);
			xmlHttp.onreadystatechange = handleServerResponse;
			//why null....because this is not post being sent
			xmlHttp.send(null);


	function handleServerResponse() {
	//readyState determines the state of request ie has not been sent (0) or complete and responese recieved (4)
	 	if (xmlHttp.readyState==4){
			//communcation has been ok
			//status is used to determine whether request is successful or not
			if (xmlHttp.status==200){
				//grabbing and dissecting file
				console.log(xmlHttp);
				console.log(xmlHttp.responseXML);
				xmlResponse = xmlHttp.responseXML;
				xmlDocumentElement = xmlResponse.documentElement;
				if (typeof kmlLayer !== 'undefined') {
					kmlLayer.setMap(null);
				}
				kmlLayer = new google.maps.KmlLayer(xmlDocumentElement.firstChild.data);

				kmlLayer.setMap(map);

			} else {
				alert('something went wrong!');
			}
		}
	}

}
