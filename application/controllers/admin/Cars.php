<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cars extends AdminController {
	function __construct () {
		parent::__construct();
	}

	public function index () {
		$this->load->model('CarModel');
		$cars = $this->CarModel->getAll();

		$this->load->model('BrandModel');

		foreach ($cars as $car) {
			$car->brand = $this->BrandModel->getByPrimary($car->brand_id);
		}

		$this->data['cars'] = $cars;

		$this->load->view('admin/cars/index', $this->data);
	}

	public function create () {
		$this->load->model('BrandModel');
		$this->data['brands'] = $this->toOptions($this->BrandModel->getAll(), 'id', 'name');

		$this->load->view('admin/cars/form', $this->data);
	}

	public function update (int $carId) {
		$this->load->model('CarModel');
		$this->data['car'] = $this->CarModel->getByPrimary($carId);

		$this->load->model('BrandModel');
		$this->data['brands'] = $this->toOptions($this->BrandModel->getAll(), 'id', 'name');

		$this->load->view('admin/cars/form', $this->data);
	}

	public function delete (int $carId) {
		$this->load->model('CarModel');
		$success = $this->CarModel->delete($carId);

		if ($success === true) {
			$this->session->set_flashdata('success', 'Carro excluído com sucesso');
		} else {
			$this->session->set_flashdata('error', 'Erro ao excluir o carro');
		}

		redirect('admin/cars');
	}

	public function save () {
		$this->form_validation->set_rules('id', 'ID', 'trim|integer');
		$this->form_validation->set_rules('model', 'Modelo', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('color', 'Cor', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('brand_id', 'Marca', 'trim|required|integer');

		if ($this->form_validation->run() === false) {
			return $this->response(['success' => false, 'error' => strip_tags(validation_errors())]);
		}

		$this->load->model('CarModel');

		$carData = [
			'id' => $this->input->post('id'),
			'model' => $this->input->post('model'),
			'color' => $this->input->post('color'),
			'brand_id' => $this->input->post('brand_id')
		];

		if (empty($carData['id'])) {
			unset($carData['id']);
			$success = !!$this->CarModel->create($carData);

			if ($success) {
				$this->session->set_flashdata('success', 'Carro criado com sucesso');
			}

			return $this->response(['success' => $success]);
		}

		$success = $this->CarModel->update($carData);
		
		if ($success) {
			$this->session->set_flashdata('success', 'Carro editado com sucesso');
		}

		return $this->response(['success' => $success]);
	}
}
