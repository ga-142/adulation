<?php

/*
  ___                                               ___                                 
 -   -_,            ,,                             -   -_,                      /\ 
(  ~/||             ||                            (  ~/||  ;        _           \/ 
(  / ||  \\/\\  _-_ ||/\\  /'\\ ,._-_  _-_,       (  / ||  \\/\/\  < \, '\\/\\  }{ 
 \/==||  || || ||   || || || ||  ||   ||_.         \/==||  || | |  /-||  || ;'  \/ 
 /_ _||  || || ||   || || || ||  ||    ~ ||        /_ _||  || | | (( ||  ||/       
(  - \\, \\ \\ \\,/ \\ |/ \\,/   \\,  ,-_-        (  - \\, \\/\\/  \/\\  |/     <> 
                      _/                                                (               
									  P___----....
									! __
						  ' ~~ ---.#..__ `  ~  ~    -  -  .   .:
						   `             ~~--.               .F~~___-__.
						   ;                   ,       .- . _!  
						  ,                     '       ;      ~ .
						 ,        ____           ;      ' _ ._    ; 
						,_ . - '___#,  ~~~ ---. _,   . '  .#'  ~ .;
					  =---==~~~    ~~~==--__     ; '~ -. ,#_     .'
					   '                     `~=.;           `  /
												 '  '          '.      
						'                         '               
				\                                  ' '            '
				`.`\    '                          . ;             ,
				  \  `  '                            '             ;
				   ;   '                           '               '
				 /_ .,                           /   __...---./   '
				 ',_,   __.--- ~~;#~ --..__    _'.-~;#     //  `.'
				 / / ~~ .' .     #;         ~~  /// #;   //   /
			   /    ' . __ .  ' ;#;_ .        ////.;#;./ ;  /
			   \ .        /    ,##' /   _   /. '(/    ~||~\'
				\  ` - . /_ . -==-  ~ '   / (/ '     . ;;. ', 
			   /' .       ' -^^^...--- ``(/'    _  '   '' `,;
	##,. .#...(       '   .c  c .c  c  c.    '..      ;; ../ 
	%%#%;,..##.\_                           ,;###;,. ;;.:##;,.    
	%%%%########%%%%;,.....,;%%%%%%;,.....,;%%%%%%%%%%%%%%%%%%%%............              
*/


class AnchorsAway {


	public $id;

	public $plunder; 

	public $trash; 

	public $return = array();

	function __construct(){
		$this->id = rand(100,1000000);
	}

	function __set($plunder,$trash){
		$this->plunder = $plunder;
		$this->trash = $trash;
	}



	function anchorsAway($url, $plunder, $depth = 2)
	{
		
	    static $seen = array();
		//stop if either of these are true
	    if (isset($seen[$url]) || $depth === 0) {
	        return;
	    }
		
		//log seen pages 
	    $seen[$url] = true;
		//get the DOM
	    $dom = new \DOMDocument('1.0');
		//parse the url into DOM object  
	    @$dom->loadHTMLFile($url);
		
		//add dom and url to plunder args 
		$resources['dom'] = $dom;
		$resources['url'] = $url;
		
		//get the anchor tags
	    $anchors = $dom->getElementsByTagName('a');
		//loop through anchors 
	    foreach ($anchors as $element) {
			//get the hrefs
	        $href = $element->getAttribute('href');
			//if the url doesnt start with http, relative url detection and global url reconstruction
	        if (0 !== strpos($href, 'http')) {
				//add a slash,but remove slashes if they are present. "/something" or "something" both return "/somthing"
	            $path = '/' . ltrim($href, '/');
				
				//if we still have http somewhere, go ahead and build url
	            if (extension_loaded('http')) {
	                $href = http_build_url($url, array('path' => $path));
	            } else {
					//parse the url in parts 'scheme' == http || https and 'host' = domain
	                $parts = parse_url($url);
					//add domain and ://
	                $href = $parts['scheme'] . '://';
					//if parts 'user' and 'pass' exist
	                if (isset($parts['user']) && isset($parts['pass'])) {
						//add them back at the begining
	                    $href .= $parts['user'] . ':' . $parts['pass'] . '@';
	                }
					//add host "domain"
	                $href .= $parts['host'];
					//add port if set
	                if (isset($parts['port'])) {
	                    $href .= ':' . $parts['port'];
	                }
					//finally add the path back in, we now now have constructed our full global url from a relative one
	                $href .= $path;
	            }
	        }
			//recursive call
	        $this->anchorsAway($href,$plunder, $depth - 1);	
	    }

	    $this->return[] = $this->plunder($plunder,$resources);

		
	}


