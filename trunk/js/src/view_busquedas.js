/**
 * TABS CODE:
 */

//this is the selected search.
var selectedSearch = null;


$(document).ready(function() {

	// Cuando el sitio carga...

	$(".tab_content").hide(); // Esconde todo el contenido

	$("ul.tabs li:first").addClass("active").show(); // Activa la
														// primera tab

	$(".tab_content:first").show(); // Muestra el contenido de la
									// primera tab

	// On Click Event

	$("ul.tabs li").click(function() {

				$("ul.tabs li").removeClass("active"); // Elimina las
														// clases
														// activas

				$(this).addClass("active"); // Agrega la clase activa a
											// la tab seleccionada

				$(".tab_content").hide(); // Esconde todo el contenido
											// de la tab

				var activeTab = $(this).find("a").attr("href"); // Encuentra
																// el
																// valor
																// del
																// atributo
																// href
																// para
																// identificar
																// la
																// tab
																// activa
																// + el
																// contenido

				$(activeTab).fadeIn(); // Agrega efecto de transici�n
										// (fade) en el contenido activo

				return false;

			});

});


$(function() {

	$('#formalEducationEditorInstitution').change(function(){
		checkInstitutionDescriptionDisabled();
	});
		
	return false;
});

		
//$idBusqueda,$idUsuario,$descripcionBusqueda,$fechaHasta,$cantidadRecursos
function newSearch(){
	$('#searchDataEditorId').val("");
	$('#searchDataEditorTitle').val("");
	$('#searchDataEditorDescription').val("");
	$('#searchDataEditorResourcesQuantity').val("");

	$('#searchDataEditorDateToContainer').css("visibility", "hidden");
	$('#searchDataEditorStatusContainer').css("visibility", "hidden");
	
	showPopUp('#searchDataPopUp');
}

function editSearchData(idSearch){
	$('#searchDataEditorId').val(userSearchs[idSearch].id_busqueda);
	$('#searchDataEditorTitle').val(userSearchs[idSearch].d_titulo);
	$('#searchDataEditorDescription').val(userSearchs[idSearch].d_busqueda);
	$('#searchDataEditorResourcesQuantity').val(userSearchs[idSearch].cantidad_recursos);
	$('#searchDataEditorDateToContainer').css("visibility", "visible");
	$('#searchDataEditorDateTo').html(userSearchs[idSearch].f_hasta);
	$('#searchDataEditorStatusContainer').css("visibility", "visible");
	$('#searchDataEditorStatus').html(userSearchs[idSearch].d_estado);
	
	showPopUp('#searchDataPopUp');

}

function setSearchData(){
	var busqueda = {
		id_busqueda: $('#searchDataEditorId').val(), // null = nuevo
		d_titulo: $('#searchDataEditorTitle').val(),
		d_busqueda: $('#searchDataEditorDescription').val(),
		f_hasta: $('#searchDataEditorDateTo').val(), 
		cantidad_recursos: $('#searchDataEditorResourcesQuantity').val()//,
		//estado: $('#searchDataEditorStatus').val() 
	};
	
	$.ajax({
		url: "busquedas/setBusqueda",
		global: false,
		type: "POST",
		data: {
			'busqueda': JSON.stringify(busqueda)
		},
		dataType: "json",
		async: true,
		success: function(response){
			hidePopUp();
			window.location.reload();
		},
		error: function(response){
			processError(response);
		}
	});
}


function editHardSkills(){
	showPopUp('#hardSkillsPopUp');
}

function setHardSkills(){
	var habilidadesIndustrias = new Array();
	var startIndex = (new String("editItemIndustry")).length;
	$('.industryItem').each(function(i,element){
		var itemId = $(element).attr("id");
		var id = itemId.substring(startIndex);
		var points = $('#' + itemId + ' .current-rating').attr("value");
		habilidadesIndustrias.push({
			id_industria: id,
			valoracion: points,
			importancia: $('#' + itemId + ' .importanceInput').val()
		});
	});

	var habilidadesAreas = new Array();
	startIndex = (new String("editItemTool")).length;
	$('.toolItem').each(function(i,element){
		var itemId = $(element).attr("id");
		var id = itemId.substring(startIndex);
		var points = $('#' + itemId + ' .current-rating').attr("value");
		habilidadesAreas.push({
			id_herramienta: id,
			valor_herramienta: points,
			importancia: $('#' + itemId + ' .importanceInput').val()
		});
	});
	
	$.ajax({
		url: "busquedas/setHabilidadesDuras",
		global: false,
		type: "POST",
		data: {
			'lista_herramienta': JSON.stringify(habilidadesAreas),
			'lista_industria': JSON.stringify(habilidadesIndustrias)
		},
		dataType: "json",
		async: true,
		success: function(response){
			alert("Se han guardado los datos");
			hidePopUp();
			//TODO this is so ugly we shouldnt reload all the page.
			window.location.reload();
		},
		error: function(response){
			processError(response);
		}
	});
	
	
}


