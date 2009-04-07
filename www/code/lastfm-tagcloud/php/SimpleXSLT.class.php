<?php

/*
	Based loosely on Cal Demaine's wordpress plugin inlineRSS
	(v1.1 - http://www.iconophobia.com/) 
	
	h2. Notes
	
	This is a stripped down, less OO version of the original.
	
	
	h2. To do
	* Allow pasing of strings, local paths or remote paths for xml and .xsl
	* Better function name
	* SIMPLE caching
	* Add caching setter function;
	** mode: none, input (local vs remote), output, all
	** dir
	** timout
	
*/

class SimpleXSLT
{
		
	function SimpleXSLT()
	{
			
	}

	function transform($xml, $xsl)
	{
		$xml = $this->loadFile($xml);
		$xsl = $this->loadFile($xsl);	
		
		return $this->doXSL($xml, $xsl);
	}
	
	function doXSL($xml, $xsl)
	{
			
		$xsl1 = PHP_VERSION >= 5;
		$xsl2 = function_exists('domxml_open_mem') && function_exists('domxml_xslt_stylesheet');
		$xsl3 = function_exists('xslt_create');
		
		if ($xsl1) {
			
          $xslt = new xsltProcessor;
          $xslt->importStyleSheet(DomDocument::loadXML($xsl));
          $xslt_result = $xslt->transformToXML(DomDocument::loadXML($xml));   
        } 
		elseif ($xsl2) { 
			// PHP 4 DOM_XML support
          if (!$domXml = domxml_open_mem($xml)) {
            $result = "Error while parsing the xml document\n";
          }
    
          $domXsltObj = domxml_xslt_stylesheet( $xsl );
          $domTranObj = $domXsltObj->process( $domXml );
          $xslt_result = $domXsltObj->result_dump_mem( $domTranObj );
        }
		elseif ($xsl3) {  // PHP 4 XSLT library
			
          $arguments = array (
            '/_xml' => $xml,
            '/_xsl' => $xsl
          );
    
          $xslt_inst = xslt_create();    
          $xslt_result = xslt_process($xslt_inst,'arg:/_xml','arg:/_xsl', NULL, $arguments);
          xslt_free($xslt_inst);
        }
		else {
			// error
			$failed = true;
			$failure_reason = 'No XSLT Available';
		}
		
		if ($failed) {
			trigger_error("XSTL Failed - $failure_reason" , E_USER_ERROR);
		}
		
		return $xslt_result;
	}
	
	function loadFile($file_path)
	{
		$curl_available = function_exists('curl_init');
		$is_local_resource = !stristr($file_path, 'http:');
		
		if ($is_local_resource || !$curl_available) {
			
			$response = file_get_contents($file_path);
		}
		else {
			
			$curl_handle = curl_init();

			$options = array(
				CURLOPT_URL => $file_path,
				CURLOPT_CONNECTTIMEOUT => 10,
				CURLOPT_RETURNTRANSFER => 1,
			);

			foreach ($options as $option => $value) {
				curl_setopt($curl_handle, $option, $value);
			}
					
			$response = curl_exec($curl_handle);
			curl_close($curl_handle);
		}
		
		return $response;
	}
}

?>