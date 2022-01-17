<?php
class AdminController extends CI_Controller {
  public $data = [];
  
  public function __construct () {
    parent::__construct();
    $this->load->library('parser');

    $this->checkLogin();
  }

  private function checkLogin () {
    $admin = $this->session->userdata('admin');

    if (!$admin) {
      redirect('admin/login');
    }
  }

  protected function response (array $response) {
    echo json_encode($response);
    return array_key_exists('success', $response) ? $response['success'] : false;
  }

  protected function toOptions (array $records, string $value, string $label, bool $required = true) {
		$options = $required === true ? [] : ['' => 'Todos'];
		foreach ($records as $record) {
			$options[$record->$value] = $record->$label;
		}
		return $options;
	}
}