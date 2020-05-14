<script type="text/javascript" src="js/jquery-1.11.0.min.js" ></script>
			<script type="text/javascript" src="js/jquery.min.js" ></script>
			<link href="css/style_pop.css" rel="stylesheet" />
			<link href="css/progressbar.css" rel="stylesheet" />

			<?php
			$files = scandir(PIWIKADMINPATH);
			//print_r($files);
			$newarr = array();
			foreach($files as $nr)
			{
				//echo '<br>'.$nr;
				$extn = explode('.',$nr);
				$narr = explode('_',$nr);
				//print_r($narr);
				if(in_array('updated',$narr))
				{
					//print_r($narr);
				}
				else
				{
					if($nr != '.' && $nr != '..')
					$newarr[] = $nr;
				
				
				}
			}
			//print_r($newarr);
			$files = array_reverse($newarr);
			$tcnt = count($files);
			$incrcnt = 100/$tcnt;
			$cnt = $incrcnt;
			if($tcnt > 0)
			{
			?>
			<section class="container">
			<div class="progress"> <span class="blue" style="width:0%;"><span>0%</span></span> </div>
			</section>
			<script src="js/jquery.simplePopup.js" type="text/javascript"></script>
			<script type='text/javascript'>
				function loading(percent){
					$('.progress span').animate({width:percent},200,function(){
						$(this).children().html(percent);
						if(percent=='100%'){
							$(this).children().html('Pushing completed...&nbsp;&nbsp;&nbsp;&nbsp;');
							setTimeout(function(){
								//$('.container').fadeOut();
								//location.href="";
								$(".examplemodal").css("display","none");
							},3000);
						}
					})
				}
			  </script> 							
			<?php
			}

			$imgf = "";
			foreach($files as $imgf)
			{
				
				$extn = explode('.',$imgf);
				
				if($imgf != '.' && $imgf != '..' && $imgf != '' && isset($extn[1]) != '')
				{
					//echo '<br>'.$imgf;
				
					if(strpos($imgf,'updated_') === 0)
					{
						
					}
					else
					{
						?>
						
						<!--<?=$imgf;?>-->
						Pushing data to piwik..
							
							<!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]--> 
							<?php
							include('config.php');
							$fil = PIWIKADMINPATH;
							echo '<script type="text/javascript">';
							$handle = @fopen($fil.$imgf, "r");
							if ($handle) {
								while (($buffer = fgets($handle, 4096)) !== false) {
									echo $buffer;
								}
								if (!feof($handle)) {
									echo "Error: unexpected fgets() fail\n";
								}
								fclose($handle);
							}
							echo '</script>';  
							$oldfilename = $fil.$imgf;
							$newfilename = $fil.'updated_'.$imgf;
							rename($oldfilename, $newfilename);
							//for($i=1;$i<=100;$i++)
							echo '<script type="text/javascript">loading("'.round($cnt).'%");</script> ';
							?>
						
						<?php
						
						
					}
				}
				$cnt = $cnt+$incrcnt;
			}
			?>