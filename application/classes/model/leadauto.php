<?php
class Model_Leadauto extends ORM{
  protected $_table_name  = 'tbl_lead_auto'; 
  protected $_primary_key = 'lead_auto_id';
  protected $_sorting = array('lead_auto_id' => 'ASC');
  public $errors = '';
}
?>