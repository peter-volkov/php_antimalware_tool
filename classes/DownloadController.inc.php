<?php

ob_start();
require_once("Archiver.inc.php");
require_once("Auth.inc.php");
ob_end_clean();

session_start();

class DownloadController {

    function streamFileContent($filename, $need_to_delete = false) {
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private",false);
        header("Content-Type: application/zip");
        header("Content-Disposition: attachment; filename=".basename($filename).";" );
        header("Content-Transfer-Encoding: binary");
        header("Content-Length: ".filesize($filename));
        readfile($filename);              

        if ($need_to_delete) {
           unlink($filename);
        }
    }

    function getPackedArchive() {
        global $project_tmp_dir; 

        $log_filename = $project_tmp_dir . '/scan_log.xml';
     	$packed_log_filename = $log_filename . '.zip';

        if (!is_file($log_filename)) {
            die(PS_ERR_NO_DOWNLOAD_LOG_FILE);
        }

        $xml_data = file_get_contents($log_filename);

        $archiver = new Archiver($packed_log_filename, 'w');
        $archiver->createFile(basename($log_filename), $xml_data);
        $archiver->close();

        $this->streamFileContent($packed_log_filename, true);
        unlink($log_filename);        
    }

    function getQuarantine() {
        $quarantine_filename = $_SESSION['quarantine_file'];
        if (!is_file($quarantine_filename)) {
            die(PS_ERR_NO_QUARANTINE_FILE);
        }

        $this->streamFileContent($quarantine_filename, true);
        unset($_SESSION['quarantine_file']);
        exit;
    }



    function start() {
        switch ($_GET['f']) {
           case 'report': $this->getPackedArchive();
                    break; 
           case 'quarantine': $this->getQuarantine();
                    break; 
        }
    }


}