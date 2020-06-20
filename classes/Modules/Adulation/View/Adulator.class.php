<?php

namespace Modules\Adulation\View;

class Adulator extends \Modules\Adulation\Controller\Adulator {
    
	public function adulate($output,$file_id){
		$file = fopen("files/output". $file_id.".csv","w");
		fputcsv($file,array('Ad Group', 'Click type',	'Ad status','Device preference','Final URL','Headline 1','Headline 2','Description','Path 1','Path 2'
		));
		foreach ($output as $out)
		  {
		  fputcsv($file,$out);
		  }
		fclose($file);
		return $file;
	}
	
	public function printItems($items,$item_class,$max_char){

		$counter = 1;
		if(is_null($items)){

			echo '<div class="input-wrap">';
			echo 
				"<label class=\"{$item_class}-label\" for=\"{$item_class}-{$counter}\">Version {$counter}</label>
					<div class=\"textarea-wrap\" >

							<div class=\"backdrop\">
								<div class=\"highlights\">";


			
							
			echo				"</div>
							</div>	
						<textarea id=\"{$item_class}-{$counter}\" class=\"max-{$max_char} {$item_class}\" rows=\"2\"  name=\"{$item_class}[] \"'>Not Found</textarea>
					</div>


				";


			echo "<button type=\"button\"  id=\"{$item_class}-{$counter}-remove-button\" class=\"remove\" onclick=\"removeItem('{$item_class}','{$item_class}-{$counter}');\" >- Remove -</button>";
				
			echo "</div>";


			


		}else{
			foreach($items as $item){

				$item = stripslashes($item);
				echo '<div class="input-wrap">';
				echo 
					"<label class=\"{$item_class}-label\" for=\"{$item_class}-{$counter}\">Version {$counter}</label>
						<div class=\"textarea-wrap\" >

								<div class=\"backdrop\">
									<div class=\"highlights\">";




				$patterns = array();
				if(isset($keywords) && !empty($keywords)){
					foreach($keywords as $key){
						$patterns[] = '/\b('.$key.')\b/i';
					}
				}

				echo preg_replace($patterns, '<mark>$0</mark>', $item);					
								
				echo				"</div>
								</div>	
							<textarea id=\"{$item_class}-{$counter}\" class=\"max-{$max_char} {$item_class}\" rows=\"2\"  name=\"{$item_class}[] \"'>{$item}</textarea>
						</div>


					";


				echo "<button type=\"button\"  id=\"{$item_class}-{$counter}-remove-button\" class=\"remove\" onclick=\"removeItem('{$item_class}','{$item_class}-{$counter}');\" >- Remove -</button>";
					
				echo "</div>";

			$counter++;
			}


		}

	}

	public function importCSV($file_id){
		$return = array();
		$importer = new \CsvImporter("files/output". $file_id.".csv",true);
		while($data = $importer->get(2000)){
			$index = explode(',',str_replace('"', '', key($data[0])));
			foreach($data as $values){
				foreach($values as $row){
				$cells = explode(',',$row);
				$return[] = array_combine ($index, $cells);
				}
			}
		} 
		return $return;
	}
    
}

?>