<?php
class Model_Agentuploadlead extends ORM{
  protected $_table_name  = 'tbl_agent_upload'; 
  protected $_primary_key = 'id';
  protected $_sorting = array('id' => 'ASC');
  public $errors = '';
}
?>