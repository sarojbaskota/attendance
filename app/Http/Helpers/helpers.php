<?php 
if (! function_exists('fileUpload')) {
    function fileUpload($filepath, $file) {
        $file_name = time().'.'.$file->getClientOriginalExtension();
        $file->move($filepath, $file_name);
        return $file_name;
    }
}
