<?php
class Model_Client extends ORM{
  protected $_table_name  = 'tbl_client'; 
  protected $_primary_key = 'iClient_id';
  protected $_sorting = array('vUsername' => 'ASC');
  public $errors = '';
}
?>