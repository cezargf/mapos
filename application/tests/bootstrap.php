<?php
// Mock CI_Model for tests if it doesn't exist
if (!class_exists('CI_Model')) {
    class CI_Model {
        public $db;
        public function __construct() {}
    }
}
require_once __DIR__ . '/../models/Clientes_model.php';
