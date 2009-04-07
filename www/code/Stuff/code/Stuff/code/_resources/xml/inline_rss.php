<?PHP
// $xml and $xsl can be local or remote
// local paths must be absolute, from /
// age is optional, if specified the result
// is cached as 'md5 of $feed'.xml
function feedgraber($xml_path, $xsl_path, $max_age = 0, $cache_dir = '.')
{	
	$cachepath = $cache . '/' . md5($xml_path);

	// Get cached version

	// If not exists, grab it & cache it

	// if xsml or xsl is empty/null return null

	// Grab XSL

	// Transform, return result.
	// feedgraber_xsl_transform($xml, $xsl)

	
	var_dump($result);
}

function feedgrabber_get_file($filepath)
{
	$curl_exists = function_exists('curl_init');
	$is_local = null;
	
	// if local, or no CURL
	if ($is_local || !$curl_exists) {
		$contents = file_get_contents($filepath);
	}
	else {

		$curl_handle = curl_init();
		curl_setopt($curl_handle,CURLOPT_URL,$filepath);
		curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,10);
		curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
		$contents = curl_exec($curl_handle);
		curl_close($curl_handle);
	}
	return $contents;
}

function feedgraber_xsl_transform($xml, $xsl)
{	
	$php5 = PHP_VERSION >= 5;
	$php4_dom_xml = function_exists('domxml_open_mem') && function_exists('domxml_xslt_stylesheet');
	$php4_xslt = function_exists('xslt_create');

	if ($php5) {
		$XSLT = new XSLTProcessor();
		$XSLT->importStyleSheet(DOMDocument::loadXML($xsl));
		$result = $XSLT->transformToXML(DOMDocument::loadXML($xml));   
	}
	elseif ($php4_dom_xml) {
	
		if (!$domXml = domxml_open_mem($xml)) {
			trigger_error('Inline RSS: Error parsing XML document', E_USER_WARNING);
		}

		$domXsltObj = domxml_xslt_stylesheet($xsl);
		$domTranObj = $domXsltObj->process($domXml);
		$result = $domXsltObj->result_dump_mem($domTranObj);
	}
	elseif ($php4_xslt) { 
	
		$arguments = array ('/_xml' => $xml, '/_xsl' => $xsl);
		$xslt_inst = xslt_create();    
		$result = xslt_process($xslt_inst, 'arg:/_xml', 'arg:/_xsl', NULL, $arguments);
		xslt_free($xslt_inst);
	}
	else {  
		trigger_error('Inline RSS: No compatible XSLT Engine found', E_USER_WARNING);
	}
	return $result;  
}