<?php
class Model_Address extends ORM{

  protected $_table_name  = 'tbl_address'; // default: accounts
  protected $_primary_key = 'address_id';      // default: id
  public $errors = '';
}