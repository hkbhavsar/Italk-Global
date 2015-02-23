<?php
class Model_Model extends ORM{

  protected $_table_name  = 'tbl_model'; // default: tbl_model
  protected $_primary_key = 'model_id';      // default: model_id
  public $errors = '';
 }