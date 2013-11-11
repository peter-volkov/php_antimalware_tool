<?php

class FileInfo
{	

	public function __construct($file_path)
	{
		$this->getInfoByName($file_path);
	}
	
	public function getInfoByName($file_path)
	{
		if (file_exists($file_path))
		{
			$this->name = $file_path;
			$this->ctime = filectime($file_path);
			$this->mtime = filemtime($file_path);
			$this->owner = fileowner($file_path); 
			$this->access = fileperms($file_path);                                           

			if (is_file($file_path)) {
			   $this->size = filesize($file_path);
			   $this->crc32 = hash_file('crc32b', $file_path);
			   $this->crc32b = hash_file('crc32', $file_path);
			   $this->md5 = hash_file('md5', $file_path);
			   $this->md2 = hash_file('md2', $file_path);
			} else {
			   $this->size = 0;
			   $this->crc32 = 0;
			   $this->crc32b = 0;
			   $this->md5 = 0;
			   $this->md2 = 0;
			}

		} else die("no such file.");
	}

	public function getXMLNode()
	{   
        $dom = new DOMDocument("1.0", "utf-8");

		$fileinfo_node = $dom->createElement("file");

    		$fileinfo_node->appendChild($dom->createElement("path",$this->name));
    		$fileinfo_node->appendChild($dom->createElement("size",$this->size));
	    	$fileinfo_node->appendChild($dom->createElement("ctime",$this->ctime));
	    	$fileinfo_node->appendChild($dom->createElement("mtime",$this->mtime));
	    	$fileinfo_node->appendChild($dom->createElement("owner",$this->owner));
	    	$fileinfo_node->appendChild($dom->createElement("access",$this->access));
	    	$fileinfo_node->appendChild($dom->createElement("crc32b",$this->crc32b));
	    	$fileinfo_node->appendChild($dom->createElement("crc32",$this->crc32));
		    $fileinfo_node->appendChild($dom->createElement("md5",$this->md5));
		    $fileinfo_node->appendChild($dom->createElement("md2",$this->md2));
        		
		$dom->appendChild($fileinfo_node);

        return $dom->getElementsByTagName("file")->item(0);

	}

	
	public function __toString()
	{   
        $data = array($this->name, $this->size, $this->lastmodified, $this->md5);    
		return implode(';', $data);
	}

}