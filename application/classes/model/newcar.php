<?php
class Model_Newcar extends ORM{

  protected $_table_name  = 'tbl_lead_newcar'; // default: tbl_model
  protected $_primary_key = 'lead_new_id';      // default: model_id
  public $errors = '';
 }