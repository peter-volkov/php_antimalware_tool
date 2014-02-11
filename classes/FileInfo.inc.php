<?php

class FileInfo {
    public function __construct($file_path) {

        $this->web_root_dir = $_SERVER['DOCUMENT_ROOT'] ;
        $this->getInfoByName($file_path);
    }

    public function getInfoByName($file_path) {

        $this->MAX_FILE_SIZE_FOR_HASHING = 1024 * 1024;
 
        if (file_exists($file_path)) {    
 
            $this->absolute_name = $file_path;
            $this->name = str_replace($this->web_root_dir, '.', $file_path);;
            $this->ctime = filectime($file_path);
            $this->mtime = filemtime($file_path);            
            $ownerInfo = posix_getpwuid(fileowner($file_path));
            $this->owner = $ownerinfo['name'];
            $groupInfo = posix_getgrgid(filegroup($file_path));
            $this->group = $groupInfo['name'];
            $this->access = substr(sprintf('%o', fileperms($file_path)), -4);
            
            if (is_file($file_path)) {
                $this->size = filesize($file_path);
               
                if ($this->size <= $this->MAX_FILE_SIZE_FOR_HASHING) {
                    $this->md5 = hash_file('md5', $file_path);                   
                }  else {
                    $this->md5 = 0;
                }
                 
            } else {
                $this->size = 0;
                $this->md5 = 0;
            }
       	} else die(PS_ERR_NO_SUCH_FILE);

        return true;
    }

    public function getXMLNode() {
        $dom = new DOMDocument("1.0", "utf-8");
        $fileinfo_node = $dom->createElement("file");
        $fileinfo_node->appendChild($dom->createElement("path", $this->name));
        $fileinfo_node->appendChild($dom->createElement("size", $this->size));
        $fileinfo_node->appendChild($dom->createElement("ctime", $this->ctime));
        $fileinfo_node->appendChild($dom->createElement("mtime", $this->mtime));
        $fileinfo_node->appendChild($dom->createElement("owner", $this->owner));
        $fileinfo_node->appendChild($dom->createElement("group", $this->group));
        $fileinfo_node->appendChild($dom->createElement("access", $this->access));
        $fileinfo_node->appendChild($dom->createElement("md5", $this->md5));
        $dom->appendChild($fileinfo_node);
        return $dom->getElementsByTagName("file")->item(0);
    }

    public function __toString() {
        $data = array($this->name, $this->size, $this->ctime, $this->mtime, $this->owner, $this->group, $this->access, $this->md5);
        return implode(';', $data);
    }
}


