<?php

class Utils
{
        static function get_uploaded_file($filename)
        {
          $uploaded = null;
          if (isset($HTTP_POST_FILES[$filename]['tmp_name']))
        	$uploaded = $HTTP_POST_FILES[$filename]['tmp_name'];
          elseif (isset($_FILES[$filename]['tmp_name']))
        	$uploaded = $_FILES[$filename]['tmp_name'];
          return $uploaded;
        }
}
