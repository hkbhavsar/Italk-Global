<?php
class Model_LeadSubmit extends ORM{
  protected $_table_name  = 'tbl_lead_submit'; 
  protected $_primary_key = 'lead_submit_id';
  protected $_sorting = array('lead_id' => 'ASC');
  public $errors = '';
}
?>