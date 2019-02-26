<!DOCTYPE html>
<html>
<head>
  <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
  <script language="JavaScript" src='./jq/jquery.min.js'></script>   
  <script language="JavaScript" src='./jq/jquery-ui.js'></script>   

  <script>
  $(document).ready(function() {
    $("#dialogo").dialog({ buttons: [
    {
        text: "Ok",
        click: function() { $(this).dialog("close"); }
    }
	] });
  });
  </script>
</head>
<body style="font-size:62.5%;">
  
<div id="dialogo" title="Título">Aquí se pueden poner varias cosas</div>


</body>
</html>
