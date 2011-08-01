<?php
class Curriculum_model extends FR_Model {
	
	function Curriculum_model() 
	{
		parent::__construct();
	}

	/**
	 * @param idUsuario
	 * @return {'gtalk', 'usuario', 'estadoCivil', 'fechaNacimiento':"1998/05/31:12:00:00AM",
	 *      'idPais','idProvincia','partido','calle',
	 *      'numero','piso','departamento','codigoPostal',
	 *      'telefono1','horarioContactoDesde1','horarioContactoHasta1','telefono2',
	 *      'horarioContactoDesde2','horarioContactoHasta2','idPaisNacionalidad','twitter','gtalk','sms'
	 *      }
	 * **/
	public function  getCurriculum($idCurriculum){


		$unCurriculumn->id = 0;
		$unCurriculumn->usuario = "unmail@unserver.com";
		$unCurriculumn->estadoCivil = 0;
		//$unCurriculumn->cantidadHijos = 0;
		$unCurriculumn->fechaNacimiento = "15/05/1966";
		$unCurriculumn->idPais = "Argentina";
		$unCurriculumn->idProvincia = "CABA";
		$unCurriculumn->partido = "Ramos Mejia";
		$unCurriculumn->calle = "Calle Falsa";
		$unCurriculumn->numero = "2222";
		$unCurriculumn->piso = "3";
		$unCurriculumn->departamento = "A";
		$unCurriculumn->codigoPostal = "CWI1417C";
		$unCurriculumn->telefono1 = "4554-1235";
		$unCurriculumn->horarioContactoDesde1 = "9";
		$unCurriculumn->horarioContactoHasta1 = "18";
		$unCurriculumn->telefono2 = "4554-1235";
		$unCurriculumn->horarioContactoDesde2 = "";
		$unCurriculumn->horarioContactoHasta2 = "";
		$unCurriculumn->idPaisNacionalidad = 0;
		$unCurriculumn->twitter = "@twitteruser";
		$unCurriculumn->gtalk = "usuario@gmail.com";
		$unCurriculumn->sms = "15-3838-4994";
		
		return $unCurriculumn;		
		
		$curs=NULL;
		$n1 = NULL;
		$n2 = NULL;
		$params = array(
		array('name'=>':pi_id_curriculm', 'value'=>$idCurriculum, 'type'=>SQLT_CHR, 'length'=>-1),
		array('name'=>':po_cv', 'value'=>&$curs, 'type'=>SQLT_RSET , 'length'=>-1),
		array('name'=>':po_c_error', 'value'=>&$n1, 'type'=>SQLT_CHR , 'length'=>255),
		array('name'=>':po_d_error', 'value'=>&$n2, 'type'=>SQLT_CHR, 'length'=>255)
		);
		
		$this->oracledb->stored_procedure($this->db->conn_id,'PKG_CV','pr_consulta_cv',$params);
		echo $n1;
		
		if ($n1 == 0){
			$dbRegistros = $this->oracledb->get_cursor_data();
			$dbRegistros = $this->decodeCursorData($dbRegistros);
			
			//convert db data to model data.
//				$response[$i]->id  = $dbRegistro->ESTADO_CIVIL;
//				$response[$i]->descripcion  = $dbRegistro->D_ESTADO_CIVIL;
				$response->id = $idCurriculum;
				$response->usuario = $dbRegistros[0]->USUARIO;
				$response->estadoCivil = $dbRegistros[0]->ESTADO_CIVIL;
				//$response->cantidadHijos = 0;
				$response->fechaNacimiento = $dbRegistros[0]->FECHA_NACIMIENTO;
				$response->idPais = $dbRegistros[0]->PAIS;
				$response->idProvincia = $dbRegistros[0]->PROVINCIA;
				$response->partido = $dbRegistros[0]->PARTIDO;
				$response->calle = $dbRegistros[0]->CALLE;
				$response->numero = $dbRegistros[0]->NUMERO;
				$response->piso = $dbRegistros[0]->PISO;
				$response->departamento = $dbRegistros[0]->DEPARTAMENTO;
				$response->codigoPostal = $dbRegistros[0]->CODIGO_POSTAL;
				$response->telefono1 = $dbRegistros[0]->TELEFONO_CONTACTO1;
				$response->horarioContactoDesde1 = $dbRegistros[0]->HORARIO_CONTACTO_DESDE1;
				$response->horarioContactoHasta1 = $dbRegistros[0]->HORARIO_CONTACTO_HASTA1;
				$response->telefono2 = $dbRegistros[0]->TELEFONO_CONTACTO2;
				$response->horarioContactoDesde2 = $dbRegistros[0]->HORARIO_CONTACTO_DESDE2;
				$response->horarioContactoHasta2 = $dbRegistros[0]->HORARIO_CONTACTO_HASTA2;
				$response->nacionalidad = $dbRegistros[0]->NACIONALIDAD;
				$response->twitter = $dbRegistros[0]->TWITTER;
				$response->gtalk = $dbRegistros[0]->GTALK;
				$response->sms = $dbRegistros[0]->SMS;
//			}
			return $response;
		}
		else{
			
			//TODO exception managment.
        	throw new Exception('Oracle error message: ' . $n2);
		}		
		
	}

