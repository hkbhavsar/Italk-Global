<?php
class Model_Diabiticauto extends ORM{
  protected $_table_name  = 'tbl_lead_diabitic'; 
  protected $_primary_key = 'diabitic_id';
  protected $_sorting = array('diabitic_id' => 'ASC');
  public $errors = '';
}
?>