<?php
class HTTPResponse {
	protected $cors=FALSE;
	protected $response_code=200;
	protected $data;		//array of data in this response
	protected static $http_response = array(
		200 => 'OK',
		201 => 'Created',
		202 => 'Accepted',
		303 => 'See Other',
		400 => 'Bad Request',
		401 => 'Unauthorized',
		402 => 'Wrong Password',
		403 => 'Forbidden',
		404 => 'Not Found',
		406 => 'Not Acceptable',
		409 => 'Conflict',
		500 => 'Internal Server Error',
		501 => 'Not Implemented'
	);
	
	protected static $cors_allowed_origins = array(
		// 'http://locahost/',
		// 'http://locahost:4200/',
		'*'
	);
	
	/***
	 * Adds a domain to CORS allowed origins
	 ***/
	static function addCORSAllowedOrigin($origin) {
		self::$cors_allowed_origins[] = $origin;
	}

	//Default function: make invalid method calls throw Exceptions
	function __call($name, $arguments) {
		throw new Exception ('Error in HTTPResponse class: method '.$name.'() does not exist');
	} //call()
	
	/*
	 * Construct with return code
	 */
	function __construct($a=200) {
		 $this->response_code = $a;
		$this->data = array();
		if (in_array("*", self::$cors_allowed_origins)) {
			$this->cors = TRUE;
		}else {
			if(isset($_SERVER['HTTP_ORIGIN']) && in_array($_SERVER['HTTP_ORIGIN'], self::$cors_allowed_origins)) {
			
				$this->cors = TRUE;
			} else {
				$this->cors = FALSE;
			}
		}
	} //construct()
	
	/*
	 * Deliver the HTTP Response
	 * Will return format according to client "HTTP Accept" header.
	 * Priority:
	 * - JSON, Javascript, XML, HTML
	 */
	function deliver() {
		header('HTTP/1.1 '.$this->response_code.' '.self::$http_response [$this->response_code]);

		// Check for CORS
		if ($this->cors) {
			header('Access-Control-Max-Age: 1728000');
			header('Access-Control-Allow-Origin: '.$_SERVER['HTTP_ORIGIN']);
			header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
			header('Access-Control-Allow-Credentials: true');
			header('Access-Control-Allow-Headers: Authorization,content-Type');
		}
 
		// Process different return formats (MIME content-types)
		$format = 'application/json';
		if (strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false) $format = 'application/json';
		else if (strpos($_SERVER['HTTP_ACCEPT'], 'application/javacsript') !== false) $format = 'application/javascript';
		else if (strpos($_SERVER['HTTP_ACCEPT'], 'text/xml') !== false) $format = 'text/xml';
		
		if($format == 'application/json'){
			header('Content-Type: application/json; charset=utf-8');
 			echo json_encode($this->data);
	    } //JSON
		elseif ($format == 'application/javascript'){
			header('Content-Type: application/json; charset=utf-8');
			
	        echo $_GET['callback'].'('. json_encode($this->data) .');';
    	} //JSONP
		elseif($format == 'text/xml'){
			header('Content-Type: application/xml; charset=utf-8');
			$xml_response = '<?xml version="1.0" encoding="UTF-8"?>'."\n";
			$xml_response .= '<response>';
			$xml_response .= array2xml($this->data);
			$xml_response .= '</response>';
		
			echo $xml_response;
		} //XML
		else{
			header('Content-Type: text/html; charset=utf-8');
			echo '<html><head>';
			echo '<title>'.SITE_NAME.' - '. self::$http_response [$this->response_code].'</title></head><body>';
			echo '<h1>'.self::$http_response [$this->response_code].'</h1>';
			echo '<table border="1" bgcolor="#DDDDDD" cellpadding="5" cellspacing="0" >';
			foreach ($this->data as $k => $v) {
				echo '<tr>';
				echo '<td align="right" valign="top"><strong><em>'.$k.':</em></strong></td>';
				echo '<td width="300">'.print_r($v, TRUE).'</td>';
				echo '</tr>';
			}
			echo '</table>';
			echo '</body></html>';		
		} //HTML
		exit(0);
	} //deliver()
	
	/***
	 * Serves a file as download
	 * - requires full file path
	 ***/
	function serveDownload($file_path) {
		if (!file_exists($file_path)) {
			$this->response_code = 404;
			$this->deliver();
		}
		
		//Serve the file
		$file_name = basename($file_path);
		header('HTTP/1.1 200 OK');
		header("Content-disposition: attachment; filename=$file_name");
		header("Content-type: application/php");
		readfile($file_path);
		exit(0);
	} //serveDownload()
	
	/***
	 * Serves a file as image
	 * - requires full file path
	 ***/ 
	function serveImage($file_path) {
		if (!file_exists($file_path)) {
			$this->response_code = 404;
			$this->deliver();
		}
		
		//Serve the file
		header('HTTP/1.1 200 OK');
		header("Content-type: image/jpeg");
		readfile($file_path);
		exit(0);
	} //serveImage()
	
	/*
	 * Sets response code
	 * Param: int of HTTP response
	 */
	function setResponseCode($c) {
		if (!isUnsignedInt($c)) throw new Exception ('Error in HTTPResponse setResponseCode: expecting int, got '.$c.' ('.gettype($c).')');
		$this->response_code = $c;
	} //setResponseCode()
	
	/*
	 * Note: sets the ENTIRE data
	 */
	function setData($d){
		if (is_array($d)) $this->data = $d;
		else throw new Exception ('Error in HTTPResponse setData: expecting array, got '.$d.' ('.gettype($d).')');
	} //setData()
	
	/*
	  * Adds to response data (dynamic)
	  * Note: will overwrite existing values!
	  */
	function addData($key, $value) {
		if (is_null($key)) throw new Exception ('Error in HTTPResponse addData(): $key is null');
		else $this->data[$key] = $value;
	} //addData()
		
	function getData($k=NULL) {
		if (isset($k)) return $this->data[$k];
		else return $this->data;
	} //getData()
} //class HTTPResponse