	/**
	 * @param unCurriculum: {'gtalk', 'usuario', 'estadoCivil', 'fechaNacimiento':"1998/05/31:12:00:00AM",
	 *      'idPais','idProvincia','partido','calle',
	 *      'numero','piso','departamento','codigoPostal',
	 *      'telefono1','horarioContactoDesde1','horarioContactoHasta1','telefono2',
	 *      'horarioContactoDesde2','horarioContactoHasta2','idPaisNacionalidad','twitter', 'gtalk','sms'
	 *      }
	 * @return 0 is Ok
	 * */
	public function  setCurriculum($unCurriculum){
		
		$curs=NULL;
		$n1 = NULL;
		$n2 = NULL;
		$params = array(
		array('name'=>':pi_id_curriculm', 'value'=>$unCurriculum->id, 'type'=>SQLT_CHR, 'length'=>-1),
		array('name'=>':pi_estado_civil', 'value'=>$unCurriculum->estadoCivil, 'type'=>SQLT_CHR, 'length'=>-1),
		array('name'=>':pi_cantidad_hijos', 'value'=>0, 'type'=>SQLT_CHR, 'length'=>-1),
		array('name'=>':pi_fecha_nacimiento', 'value'=>$unCurriculum->fechaNacimiento, 'type'=>SQLT_CHR, 'length'=>-1),
		array('name'=>':pi_pais', 'value'=>$unCurriculum->idPais, 'type'=>SQLT_CHR, 'length'=>-1),
		array('name'=>':pi_provincia', 'value'=>$unCurriculum->idProvincia, 'type'=>SQLT_CHR, 'length'=>-1),
		array('name'=>':pi_partido', 'value'=>$unCurriculum->partido, 'type'=>SQLT_CHR, 'length'=>-1),
		array('name'=>':pi_calle', 'value'=>$unCurriculum->calle, 'type'=>SQLT_CHR, 'length'=>-1),
		array('name'=>':pi_numero', 'value'=>$unCurriculum->numero, 'type'=>SQLT_CHR, 'length'=>-1),
		array('name'=>':pi_piso', 'value'=>$unCurriculum->piso, 'type'=>SQLT_CHR, 'length'=>-1),
		array('name'=>':pi_departamento', 'value'=>$unCurriculum->departamento, 'type'=>SQLT_CHR, 'length'=>-1),
		array('name'=>':pi_codigo_postal', 'value'=>$unCurriculum->codigoPostal, 'type'=>SQLT_CHR, 'length'=>-1),
		array('name'=>':pi_telefono_contacto1', 'value'=>$unCurriculum->telefono1, 'type'=>SQLT_CHR, 'length'=>-1),
		array('name'=>':pi_horario_contacto1_desde1', 'value'=>$unCurriculum->horarioContactoDesde1, 'type'=>SQLT_CHR, 'length'=>-1),
		array('name'=>':pi_horario_contacto1_hasta1', 'value'=>$unCurriculum->horarioContactoHasta1, 'type'=>SQLT_CHR, 'length'=>-1),
		array('name'=>':pi_telefono_contacto2', 'value'=>$unCurriculum->telefono2, 'type'=>SQLT_CHR, 'length'=>-1),
		array('name'=>':pi_horario_contacto2_desde', 'value'=>$unCurriculum->horarioContactoDesde2, 'type'=>SQLT_CHR, 'length'=>-1),
		array('name'=>':pi_horario_contacto2_hasta', 'value'=>$unCurriculum->horarioContactoHasta2, 'type'=>SQLT_CHR, 'length'=>-1),
		array('name'=>':pi_nacionalidad', 'value'=>$unCurriculum->idPaisNacionalidad, 'type'=>SQLT_CHR, 'length'=>-1),
		array('name'=>':pi_twitter', 'value'=>$unCurriculum->twitter, 'type'=>SQLT_CHR, 'length'=>-1),
		array('name'=>':pi_gtalk', 'value'=>$unCurriculum->gtalk, 'type'=>SQLT_CHR, 'length'=>-1),
		array('name'=>':pi_sms', 'value'=>$unCurriculum->sms, 'type'=>SQLT_CHR, 'length'=>-1),	
		array('name'=>':po_c_error', 'value'=>&$n1, 'type'=>SQLT_CHR , 'length'=>255),
		array('name'=>':po_d_error', 'value'=>&$n2, 'type'=>SQLT_CHR, 'length'=>255)
		);
		
		$this->oracledb->stored_procedure($this->db->conn_id,'PKG_CV','pr_actualiza_cv',$params);
		echo $n1;
		
		if ($n1 == 0){
			return 0;
		}
		else{
			
			//TODO exception managment.
        	throw new Exception('Oracle error message: ' . $n2);
		}		
		
	}
	
