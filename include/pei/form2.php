<!DOCTYPE html>
<html>
<head>
<link href='form.css' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="../../jq/jquery.min.js"></script>
<script type="text/javascript" src="../../jq/jquery-ui.js"></script>
</head>
<body>

<div class="nav">
  <input type='checkbox' id='meta' name='primero' checked='checked' value='Borja'>1. Garantizar la cobertura de necesidades básicas
  <div id='extra' >
    <input type='text' id='pregunta1' size=20 name='meta-1-1' value=''>
    <input type='text' id='pregunta2' size=20 name='meta-1-2' value=''>
  </div>
</div>

<div class="nav">
  <input type='checkbox' id='meta' name='primero' checked='checked' value='Borja'>2. Incrementar el nivel de ingresos económicos.
  <div id='extra' >
    <input type='text' id='pregunta1' size=20 name='meta-2-1' value=''>
    <input type='text' id='pregunta2' size=20 name='meta-2-2' value=''>
  </div>
</div>


<script>
// applies italics to text of the second <li> within each <ul class="nav">
$("div.nav").each(function(index) {
  var $x = $(this).find("div");

  $(this).find("input#meta").click(function(){
    if ($(this).is(":checked"))
      {
        $x.show("fast");
      } else {
        $x.hide("fast");
      }
  });

});



/*
$("div.nav").each(function(index) {
  x = $(this).find("div").attr("id");

  $(this).find("input#meta").click(function(){
    if ($(this).is(":checked"))
      {
        $('div[id=x]').show("fast");
      } else {
        $('div[id=x]').hide("fast");
      }
  });

});
*/

</script>

</body>
</html>
