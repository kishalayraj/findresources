<?php 
class Login extends CI_Controller {
	
	public function Login(){
		parent::__construct();
		$this->view_data['base_url'] = base_url();
		
	}
	
	public function index(){
		
		$data['industriasDisponibles'] = $this->Util_model->getIndustriasDisponibles();
		$data['tiposDeDocumentos'] =  $this->Util_model->getTiposDeDocumentos();

		$idUsuario = $this->session->userdata('ID_USUARIO');
		
		if($idUsuario){
			//user is already logged in.
			//$this->load->view('view_home', $data);
			redirect('home');
			
		}else{
			//user is already logged in.
			$this->load->view('view_login', $data);
		}
		
		
	}
	
	
	/**
	 * Crea nuevo usuario.
	 * input: json 'usuario' {email, clave, nombre, apellido, razonSocial, idIndustria, idTipoDocumento, 
	 * 			numeroDocumento, telefono, idPais, tipoUsuario: "E">empresa "C">candidato}
	 * output: 
	 */
	public function  crearNuevoUsuario(){
		$usuario = $this->input->post('usuario');
		$usuario = json_decode($usuario);
		$usuario->clave = md5($usuario->clave);
		$respuesta = $this->Usuario_model->crearNuevoUsuario($usuario);
		
		//email confirmation
		$this->email->from('registracion@findresources.com.ar', 'Findresources');
		$this->email->to($usuario->email);
		$this->email->subject('FindResources - Confirmacion de Registraci�n');
		$this->email->message('Porfavor clickee este link para confirmar su registraci�n. ' . anchor('http://localhost/FindResources/autenticacion?autCode=' . $respuesta, 'Confirme registracion'));
//		$this->email->send();
		
		//ENVIAR EMAIL.
		
		//http://localhost/FindResources/autenticacion?autCode={$respuesta}
		echo json_encode($respuesta);
	}

	/**
	 * Realiza el login.
	 * input: json 'usuario' {email, clave}
	 * output: true si esta logged in, false si user/password son invalidas
	 * TODO Esta llamada debe ser segura, investigar este tema.
	 */
	public function  doLogin(){
		$usuario = $this->input->post('usuario');
		$usuario = json_decode($usuario);
		$clave = md5($usuario->clave);
		$isLoggued = $this->Usuario_model->canLogin($usuario->email, $clave);
		if($isLoggued){
			$this->session->sess_destroy();
			$this->session->set_userdata('ID_USUARIO', $usuario->email);
			echo "true";
		}else{
			echo "false";
		}
	}
	
	/**
	 * Realiza el login.
	 * input: json 'usuario' con el email que ingres�.
	 * output: true si existe el usuario, false si el nombre de usuario esta disponible.
	 */
	public function getExisteUsuario(){
		$usuario = $this->input->post('usuario');
		$existe = $this->Usuario_model->getExisteUsuario($usuario);
		if($existe){
			echo "true";
		} else{
			echo "false";
		}
	}
	
	
}

?>

