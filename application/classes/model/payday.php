<?php
class Model_Payday extends ORM{
  protected $_table_name  = 'tbl_lead_payday'; 
  protected $_primary_key = 'payday_id';
  protected $_sorting = array('payday_id' => 'ASC');
  public $errors = '';
}
?>