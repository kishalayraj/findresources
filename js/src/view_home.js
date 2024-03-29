function editUserData(){
	$('#userDataEditorFirstName').val(userData.nombre);
	$('#userDataEditorLastName').val(userData.apellido);
	$('#userDataEditorIdType').val(userData.idTipoDocumento);
	$('#userDataEditorIdNumber').val(userData.numeroDocumento);
	$('#userDataEditorPhone').val(userData.telefono);
	$('#userDataEditorCountry').val(userData.idPais);
	$('#userDataEditorRazonSocial').val(userData.razonSocial);
	$('#userDataEditorIdIndustria').val(userData.idIndustria);
	
	if (userData.idTipoUsuario == "E") {
		$('#userDataEditorAddress').val(userData.calle),
		$('#userDataEditorAddressNumber').val(userData.numero);
		$('#userDataEditorAddressPiso').val(userData.piso);
		$('#userDataEditorAddressDpto').val(userData.departamento);
		$('#userDataEditorLocalidad').val(userData.localidad);
		$('#userDataEditorProvincia').val(userData.idProvincia);
		$('#userDataEditorCantEmpleados').val(userData.cantEmpleados);
		$('#userDataEditorFechaInicio').val(userData.fechaInicio);
	}
	showPopUp('#userDataPopUp');
}


/*WINDOW ONLOAD*/
$(function(){

	$('#userDataPopUp .sendButton').click(function(){

		var usuario = {
			nombre: $('#userDataEditorFirstName').val(),
			apellido: $('#userDataEditorLastName').val(),
			razonSocial:$('#userDataEditorRazonSocial').val(),
			idIndustria:$('#userDataEditorIdIndustria').val(),
			idTipoDocumento:$('#userDataEditorIdType').val(),
			numeroDocumento:$('#userDataEditorIdNumber').val(),
			telefono:$('#userDataEditorPhone').val(),
			idPais:$('#userDataEditorCountry').val(),

			idTipoUsuario: userData.idTipoUsuario
		};
		var error_setUsr = false;
		$.ajax({
			url: "home/setUsuario",
			global: false,
			type: "POST",
			data: {
				'usuario': JSON.stringify(usuario)
			},
			dataType: "json",
			async: true,
			success: function(response){
				if (userData.idTipoUsuario != "E") {
					//alert("Se han guardado los datos");
					hidePopUp();
					//TODO this is so ugly we shouldnt reload all the page.
					window.location.reload();
				}
			},
			error: function(response){
				error_setUsr = true; 
				processError(response);
			}
		});
		if (userData.idTipoUsuario =="E" && error_setUsr == false) {
			//Valido el formato de la fecha para que no tire error el SP dd/mm/yyyy
			//if(validate($('#userDataEditorFechaInicio').val())){
				
				var empresa = {
					calle: $('#userDataEditorAddress').val(),
					numero: $('#userDataEditorAddressNumber').val(),
					piso:$('#userDataEditorAddressPiso').val(),
					departamento:$('#userDataEditorAddressDpto').val(),
					localidad:$('#userDataEditorLocalidad').val(),
					provincia:$('#userDataEditorProvincia').val(),
					cantempleados:$('#userDataEditorCantEmpleados').val(),
					fechainicio:$('#userDataEditorFechaInicio').val(),
					idTipoUsuario: userData.idTipoUsuario
				};
				$.ajax({
					url: "home/setUsuarioEmpresa",
					global: false,
					type: "POST",
					data: {
						'empresa': JSON.stringify(empresa)
					},
					dataType: "json",
					async: true,
					success: function(response){
						//alert("Se han guardado los datos");
						hidePopUp();
						//TODO this is so ugly we shouldnt reload all the page.
						window.location.reload();
					},
					error: function(response){
						processError(response);
					}
				});
			
			//} else {
			//	alert("Formato de fecha incorrecto. Debe ser dd/mm/yyyy");
			//	return false;
			//}
			
		}
	});

	return false;
});

function validate(date){

	splitDate = date.split("/");
	if (splitDate[2] && splitDate[2].length == 2){splitDate[2] = "20"+splitDate[2]}
	refDate = new Date(splitDate[1]+"/"+splitDate[0]+"/"+splitDate[2]);
	if (splitDate[1] < 1 || splitDate[1] > 12 || refDate.getDate() != splitDate[0] || splitDate[2].length != 4 || (!/^20/.test(splitDate[2])))
	{
			return false;
	} else {
			return true;
	}
}