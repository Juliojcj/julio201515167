<?php
class db{
      private $objConexion;
      function __construct($strHost,$strUser,$strPass,$strDb) {
        $this->objConexion=new mysqli($strHost, $strUser, $strPass, $strDb);
      }
      public function query($strQuery){
        return  $this->objConexion->query($strQuery);    
      }
	  public function num_rows($result){
		  return mysqli_num_rows($result);
	  }
	  public function assoc($result){
		  return mysqli_fetch_assoc($result);
	  }
	  public function free_result($result){
		  mysqli_free_result($result);
	  }
}


?>