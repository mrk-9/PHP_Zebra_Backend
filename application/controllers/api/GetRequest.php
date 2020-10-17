<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
# API REQUEST NOT
# CALL FUNCTION $this->request->getUrlRequest();
 // $this->request->getUrlRequest(array value passing,'function name','passing header key value like 1,2,3,4','passing array key value array like this 'array('packageName'=>'123456'));
class GetRequest extends CI_Controller{
    
     # SET Connection
    public function Connect(){
      $checkRequestKeys = array('hostname','password','databaseName','username');
      $this->request->getUrlRequest($checkRequestKeys,'Connect');
    }
    
    # GET Data from Table
    public function SearchData(){
      $checkRequestKeys = array('hostname','password','databaseName','username','rackId','job','paintNumber');
      $this->request->getUrlRequest($checkRequestKeys,'SearchData');
    }
}