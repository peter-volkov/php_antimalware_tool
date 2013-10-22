<?php
require_once("FileInfo.inc.php");

class WhiteListBuilder
{
    function __construct($start_path, $wl_filename) {
         $this->wl_filename = $wl_filename;
         $this->root_path = $start_path;

         $this->dom = new DOMDocument("1.0", "utf-8");
         $this->dom->formatOutput = true;

         $this->files_node = $this->dom->createElement("files");
         $this->dom->appendChild($this->files_node);
    }
     

    function generate() {
       chdir($this->root_path);
       $this->recursive_scan('.', 1);
       chdir('..');

       $exclude_array = array('ctime', 'mtime', 'owner', 'access');

       foreach ($exclude_array as $item) {
          $els = $this->dom->getElementsByTagName($item);
          for ($i = $els->length; --$i >= 0; ) {
            $el = $els->item($i);
            $el->parentNode->removeChild($el);
          }
       }

       $this->dom->save($this->wl_filename);
    }

  function recursive_scan($path, $recurs) {
	global $find, $files;
	if ($dir = opendir($path)) {
	        while($file = readdir($dir)) {
		    if ($file == '.' or $file == '..' or is_link($file)) continue;

		    $name = $file;
		    $file = $path . '/' . $file;

		    if (is_dir($file) && $recurs)  {
			$this->recursive_scan($file, 1);
		    }

       		    $fileinfo = new FileInfo($file);
                    $fileinfo_node = $fileinfo->getXMLNode();
                    $new_node = $this->dom->importNode($fileinfo_node, true);

                    $this->dom->documentElement->appendChild($new_node);

                    echo $file . "\n";

		}  

		closedir($dir);
 	}
  }

} // END
