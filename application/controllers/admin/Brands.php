<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Brands extends AdminController {
	function __construct () {
		parent::__construct();
	}

	public function index () {
		$this->load->model('BrandModel');
		$this->data['brands'] = $this->BrandModel->getAll();

		$this->load->view('admin/brands/index', $this->data);
	}

	public function create () {
		$this->load->view('admin/brands/form', $this->data);	
	}

	public function update (int $brandId) {
		$this->load->model('BrandModel');
		$this->data['brand'] = $this->BrandModel->getByPrimary($brandId);

		$this->load->view('admin/brands/form', $this->data);
	}

	public function delete (int $brandId) {
		$this->load->model('BrandModel');
		$success = $this->BrandModel->delete($brandId);

		if ($success === true) {
			$this->session->set_flashdata('success', 'Marca excluída com sucesso');
		} else {
			$this->session->set_flashdata('error', 'Erro ao excluir a marca');
		}

		redirect('admin/brands');
	}

	public function save () {
		$this->form_validation->set_rules('id', 'ID', 'trim|integer');
		$this->form_validation->set_rules('name', 'Nome', 'trim|required|max_length[255]');

		if ($this->form_validation->run() === false) {
			return $this->response(['success' => false, 'error' => strip_tags(validation_errors())]);
		}

		$this->load->model('BrandModel');

		$brandData = [
			'id' => $this->input->post('id'),
			'name' => $this->input->post('name')
		];

		if (empty($brandData['id'])) {
			unset($brandData['id']);
			$success = !!$this->BrandModel->create($brandData);

			if ($success) {
				$this->session->set_flashdata('success', 'Marca criada com sucesso');
			}

			return $this->response(['success' => $success]);
		}

		$success = $this->BrandModel->update($brandData);
		
		if ($success) {
			$this->session->set_flashdata('success', 'Marca editada com sucesso');
		}

		return $this->response(['success' => $success]);
	}
}
