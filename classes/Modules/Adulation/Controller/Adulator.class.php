<?php

namespace Modules\Adulation\Controller;

class Adulator extends \Modules\Adulation\Model\Adulator {
    
	public function recombine(){

		$adgroup = $this->args['adgroup'];
		$url = $this->args['url'];
		$path1 = $this->args['path1'];

		$path2 = $this->args['path2'];

		$first_headlines = $this->args['first_headlines'];
		$second_headlines = $this->args['second_headlines'];
		$descs = $this->args['descs'];

		$return = array();

	    if(!isset($first_headlines)){
	    	$first_headlines[] = 'WARNING: No data posted for H1 elements, Adulator/view/line 22';	 
	    }
	    if(!isset($second_headlines)){
	    	$second_headlines[] = 'WARNING: No data posted for H2 elements, Adulator/view/line 24';
	    }
	    if(!isset($descs)){
	    	$descs[] = 'WARNING: No data posted for P elements, Adulator/view/line 27';
	    }



	    foreach($first_headlines as $prime){

	        $prime = trim($prime);
	        if(strlen($prime) > 0 ){
	        
	            foreach($second_headlines as $sec){

	                $sec = trim($sec);

	                if(strlen($sec) > 0 && $prime != $sec ){

	                    if(isset($descs) && !empty($descs)){
	                        foreach($descs as $tet){
	                            if(strlen($tet) > 0 && $sec != $tet ){   
	                             $return[] =  array($adgroup,'Headline','Enabled','All',$url,$prime,$sec,$tet,$path1,$path2);
	                            }
	                        }
	                    }
	                }
	            }
	        }       
	    }

	    return $return;
	}

	public function sortScrape($scrape,$args){
		$return = array();

		foreach($scrape[0] as $k => $v){
			if(!empty($v["headlines"]["h1"])){		
				$return["first_headlines"] = $v["headlines"]["h1"];
			}
			else{
				$return["first_headlines"] = array('No H1 Tags Found');
			}
			if(!empty($v["headlines"]["h2"])){

				$return["second_headlines"] = $v["headlines"]["h2"];
			}
			else{
				$return["second_headlines"] = array('No H2 Tags Found');
			}
			if(!empty($v["paragraphs"])){			
				$return["descs"] = $v["paragraphs"];
			}
			else{
				$return["descs"] = array('No P Tags Found');
			}
			if($args['include titles'] == true){
				if($args['split title'] == true){
					$splits = preg_split('/\||-/', $v["title"] ); 
					foreach($splits as $split){
						$return["first_headlines"][] = 	$split;
					}	
				}
				else{
					$return["first_headlines"][] = $v["title"];					
				}
			}
			if($args['include metas'] == true){
				$return["descs"][] = $v["description"];
			}
		}

		return $return;
	}
}

?>