function editSoftSkills(){
	showPopUp('#softSkillsPopUp');
}

function setSoftSkills(){
	var habilidades = new Array();
	var startIndex = (new String("editSoftSkillItem")).length;
	$('#softSkillsPopUp .softSkillItem').each(function(i,element){
		var itemId = $(element).attr("id");
		var id = itemId.substring(startIndex);
		habilidades.push(id);
	});
	
	$.ajax({
		url: "busquedas/setHabilidadesBlandas",
		global: false,
		type: "POST",
		data: {
			'hab_blandas': JSON.stringify(habilidades)
		},
		dataType: "json",
		async: true,
		success: function(response){
			alert("Se han guardado los datos");
			hidePopUp();
			//TODO this is so ugly we shouldnt reload all the page.
			window.location.reload();
		},
		error: function(response){
			processError(response);
		}
	});
		
}


var activatedSearch = null;

function retriveSearchData(data){
	activatedSearch = data;
}


function removeSoftSkill(idSoftSkill){
	$('#editSoftSkillItem' + idSoftSkill).remove();
}


function addSoftSkill(){
	var selectedSoftSkillIndex = $('#availableSoftSkillsSelect').val();
	var selectedIdSoftSkill = availableSoftSkills[selectedSoftSkillIndex].id_habilidad_blanda;
	var selectedDescriptionSoftSkill = availableSoftSkills[selectedSoftSkillIndex].d_habilidad_blanda;
	
	if($('#editSoftSkillItem' + selectedIdSoftSkill).length == 0){
		var softSkillLi = "<li id=\"editSoftSkillItem" + selectedIdSoftSkill  + "\" class=\"softSkillItem\">"+
					"<img src='/images/src/bullet_flecha.png' /> "+ selectedDescriptionSoftSkill + 
					"<a href=\"javascript:removeSoftSkill(" + selectedIdSoftSkill + ");\">&nbsp;<img src='/images/src/delete.png'/></a>" + 
				"</div><br /><br /></li>"

		$('#editItemSoftSkillList').append(softSkillLi);
		
	}else {
		//it is already selected.
		alert("Ya tiene esa caracter�stica seleccionada");
	}
	
}

function addFormalEduction(){
	
	$('#formalEducationEditorInstitution').val();
	$('#formalEducationEditorInstitutionDescription').val();
	checkInstitutionDescriptionDisabled();

	$('#formalEducationEditorInstitutionMode').val();
	
	$('#formalEducationEditorTitle').val();
	$('#formalEducationEditorTitleMode').val();
	
	$('#formalEducationEditorLevel').val();
	$('#formalEducationEditorLevelMode').val();

	$('#formalEducationEditorArea').val();
	$('#formalEducationEditorAreaMode').val();
	

	$('#formalEducationEditorStatus').val();
	$('#formalEducationEditorStatusMode').val();
	
	$('#formalEducationEditorStatusMode').val();
	$('#formalEducationEditorAverageFrom').val();
	$('#formalEducationEditorAverageTo').val();
	$('#formalEducationEditorAverageMode').val();

	showPopUp('#formalEducationPopUp');

}

function editFormalEducation(index){
	
	var formalEducation = selectedSearch['edu_formal'][index];
	
	$('#formalEducationId').val(formalEducation.id_bus_edu_formal);

	$('#formalEducationEditorInstitution').val(formalEducation.id_entidad_educativa);
	$('#formalEducationEditorInstitutionDescription').val(formalEducation.d_entidad);
	checkInstitutionDescriptionDisabled();
	
	$('#formalEducationEditorInstitutionMode').val(formalEducation.c_modo_entidad);
	
	$('#formalEducationEditorTitle').val(formalEducation.titulo);
	$('#formalEducationEditorTitleMode').val(formalEducation.c_modo_titulo);
	
	$('#formalEducationEditorLevel').val(formalEducation.id_nivel_educacion);
	$('#formalEducationEditorLevelMode').val(formalEducation.c_modo_nivel_educacion);

	$('#formalEducationEditorArea').val(formalEducation.id_area);
	$('#formalEducationEditorAreaMode').val(formalEducation.c_modo_area);
	

	$('#formalEducationEditorStatus').val(formalEducation.estado);
	$('#formalEducationEditorStatusMode').val(formalEducation.c_modo_estado);
	
	$('#formalEducationEditorStatusMode').val(formalEducation.c_modo_estado);
	$('#formalEducationEditorAverageFrom').val(formalEducation.promedio_desde);
	$('#formalEducationEditorAverageTo').val(formalEducation.promedio_hasta);
	$('#formalEducationEditorAverageMode').val(formalEducation.c_modo_promedio);
	
	showPopUp('#formalEducationPopUp');
}

