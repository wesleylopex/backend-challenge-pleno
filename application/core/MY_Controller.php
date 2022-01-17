<?php

include_once 'application/core/AdminController.php';

class SiteController extends CI_Controller {
  public function __construct () {
    parent::__construct();

    $this->load->vars($this->data);
  }
}
