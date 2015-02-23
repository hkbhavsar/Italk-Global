<?php
class Model_Inventorybarcode extends ORM{
  protected $_table_name  = 'tbl_inventory_barcode'; 
  protected $_primary_key = 'inventory_barcode_id';      // default: id
  public $errors = '';
}