function eraseFormalEducation(index){
	var formalEducation = selectedSearch['edu_formal'][index];

	r = confirm("Esta seguro que desea eliminar la educacion formal");
	if (r==true)
	  {

		var edu_formal = {
			id_bus_edu_formal: formalEducation.id_bus_edu_formal,
			id_entidad_educativa: '',
			d_entidad: '',
			c_modo_entidad: '',
			titulo: '',
			c_modo_titulo: '',
			id_nivel_educacion: '',
			c_modo_nivel_educacion: '',
			id_area: '',
			c_modo_area: '',
			estado: '',
			c_modo_estado: '',
			c_modo_estado: '',
			promedio_desde: '',
			promedio_hasta: '',
			c_modo_promedio: '',
			c_baja: "S"
		}
		
		$.ajax({
			url: "busquedas/setEducacionFormal",
			global: false,
			type: "POST",
			data: {
				'edu_formal': JSON.stringify(edu_formal)
			},
			dataType: "json",
			async: true,
			success: function(response){
				alert("Se han guardado los datos");
				hidePopUp();
				//TODO this is so ugly we shouldnt reload all the page.
				window.location.reload();
			},
			error: function(response){
				processError(response);
			}
		});

  }
}

function checkInstitutionDescriptionDisabled(){
	$('#formalEducationEditorInstitutionDescription').attr("disabled", 
			($('#formalEducationEditorInstitution').val() != ""));
}

function setFormalEducation(){
	
	var edu_formal = {
		id_bus_edu_formal: $('#formalEducationId').val(),
		id_entidad_educativa: $('#formalEducationEditorInstitution').val(),
		d_entidad: $('#formalEducationEditorInstitutionDescription').val(),
		c_modo_entidad: $('#formalEducationEditorInstitutionMode').val(),
		
		titulo: $('#formalEducationEditorTitle').val(),
		c_modo_titulo: $('#formalEducationEditorTitleMode').val(),
		
		id_nivel_educacion: $('#formalEducationEditorLevel').val(),
		c_modo_nivel_educacion: $('#formalEducationEditorLevelMode').val(),
	
		id_area: $('#formalEducationEditorArea').val(),
		c_modo_area: $('#formalEducationEditorAreaMode').val(),
		
	
		estado: $('#formalEducationEditorStatus').val(),
		c_modo_estado: $('#formalEducationEditorStatusMode').val(),
		
		c_modo_estado: $('#formalEducationEditorStatusMode').val(),
		promedio_desde: $('#formalEducationEditorAverageFrom').val(),
		promedio_hasta: $('#formalEducationEditorAverageTo').val(),
		c_modo_promedio: $('#formalEducationEditorAverageMode').val(),
		c_baja: ""
	}
	
	$.ajax({
		url: "busquedas/setEducacionFormal",
		global: false,
		type: "POST",
		data: {
			'edu_formal': JSON.stringify(edu_formal)
		},
		dataType: "json",
		async: true,
		success: function(response){
			alert("Se han guardado los datos");
			hidePopUp();
			//TODO this is so ugly we shouldnt reload all the page.
			window.location.reload();
		},
		error: function(response){
			processError(response);
		}
	});	
}


function editAditionalData(){
	showPopUp('#aditionalDataPopUp');
}



function setAditionalData(){
		var recurso = {
			edad_desde: $('#aditionalDataEditorAgeFrom').val(),
			edad_hasta: $('#aditionalDataEditorAgeTo').val(),
			edad_c_modo: $('#aditionalDataEditorAgeMode').val(),
			nacionalidad: "",
			provincia: "",
			localidad: "",
			twitter_c_modo: $('#aditionalDataEditorTwitterMode').val(),
			gtalk_c_modo: $('#aditionalDataEditorGtalkMode').val(),
			sms_c_modo: $('#aditionalDataEditorSmsMode').val() 
		}
		
		$.ajax({
			url: "busquedas/setRecurso",
			global: false,
			type: "POST",
			data: {
				'recurso': JSON.stringify(recurso)
			},
			dataType: "json",
			async: true,
			success: function(response){
				alert("Se han guardado los datos");
				hidePopUp();
				//TODO this is so ugly we shouldnt reload all the page.
				window.location.reload();
			},
			error: function(response){
				processError(response);
			}
		});	
}


function setEstadoCVBusqueda(formID){
	var cv_bus = {
	cv_busqueda : $("form#"+formID+" input[name=cv_busqueda]").val(),
	estado_cv_busqueda : $("form#"+formID+" select[name=estado_cv_busqueda]").val(),
	observacion_cv_busqueda : ''
	}
	$.ajax({
		url: "busquedas/setEstadoCVBusqueda",
		global: false,
		type: "POST",
		data: {
			'cv_bus': JSON.stringify(cv_bus)
		},
		dataType: "json",
		async: true,
		success: function(response){
			alert("Se han actualizado los datos");
			hidePopUp();
		},
		error: function(response){
			processError(response);
		}
	});	
}