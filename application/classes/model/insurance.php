<?php
class Model_Insurance extends ORM{

  protected $_table_name  = 'tbl_lead_insurance'; // default: tbl_model
  protected $_primary_key = 'lead_insurance_id';      // default: model_id
  public $errors = '';
 }