	/**
	 * Devuelve las habilidades del cv mostrando.
	 * */
	public function  getHabilidadesDelCV($idCurriculum){
		$respuesta[0]->tipo = 0; //Industria
		$respuesta[0]->id = 0;
		$respuesta[0]->puntaje = 5;
		
		$respuesta[1]->tipo = 1;
		$respuesta[1]->id = 0;
		$respuesta[1]->puntaje = 2;
				
		return $respuesta;
	}

	/**
	 * Ingresar la lista de habilidades.
	 * */
	public function  setHabilidadesDelCV($idCurriculum, $habilidades){
		$parametro = "";
		foreach ($habilidades as $habilidad){
			if($parametro != ""){
				//Its not the first need add ;
				$parametro = $parametro . ';'; 
			}
			$parametro = $parametro . $habilidad->tipoHabilidad . ';' . $habilidad->idHabilidad . ';' . $habilidad->puntajeHabilidad;
		}
		return 0;
	}	
	
	/**
	 * @param: idCurriculum
	 * @return: array with [{id, compania, idRubro, idPais, fechaDesde, fechaHasta}]
	 */
	public function  getExperienciaLaboralDelCv($idCurriculum){
		$respuesta[0]->id = 0;
		$respuesta[0]->compania = "netsol";
		$respuesta[0]->idRubro = 0;
		$respuesta[0]->idPais = 0;
		$respuesta[0]->fechaDesde = "01/01/1900";
		$respuesta[0]->fechaHasta = "01/01/1900";
		$respuesta[0]->logro = " un logro ";
		$respuesta[1]->id = 0;
		$respuesta[1]->compania = 0;
		$respuesta[1]->idRubro = 0;
		$respuesta[1]->idPais = 0;
		$respuesta[1]->fechaDesde = "01/01/1900";
		$respuesta[1]->fechaHasta = "01/01/1900";
		$respuesta[1]->logro = 0;
		return $respuesta;
		
		$curs=NULL;
		$n1 = NULL;
		$n2 = NULL;
		$params = array(
		array('name'=>':pi_id_curriculm', 'value'=>$idCurriculum, 'type'=>SQLT_CHR, 'length'=>-1),
		array('name'=>':po_exp_laboral', 'value'=>&$curs, 'type'=>SQLT_RSET , 'length'=>-1),
		array('name'=>':po_c_error', 'value'=>&$n1, 'type'=>SQLT_CHR , 'length'=>255),
		array('name'=>':po_d_error', 'value'=>&$n2, 'type'=>SQLT_CHR, 'length'=>255)
		);
		
		$this->oracledb->stored_procedure($this->db->conn_id,'PKG_CV','pr_consulta_exp_laboral',$params);
		echo $n1;
		
		if ($n1 == 0){
			$dbRegistros = $this->oracledb->get_cursor_data();
			$dbRegistros = $this->decodeCursorData($dbRegistros);
			
			//convert db data to model data.
			foreach ($dbRegistros as $i => $dbRegistro){
				var_dump($dbRegistros);
				exit;
//				$response[$i]->id  = $dbRegistro->ESTADO_CIVIL;
//				$response[$i]->descripcion  = $dbRegistro->D_ESTADO_CIVIL;
			}
			return $response;
		}
		else{
			
			//TODO exception managment.
        	throw new Exception('Oracle error message: ' . $n2);
		}				
		
	}

