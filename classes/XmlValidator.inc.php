<?php
class XmlValidator {
    function libxmlDisplayError($error) {
        $return = "<br/>\n";
        switch ($error->level) {
            case LIBXML_ERR_WARNING:
                $return.= "<b>Warning $error->code</b>: ";
            break;
            case LIBXML_ERR_ERROR:
                $return.= "<b>Error $error->code</b>: ";
            break;
            case LIBXML_ERR_FATAL:
                $return.= "<b>Fatal Error $error->code</b>: ";
            break;
        }
        $return.= trim($error->message);
        if ($error->file) {
            $return.= " in <b>$error->file</b>";
        }
        $return.= " on line <b>$error->line</b>\n";
        return $return;
    }
    function libxmlDisplayErrors() {
        $errors = libxml_get_errors();
        foreach ($errors as $error) {
            print $this->libxmlDisplayError($error);
        }
        libxml_clear_errors();
    }
    function validate($xml_str, $schema_path) {
        libxml_use_internal_errors(true);
        $xml = new DOMDocument();
        
        $xml->loadXML($xml_str);
       
        if (!$xml->schemaValidate($schema_path)) {
            print '<b>DOMDocument::schemaValidate() Generated Errors!</b>';
            $this->libxmlDisplayErrors();
            return false;
        }
        return true;
    }
}

