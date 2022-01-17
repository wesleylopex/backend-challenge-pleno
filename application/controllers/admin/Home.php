<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends AdminController {
  function __construct () {
    parent::__construct();
  }

  public function index () {
    redirect('admin/cars');
  }
}