	public function  setExperienciaLaboral($idCurriculum, $experienciaLaboral){
	
	}
	
	public function  getEducacionFormalDelCv($idCurriculum){
		$respuesta[0]->id = 0;
		$respuesta[0]->idEntidad = 0;
		$respuesta[0]->descripcionEntidad = "en caso de otros";
		$respuesta[0]->titulo = "titulo";
		$respuesta[0]->idNivelEducacion = 0;
		$respuesta[0]->idArea = 0;
		$respuesta[0]->estado = "T";
		$respuesta[0]->fechaInicio = "01/01/1900";
		$respuesta[0]->fechaFinalizacion = "01/01/1900";
		$respuesta[0]->promedio = 6.89;
		
		$respuesta[1]->id = 0;
		$respuesta[1]->idEntidad = 0;
		$respuesta[1]->descripcionEntidad = "en caso de otros";
		$respuesta[1]->titulo = "titulo";
		$respuesta[1]->idNivelEducacion = 0;
		$respuesta[1]->idArea = 0;
		$respuesta[1]->estado = "T";
		$respuesta[1]->fechaInicio = "01/01/1900";
		$respuesta[1]->fechaFinalizacion = "01/01/1900";
		$respuesta[1]->promedio = 6.89;
	}
	
	public function  editarEducacionFormal($idCurriculum, $educacionFormal){
	
	}
	
	
	public function  getEducacionNoFormalDelCv(){
		$respuesta[0]->id = 0;
		$respuesta[0]->idEntidad = 0;
		$respuesta[0]->descripcionEntidad = "en caso de otros";
		$respuesta[0]->titulo = "titulo";
		$respuesta[0]->idNivelEducacion = 0;
		$respuesta[0]->idArea = 0;
		$respuesta[0]->estado = "T";
		$respuesta[0]->fechaInicio = "01/01/1900";
		$respuesta[0]->fechaFinalizacion = "01/01/1900";
		$respuesta[0]->promedio = 6.89;
		
		$respuesta[1]->id = 0;
		$respuesta[1]->idEntidad = 0;
		$respuesta[1]->descripcionEntidad = "en caso de otros";
		$respuesta[1]->titulo = "titulo";
		$respuesta[1]->idNivelEducacion = 0;
		$respuesta[1]->idArea = 0;
		$respuesta[1]->estado = "T";
		$respuesta[1]->fechaInicio = "01/01/1900";
		$respuesta[1]->fechaFinalizacion = "01/01/1900";
		$respuesta[1]->promedio = 6.89;
	}
	
	public function  editarEducacionNoFormal(){
	
	}
	
	
}

?>