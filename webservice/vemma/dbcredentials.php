<?php
class dbcredentails {
  var $host="localhost";
  var $user="joelf_vemma";
  var $password="vemma01";
  var $dbname="joelf_vemma";
  //live detail
  /*var $host="localhost";
  var $user="icmd_sagarshah";
  var $password="m8jd227U43502o4W";
  var $dbname="hypervwe_VVSEKSPERTEN";*/

  function getVar($name){
     return $this->{$name};
  }
}