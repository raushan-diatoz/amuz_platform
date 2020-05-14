<?php include("includes/header.php"); ?>
<style>
body{width:610;}
.demo-table {width: 100%;border-spacing: initial;margin: 20px 0px;word-break: break-word;table-layout: auto;line-height:1.8em;color:#333;}
.demo-table th {background: #999;padding: 5px;text-align: left;color:#FFF;}
.demo-table td {border-bottom: #f0f0f0 1px solid;background-color: #ffffff;padding: 5px;}
.demo-table td div.feed_title{text-decoration: none;color:#00d4ff;font-weight:bold;}
.demo-table ul{margin:0;padding:0;}
.demo-table li{cursor:pointer;list-style-type: none;display: inline-block;color: #F0F0F0;text-shadow: 0 0 1px #666666;font-size:20px;}
.demo-table .highlight, .demo-table .selected {color:#F4B30A;text-shadow: 0 0 1px #F48F0A;}
</style>

<script>function highlightStar(obj,id) {
	removeHighlight(id);		
	$('.demo-table #tutorial-'+id+' li').each(function(index) {
		$(this).addClass('highlight');
		if(index == $('.demo-table #tutorial-'+id+' li').index(obj)) {
			return false;	
		}
	});
}

function removeHighlight(id) {
	$('.demo-table #tutorial-'+id+' li').removeClass('selected');
	$('.demo-table #tutorial-'+id+' li').removeClass('highlight');
}

function addRating(obj,id) {
	$('.demo-table #tutorial-'+id+' li').each(function(index) {
		$(this).addClass('selected');
		$('#tutorial-'+id+' #rating').val((index+1));
		if(index == $('.demo-table #tutorial-'+id+' li').index(obj)) {
			return false;	
		}
	});
	/* $.ajax({
	url: "add_rating.php",
	data:'id='+id+'&rating='+$('#tutorial-'+id+' #rating').val(),
	type: "POST"
	}); */
}

function resetRating(id) {
	if($('#tutorial-'+id+' #rating').val() != 0) {
		$('.demo-table #tutorial-'+id+' li').each(function(index) {
			$(this).addClass('selected');
			if((index+1) == $('#tutorial-'+id+' #rating').val()) {
				return false;	
			}
		});
	}
} 
</script>
<div class="container">
    <div class="row">
		<div class="media-list">      
			<form name="myForm" id="myForm" action="feedback_action.php" method="post">
				<table cellpadding="5" cellspacing="5" class="table table-bordered demo-table">
					<tr>
						<td>Rating</td>
						<td>
							<div id="tutorial-1">
							<input type="hidden" name="rating" id="rating" value="" />
							<ul onMouseOut="resetRating(1);">
							  <?php
							  for($i=1;$i<=5;$i++) {
							  ?>
							  <li class='' onmouseover="highlightStar(this,1);" onmouseout="removeHighlight(1);" onClick="addRating(this,1);">&#9733;</li>  
							  <?php }  ?>
							<ul>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							Mobile No.
						</td>
						<td>
							<input type="text" name="contactno" id="contactno" value="">
						</td>
					</tr>
					<tr>
						<td>
							Email
						</td>
						<td>
							<input type="text" name="clientemail" id="clientemail" value="">
						</td>
					</tr>
					<tr>
						<td>
							Comment
						</td>
						<td>
							<textarea name="comment" id="comment" rows="5" cols="30"></textarea>
						</td>
					</tr>
					<tr>
						<td>
							<button class="btn btn-sm btn-default" type="button" onClick="window.location = 'index.php'">Back</button>
						</td>
						<td>
							<input type="submit" name="buttons3" class="btn btn-default" onClick=""  value="Submit">
						</td>
					</tr>
					
				</table>
			</form>
		</div>
    </div>
</div>

<?php include("includes/footer.php"); ?>