<?php 

class Test extends CI_Controller {
	
 	function __construct() {
        parent::__construct();
    }

	function index(){
		/** REALIZAR VALIDACION DE LOS TESTS A REALIZAR POR EL USUARIO**/
		/** E IR LLAMANDO A LOS TESTS QUE CORRESPONDAN**/
	}
	
	function luscher(){
		$data['c1'] = '';
		$data['c2'] = '';
		$data['timer1'] = '';
		$data['timer2'] = '';
		if($this->input->post('init') == '') {
			$data['source'] = "init_test";
			$this->load->view('view_test_luscher',$data);
		 } else {
		 	if ($this->input->post('colors1') == '') {
			 	$data['source'] = "select_colors1";
			 	$this->load->view('view_test_luscher',$data);
		 	} else {
		 		if ($this->input->post('colors2') == '') {
		 			$data['c1'] = $this->input->post('colors1');
		 			$data['timer1'] = $this->input->post('timer');
			 		$data['source'] = "select_colors2";
			 		$this->load->view('view_test_luscher',$data);
		 		} else {
		 			$data['c1'] = $this->input->post('colors1');
		 			$data['c2'] = $this->input->post('colors2');
		 			$data['timer1'] = $this->input->post('timer1');
		 			$data['timer2'] = $this->input->post('timer');
		 			$data['source'] = "test_finished";
		 			$this->load->view('view_test_luscher',$data);
		 		}
		 	}
		 }
	}

	
	
}
?>