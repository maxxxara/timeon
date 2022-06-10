<?php
class Static_methods{
  public static function validate_image($file,$upload_file_path){
    try{
      $valid_file_types = ["image/jpeg","image/png"];
      $valid_file_ends = ["jpg", "jpeg", "jfif", "pjpeg", "pjp", "png"];

      $avatar_image_ends_with = explode(".",$file["name"]);
      $file_tmp = $file["tmp_name"];
      $avatar_file_type = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $file_tmp);
      $file_new_name = bin2hex(random_bytes(20)).".".$avatar_image_ends_with[sizeof($avatar_image_ends_with)-1];
      $file_new_location = $upload_file_path.$file_new_name;

      if ($file['size'] > 3000000) {
          return ["status"=>false,"message"=>"File is more then 3mb"];
      }
      if(!in_array($avatar_file_type, $valid_file_types)){
        return ["status"=>false,"message"=>"Invalid file type"];
      }
      if(!in_array($avatar_image_ends_with[sizeof($avatar_image_ends_with)-1],$valid_file_ends)){
        return ["status"=>false,"message"=>"Invalid file ext"];
      }
      if (!move_uploaded_file($file_tmp,$file_new_location)){
            return ["status"=>false,"message"=>"Something went wrong during file moving"];
      }
      return ["status"=>true,"message"=>"image successfully uploaded","file_name"=>$file_new_name];
    }catch(Exception $e) {
        return ["status"=>false,"message"=>$e->getMessage()];
    }
  }
  public static function return_cur_date_in_geo(){
    $geo_arr = [
        "Jan"=>"იანვარი", "Feb"=>"თებერვალი", "Mar"=>"მარტი",
        "Apr"=>"აპრილი", "May"=>"მაისი", "Jun"=>"ივნისი",
        "Jul"=>"ივლისი", "Aug"=>"აგვისტო", "Sep"=>"სექტემბერი",
        "Oct"=>"ოქტომბერი", "Nov"=>"ნოემბერი", "Dec"=>"დეკემბერი"
            ];
    $date = new DateTime("now", new DateTimeZone('Asia/Tbilisi'));
    $data = $date->modify("+1 day");
    $data = $date->format("M d");
    $data = explode(" ",$date->format("M d"));
    return ["month"=>$geo_arr[$data[0]],"day"=>$data[1]];
  }
}

?>
