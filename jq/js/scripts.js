	
	//
	//  Scripts para el display del buscador, en el menú lateral
	//

	function lookup(inputString) {
		if(inputString.length == 0) {
			// Hide the suggestion box.
			$('#suggestions').hide();
		} else {
			// post data to our php processing page and if there is a return greater than zero
			// show the suggestions box
			$.post("string_search.php", {mysearchString: ""+inputString+""}, function(data){
				if(data.length >0) {
					$('#suggestions').show();
					data=data.substring(5,data.length);
					$('#autoSuggestionsList').html(data);
				}
			});
		}
	} //end
	

	function lookup2(inputString) {
		if(inputString.length == 0) {
			// Hide the suggestion box.
			$('#suggestions').hide();
		} else {
			// post data to our php processing page and if there is a return greater than zero
			// show the suggestions box
			$.post("string_search2.php", {mysearchString: ""+inputString+""}, function(data){
				if(data.length >0) {
					$('#suggestions').show();
					data=data.substring(5,data.length);
					$('#autoSuggestionsList').html(data);
				}
			});
		}
	} //end
	
	function lookup3(inputString) {
		if(inputString.length == 0) {
			// Hide the suggestion box.
			$('#suggestions').hide();
		} else {
			// post data to our php processing page and if there is a return greater than zero
			// show the suggestions box
			$.post("string_search3.php", {mysearchString: ""+inputString+""}, function(data){
				if(data.length >0) {
					$('#suggestions').show();
					$('#autoSuggestionsList').html(data);
				}
			});
		}
	} //end


	// if user clicks a suggestion, fill the text box.
	function fill(thisValue) {
		$('#inputString').val(thisValue);
		setTimeout("$('#suggestions').hide();", 200);
	}


