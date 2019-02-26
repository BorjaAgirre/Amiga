<!DOCTYPE html>
<html>
<head>
<link href='form.css' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="../../jq/jquery.min.js"></script>
<script type="text/javascript" src="../../jq/jquery-ui.js"></script>
</head>
<body>

<script>
$(document).ready(function () {
	$("input#ob").click(function () {
		if ($(this).is(":checked"))
        {
	  $("div").show("fast");
	}else {
          $("div").hide("fast");
        }
	});
});

$("#hidr").click(function () {
  $("div").hide(1000);
});
</script>

  
  <input type='checkbox' id="ob" checked='checked'>Show</button>
  <button id="hidr">Hide</button>
  <div  style = 'display: none'>Hello 3,</div>

</body>
</html>
