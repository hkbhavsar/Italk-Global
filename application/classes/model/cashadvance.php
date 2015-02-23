<?php
class Model_Cashadvance extends ORM{
  protected $_table_name  = 'cash_advance'; 
  protected $_primary_key = 'id';
  protected $_sorting = array('id' => 'ASC');
  public $errors = '';
}
?>