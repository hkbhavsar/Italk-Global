<?php
class Model_Paydaylead extends ORM{
  protected $_table_name  = 'tbl_lead_new_payday'; 
  protected $_primary_key = 'newpayday_id';
  protected $_sorting = array('newpayday_id' => 'ASC');
  public $errors = '';
}
?>