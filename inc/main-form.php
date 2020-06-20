		<form method='post' id="main-form">

			<div id="details-wrap">
				<div id="static-fields-left" >
		        	<label>Ad Group</label>

		        	<div class="input-wrap">
		        		<input type="text" name="adgroup" value="<?php echo htmlspecialchars($_POST['adgroup'],ENT_QUOTES); ?>">
		        	</div>

		        	<label>Final URL</label>

		        	<div class="input-wrap">
		        		<input type="text" name="url" value="<?php
		        		 if($scrape_success == true ){

		        			echo htmlspecialchars($_POST['scrape_url'],ENT_QUOTES);
		        		}else{

		        			echo htmlspecialchars($_POST['url'],ENT_QUOTES); 
		        		}
		        			?>">
		    	    </div>
		    	</div><div id="static-fields-right" >
		    	    <label for="path-1">Path 1</label>
		        	<div class="input-wrap">
		        		<input id="path-1" class="max-15" type="text" name="path1" value="<?php echo htmlspecialchars($_POST['path1'],ENT_QUOTES); ?>">
		    	    </div>

		  	   		 <label for="path-2">Path 2</label>
		        	<div class="input-wrap">
		        		<input id="path-2" class="max-15" type="text" name="path2" value="<?php echo htmlspecialchars($_POST['path2'],ENT_QUOTES); ?>">
		    	    </div>
		    	</div>
		    	<div id="main-button-wrap">
				  <button type='submit'>Assemble Ads</button>
	           	  <?php 
	        		if($success == true){
	        			echo '<a href="files/output'.$file_id.'.csv"><button type="button" >Download CSV</button><a>';
	        		}
	        		?>
		    	</div>
		    	<h2>Step 3. Edit/add/remove your ad elements below.</h2>
		    	<p> Keywords will <mark>highlight</mark> when present in elements. Once satisfied, click assemble ads and a .csv is assembled of every possible combination of elements, except for combinations with duplicate headlines</p>
		    	<p>
		    	It can generate an exponential number of ads and adwords currently only allows 50 per adgroup. I suggest limiting it to 4 h1s, 4 h2s & 3 descs or 3,4,4, or 4,3,4 which all generate 48, or any combination of 5,5,2 which generates an even 50. </p>
		    	<p>
		    	<p>
		    	Remember to hit assemble ads again if you make changes and want to download an updated .csv.


		    	</p>
		    </div>







  		  <!-- end upper section / begin lower section -->







	    	<div class="space"></div>
    	    <div class="segment">
			  	<div id="first_headlines-wrap">	
	        	<h3>First Headlines</h3>
	        	

			<?php if( empty($sortedVars['first_headlines'] ) && $scrape_success !== true){?>

	        		<div class="input-wrap">

						<label class="first_headlines-label" for="first_headlines-1">Version 1</label>
						<div class="textarea-wrap" >	
		        			<div class="backdrop">
								<div class="highlights"></div>
							</div>						
							<textarea id="first_headlines-1" class="max-30 first_headlines" rows="1"  name='first_headlines[]'></textarea>
						</div>
						<button type="button"  id="first_headlines-1-remove-button" class="remove" onclick="removeItem('first_headlines','first_headlines-1');" >- Remove -</button>
					</div>
					<div class="input-wrap">
						<label class="first_headlines-label" for="first_headlines-2">Version 2</label>
						<div class="textarea-wrap" >
		        			<div class="backdrop">
								<div class="highlights"></div>
							</div>
							<textarea id="first_headlines-2" class="max-30 first_headlines" rows="1"  name='first_headlines[]'></textarea>
						</div>
						<button type="button"  id="first_headlines-2-remove-button" class="remove" onclick="removeItem('first_headlines','first_headlines-2');" >- Remove -</button>
					</div>

			<?php
				}
				else{
					    if($scrape_success === true){
						    $adu->printItems($scrape_data['first_headlines'],'first_headlines',30);
						}else{
						    $adu->printItems($sortedVars['first_headlines'],'first_headlines',30);
						}
					//$adu->printItems($sortedVars['first_headlines'],'first_headlines',30);

				}
			?>

				</div>	

				<div id="first_headlines-button-wrap">
					<button type="button" id="add-first_headlines" class="add">+ Add More +</button>
				</div>

			</div><div class="segment">

			   	<div id="second_headlines-wrap">
					<h3>Second Headlines</h3>
			<?php if( empty($sortedVars['second_headlines'] ) && $scrape_success !== true){?>
		        		<div class="input-wrap">
							<label class="second_headlines-label" for="second_headlines-1">Version 1</label>
							<div class="textarea-wrap" >			
		        
							<div class="backdrop">
								<div class="highlights"></div>
							</div>	
							<textarea id="second_headlines-1" class="max-30 second_headlines" rows="1"  name='second_headlines[]'></textarea>
							</div>
							<button type="button"  id="second_headlines-1-remove-button" class="remove" onclick="removeItem('second_headlines','second_headlines-1');" >- Remove -</button>
						</div>

						<div class="input-wrap">
							<label class="second_headlines-label" for="second_headlines-2">Version 2</label>
							<div class="textarea-wrap" >			
		        
							<div class="backdrop">
								<div class="highlights"></div>
							</div>	
							<textarea id="second_headlines-2" class="max-30 second_headlines" rows="1"  name='second_headlines[]'></textarea>
							</div>
							<button type="button"  id="second_headlines-2-remove-button" class="remove" onclick="removeItem('second_headlines','second_headlines-2');" >- Remove -</button>
						</div>
				<?php
					}
					else{
					    if($scrape_success === true){
						    $adu->printItems($scrape_data['second_headlines'],'second_headlines',30);
						}else{
						    $adu->printItems($sortedVars['second_headlines'],'second_headlines',30);
						}
						//$adu->printItems($sortedVars['second_headlines'],'second_headlines',30);
					}
				?>
				</div>	


				<div id="second_headlines-button-wrap">
					<button type="button" id="add-second_headlines" class="add">+ Add More +</button>
				</div>

			</div><div class="segment">

	 	      	<div id="descs-wrap">
	            	<h3>Descriptions</h3>
				<?php if( empty($sortedVars['descs'] ) && $scrape_success !== true){?>


					<div class="input-wrap">
	          			<label class="descs-label" for="descs-1">Version 1</label>
	          			<div class="textarea-wrap" >			
		        
							<div class="backdrop">
								<div class="highlights"></div>
							</div>	
							<textarea  class="descs max-80" rows="1" id="descs-1" name='descs[]'></textarea>		
		          		</div>
		          		<button type="button"  id="descs-1-remove-button" class="remove" onclick="removeItem('descs','descs-1');" >- Remove -</button>
		          	</div>

			        <div class="input-wrap">
			         	<label class="descs-label" for="descs-2">Version 2</label>

		         		<div class="textarea-wrap" >			
		        
							<div class="backdrop">
								<div class="highlights"></div>
							</div>	
							<textarea  class="descs max-80"  rows="1" id="descs-2" name='descs[]'></textarea>
			         	</div>
						<button type="button"  id="descs-2-remove-button" class="remove" onclick="removeItem('descs','descs-2');" >- Remove -</button>
					</div>

				<?php
					}
					else{
					    if($scrape_success === true){
						    $adu->printItems($scrape_data['descs'],'descs',80);
						}else{
						    $adu->printItems($sortedVars['descs'],'descs',80);
						}
					}
				?>


	         	</div>					
				<div id="descs-button-wrap">
					<button type="button" id="add-descs" class="add">+ Add More +</button>

				</div>
			</div>
        </form>