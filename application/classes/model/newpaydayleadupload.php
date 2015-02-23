<?php
class Model_Newpaydayleadupload extends ORM{
  protected $_table_name  = 'tbl_newpayday_for_agent'; 
  protected $_primary_key = 'newpayday_id';
  protected $_sorting = array('newpayday_id' => 'ASC');
  public $errors = '';
}
?>