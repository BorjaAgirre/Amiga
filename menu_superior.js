	function toggleDiv(id,flagit) {
		if (flagit=="1"){
			 if (document.getElementById) document.getElementById(''+id+'').style.display = '';
		}
		else
		if (flagit=="0"){
		if (document.getElementById) document.getElementById(''+id+'').style.display = 'none';
		}
	}
		

	function ningunrecuadro() {
		
		toggleDiv('datos_personales',0);
		toggleDiv('formativo',0);
		toggleDiv('administrativo',0);
		toggleDiv('salud',0);
		toggleDiv('juridico',0);
		toggleDiv('intervencion',0);
	}
		
		
	function datos_personales()
		{
		toggleDiv('datos_personales',1);
	}
		
		
	function formativo()
		{
		toggleDiv('formativo',1);
	}
		
		
	function salud()
		{
		toggleDiv('salud',1);
	}
		
		
	function administrativo()
		{
		toggleDiv('administrativo',1);
	}

		
	function juridico()
		{
		toggleDiv('juridico',1);
	}

		
	function intervencion()
		{
		toggleDiv('intervencion',1);
	}


