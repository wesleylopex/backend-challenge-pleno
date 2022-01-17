<?php
class CarModel extends MY_Model {
	protected $table = 'cars';
	protected $primary = 'id';
	protected $field_order = 'id';
	protected $type_order = 'desc';
}
