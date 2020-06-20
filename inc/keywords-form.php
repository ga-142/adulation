    	<div id="keywords-wrap">			      
        	<h2>Step 2. Choose Your Keywords</h2>
        	<p>One per line. Currently this is used only to highlight keywords in your ad elements. Keyword scoring and forking into relevant adgroups coming soon.</p>
			<form method="post" id="keywords">
				<textarea id="keywords-textarea" name="keywords"><?php
					if(!empty($_POST['keywords'])){
						foreach($_POST['keywords'] as $keyword){
							echo htmlspecialchars($keyword,ENT_QUOTES)."\n";
						}
					}
			  ?></textarea>
			</form>
		</div>

