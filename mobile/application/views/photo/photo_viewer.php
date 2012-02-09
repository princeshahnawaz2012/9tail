<!DOCTYPE html> 
<html> 
	<head> 
	<title><?php echo $profile_data['screen_name'];?>'s Profile</title> 
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.0a3/jquery.mobile-1.0a3.min.css" />
	
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.5.min.js"></script>
	
	<script type="text/javascript">
		    $(document).bind("mobileinit", function () {
		           $.mobile.ajaxLinksEnabled = false;
					$.mobile.ajaxEnabled = false;
		     });
	</script>
		
	<script type="text/javascript" src="http://code.jquery.com/mobile/1.0a3/jquery.mobile-1.0a3.min.js"></script>
	<script type="text/javascript">

$(document).ready(function(){
	var user_id = <?php echo $profile_data['id'];?>;
	//var getStatusUrl = 'http://mobile.9tail.com/profile/getstatus/'+user_id;
	var url  = "<?php echo site_url('profile/getstatus');?>";
	var para = {
		userid : user_id
	}
	/*	
	$.post(url,para,function(data){

			var path = "<?php echo 'http://www.9tail.com/files/user_photo/thumb/';?>";
			$.each(data, function(i,item){

			 var img =  $("<img/>").attr("src", path +item.small_thumbnail).addClass('ui-li-thumb');
			var h4 = $("<h3/>").text(item.screen_name);
			var link = $("<a/>").attr('href','<?php echo site_url("profile/user/");?>/' + item.from);
			var para = $("<p/>").text(item.text);

			$("<li/>").addClass('ui-li-has-thumb')
			.append(img)
			.append(h4)
			.append(link)
			.append(para)
			.appendTo('#messageview');

		     });

		   $('ul').listview('refresh');


	},"json");*/

	$("#submit_msg").click(function(){

		var text =  $("#post_text").val();
		var to_user = <?php echo $profile_data['id']; ?>;
		var from_user = <?php echo $user_data['id'];?>;

		if(text.trim() == "") return false;


		var url = "<?php echo site_url('profile/postmessage');?>";
		var para = {
			post_text : text,
			from: from_user,
			to: to_user
		};

		$('#post_text').attr('disabled','disabled');
		$("#submit_msg").attr('disabled','disabled');
		$.post(url,para,function(item){
			var path = "<?php echo 'http://www.9tail.com/files/user_photo/thumb/';?>";


			 var img =  $("<img/>").attr("src", path +item.small_thumbnail).addClass('ui-li-thumb');
			var h4 = $("<h3/>").text(item.screen_name);
			var link = $("<a/>").attr('href','#');
			var para = $("<p/>").text(item.text);

			$("<li/>").addClass('ui-li-has-thumb')
			.append(img)
			.append(h4)
			.append(link)
			.append(para)
			.prependTo('#messageview');

		$('#post_text').removeAttr('disabled');
		$("#submit_msg").removeAttr('disabled');
		$('#post_text').val('');



		   $('ul').listview('refresh');

		},'json');
		return false;
	});

});

</script>
	<style>
		label,input{
			display:block;
		}
	</style>
	

	
	<style>
		#top_wrap{
			
			display:block;
			height:90px;
			
			
			border-bottom:1px solid #ccc;
		}
	
	#top_wrap p{
		margin:0;
		padding:0;
		font-size:12px;
	}
	#top_wrap h3{
		margin:10px 0 10px ;
		padding:0;
	}
	
		#top_wrap img{
			max-height:80px;
			float:left;
			margin-right:20px;
		}
		
		#top_wrap #user_profile{
	
			overflow:hidden;
		}
		
		#message_box_wrap{
			margin:5px 0;
			padding:5px 0;
		}
		
		#photo_wrap{
			margin-bottom:20px;
			display:block;
			overflow:hidden;
		}
		
		.photo_box{
			width:80px
			height:80px
			overflow:hidden;
			float:left;
			margin-right:10px;
			margin-bottom:10px;
		}
		.photo_box img{
			max-width:80px;
			max-height:80px;
		}
		
		#photo_box{
			width:100%;
			position:relative;
		}
		
		#photo_box img{
			width:100%;
			
		}
	</style>
</head> 
<body> 
	<div data-role="page"> 
		
		<div data-role="header">	
		<a href=<?php echo site_url('profile/photo/'.$photo_data['user_id']);?> data-icon="back">Back</a>
			<h1>Profile: <?php echo $profile_data['screen_name']?></h1>
			<a href="/" data-icon="gear" class="ui-btn-right">Home</a>
			<div data-role="navbar">
					<ul>
						<li><?php echo anchor('profile/user/'.$profile_data['id'],'Profile: ' .$profile_data['screen_name']); ?></li>
						<li><?php echo anchor('profile/photo/'.$profile_data['id'],'My Photo','class="ui-btn-active"');?></li>
						
					</ul>
				</div><!-- /navbar -->
			</div> 

		<div data-role="content">
			<div id="top_wrap">
				
				<?php 
				$path = 'http://www.9tail.com/files/user_photo/thumb/';
				echo img($path.$profile_data['small_thumbnail']);
				?>
				
				<div id="user_profile">
					<h3><?php echo $profile_data['screen_name']?></h3>
					<p><?php echo $profile_data['firstname'] . ' ' . $profile_data['lastname']; ?></p>
					
				</div>
			</div>
			
		
		
			
			<div id="photo_box">
				<?php
				
					$path = 'http://www.9tail.com/files/user_photo/';
					echo img($path . $photo_data['path']);
				?>
				
				
					
			
			</div>
			
			<a href="<?php echo site_url('login/logout');?>" data-role="button" data-theme="a">Sign out</a>
		</div> 
		<div data-role="footer">
		<h4>9tail</h4>
		</div>
	</div>

	


</body>
</html>