		<div id="scrape-wrap">
	        <form id="scrape-page" method='post'>
	        	<h2>Step 1. Scrape Page</h2>
	        	<h4>Scrape a page for potential copy with the form below, currently includes: All H1,H2,Title, Meta Description & P Tags. Controls for this and where they go are coming soon.</h4>
	        	<div class="check-wrap">
	    			<label class="check-label">Include Title Tag</label>
		       		<input type="checkbox" name="include_titles" value="true" checked>
		       	</div>
		       	<div class="check-wrap">
		       	 <label class="check-label">Include Meta Description</label>
		       	 <input type="checkbox" name="include_meta" value="true" checked>
		       	</div>
		        <br>
		        <br>
		        <label>URL to scrape</label>
		        <?php if($url_error == true){
		        	echo '<h5 style="color:red;">Your URL appears invalid. Please make sure you included "http://" or "https://".</h5>';
		        }?>
	    		<input type="text" name="scrape_url" value="<?php echo htmlspecialchars($_POST['scrape_url'],ENT_QUOTES); ?>">
	    		<button type='submit' >Scrape</button>
	        </form>
    	</div>

