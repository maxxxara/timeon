<?php
class Static_methods{
  public static function validate(){
      
     
    if(isset($_SESSION)) {
        session_start();
    }
      
      if(isset($_SESSION["id"]) && isset($_SESSION["username"]) &&  isset($_SESSION["status"])){
        if($_SESSION["status"] !== true){
          header("location: ./index.php");
          exit();
        }

      }
    //   else{
    //       header("location: ./index.php");
    //       exit();
    //   }
  }
  public static function upload_file($file,$upload_file_path,$max_file_size=5000000){
    try{
      $valid_file_types = ["image/jpeg","image/png","video/mp4"];
      $valid_file_ends = ["jpg", "jpeg", "jfif", "pjpeg", "pjp", "png", "mp4"];

      $file_ends_with = explode(".",$file["name"]);
      $file_tmp = $file["tmp_name"];
      $file_type = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $file_tmp);
      $file_new_name = bin2hex(random_bytes(20)).".".$file_ends_with[sizeof($file_ends_with)-1];
      $file_new_location = $upload_file_path.$file_new_name;

      if ($file['size'] > $max_file_size) {
          return ["status"=>false,"message"=>"File is more then 3mb"];
      }
      if(!in_array($file_type, $valid_file_types)){
        return ["status"=>false,"message"=>"Invalid file type"];
      }
      if(!in_array($file_ends_with[sizeof($file_ends_with)-1],$valid_file_ends)){
        return ["status"=>false,"message"=>"Invalid file ext"];
      }
      if (!move_uploaded_file($file_tmp,$file_new_location)){
            return ["status"=>false,"message"=>"Something went wrong during file moving"];
      }
      return ["status"=>true,"message"=>"File successfully uploaded","file_name"=>$file_new_name];
    }catch(Exception $e) {
        return ["status"=>false,"message"=>$e->getMessage()];
    }
  }
}

?>
