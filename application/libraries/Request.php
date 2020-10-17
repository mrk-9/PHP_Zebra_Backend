<?php
defined('BASEPATH') OR exit('No direct script access allowed');
define('ROW',1);
define('MULTI',2);
class Request {
	public function __construct(){
        $this->_CI = & get_instance();
        $this->_CI->load->model('ApiModel');
    }
	 public function getUrlRequest($array=false,$functionName=false,$setHeader=false,$checkHeaderKey=false){
	 	# POST DATA
        if($_SERVER['REQUEST_METHOD']== POST){
             self::getUrlResponse($array,$functionName,$setHeader,$checkHeaderKey);
          } 
           # If user Get Request
          if($_SERVER['REQUEST_METHOD']==GET){ 
               // echo 'get';
          	 if(!empty($setHeader)):
	 	       self::SetHeader($setHeader,$checkHeaderKey);
	 	     endif;
	 	     self::setGetFunction($functionName);
          }
          # IF USER GET DATA  
	 }
	 public function getUrlResponse($array,$functionName,$setHeader,$checkHeaderKey){
	 	$requestData   = getRequestJson(); 
	 	$resultJson    =  validateJson($requestData,$array);
	 	   if(!empty($setHeader)):
	 	     self::SetHeader($setHeader,$checkHeaderKey);
	 	   endif;
	 	if($resultJson==OK):
	 		 self::setPostFunction($functionName,$requestData[APP_NAME]);
          else:
          generateServerResponse('0', '100');
        endif;
	 }
	 # Heder Validate
	 public function SetHeader($setHeader,$checkHeaderKey){
          $headers = apache_request_headers();
          $getHeaderKey = explode(",",$setHeader);
          if(!empty($getHeaderKey)):
          	    $status = false;
               // Check Header Key
          	   foreach($getHeaderKey as $getKey):
          	   	       $getKeyValue = self::checkHeaderArray($getKey);
          	   	       // If value in header set then
          	   	        if(@$headers[$getKeyValue] != @$checkHeaderKey[$getKeyValue]){
                            generateServerResponse('URL', '163');
          	   	        }else{
          	   	        	$status = true;
          	   	        }
          	   	       // Close here
          	   endforeach;
          	    if($status == true):
          	    	return true;
          	    endif;
          	   // Close 
          else:
             generateServerResponse('URL', '163');
          endif;
	 }
	 public function checkHeaderArray($res_msg){
	 	  $codes = Array(
                    '1' => 'tokenAccess',
                    '2' => 'packageName'
                );
        return (isset($codes[$res_msg])) ? $codes[$res_msg] : '';  
	 }
	 
	 
	 /* Set Here All Function*/
	 public function setPostFunction($functionName,$requestData=false){
	 	    if(!empty($functionName)){
                  $this->_CI->ApiModel->{'post'.$functionName}($requestData);
	 	    }else{
	 	       generateServerResponse('0', 'W');
	 	    }
       // switch ($resCode) {
       // 	case 'accessToken':
       // 		    $this->_CI->api_model->getAccessToken($requestData);
       // 		break;
       // 	# If not match function 
       // 	default:
       // 		generateServerResponse('0', '100');
       // 	break;
       // }
	 }
	 // GET FUNCTION DATA
	 public function setGetFunction($resCode){
	 	 if(!empty($resCode)){
                $this->_CI->ApiModel->{'get'.$resCode}();
	 	    }else{
	 	       generateServerResponse('0', 'W');
	 	  }
	 	// switch ($resCode) {
   //     	    case 'function Name':
   //     		    //$this->_CI->api_model->getAccessToken();
   //     		break;
   //     	# If not match function 
   //     	default:
   //     		generateServerResponse('0', '100');
   //     	break;
   //     }
	 }
    public function getRequest($res_msg,$rowType=false,$getArray=false,$columnName=false,$orderBy=false){
    	 $codes = Array(
                    '1' => 'adminmaster',
                    '2' => 'campaignmaster',
                    '3' => 'campaignamount',
                    '4' => 'charitymaster',
                    '5' => 'accesstokenmaster',
                    '6' => 'contactus',
                    '7' => 'country',
                    '8' => 'mobilenetwork',
                    '9' => 'usermaster',
                    '10'=>'loginmaster',
                    '11'=>'userdonationmaster'
                );
    	 if(!empty($rowType) && !empty($getArray)){
                # If row type equal two 1 that mean get single data other wise get multiple data
    	 	     if($rowType == 1){
                      if(!empty($orderBy)){
                         $this->_CI->db->order_by($orderBy);
                      }
                      if(!empty($columnName)){
                         $this->_CI->db->select($columnName);
                      }
                     return $this->_CI->db->get_where($codes[$res_msg],$getArray)->row_array();
    	 	     }else if($rowType == 2){
                      if(!empty($orderBy)){
                         $this->_CI->db->order_by($orderBy);
                      }
                     if(!empty($columnName)){
                         $this->_CI->db->select($columnName);
                      }
                     return $this->_CI->db->get_where($codes[$res_msg],$getArray)->result_array();
    	 	     }
    	 	    # Close here
    	 }else{
    	 	 return (isset($codes[$res_msg])) ? $codes[$res_msg] : '';  
    	 }
    }
    # Update Table Value
    public function updateData($tableName,$arrayValue,$condation){
       $this->_CI->db->where($condation);
       $this->_CI->db->update(self::getRequest($tableName),$arrayValue);
       return $this->_CI->db->affected_rows();
    }
    public function insertData($tableName,$arrayValue){
       $this->_CI->db->insert(self::getRequest($tableName),$arrayValue);
       return $this->_CI->db->insert_id();
    }
    public function getJoinData(){
    	 
    }
}
?>