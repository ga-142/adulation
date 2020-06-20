	<?php 


	$myPlunder = array(
		//'img' => 1,
		//'elements by id' => 'partLongDescription',
		//'img xpath' => "//div[@id='ie8Image']/img",
		//'description xpath' => "//div[@id='partLongDescText']/div",
		//'children xpath' => "",
		'metas' => true,
		'titles' => true,
		'headlines' => true,
		'paragraphs' => true,
		//'drop dashes' => true,
		//'download imgs' => true,
	);


	

	if(!empty($_POST)){

		if(empty($_POST['scrape_url'])){
			$adu = new \Modules\Adulation\View\Adulator();

			$sortedVars = $_POST;
			$adu->args = $_POST;

			$combos = $adu->recombine();
		
			$file_id = generateRandomString(16);
			$thisfile = $adu->adulate($combos, $file_id);
			//$import = $adu->importCSV($file_id);

			$success = true;
		}
		else{

			$_POST['scrape_url'] = trim($_POST['scrape_url']);


			if (!filter_var($_POST['scrape_url'], FILTER_VALIDATE_URL)) {

			    $url_error = true;

			} else {
			    $url_error = false;
				$ahoy = new \Modules\Crawler\View\AnchorsAway();
				$ahoy->anchorsAway($_POST['scrape_url'], $myPlunder, 1);
				$scrape = $ahoy->return;
				$adu = new \Modules\Adulation\View\Adulator();

				$ss_args = array(
					'include titles' => $_POST["include_titles"],
					'include metas' => $_POST["include_meta"],
					'split title' => true,
				);

				$scrape_data = $adu->sortScrape($scrape,$ss_args);
				if(!empty($scrape_data)){

					$scrape_success = true;
				}
			}		
		}
	}


	?>