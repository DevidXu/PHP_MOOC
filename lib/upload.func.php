<?php

require_once "string.func.php";


function uploadFile($path) {
    $fileInfo = buildInfo();
    $i = 0;
    $uploadFiles = [];
    foreach ($fileInfo as $info) {
        $serverFile = uploadSingleFile($info, $path);
        if (!$serverFile) return false;
        $uploadFiles[$i] = $serverFile;
        $i++;
    }
    return $uploadFiles;
}



function buildInfo() {
    $i = 0;
    $files = [];
    foreach ($_FILES as $v) {
        if (is_string($v["name"])) {
            // single file
            $files[$i] = $v;
            $i++;
        }
        else {
            // multiple files
            foreach ($v["name"] as $key=>$val) {
                $files[$i]["name"] = $val;
                $files[$i]["size"] = $v["size"][$key];
                $files[$i]["tmp_name"] = $v["tmp_name"][$key];
                $files[$i]["type"] = $v["type"][$key];
                $files[$i]["error"] = $v["error"][$key];
                $i++;
            }
        }
    }
    return $files;
}


function uploadSingleFile($fileInfo, $path, $allowExt = array("gif", "jpeg", "jpg", "bmp"), $maxSize = 2097152, $imgFlag = false) {
    if (!file_exists($path)) {
        mkdir($path);
    }

    $serverFile = [];
    if ($fileInfo["error"]==UPLOAD_ERR_OK) {
        if (!is_uploaded_file($fileInfo["tmp_name"])) {
            $mes = "File is not uploaded with HTTP POST";
        }
        else {
            $ext = getExt($fileInfo["name"]);
            if (!in_array($ext, $allowExt)) {
                exit("Illegal file type");
            }
            else if ($imgFlag) {
                // verify real image
                $info = getimagesize($fileInfo["tmp_name"]);
                if (!$info) {
                    exit("Illegal file (not real image)");
                }
            }
            if ($fileInfo["size"]>$maxSize) {
                exit("File larger than 2M");
            }

            // store as random name to avoid repeat
            $fileName = getUniName().".".$ext;
            $serverFile["name"] = $fileName;
            $serverFile["type"] = $fileInfo["type"];
            $serverFile["size"] = $fileInfo["size"];
            $destination = $path."/{$fileName}";

            if (!move_uploaded_file($fileInfo["tmp_name"], $destination)) {  // move temp-name file to destination
                exit("Fail to upload the file");
            }

        }
    }
    else {
        switch ($fileInfo["error"]) {
            case UPLOAD_ERR_INI_SIZE: $mes = "Larger than configured file size limit";
            case UPLOAD_ERR_FORM_SIZE: $mes = "Larger than form-set file size limit";
            case UPLOAD_ERR_PARTIAL: $mes = "Only part of file is uploaded";
            case UPLOAD_ERR_NO_FILE: $mes = "No file uploaded";
            case UPLOAD_ERR_NO_TMP_DIR: $mes = "No temp directory found";
            case UPLOAD_ERR_CANT_WRITE: "File cannot be written";
            case UPLOAD_ERR_EXTENSION: $mes = "Extension of PHP interrupts file uploading";
        }
    }
    return $serverFile;
}

// configure on server side:
// php.ini: max size is 2M
// post_max_size: 8M
// configure on client side:
//
?>