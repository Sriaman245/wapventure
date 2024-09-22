<?php
require "serviceconfig.php";
require "fixxy.php";
require dirname(dirname(__FILE__)) . "/vendor/autoload.php";
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Grimzy\LaravelMysqlSpatial\Types\Polygon;
use Grimzy\LaravelMysqlSpatial\Types\LineString;
if (isset($_POST["type"])) {
    if ($_POST["type"] == "login") {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $stype = $_POST["stype"];
        if ($stype == "mowner") {
            $h = new Fixxy();

            $count = $h->servicelogin($username, $password, "admin");
            if ($count != 0) {
                $_SESSION["servicename"] = $username;
                $_SESSION["stype"] = $stype;
                $returnArr = [
                    "ResponseCode" => "200",
                    "Result" => "true",
                    "title" => "Login Successfully!",
                    "message" => "welcome admin!!",
                    "action" => "dashboard.php",
                ];
            } else {
                $returnArr = [
                    "ResponseCode" => "200",
                    "Result" => "false",
                    "title" => "Please Use Valid Data!!",
                    "message" => "Invalid Data!!",
                    "action" => "index.php",
                ];
            }
        } else {
            $h = new Fixxy();

            $count = $h->servicelogin($username, $password, "service_details");
            if ($count != 0) {
                $_SESSION["servicename"] = $username;
                $_SESSION["stype"] = $stype;
                $returnArr = [
                    "ResponseCode" => "200",
                    "Result" => "true",
                    "title" => "Login Successfully!",
                    "message" => "welcome Store Owner!!",
                    "action" => "dashboard.php",
                ];
            } else {
                $returnArr = [
                    "ResponseCode" => "200",
                    "Result" => "false",
                    "title" => "Please Use Valid Data!!",
                    "message" => "Invalid Data!!",
                    "action" => "index.php",
                ];
            }
        }
    }  elseif ($_POST["type"] == "add_timeslot") {
        $cat_id = $_POST["category"];

        $day_type = $_POST["dthing"];
        $total_days = $_POST["day"];
        $timeslot = implode(",", $_POST["timsloat"]);
        $vendor_id = $sdata["id"];
        $table = "tbl_timeslot";
        $check_exist = $service->query(
            "select * from tbl_timeslot where cat_id=" .
                $cat_id .
                " and vendor_id=" .
                $vendor_id .
                ""
        )->num_rows;
        if ($check_exist != 0) {
            $returnArr = [
                "ResponseCode" => "401",
                "Result" => "false",
                "title" => "Timeslot Already Added In Category!",
                "message" => "Timeslot section!",
                "action" => "list_Timeslot.php",
            ];
        } else {
            $field_values = [
                "cat_id",
                "vendor_id",
                "day_type",
                "total_days",
                "timeslot",
            ];
            $data_values = [
                "$cat_id",
                "$vendor_id",
                "$day_type",
                "$total_days",
                "$timeslot",
            ];

            $h = new Fixxy();
            $check = $h->serviceinsertdata($field_values, $data_values, $table);
            if ($check == 1) {
                $returnArr = [
                    "ResponseCode" => "200",
                    "Result" => "true",
                    "title" => "Timeslot Add Successfully!!",
                    "message" => "Timeslot section!",
                    "action" => "list_Timeslot.php",
                ];
            } 
        }
    } elseif ($_POST["type"] == "add_service") {
        $mtitle = $service->real_escape_string($_POST["mtitle"]);
        $sdisc = $_POST["sdisc"];
        $stime = $_POST["stime"];
        $mqty = $_POST["mqty"];
        $status = $_POST["status"];
        $thing = $_POST["thing"];
        $price = $_POST["price"];
        $cat = $_POST["cat"];
        $subcat = $_POST["subcat"];
        $mdesc = $service->real_escape_string($_POST["sdescription"]);
        $vendor_id = $sdata["id"];
        $target_dir = dirname(dirname(__FILE__)) . "/images/serviceimg/";
        $url = "images/serviceimg/";
        $temp = explode(".", $_FILES["cat_img"]["name"]);
        $newfilename = round(microtime(true)) . "." . end($temp);
        $target_file = $target_dir . basename($newfilename);
        $url = $url . basename($newfilename);

        $target_dirs = dirname(dirname(__FILE__)) . "/images/servicevideo/";
        $urls = "images/servicevideo/";
        $temps = explode(".", $_FILES["cat_video"]["name"]);
        $newfilenames = round(microtime(true)) . "." . end($temps);
        $target_files = $target_dirs . basename($newfilenames);
        $urls = $urls . basename($newfilenames);

       
            $check_service = $service->query(
                "select * from tbl_service where vendor_id=" .
                    $vendor_id .
                    " and cat_id=" .
                    $cat .
                    " and sub_id=" .
                    $subcat .
                    " and title='" .
                    $title .
                    "'"
            )->num_rows;
            if ($check_service != 0) {
                $returnArr = [
                    "ResponseCode" => "401",
                    "Result" => "false",
                    "title" => "Already Added Service !!",
                    "message" => "Exist Service Problem!!",
                    "action" => "add_Service.php",
                ];
            } else {
                move_uploaded_file(
                    $_FILES["cat_img"]["tmp_name"],
                    $target_file
                );
                move_uploaded_file(
                    $_FILES["cat_video"]["tmp_name"],
                    $target_files
                );

                $table = "tbl_service";
                $field_values = [
                    "cat_id",
                    "sub_id",
                    "img",
                    "vendor_id",
                    "video",
                    "service_type",
                    "title",
                    "take_time",
                    "max_quantity",
                    "price",
                    "discount",
                    "service_desc",
                    "status",
                ];
                $data_values = [
                    "$cat",
                    "$subcat",
                    "$url",
                    "$vendor_id",
                    "$urls",
                    "$thing",
                    "$mtitle",
                    "$stime",
                    "$mqty",
                    "$price",
                    "$sdisc",
                    "$mdesc",
                    "$status",
                ];
                $h = new Fixxy();
                $check = $h->serviceinsertdata(
                    $field_values,
                    $data_values,
                    $table
                );
                if ($check == 1) {
                    $returnArr = [
                        "ResponseCode" => "200",
                        "Result" => "true",
                        "title" => "Service Add Successfully!!",
                        "message" => "Service section!",
                        "action" => "list_Service.php",
                    ];
                } 
            }
        
    } elseif ($_POST["type"] == "edit_service") {
        $mtitle = $service->real_escape_string($_POST["mtitle"]);
        $sdisc = $_POST["sdisc"];
        $stime = $_POST["stime"];
        $mqty = $_POST["mqty"];
        $status = $_POST["status"];
        $thing = $_POST["thing"];
        $price = $_POST["price"];
        $cat = $_POST["cat"];
        $subcat = $_POST["subcat"];
        $mdesc = $service->real_escape_string($_POST["sdescription"]);
        $vendor_id = $sdata["id"];
        $id = $_POST["id"];

        if (
            $_FILES["cat_img"]["name"] != "" and
            $_FILES["cat_video"]["name"] == ""
        ) {
            $target_dir = dirname(dirname(__FILE__)) . "/images/serviceimg/";
            $url = "images/serviceimg/";
            $temp = explode(".", $_FILES["cat_img"]["name"]);
            $newfilename = round(microtime(true)) . "." . end($temp);
            $target_file = $target_dir . basename($newfilename);
            $url = $url . basename($newfilename);
           
                move_uploaded_file(
                    $_FILES["cat_img"]["tmp_name"],
                    $target_file
                );
                $table = "tbl_service";
                $field = [
                    "img" => $url,
                    "cat_id" => $cat,
                    "sub_id" => $subcat,
                    "service_type" => $thing,
                    "title" => $mtitle,
                    "take_time" => $stime,
                    "max_quantity" => $mqty,
                    "price" => $price,
                    "discount" => $sdisc,
                    "service_desc" => $mdesc,
                    "status" => $status,
                ];
                $where =
                    "where id=" . $id . " and vendor_id=" . $vendor_id . "";
                $h = new Fixxy();
                $check = $h->serviceupdateData($field, $table, $where);

                if ($check == 1) {
                    $returnArr = [
                        "ResponseCode" => "200",
                        "Result" => "true",
                        "title" => "Service Update Successfully!!",
                        "message" => "Service section!",
                        "action" => "list_Service.php",
                    ];
                }
            
        } elseif (
            $_FILES["cat_img"]["name"] == "" and
            $_FILES["cat_video"]["name"] != ""
        ) {
            $target_dirs = dirname(dirname(__FILE__)) . "/images/servicevideo/";
            $urls = "images/servicevideo/";
            $temps = explode(".", $_FILES["cat_video"]["name"]);
            $newfilenames = round(microtime(true)) . "." . end($temps);
            $target_files = $target_dirs . basename($newfilenames);
            $urls = $urls . basename($newfilenames);
           
                move_uploaded_file(
                    $_FILES["cat_video"]["tmp_name"],
                    $target_files
                );
                $table = "tbl_service";
                $field = [
                    "video" => $urls,
                    "cat_id" => $cat,
                    "sub_id" => $subcat,
                    "service_type" => $thing,
                    "title" => $mtitle,
                    "take_time" => $stime,
                    "max_quantity" => $mqty,
                    "price" => $price,
                    "discount" => $sdisc,
                    "service_desc" => $mdesc,
                    "status" => $status,
                ];
                $where =
                    "where id=" . $id . " and vendor_id=" . $vendor_id . "";
                $h = new Fixxy();
                $check = $h->serviceupdateData($field, $table, $where);

                if ($check == 1) {
                    $returnArr = [
                        "ResponseCode" => "200",
                        "Result" => "true",
                        "title" => "Service Update Successfully!!",
                        "message" => "Service section!",
                        "action" => "list_Service.php",
                    ];
                } 
            
        } elseif (
            $_FILES["cat_img"]["name"] != "" and
            $_FILES["cat_video"]["name"] != ""
        ) {
            $target_dir = dirname(dirname(__FILE__)) . "/images/serviceimg/";
            $url = "images/serviceimg/";
            $temp = explode(".", $_FILES["cat_img"]["name"]);
            $newfilename = round(microtime(true)) . "." . end($temp);
            $target_file = $target_dir . basename($newfilename);
            $url = $url . basename($newfilename);

            $target_dirs = dirname(dirname(__FILE__)) . "/images/servicevideo/";
            $urls = "images/servicevideo/";
            $temps = explode(".", $_FILES["cat_video"]["name"]);
            $newfilenames = round(microtime(true)) . "." . end($temps);
            $target_files = $target_dirs . basename($newfilenames);
            $urls = $urls . basename($newfilenames);
            
                move_uploaded_file(
                    $_FILES["cat_img"]["tmp_name"],
                    $target_file
                );
                move_uploaded_file(
                    $_FILES["cat_video"]["tmp_name"],
                    $target_files
                );
                $table = "tbl_service";
                $field = [
                    "img" => $url,
                    "video" => $urls,
                    "cat_id" => $cat,
                    "sub_id" => $subcat,
                    "service_type" => $thing,
                    "title" => $mtitle,
                    "take_time" => $stime,
                    "max_quantity" => $mqty,
                    "price" => $price,
                    "discount" => $sdisc,
                    "service_desc" => $mdesc,
                    "status" => $status,
                ];
                $where =
                    "where id=" . $id . " and vendor_id=" . $vendor_id . "";
                $h = new Fixxy();
                $check = $h->serviceupdateData($field, $table, $where);

                if ($check == 1) {
                    $returnArr = [
                        "ResponseCode" => "200",
                        "Result" => "true",
                        "title" => "Service Update Successfully!!",
                        "message" => "Service section!",
                        "action" => "list_Service.php",
                    ];
                } 
            
        } else {
            $table = "tbl_service";
            $field = [
                "cat_id" => $cat,
                "sub_id" => $subcat,
                "service_type" => $thing,
                "title" => $mtitle,
                "take_time" => $stime,
                "max_quantity" => $mqty,
                "price" => $price,
                "discount" => $sdisc,
                "service_desc" => $mdesc,
                "status" => $status,
            ];
            $where = "where id=" . $id . " and vendor_id=" . $vendor_id . "";
            $h = new Fixxy();
            $check = $h->serviceupdateData($field, $table, $where);
            if ($check == 1) {
                $returnArr = [
                    "ResponseCode" => "200",
                    "Result" => "true",
                    "title" => "Service Update Successfully!!",
                    "message" => "Service section!",
                    "action" => "list_Service.php",
                ];
            } 
        }
    } elseif ($_POST["type"] == "edit_timeslot") {
        $cat_id = $_POST["category"];

        $day_type = $_POST["dthing"];
        $total_days = $_POST["day"];
        $id = $_POST["id"];
        $timeslot = implode(",", $_POST["timsloat"]);
        $vendor_id = $sdata["id"];
        $check_exist = $service->query(
            "select * from tbl_timeslot where cat_id=" .
                $cat_id .
                " and vendor_id=" .
                $vendor_id .
                " and id!=" .
                $id .
                ""
        )->num_rows;
        if ($check_exist != 0) {
            $returnArr = [
                "ResponseCode" => "401",
                "Result" => "false",
                "title" => "Timeslot Already Added In Category!",
                "message" => "Timeslot section!",
                "action" => "list_Timeslot.php",
            ];
        } else {
            $table = "tbl_timeslot";
            $field = [
                "cat_id" => $cat_id,
                "day_type" => $day_type,
                "total_days" => $total_days,
                "timeslot" => $timeslot,
            ];
            $where = "where id=" . $id . " and vendor_id=" . $vendor_id . "";
            $h = new Fixxy();
            $check = $h->serviceupdateData($field, $table, $where);

            if ($check == 1) {
                $returnArr = [
                    "ResponseCode" => "200",
                    "Result" => "true",
                    "title" => "Timeslot Update Successfully!!",
                    "message" => "Timeslot section!",
                    "action" => "list_Timeslot.php",
                ];
            } 
        }
    } elseif ($_POST["type"] == "add_banner") {
        $okey = $_POST["status"];
        $target_dir = dirname(dirname(__FILE__)) . "/images/banner/";
        $url = "images/banner/";
        $temp = explode(".", $_FILES["cat_img"]["name"]);
        $newfilename = round(microtime(true)) . "." . end($temp);
        $target_file = $target_dir . basename($newfilename);
        $url = $url . basename($newfilename);
        
            move_uploaded_file($_FILES["cat_img"]["tmp_name"], $target_file);
            $table = "banner";
            $field_values = ["img", "status"];
            $data_values = ["$url", "$okey"];

            $h = new Fixxy();
            $check = $h->serviceinsertdata($field_values, $data_values, $table);
            if ($check == 1) {
                $returnArr = [
                    "ResponseCode" => "200",
                    "Result" => "true",
                    "title" => "Banner Add Successfully!!",
                    "message" => "banner section!",
                    "action" => "list_Banner.php",
                ];
            } 
        
    } elseif ($_POST["type"] == "add_section_item") {
        $okey = $_POST["status"];
        $catsearch = $_POST["catsearch"];
        $title = $service->real_escape_string($_POST["title"]);
        $target_dir = dirname(dirname(__FILE__)) . "/images/section/";
        $url = "images/section/";
        $temp = explode(".", $_FILES["cat_img"]["name"]);
        $newfilename = round(microtime(true)) . "." . end($temp);
        $target_file = $target_dir . basename($newfilename);
        $url = $url . basename($newfilename);
        
            move_uploaded_file($_FILES["cat_img"]["tmp_name"], $target_file);
            $table = "section_item";
            $field_values = ["img", "status", "title", "section_id"];
            $data_values = ["$url", "$okey", "$title", "$catsearch"];

            $h = new Fixxy();
            $check = $h->serviceinsertdata($field_values, $data_values, $table);
            if ($check == 1) {
                $returnArr = [
                    "ResponseCode" => "200",
                    "Result" => "true",
                    "title" => "Section Item Add Successfully!!",
                    "message" => "Section Item section!",
                    "action" => "list_Section_Item.php",
                ];
            } 
        
    } elseif ($_POST["type"] == "edit_section_item") {
        $okey = $_POST["status"];
        $catsearch = $_POST["catsearch"];
        $title = $service->real_escape_string($_POST["title"]);
        $id = $_POST["id"];
        $target_dir = dirname(dirname(__FILE__)) . "/images/section/";
        $url = "images/section/";
        $temp = explode(".", $_FILES["cat_img"]["name"]);
        $newfilename = round(microtime(true)) . "." . end($temp);
        $target_file = $target_dir . basename($newfilename);
        $url = $url . basename($newfilename);
        if ($_FILES["cat_img"]["name"] != "") {
            
                move_uploaded_file(
                    $_FILES["cat_img"]["tmp_name"],
                    $target_file
                );
                $table = "section_item";
                $field = [
                    "status" => $okey,
                    "img" => $url,
                    "title" => $title,
                    "section_id" => $catsearch,
                ];
                $where = "where id=" . $id . "";
                $h = new Fixxy();
                $check = $h->serviceupdateData($field, $table, $where);

                if ($check == 1) {
                    $returnArr = [
                        "ResponseCode" => "200",
                        "Result" => "true",
                        "title" => "Section Item Update Successfully!!",
                        "message" => "Section Item section!",
                        "action" => "list_Section_Item.php",
                    ];
                } 
            
        } else {
            $table = "section_item";
            $field = [
                "status" => $okey,
                "title" => $title,
                "section_id" => $catsearch,
            ];
            $where = "where id=" . $id . "";
            $h = new Fixxy();
            $check = $h->serviceupdateData($field, $table, $where);
            if ($check == 1) {
                $returnArr = [
                    "ResponseCode" => "200",
                    "Result" => "true",
                    "title" => "Section Item Update Successfully!!",
                    "message" => "Section Item section!",
                    "action" => "list_Section_Item.php",
                ];
            } 
        }
    } elseif ($_POST["type"] == "add_cover_img") {
        $id = $_POST["id"];
        $count = $service->query(
            "select * from tbl_cover_images where cover_id=" . $id . ""
        )->num_rows;
        if ($count >= 5) {
            $returnArr = [
                "ResponseCode" => "200",
                "Result" => "false",
                "title" => "Only Allow 5 Images",
                "message" => "Upload Problem!!",
                "action" => "list_Cover.php",
            ];
        } else {
            $target_dir = dirname(dirname(__FILE__)) . "/images/cover/";
            $url = "images/cover/";
            $temp = explode(".", $_FILES["cat_img"]["name"]);
            $newfilename = round(microtime(true)) . "." . end($temp);
            $target_file = $target_dir . basename($newfilename);
            $url = $url . basename($newfilename);
            
                move_uploaded_file(
                    $_FILES["cat_img"]["tmp_name"],
                    $target_file
                );
                $table = "tbl_cover_images";
                $field_values = ["text", "cover_id"];
                $data_values = ["$url", "$id"];

                $h = new Fixxy();
                $check = $h->serviceinsertdata(
                    $field_values,
                    $data_values,
                    $table
                );
                if ($check == 1) {
                    $returnArr = [
                        "ResponseCode" => "200",
                        "Result" => "true",
                        "title" => "Cover Image Update Successfully!!",
                        "message" => "Cover Image section!",
                        "action" => "list_Cover.php",
                    ];
                } 
            
        }
    } elseif ($_POST["type"] == "edit_cover_img") {
        $id = $_POST["id"];
        if ($_FILES["cat_img"]["name"] != "") {
            $target_dir = dirname(dirname(__FILE__)) . "/images/cover/";
            $url = "images/cover/";
            $temp = explode(".", $_FILES["cat_img"]["name"]);
            $newfilename = round(microtime(true)) . "." . end($temp);
            $target_file = $target_dir . basename($newfilename);
            $url = $url . basename($newfilename);
           
                move_uploaded_file(
                    $_FILES["cat_img"]["tmp_name"],
                    $target_file
                );
                $table = "tbl_cover_images";
                $field = ["text" => $url];
                $where = "where id=" . $id . "";
                $h = new Fixxy();
                $check = $h->serviceupdateData($field, $table, $where);
                if ($check == 1) {
                    $returnArr = [
                        "ResponseCode" => "200",
                        "Result" => "true",
                        "title" => "Cover Image Update Successfully!!",
                        "message" => "Cover Image section!",
                        "action" => "list_Cover.php",
                    ];
                } 
            
        } else {
            $returnArr = [
                "ResponseCode" => "200",
                "Result" => "false",
                "title" => "Cover Image Update Successfully!!",
                "message" => "Cover Image Section!!",
                "action" => "list_Cover.php",
            ];
        }
    } elseif ($_POST["type"] == "add_category") {
        $okey = $_POST["status"];
        $title = $service->real_escape_string($_POST["title"]);
        $target_dir = dirname(dirname(__FILE__)) . "/images/category/";
        $url = "images/category/";
        $temp = explode(".", $_FILES["cat_img"]["name"]);
        $newfilename = round(microtime(true)) . "." . end($temp);
        $target_file = $target_dir . basename($newfilename);
        $url = $url . basename($newfilename);
        
            move_uploaded_file($_FILES["cat_img"]["tmp_name"], $target_file);
            $table = "tbl_category";
            $field_values = ["img", "status", "title"];
            $data_values = ["$url", "$okey", "$title"];

            $h = new Fixxy();
            $check = $h->serviceinsertdata($field_values, $data_values, $table);
            if ($check == 1) {
                $returnArr = [
                    "ResponseCode" => "200",
                    "Result" => "true",
                    "title" => "Category Add Successfully!!",
                    "message" => "Category section!",
                    "action" => "list_Category.php",
                ];
            } 
        
    } elseif ($_POST["type"] == "com_payout") {
        $payout_id = $_POST["payout_id"];
        $target_dir = dirname(dirname(__FILE__)) . "/images/payout/";
        $url = "images/payout/";
        $temp = explode(".", $_FILES["cat_img"]["name"]);
        $newfilename = round(microtime(true)) . "." . end($temp);
        $target_file = $target_dir . basename($newfilename);
        $url = $url . basename($newfilename);
        
            move_uploaded_file($_FILES["cat_img"]["tmp_name"], $target_file);
            $table = "payout_setting";
            $field = ["proof" => $url, "status" => "completed"];
            $where = "where id=" . $payout_id . "";
            $h = new Fixxy();
            $check = $h->serviceupdateData($field, $table, $where);

            if ($check == 1) {
                $returnArr = [
                    "ResponseCode" => "200",
                    "Result" => "true",
                    "title" => "Payout Update Successfully!!",
                    "message" => "Payout section!",
                    "action" => "payout.php",
                ];
            } 
        
    } elseif ($_POST["type"] == "add_subcategory") {
        $cat_id = $_POST["cat_id"];
        $vendor_id = $sdata["id"];
        $okey = $_POST["status"];
        $title = $service->real_escape_string($_POST["title"]);
        $target_dir = dirname(dirname(__FILE__)) . "/images/subcategory/";
        $url = "images/subcategory/";
        $temp = explode(".", $_FILES["cat_img"]["name"]);
        $newfilename = round(microtime(true)) . "." . end($temp);
        $target_file = $target_dir . basename($newfilename);
        $url = $url . basename($newfilename);
        
            move_uploaded_file($_FILES["cat_img"]["tmp_name"], $target_file);
            $table = "tbl_subcategory";
            $field_values = ["img", "status", "title", "vendor_id", "cat_id"];
            $data_values = ["$url", "$okey", "$title", "$vendor_id", "$cat_id"];

            $h = new Fixxy();
            $check = $h->serviceinsertdata($field_values, $data_values, $table);
            if ($check == 1) {
                $returnArr = [
                    "ResponseCode" => "200",
                    "Result" => "true",
                    "title" => "Subcategory Add Successfully!!",
                    "message" => "Subcategory section!",
                    "action" => "list_Subcategory.php",
                ];
            } 
        
    } elseif ($_POST["type"] == "edit_coupon") {
        $expire_date = $_POST["expire_date"];
        $vendor_id = $sdata["id"];
        $id = $_POST["id"];
        $status = $_POST["status"];
        $coupon_code = $_POST["coupon_code"];
        $min_amt = $_POST["min_amt"];
        $coupon_val = $_POST["coupon_val"];
        $description = $service->real_escape_string($_POST["description"]);
        $title = $service->real_escape_string($_POST["title"]);
        $subtitle = $service->real_escape_string($_POST["subtitle"]);
        $target_dir = dirname(dirname(__FILE__)) . "/images/coupon/";
        $url = "images/coupon/";
        $temp = explode(".", $_FILES["coupon_img"]["name"]);
        $newfilename = round(microtime(true)) . "." . end($temp);
        $target_file = $target_dir . basename($newfilename);
        $url = $url . basename($newfilename);
        if ($_FILES["coupon_img"]["name"] != "") {
            
                move_uploaded_file(
                    $_FILES["coupon_img"]["tmp_name"],
                    $target_file
                );
                $table = "tbl_coupon";
                $field = [
                    "status" => $status,
                    "coupon_img" => $url,
                    "title" => $title,
                    "coupon_code" => $coupon_code,
                    "min_amt" => $min_amt,
                    "coupon_val" => $coupon_val,
                    "description" => $description,
                    "subtitle" => $subtitle,
                    "expire_date" => $expire_date,
                ];
                $where =
                    "where id=" . $id . " and vendor_id=" . $vendor_id . "";
                $h = new Fixxy();
                $check = $h->serviceupdateData($field, $table, $where);

                if ($check == 1) {
                    $returnArr = [
                        "ResponseCode" => "200",
                        "Result" => "true",
                        "title" => "Coupon Update Successfully!!",
                        "message" => "Coupon section!",
                        "action" => "list_Coupon.php",
                    ];
                } 
            
        } else {
            $table = "tbl_coupon";
            $field = [
                "status" => $status,
                "title" => $title,
                "coupon_code" => $coupon_code,
                "min_amt" => $min_amt,
                "coupon_val" => $coupon_val,
                "description" => $description,
                "subtitle" => $subtitle,
                "expire_date" => $expire_date,
            ];
            $where = "where id=" . $id . " and vendor_id=" . $vendor_id . "";
            $h = new Fixxy();
            $check = $h->serviceupdateData($field, $table, $where);
            if ($check == 1) {
                $returnArr = [
                    "ResponseCode" => "200",
                    "Result" => "true",
                    "title" => "Coupon Update Successfully!!",
                    "message" => "Coupon section!",
                    "action" => "list_Coupon.php",
                ];
            } 
        }
    } elseif ($_POST["type"] == "add_partner") {
        $email = $_POST["email"];
        $vendor_id = $sdata["id"];
        $status = $_POST["status"];
        $ccode = $_POST["ccode"];
        $mobile = $_POST["mobile"];
        $password = $service->real_escape_string($_POST["password"]);
        $title = $service->real_escape_string($_POST["title"]);
        $target_dir = dirname(dirname(__FILE__)) . "/images/partner/";
        $url = "images/partner/";
        $temp = explode(".", $_FILES["cat_img"]["name"]);
        $newfilename = round(microtime(true)) . "." . end($temp);
        $target_file = $target_dir . basename($newfilename);
        $url = $url . basename($newfilename);
       
            $check_email = $service->query(
                "select * from tbl_partner where email='" . $email . "'"
            )->num_rows;
            if ($check_email != 0) {
                $returnArr = [
                    "ResponseCode" => "401",
                    "Result" => "false",
                    "title" => "Email Address Already Used!!",
                    "message" => "Exist Problem!",
                    "action" => "list_Partner.php",
                ];
            } else {
                $timestamp = date("Y-m-d");
                move_uploaded_file(
                    $_FILES["cat_img"]["tmp_name"],
                    $target_file
                );
                $table = "tbl_partner";
                $field_values = [
                    "img",
                    "status",
                    "title",
                    "vendor_id",
                    "email",
                    "ccode",
                    "mobile",
                    "password",
                    "rdate",
                ];
                $data_values = [
                    "$url",
                    "$status",
                    "$title",
                    "$vendor_id",
                    "$email",
                    "$ccode",
                    "$mobile",
                    "$password",
                    "$timestamp",
                ];

                $h = new Fixxy();
                $check = $h->serviceinsertdata(
                    $field_values,
                    $data_values,
                    $table
                );
                if ($check == 1) {
                    $returnArr = [
                        "ResponseCode" => "200",
                        "Result" => "true",
                        "title" => "Partner Add Successfully!!",
                        "message" => "Partner section!",
                        "action" => "list_Partner.php",
                    ];
                } 
            }
        
    } elseif ($_POST["type"] == "edit_partner") {
        $email = $_POST["email"];
        $vendor_id = $sdata["id"];
        $status = $_POST["status"];
        $ccode = $_POST["ccode"];
        $mobile = $_POST["mobile"];
        $id = $_POST["id"];
        $password = $service->real_escape_string($_POST["password"]);
        $title = $service->real_escape_string($_POST["title"]);
        $target_dir = dirname(dirname(__FILE__)) . "/images/partner/";
        $url = "images/partner/";
        $temp = explode(".", $_FILES["cat_img"]["name"]);
        $newfilename = round(microtime(true)) . "." . end($temp);
        $target_file = $target_dir . basename($newfilename);
        $url = $url . basename($newfilename);
        $check_email = $service->query(
            "select * from tbl_partner where email='" .
                $email .
                "' and id!=" .
                $id .
                ""
        )->num_rows;
        if ($check_email != 0) {
            $returnArr = [
                "ResponseCode" => "401",
                "Result" => "false",
                "title" => "Email Address Already Used!!",
                "message" => "Exist Problem!",
                "action" => "list_Partner.php",
            ];
        } else {
            
                    move_uploaded_file(
                        $_FILES["cat_img"]["tmp_name"],
                        $target_file
                    );
                    $table = "tbl_partner";
                    $field = [
                        "status" => $status,
                        "img" => $url,
                        "title" => $title,
                        "email" => $email,
                        "ccode" => $ccode,
                        "mobile" => $mobile,
                        "password" => $password,
                    ];
                    $where =
                        "where id=" . $id . " and vendor_id=" . $vendor_id . "";
                    $h = new Fixxy();
                    $check = $h->serviceupdateData($field, $table, $where);

                    if ($check == 1) {
                        $returnArr = [
                            "ResponseCode" => "200",
                            "Result" => "true",
                            "title" => "Partner Update Successfully!!",
                            "message" => "Partner section!",
                            "action" => "list_Partner.php",
                        ];
                    } 
                
            } else {
                $table = "tbl_partner";
                $field = [
                    "status" => $status,
                    "title" => $title,
                    "email" => $email,
                    "ccode" => $ccode,
                    "mobile" => $mobile,
                    "password" => $password,
                ];
                $where =
                    "where id=" . $id . " and vendor_id=" . $vendor_id . "";
                $h = new Fixxy();
                $check = $h->serviceupdateData($field, $table, $where);
                if ($check == 1) {
                    $returnArr = [
                        "ResponseCode" => "200",
                        "Result" => "true",
                        "title" => "Partner Update Successfully!!",
                        "message" => "Partner section!",
                        "action" => "list_Partner.php",
                    ];
                } 
            }
        }
    } elseif ($_POST["type"] == "edit_category") {
        $okey = $_POST["status"];
        $id = $_POST["id"];
        $title = $service->real_escape_string($_POST["title"]);
        $target_dir = dirname(dirname(__FILE__)) . "/images/category/";
        $url = "images/category/";
        $temp = explode(".", $_FILES["cat_img"]["name"]);
        $newfilename = round(microtime(true)) . "." . end($temp);
        $target_file = $target_dir . basename($newfilename);
        $url = $url . basename($newfilename);
        if ($_FILES["cat_img"]["name"] != "") {
            
                move_uploaded_file(
                    $_FILES["cat_img"]["tmp_name"],
                    $target_file
                );
                $table = "tbl_category";
                $field = ["status" => $okey, "img" => $url, "title" => $title];
                $where = "where id=" . $id . "";
                $h = new Fixxy();
                $check = $h->serviceupdateData($field, $table, $where);

                if ($check == 1) {
                    $returnArr = [
                        "ResponseCode" => "200",
                        "Result" => "true",
                        "title" => "Category Update Successfully!!",
                        "message" => "Category section!",
                        "action" => "list_Category.php",
                    ];
                } 
            
        } else {
            $table = "tbl_category";
            $field = ["status" => $okey, "title" => $title];
            $where = "where id=" . $id . "";
            $h = new Fixxy();
            $check = $h->serviceupdateData($field, $table, $where);
            if ($check == 1) {
                $returnArr = [
                    "ResponseCode" => "200",
                    "Result" => "true",
                    "title" => "Category Update Successfully!!",
                    "message" => "Category section!",
                    "action" => "list_Category.php",
                ];
            } 
        }
    } elseif ($_POST["type"] == "edit_subcategory") {
        $cat_id = $_POST["cat_id"];
        $vendor_id = $sdata["id"];
        $okey = $_POST["status"];
        $id = $_POST["id"];
        $title = $service->real_escape_string($_POST["title"]);
        $target_dir = dirname(dirname(__FILE__)) . "/images/subcategory/";
        $url = "images/subcategory/";
        $temp = explode(".", $_FILES["cat_img"]["name"]);
        $newfilename = round(microtime(true)) . "." . end($temp);
        $target_file = $target_dir . basename($newfilename);
        $url = $url . basename($newfilename);
        if ($_FILES["cat_img"]["name"] != "") {
           
                move_uploaded_file(
                    $_FILES["cat_img"]["tmp_name"],
                    $target_file
                );
                $table = "tbl_subcategory";
                $field = [
                    "status" => $okey,
                    "img" => $url,
                    "title" => $title,
                    "cat_id" => $cat_id,
                ];
                $where =
                    "where id=" . $id . " and vendor_id=" . $vendor_id . "";
                $h = new Fixxy();
                $check = $h->serviceupdateData($field, $table, $where);

                if ($check == 1) {
                    $returnArr = [
                        "ResponseCode" => "200",
                        "Result" => "true",
                        "title" => "Subcategory Update Successfully!!",
                        "message" => "Subcategory section!",
                        "action" => "list_Subcategory.php",
                    ];
                } 
            
        } else {
            $table = "tbl_subcategory";
            $field = [
                "status" => $okey,
                "title" => $title,
                "cat_id" => $cat_id,
            ];
            $where = "where id=" . $id . " and vendor_id=" . $vendor_id . "";
            $h = new Fixxy();
            $check = $h->serviceupdateData($field, $table, $where);
            if ($check == 1) {
                $returnArr = [
                    "ResponseCode" => "200",
                    "Result" => "true",
                    "title" => "Subcategory Update Successfully!!",
                    "message" => "Subcategory section!",
                    "action" => "list_Subcategory.php",
                ];
            } 
        }
    } elseif ($_POST["type"] == "edit_banner") {
        $okey = $_POST["status"];
        $id = $_POST["id"];
        $target_dir = dirname(dirname(__FILE__)) . "/images/banner/";
        $url = "images/banner/";
        $temp = explode(".", $_FILES["cat_img"]["name"]);
        $newfilename = round(microtime(true)) . "." . end($temp);
        $target_file = $target_dir . basename($newfilename);
        $url = $url . basename($newfilename);
        if ($_FILES["cat_img"]["name"] != "") {
            
                move_uploaded_file(
                    $_FILES["cat_img"]["tmp_name"],
                    $target_file
                );
                $table = "banner";
                $field = ["status" => $okey, "img" => $url];
                $where = "where id=" . $id . "";
                $h = new Fixxy();
                $check = $h->serviceupdateData($field, $table, $where);

                if ($check == 1) {
                    $returnArr = [
                        "ResponseCode" => "200",
                        "Result" => "true",
                        "title" => "Banner Update Successfully!!",
                        "message" => "banner section!",
                        "action" => "list_Banner.php",
                    ];
                }
            
        } else {
            $table = "banner";
            $field = ["status" => $okey];
            $where = "where id=" . $id . "";
            $h = new Fixxy();
            $check = $h->serviceupdateData($field, $table, $where);
            if ($check == 1) {
                $returnArr = [
                    "ResponseCode" => "200",
                    "Result" => "true",
                    "title" => "Banner Update Successfully!!",
                    "message" => "banner section!",
                    "action" => "list_Banner.php",
                ];
            } 
        }
    } elseif ($_POST["type"] == "add_zone") {
        $zname = $_POST["zname"];
        $okey = $_POST["status"];
        $coordinates = $_POST["coordinates"];
        foreach (
            explode("),(", trim($coordinates, "()"))
            as $index => $single_array
        ) {
            if ($index == 0) {
                $lastcord = explode(",", $single_array);
            }
            $coords = explode(",", $single_array);
            $polygon[] = new Point($coords[0], $coords[1]);
        }

        $polygon[] = new Point($lastcord[0], $lastcord[1]);
        $pv = new Polygon([new LineString($polygon)]);

        $table = "zones";
        $field_values = ["coordinates", "title", "status", "alias"];
        $data_values = [
            "ST_GeomFromText('POLYGON($pv)')",
            "$zname",
            "$okey",
            "$coordinates",
        ];

        $h = new Fixxy();
        $check = $h->servicezoneinsertdata($field_values, $data_values, $table);
        if ($check == 1) {
            $returnArr = [
                "ResponseCode" => "200",
                "Result" => "true",
                "title" => "Zone Add Successfully!!",
                "message" => "Zone section!",
                "action" => "list_Zone.php",
            ];
        } 
    } elseif ($_POST["type"] == "edit_zone") {
        $zname = $_POST["zname"];
        $id = $_POST["id"];
        $okey = $_POST["status"];
        $coordinates = $_POST["coordinates"];

        foreach (
            explode("),(", trim($coordinates, "()"))
            as $index => $single_array
        ) {
            if ($index == 0) {
                $lastcord = explode(",", $single_array);
            }
            $coords = explode(",", $single_array);
            $polygon[] = new Point($coords[0], $coords[1]);
        }

        $polygon[] = new Point($lastcord[0], $lastcord[1]);
        $pv = new Polygon([new LineString($polygon)]);

        $table = "zones";
        $field = [
            "coordinates" => "ST_GeomFromText('POLYGON($pv)')",
            "title" => $zname,
            "status" => $okey,
            "alias" => $coordinates,
        ];
        $where = "where id=" . $id . "";
        $h = new Fixxy();
        $check = $h->servicezoneupdateData($field, $table, $where);
        if ($check == 1) {
            $returnArr = [
                "ResponseCode" => "200",
                "Result" => "true",
                "title" => "Zone Update Successfully!!",
                "message" => "Zone section!",
                "action" => "list_Zone.php",
            ];
        } 
    } elseif ($_POST["type"] == "add_Provider") {
        $cname = mysqli_real_escape_string($service, $_POST["cname"]);
        $status = $_POST["status"];
        $arate = $_POST["arate"];
        $adtime = $_POST["adtime"];
        $lcode = $_POST["lcode"];
        $mobile = $_POST["mobile"];
        $sdesc = $_POST["sdesc"];
        $catsearch = implode(",", $_POST["catsearch"]);
        $FullAddress = mysqli_real_escape_string(
            $service,
            $_POST["FullAddress"]
        );
        $pincode = $_POST["pincode"];
        $landmark = mysqli_real_escape_string($service, $_POST["landmark"]);
        $latitude = $_POST["latitude"];
        $longitude = $_POST["longitude"];
        $scharge = $_POST["scharge"];

        $charge_type = $_POST["charge_type"];
        $dcharge = empty($_POST["dcharge"]) ? 0 : $_POST["dcharge"];
        $ukms = empty($_POST["ukms"]) ? 0 : $_POST["ukms"];
        $uprice = empty($_POST["uprice"]) ? 0 : $_POST["uprice"];
        $aprice = empty($_POST["aprice"]) ? 0 : $_POST["aprice"];
        $morder = $_POST["morder"];
        $commission = $_POST["commission"];
        $bname = mysqli_real_escape_string($service, $_POST["bname"]);
        $ifsc = $_POST["ifsc"];
        $rname = mysqli_real_escape_string($service, $_POST["rname"]);
        $ano = $_POST["ano"];
        $paypal = $_POST["paypal"];
        $upi = $_POST["upi"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $zone_id = $_POST["zone_id"];

        $target_dir = dirname(dirname(__FILE__)) . "/images/provider/";
        $url = "images/provider/";
        $temp = explode(".", $_FILES["kit_img"]["name"]);
        $newfilename = round(microtime(true)) . "." . end($temp);
        $target_file = $target_dir . basename($newfilename);
        $url = $url . basename($newfilename);

        $target_dirs = dirname(dirname(__FILE__)) . "/images/provider/";
        $urls = "images/provider/";
        $temps = explode(".", $_FILES["cover_img"]["name"]);
        $newfilenames = uniqid() . round(microtime(true)) . "." . end($temps);
        $target_files = $target_dirs . basename($newfilenames);
        $urls = $urls . basename($newfilenames);

        $check_details = $service->query(
            "select email from service_details where email='" . $email . "'"
        )->num_rows;
        if ($check_details != 0) {
            $returnArr = [
                "ResponseCode" => "200",
                "Result" => "false",
                "title" => "Service Provider Email Already Used!!",
                "message" => "Service Provider section!",
                "action" => "add_Provider.php",
            ];
        } else {
            
                move_uploaded_file(
                    $_FILES["kit_img"]["tmp_name"],
                    $target_file
                );
                move_uploaded_file(
                    $_FILES["cover_img"]["tmp_name"],
                    $target_files
                );
                $table = "service_details";
                $field_values = [
                    "sdesc",
                    "rimg",
                    "status",
                    "title",
                    "rate",
                    "dtime",
                    "lcode",
                    "catid",
                    "full_address",
                    "pincode",
                    "landmark",
                    "lats",
                    "longs",
                    "store_charge",
                    "dcharge",
                    "morder",
                    "commission",
                    "bank_name",
                    "ifsc",
                    "receipt_name",
                    "acc_number",
                    "paypal_id",
                    "upi_id",
                    "email",
                    "password",
                    "mobile",
                    "charge_type",
                    "ukm",
                    "uprice",
                    "aprice",
                    "zone_id",
                    "cover_img",
                ];
                $data_values = [
                    "$sdesc",
                    "$url",
                    "$status",
                    "$cname",
                    "$arate",
                    "$adtime",
                    "$lcode",
                    "$catsearch",
                    "$FullAddress",
                    "$pincode",
                    "$landmark",
                    "$latitude",
                    "$longitude",
                    "$scharge",
                    "$dcharge",
                    "$morder",
                    "$commission",
                    "$bname",
                    "$ifsc",
                    "$rname",
                    "$ano",
                    "$paypal",
                    "$upi",
                    "$email",
                    "$password",
                    "$mobile",
                    "$charge_type",
                    "$ukms",
                    "$uprice",
                    "$aprice",
                    "$zone_id",
                    "$urls",
                ];
                $h = new Fixxy();
                $check = $h->serviceinsertdata(
                    $field_values,
                    $data_values,
                    $table
                );
                if ($check == 1) {
                    $returnArr = [
                        "ResponseCode" => "200",
                        "Result" => "true",
                        "title" => "Service Provider Add Successfully!!",
                        "message" => "Service Provider section!",
                        "action" => "list_Provider.php",
                    ];
                } 
            }
        
    } elseif ($_POST["type"] == "edit_Provider") {
        $id = $_POST["id"];
        $cname = mysqli_real_escape_string($service, $_POST["cname"]);
        $status = $_POST["status"];
        $arate = $_POST["arate"];
        $adtime = $_POST["adtime"];
        $lcode = $_POST["lcode"];
        $mobile = $_POST["mobile"];
        $sdesc = $_POST["sdesc"];

        $catsearch = implode(",", $_POST["catsearch"]);
        $FullAddress = mysqli_real_escape_string(
            $service,
            $_POST["FullAddress"]
        );
        $pincode = $_POST["pincode"];
        $landmark = mysqli_real_escape_string($service, $_POST["landmark"]);
        $latitude = $_POST["latitude"];
        $longitude = $_POST["longitude"];
        $scharge = $_POST["scharge"];

        $charge_type = $_POST["charge_type"];
        $dcharge = empty($_POST["dcharge"]) ? 0 : $_POST["dcharge"];
        $ukms = empty($_POST["ukms"]) ? 0 : $_POST["ukms"];
        $uprice = empty($_POST["uprice"]) ? 0 : $_POST["uprice"];
        $aprice = empty($_POST["aprice"]) ? 0 : $_POST["aprice"];
        $morder = $_POST["morder"];
        $commission = $_POST["commission"];
        $bname = mysqli_real_escape_string($service, $_POST["bname"]);
        $ifsc = $_POST["ifsc"];
        $rname = mysqli_real_escape_string($service, $_POST["rname"]);
        $ano = $_POST["ano"];
        $paypal = $_POST["paypal"];
        $upi = $_POST["upi"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $zone_id = $_POST["zone_id"];

        $target_dir = dirname(dirname(__FILE__)) . "/images/provider/";
        $url = "images/provider/";
        $temp = explode(".", $_FILES["kit_img"]["name"]);
        $newfilename = round(microtime(true)) . "." . end($temp);
        $target_file = $target_dir . basename($newfilename);
        $url = $url . basename($newfilename);

        $target_dirs = dirname(dirname(__FILE__)) . "/images/provider/";
        $urls = "images/provider/";
        $temps = explode(".", $_FILES["cover_img"]["name"]);
        $newfilenames = uniqid() . round(microtime(true)) . "." . end($temps);
        $target_files = $target_dirs . basename($newfilenames);
        $urls = $urls . basename($newfilenames);

        $check_details = $service->query(
            "select email from service_details where email='" .
                $email .
                "' and id!=" .
                $id .
                ""
        )->num_rows;
        if ($check_details != 0) {
            $returnArr = [
                "ResponseCode" => "200",
                "Result" => "false",
                "title" => "Service Provider Email Already Used!!",
                "message" => "Service Provider section!",
                "action" => "add_Provider.php?id=" . $id . "",
            ];
        } else {
            if (
                $_FILES["kit_img"]["name"] != "" and
                $_FILES["cover_img"]["name"] == ""
            ) {
                
                    move_uploaded_file(
                        $_FILES["kit_img"]["tmp_name"],
                        $target_file
                    );
                    $table = "service_details";
                    $field = [
                        "zone_id" => $zone_id,
                        "charge_type" => $charge_type,
                        "ukm" => $ukms,
                        "aprice" => $aprice,
                        "uprice" => $uprice,
                        "sdesc" => $sdesc,
                        "status" => $status,
                        "rimg" => $url,
                        "title" => $cname,
                        "rate" => $arate,
                        "dtime" => $adtime,
                        "lcode" => $lcode,
                        "catid" => $catsearch,
                        "full_address" => $FullAddress,
                        "pincode" => $pincode,
                        "landmark" => $landmark,
                        "lats" => $latitude,
                        "longs" => $longitude,
                        "store_charge" => $scharge,
                        "dcharge" => $dcharge,
                        "morder" => $morder,
                        "commission" => $commission,
                        "bank_name" => $bname,
                        "ifsc" => $ifsc,
                        "receipt_name" => $rname,
                        "acc_number" => $ano,
                        "paypal_id" => $paypal,
                        "upi_id" => $upi,
                        "email" => $email,
                        "password" => $password,
                        "mobile" => $mobile,
                    ];
                    $where = "where id=" . $id . "";
                    $h = new Fixxy();
                    $check = $h->serviceupdateData($field, $table, $where);

                    if ($check == 1) {
                        $returnArr = [
                            "ResponseCode" => "200",
                            "Result" => "true",
                            "title" => "Service Provider Update Successfully!!",
                            "message" => "Service Provider section!",
                            "action" => "list_Provider.php",
                        ];
                    } 
                
            } elseif (
                $_FILES["kit_img"]["name"] == "" and
                $_FILES["cover_img"]["name"] != ""
            ) {
                
                    move_uploaded_file(
                        $_FILES["cover_img"]["tmp_name"],
                        $target_files
                    );
                    $table = "service_details";
                    $field = [
                        "zone_id" => $zone_id,
                        "charge_type" => $charge_type,
                        "ukm" => $ukms,
                        "aprice" => $aprice,
                        "uprice" => $uprice,
                        "sdesc" => $sdesc,
                        "status" => $status,
                        "cover_img" => $urls,
                        "title" => $cname,
                        "rate" => $arate,
                        "dtime" => $adtime,
                        "lcode" => $lcode,
                        "catid" => $catsearch,
                        "full_address" => $FullAddress,
                        "pincode" => $pincode,
                        "landmark" => $landmark,
                        "lats" => $latitude,
                        "longs" => $longitude,
                        "store_charge" => $scharge,
                        "dcharge" => $dcharge,
                        "morder" => $morder,
                        "commission" => $commission,
                        "bank_name" => $bname,
                        "ifsc" => $ifsc,
                        "receipt_name" => $rname,
                        "acc_number" => $ano,
                        "paypal_id" => $paypal,
                        "upi_id" => $upi,
                        "email" => $email,
                        "password" => $password,
                        "mobile" => $mobile,
                    ];
                    $where = "where id=" . $id . "";
                    $h = new Fixxy();
                    $check = $h->serviceupdateData($field, $table, $where);

                    if ($check == 1) {
                        $returnArr = [
                            "ResponseCode" => "200",
                            "Result" => "true",
                            "title" => "Service Provider Update Successfully!!",
                            "message" => "Service Provider section!",
                            "action" => "list_Provider.php",
                        ];
                    } 
                
            } elseif (
                $_FILES["kit_img"]["name"] != "" and
                $_FILES["cover_img"]["name"] != ""
            ) {
                
                    move_uploaded_file(
                        $_FILES["cover_img"]["tmp_name"],
                        $target_files
                    );
                    move_uploaded_file(
                        $_FILES["kit_img"]["tmp_name"],
                        $target_file
                    );

                    $table = "service_details";
                    $field = [
                        "zone_id" => $zone_id,
                        "charge_type" => $charge_type,
                        "ukm" => $ukms,
                        "aprice" => $aprice,
                        "uprice" => $uprice,
                        "sdesc" => $sdesc,
                        "status" => $status,
                        "cover_img" => $urls,
                        "rimg" => $url,
                        "title" => $cname,
                        "rate" => $arate,
                        "dtime" => $adtime,
                        "lcode" => $lcode,
                        "catid" => $catsearch,
                        "full_address" => $FullAddress,
                        "pincode" => $pincode,
                        "landmark" => $landmark,
                        "lats" => $latitude,
                        "longs" => $longitude,
                        "store_charge" => $scharge,
                        "dcharge" => $dcharge,
                        "morder" => $morder,
                        "commission" => $commission,
                        "bank_name" => $bname,
                        "ifsc" => $ifsc,
                        "receipt_name" => $rname,
                        "acc_number" => $ano,
                        "paypal_id" => $paypal,
                        "upi_id" => $upi,
                        "email" => $email,
                        "password" => $password,
                        "mobile" => $mobile,
                    ];
                    $where = "where id=" . $id . "";
                    $h = new Fixxy();
                    $check = $h->serviceupdateData($field, $table, $where);

                    if ($check == 1) {
                        $returnArr = [
                            "ResponseCode" => "200",
                            "Result" => "true",
                            "title" => "Service Provider Update Successfully!!",
                            "message" => "Service Provider section!",
                            "action" => "list_Provider.php",
                        ];
                    } 
                
            } else {
                $table = "service_details";
                $field = [
                    "zone_id" => $zone_id,
                    "charge_type" => $charge_type,
                    "ukm" => $ukms,
                    "aprice" => $aprice,
                    "uprice" => $uprice,
                    "sdesc" => $sdesc,
                    "status" => $status,
                    "title" => $cname,
                    "rate" => $arate,
                    "dtime" => $adtime,
                    "lcode" => $lcode,
                    "catid" => $catsearch,
                    "full_address" => $FullAddress,
                    "pincode" => $pincode,
                    "landmark" => $landmark,
                    "lats" => $latitude,
                    "longs" => $longitude,
                    "store_charge" => $scharge,
                    "dcharge" => $dcharge,
                    "morder" => $morder,
                    "commission" => $commission,
                    "bank_name" => $bname,
                    "ifsc" => $ifsc,
                    "receipt_name" => $rname,
                    "acc_number" => $ano,
                    "paypal_id" => $paypal,
                    "upi_id" => $upi,
                    "email" => $email,
                    "password" => $password,
                    "mobile" => $mobile,
                ];
                $where = "where id=" . $id . "";
                $h = new Fixxy();
                $check = $h->serviceupdateData($field, $table, $where);

                if ($check == 1) {
                    $returnArr = [
                        "ResponseCode" => "200",
                        "Result" => "true",
                        "title" => "Service Provider Update Successfully!!",
                        "message" => "Service Provider section!",
                        "action" => "list_Provider.php",
                    ];
                } 
            }
        }
    } elseif ($_POST["type"] == "edit_payment") {
        $dname = mysqli_real_escape_string($service, $_POST["cname"]);
        $attributes = mysqli_real_escape_string($service, $_POST["p_attr"]);
        $ptitle = mysqli_real_escape_string($service, $_POST["ptitle"]);
        $okey = $_POST["status"];
        $id = $_POST["id"];
        $p_show = $_POST["p_show"];
        $target_dir = dirname(dirname(__FILE__)) . "/images/payment/";
        $url = "images/payment/";
        $temp = explode(".", $_FILES["cat_img"]["name"]);
        $newfilename = round(microtime(true)) . "." . end($temp);
        $target_file = $target_dir . basename($newfilename);
        $url = $url . basename($newfilename);
        if ($_FILES["cat_img"]["name"] != "") {
            
                move_uploaded_file(
                    $_FILES["cat_img"]["tmp_name"],
                    $target_file
                );
                $table = "tbl_payment_list";
                $field = [
                    "title" => $dname,
                    "status" => $okey,
                    "img" => $url,
                    "attributes" => $attributes,
                    "subtitle" => $ptitle,
                    "p_show" => $p_show,
                ];
                $where = "where id=" . $id . "";
                $h = new Fixxy();
                $check = $h->serviceupdateData($field, $table, $where);

                if ($check == 1) {
                    $returnArr = [
                        "ResponseCode" => "200",
                        "Result" => "true",
                        "title" => "Payment Gateway Update Successfully!!",
                        "message" => "Payment Gateway section!",
                        "action" => "payment_method.php",
                    ];
                } 
            
        } else {
            $table = "tbl_payment_list";
            $field = [
                "title" => $dname,
                "status" => $okey,
                "attributes" => $attributes,
                "subtitle" => $ptitle,
                "p_show" => $p_show,
            ];
            $where = "where id=" . $id . "";
            $h = new Fixxy();
            $check = $h->serviceupdateData($field, $table, $where);
            if ($check == 1) {
                $returnArr = [
                    "ResponseCode" => "200",
                    "Result" => "true",
                    "title" => "Payment Gateway Update Successfully!!",
                    "message" => "Payment Gateway section!",
                    "action" => "payment_method.php",
                ];
            } 
        }
    } elseif ($_POST["type"] == "add_faq") {
        $okey = $_POST["status"];
        $question = $service->real_escape_string($_POST["question"]);
        $answer = $service->real_escape_string($_POST["answer"]);

        $table = "tbl_faq";
        $field_values = ["question", "answer", "status"];
        $data_values = ["$question", "$answer", "$okey"];

        $h = new Fixxy();
        $check = $h->serviceinsertdata($field_values, $data_values, $table);
        if ($check == 1) {
            $returnArr = [
                "ResponseCode" => "200",
                "Result" => "true",
                "title" => "FAQ Add Successfully!!",
                "message" => "FAQ section!",
                "action" => "list_faq.php",
            ];
        } 
    } elseif ($_POST["type"] == "add_code") {
        $okey = $_POST["status"];
        $title = $service->real_escape_string($_POST["title"]);

        $table = "tbl_code";
        $field_values = ["ccode", "status"];
        $data_values = ["$title", "$okey"];

        $h = new Fixxy();
        $check = $h->serviceinsertdata($field_values, $data_values, $table);
        if ($check == 1) {
            $returnArr = [
                "ResponseCode" => "200",
                "Result" => "true",
                "title" => "Country Code Add Successfully!!",
                "message" => "Country Code section!",
                "action" => "list_country_code.php",
            ];
        }
    } elseif ($_POST["type"] == "add_cover") {
        $cat_id = $_POST["cat_id"];
        $vendor_id = $sdata["id"];
        $status = $_POST["status"];
        $check_cover = $service->query(
            "select * from tbl_cover where cat_id=" .
                $cat_id .
                " and vendor_id=" .
                $vendor_id .
                ""
        )->num_rows;
        if ($check_cover != 0) {
            $returnArr = [
                "ResponseCode" => "200",
                "Result" => "false",
                "title" => "Cover Category Already Added",
                "message" => "Exist  Probblem!!",
                "action" => "add_Cover.php",
            ];
        } else {
            $table = "tbl_cover";
            $field_values = ["cat_id", "vendor_id", "status"];
            $data_values = ["$cat_id", "$vendor_id", "$status"];

            $h = new Fixxy();
            $check = $h->serviceinsertdata($field_values, $data_values, $table);
            if ($check == 1) {
                $returnArr = [
                    "ResponseCode" => "200",
                    "Result" => "true",
                    "title" => "Country Code Add Successfully!!",
                    "message" => "Country Code section!",
                    "action" => "list_Cover.php",
                ];
            } 
        }
    } elseif ($_POST["type"] == "edit_cover") {
        $cat_id = $_POST["cat_id"];
        $vendor_id = $sdata["id"];
        $id = $data["id"];
        $status = $_POST["status"];
        $check_cover = $service->query(
            "select * from tbl_cover where cat_id=" .
                $cat_id .
                " and vendor_id=" .
                $vendor_id .
                " and id!=" .
                $id .
                ""
        )->num_rows;
        if ($check_cover != 0) {
            $returnArr = [
                "ResponseCode" => "200",
                "Result" => "false",
                "title" => "Cover Category Already Added",
                "message" => "Exist  Probblem!!",
                "action" => "add_Cover.php",
            ];
        } else {
            $table = "tbl_cover";
            $field = ["cat_id" => $cat_id, "status" => $status];
            $where = "where id=" . $id . " and vendor_id=" . $vendor_id . "";
            $h = new Fixxy();
            $check = $h->serviceupdateData($field, $table, $where);

            if ($check == 1) {
                $returnArr = [
                    "ResponseCode" => "200",
                    "Result" => "true",
                    "title" => "Cover Update Successfully!!",
                    "message" => "Country Code section!",
                    "action" => "list_Cover.php",
                ];
            } 
        }
    } elseif ($_POST["type"] == "add_section") {
        $okey = $_POST["status"];
        $title = $service->real_escape_string($_POST["title"]);
        $catsearch = $_POST["catsearch"];

        $table = "tbl_section";
        $field_values = ["title", "status", "cat_id"];
        $data_values = ["$title", "$okey", "$catsearch"];

        $h = new Fixxy();
        $check = $h->serviceinsertdata($field_values, $data_values, $table);
        if ($check == 1) {
            $returnArr = [
                "ResponseCode" => "200",
                "Result" => "true",
                "title" => "Section  Add Successfully!!",
                "message" => "Section Operation!",
                "action" => "list_Section.php",
            ];
        } 
    } elseif ($_POST["type"] == "edit_section") {
        $okey = $_POST["status"];
        $title = $service->real_escape_string($_POST["title"]);
        $catsearch = $_POST["catsearch"];
        $id = $_POST["id"];
        $table = "tbl_section";
        $field = ["status" => $okey, "title" => $title, "cat_id" => $catsearch];
        $where = "where id=" . $id . "";
        $h = new Fixxy();
        $check = $h->serviceupdateData($field, $table, $where);
        if ($check == 1) {
            $returnArr = [
                "ResponseCode" => "200",
                "Result" => "true",
                "title" => "Section Update Successfully!!",
                "message" => "Section Operation!",
                "action" => "list_Section.php",
            ];
        } 
    } elseif ($_POST["type"] == "edit_faq") {
        $okey = $_POST["status"];
        $question = $service->real_escape_string($_POST["question"]);
        $answer = $service->real_escape_string($_POST["answer"]);
        $id = $_POST["id"];
        $table = "tbl_faq";
        $field = [
            "status" => $okey,
            "answer" => $answer,
            "question" => $question,
        ];
        $where = "where id=" . $id . "";
        $h = new Fixxy();
        $check = $h->serviceupdateData($field, $table, $where);
        if ($check == 1) {
            $returnArr = [
                "ResponseCode" => "200",
                "Result" => "true",
                "title" => "FAQ Update Successfully!!",
                "message" => "FAQ Code section!",
                "action" => "list_faq.php",
            ];
        } 
    } elseif ($_POST["type"] == "edit_code") {
        $okey = $_POST["status"];
        $title = $service->real_escape_string($_POST["title"]);
        $id = $_POST["id"];
        $table = "tbl_code";
        $field = ["status" => $okey, "ccode" => $title];
        $where = "where id=" . $id . "";
        $h = new Fixxy();
        $check = $h->serviceupdateData($field, $table, $where);
        if ($check == 1) {
            $returnArr = [
                "ResponseCode" => "200",
                "Result" => "true",
                "title" => "Country Code Update Successfully!!",
                "message" => "Country Code section!",
                "action" => "list_country_code.php",
            ];
        } 
    } elseif ($_POST["type"] == "code_delete") {
        $id = $_POST["id"];

        $table = "tbl_code";
        $where = "where id=" . $id . "";
        $h = new Fixxy();
        $check = $h->serviceDeleteData($where, $table);
        if ($check == 1) {
            $returnArr = [
                "ResponseCode" => "200",
                "Result" => "true",
                "title" => "Country Code Delete Successfully!!",
                "message" => "Country Code section!",
                "action" => "list_country_code.php",
            ];
        } 
    } elseif ($_POST["type"] == "faq_delete") {
        $id = $_POST["id"];

        $table = "tbl_faq";
        $where = "where id=" . $id . "";
        $h = new Fixxy();
        $check = $h->serviceDeleteData($where, $table);
        if ($check == 1) {
            $returnArr = [
                "ResponseCode" => "200",
                "Result" => "true",
                "title" => "FAQ Delete Successfully!!",
                "message" => "FAQ section!",
                "action" => "list_faq.php",
            ];
        } 
    } elseif ($_POST["type"] == "home_delete") {
        $id = $_POST["id"];

        $table = "tbl_section";
        $where = "where id=" . $id . "";
        $h = new Fixxy();
        $check = $h->serviceDeleteData($where, $table);
        $table = "section_item";
        $where = "where section_id=" . $id . "";
        $h = new Fixxy();
        $h->serviceDeleteData($where, $table);

        if ($check == 1) {
            $returnArr = [
                "ResponseCode" => "200",
                "Result" => "true",
                "title" => "Section Delete Successfully!!",
                "message" => "Section Operation!",
                "action" => "list_Section.php",
            ];
        } 
    } elseif ($_POST["type"] == "home_item_delete") {
        $id = $_POST["id"];

        $table = "section_item";
        $where = "where id=" . $id . "";
        $h = new Fixxy();
        $check = $h->serviceDeleteData($where, $table);

        if ($check == 1) {
            $returnArr = [
                "ResponseCode" => "200",
                "Result" => "true",
                "title" => "Section Item Delete Successfully!!",
                "message" => "Section Item Operation!",
                "action" => "list_Section_Item.php",
            ];
        } 
    } elseif ($_POST["type"] == "add_page") {
        $ctitle = $service->real_escape_string($_POST["ctitle"]);
        $cstatus = $_POST["cstatus"];
        $cdesc = $service->real_escape_string($_POST["cdesc"]);
        $table = "tbl_page";

        $field_values = ["description", "status", "title"];
        $data_values = ["$cdesc", "$cstatus", "$ctitle"];

        $h = new Fixxy();
        $check = $h->serviceinsertdata($field_values, $data_values, $table);
        if ($check == 1) {
            $returnArr = [
                "ResponseCode" => "200",
                "Result" => "true",
                "title" => "Page Add Successfully!!",
                "message" => "Page section!",
                "action" => "list_Page.php",
            ];
        } 
    } elseif ($_POST["type"] == "edit_page") {
        $id = $_POST["id"];
        $ctitle = $service->real_escape_string($_POST["ctitle"]);
        $cstatus = $_POST["cstatus"];
        $cdesc = $service->real_escape_string($_POST["cdesc"]);

        $table = "tbl_page";
        $field = [
            "description" => $cdesc,
            "status" => $cstatus,
            "title" => $ctitle,
        ];
        $where = "where id=" . $id . "";
        $h = new Fixxy();
        $check = $h->serviceupdateData($field, $table, $where);
        if ($check == 1) {
            $returnArr = [
                "ResponseCode" => "200",
                "Result" => "true",
                "title" => "Page Update Successfully!!",
                "message" => "Page section!",
                "action" => "list_Page.php",
            ];
        } 
    } elseif ($_POST["type"] == "page_delete") {
        $id = $_POST["id"];

        $table = "tbl_page";
        $where = "where id=" . $id . "";
        $h = new Fixxy();
        $check = $h->serviceDeleteData($where, $table);
        if ($check == 1) {
            $returnArr = [
                "ResponseCode" => "200",
                "Result" => "true",
                "title" => "Page Delete Successfully!!",
                "message" => "Page  section!",
                "action" => "list_Page.php",
            ];
        } 
    } elseif ($_POST["type"] == "edit_profile") {
        $dname = $_POST["email"];
        $dsname = $_POST["password"];
        $id = $_POST["id"];
        $table = "admin";
        $field = ["username" => $dname, "password" => $dsname];
        $where = "where id=" . $id . "";
        $h = new Fixxy();
        $check = $h->serviceupdateData($field, $table, $where);
        if ($check == 1) {
            $returnArr = [
                "ResponseCode" => "200",
                "Result" => "true",
                "title" => "Profile Update Successfully!!",
                "message" => "Profile  section!",
                "action" => "profile.php",
            ];
        } 
    } elseif ($_POST["type"] == "edit_setting") {
        $webname = mysqli_real_escape_string($service, $_POST["webname"]);
        $timezone = $_POST["timezone"];
        $currency = $_POST["currency"];
        $pstore = $_POST["pstore"];

        $id = $_POST["id"];

        $one_key = $_POST["one_key"];

        $one_hash = $_POST["one_hash"];
        $s_key = $_POST["s_key"];

        $s_hash = $_POST["s_hash"];

        $cov_fees = $_POST["cov_fees"];
        $d_key = $_POST["d_key"];
        $d_hash = $_POST["d_hash"];
        $scredit = $_POST["scredit"];
        $rcredit = $_POST["rcredit"];

        $target_dir = dirname(dirname(__FILE__)) . "/images/website/";
        $url = "images/website/";
        $temp = explode(".", $_FILES["weblogo"]["name"]);
        $newfilename = round(microtime(true)) . "." . end($temp);
        $target_file = $target_dir . basename($newfilename);
        $url = $url . basename($newfilename);
        if ($_FILES["weblogo"]["name"] != "") {
            
                move_uploaded_file(
                    $_FILES["weblogo"]["tmp_name"],
                    $target_file
                );
                $table = "tbl_setting";
                $field = [
                    "cov_fees" => $cov_fees,
                    "timezone" => $timezone,
                    "weblogo" => $url,
                    "webname" => $webname,
                    "currency" => $currency,
                    "pstore" => $pstore,
                    "one_key" => $one_key,
                    "one_hash" => $one_hash,
                    "d_key" => $d_key,
                    "d_hash" => $d_hash,
                    "s_key" => $s_key,
                    "s_hash" => $s_hash,
                    "scredit" => $scredit,
                    "rcredit" => $rcredit,
                ];
                $where = "where id=" . $id . "";
                $h = new Fixxy();
                $check = $h->serviceupdateData($field, $table, $where);

                if ($check == 1) {
                    $returnArr = [
                        "ResponseCode" => "200",
                        "Result" => "true",
                        "title" => "Setting Update Successfully!!",
                        "message" => "Setting section!",
                        "action" => "setting.php",
                    ];
                } 
            
        } else {
            $table = "tbl_setting";
            $field = [
                "cov_fees" => $cov_fees,
                "timezone" => $timezone,
                "webname" => $webname,
                "currency" => $currency,
                "pstore" => $pstore,
                "one_key" => $one_key,
                "one_hash" => $one_hash,
                "d_key" => $d_key,
                "d_hash" => $d_hash,
                "s_key" => $s_key,
                "s_hash" => $s_hash,
                "scredit" => $scredit,
                "rcredit" => $rcredit,
            ];
            $where = "where id=" . $id . "";
            $h = new Fixxy();
            $check = $h->serviceupdateData($field, $table, $where);
            if ($check == 1) {
                $returnArr = [
                    "ResponseCode" => "200",
                    "Result" => "true",
                    "title" => "Setting Update Successfully!!",
                    "message" => "Offer section!",
                    "action" => "setting.php",
                ];
            } 
        }
    } elseif ($_POST["type"] == "ban_delete") {
        $id = $_POST["id"];

        $table = "banner";
        $where = "where id=" . $id . "";
        $h = new Fixxy();
        $check = $h->serviceDeleteData($where, $table);
        if ($check == 1) {
            $returnArr = [
                "ResponseCode" => "200",
                "Result" => "true",
                "title" => "Banner Delete Successfully!!",
                "message" => "banner section!",
                "action" => "list_banner.php",
            ];
        } 
    } elseif ($_POST["type"] == "subcat_delete") {
        $id = $_POST["id"];
        $vendor_id = $sdata["id"];
        $table = "tbl_subcategory";
        $where = "where id=" . $id . " and vendor_id=" . $vendor_id . "";
        $h = new Fixxy();
        $check = $h->serviceDeleteData($where, $table);
        if ($check == 1) {
            $returnArr = [
                "ResponseCode" => "200",
                "Result" => "true",
                "title" => "Subcategory Delete Successfully!!",
                "message" => "Subcategory section!",
                "action" => "list_Subcategory.php",
            ];
        } 
    } elseif ($_POST["type"] == "cvimg_delete") {
        $id = $_POST["id"];
        $vendor_id = $sdata["id"];
        $table = "tbl_cover_images";
        $where = "where id=" . $id . "";
        $h = new Fixxy();
        $check = $h->serviceDeleteData($where, $table);
        if ($check == 1) {
            $returnArr = [
                "ResponseCode" => "200",
                "Result" => "true",
                "title" => "Cover Image Delete Successfully!!",
                "message" => "Cover Image section!",
                "action" => "list_Cover.php",
            ];
        } 
    } elseif ($_POST["type"] == "service_delete") {
        $id = $_POST["id"];
        $vendor_id = $sdata["id"];
        $table = "tbl_service";
        $where = "where id=" . $id . " and vendor_id=" . $vendor_id . "";
        $h = new Fixxy();
        $check = $h->serviceDeleteData($where, $table);
        if ($check == 1) {
            $returnArr = [
                "ResponseCode" => "200",
                "Result" => "true",
                "title" => "Service Delete Successfully!!",
                "message" => "Service section!",
                "action" => "list_Service.php",
            ];
        } 
    }
}
echo json_encode($returnArr);