	function plunder($plunder, $resources){

		$dom = $resources['dom'];
		$url = $resources['url'];
		$finder = new \DomXPath($dom);
		$booty = array();
		//get title tags
		if(isset($plunder['titles'])){
			$titles = $dom->getElementsByTagName("title");	
			if(isset($titles->item(0)->textContent)){
				$title = $titles->item(0)->textContent;	
			}
		}	
		if(isset($plunder['metas'])){
			//get meta tags
			$metas = @get_meta_tags($url);
		}

		if(isset($plunder['drop dashes'])){
			$url_key = str_replace('-'," ",basename($url));
		}
		else{
			$url_key = basename($url);
		}
		$booty[$url_key] = array();
		
		
		if(isset($title)){
			$booty[$url_key]['title'] = addslashes($title);
		}
		if(isset($metas['description'])){
			$booty[$url_key]['description'] = addslashes($metas['description']);
		}
		if(isset($metas['keywords'])){
			$booty[$url_key]['keywords'] = addslashes($metas['keywords']);
		}
		
		//scrape images
		if(isset($plunder['img'])){
			$booty[$url_key]['imgs'] = array();
			//get images 
			$images = $dom->getElementsByTagName("img");
			
			//iterate through and get paths
			foreach($images as $image){
				$image_paths[]=urldecode($image->getAttribute('src'));
			}
			//filter out all null, false and empty values
			$image_paths = array_filter($image_paths,'strlen');
			//reset keys after removing empties
			$image_paths = array_values($image_paths);
			//write our array
			foreach($image_paths as $key => $image_path){
				$booty[$url_key]['imgs'][$key] = $image_path;
			}

		}
		

			if(isset($plunder['elements by id'])){
				
				$element = $dom->getElementById($plunder['elements by id'])->textContent;
				$booty[$url_key]['text content'] = trim($element);

			}
			if(isset($plunder['img xpath'])){
				
				$xpath = $plunder['img xpath'];

				$content = $finder->query($xpath);
				
				foreach ($content as $img) {
					$booty[$url_key]['xpath imgs'][] = $img->getAttribute('src');
				}
				if(isset($plunder['download imgs'])){
					
					foreach ($booty[$url_key]['xpath imgs'] as $key => $value) {
								
						$path_info = pathinfo($value);		
								
						if(!file_exists('./upload/media/'.$url_key.'.'.$path_info['extension'])) {
							$ch = curl_init($value);
							if($ch !== false) {
								$fp = fopen('./upload/media/'.$url_key.'.'.$path_info['extension'], 'w');
								if(curl_setopt($ch, CURLOPT_FILE, $fp) === false)
									echo " - FAIL CURLOPT_FILE";
								if(curl_setopt($ch, CURLOPT_HEADER, 0) === false)
									echo " - FAIL CURLOPT_HEADER";
								if(curl_exec($ch) === false)
									echo " - FAIL CURL_EXEC";
								curl_close($ch);
								fclose($fp);
								echo " - SUCCESS<br>";
							} else {
								echo " - FAIL INIT<br>";
							}
						} else {
							echo " - EXISTS<br>";
						}
					
					}
				}

			}
			if(isset($plunder['description xpath'])){
				
				$xpath = $plunder['description xpath'];
				
				$content = $finder->query($xpath);
				
				foreach ($content as $desc) {
					$booty[$url_key]['xpath description'][] = $desc->textContent;
				}
			}
			if(isset($plunder['children xpath'])){
				
				$xpath = $plunder['children xpath'];
				
				$content = $finder->query($xpath);
				

				foreach ($content as $desc) {
					
					
					var_dump(DOMinnerHTML($desc));
					
					
					$booty[$url_key]['xpath html'][] = $desc;

				}
			}
			if(isset($plunder['headlines'])){

		
				$h1s = $dom->getElementsByTagName("h1");
				$h2s = $dom->getElementsByTagName("h2");


				
				foreach ($h1s as $headline) {
					$booty[$url_key]['headlines']['h1'][] = $headline->textContent;

				}
				foreach ($h2s as $headline) {
					$booty[$url_key]['headlines']['h2'][] = $headline->textContent;

				}
			}
			if(isset($plunder['paragraphs'])){

		
				$paragraphs = $dom->getElementsByTagName("p");

				foreach ($paragraphs as $paragraph) {
					
					$store = htmlspecialchars_decode($paragraph->textContent);


					if( strlen($store) >= 10 ){
						$booty[$url_key]['paragraphs'][] = $store;
					}

				}

			}

			return $booty;

	}

	function DOMinnerHTML(DOMNode $element) 
	{ 
	    $innerHTML = ""; 
	    $children  = $element->childNodes;

	    foreach ($children as $child) 
	    { 
	        $innerHTML .= $element->ownerDocument->saveHTML($child);
	    }

	    return $innerHTML; 
	} 



}






?>




