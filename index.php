<?php
include ("includes/header.php");
include("includes/classes/User.php");
include("includes/classes/Post.php");
//session_destroy();

if(isset($_POST['post'])){
	$post = new Post($con, $userLoggedIn);
	$post->submitPost($_POST['post_text'], 'none');
}

?>
	<div class="user_details column">
			<a href="<?php echo $userLoggedIn; ?>"><img src="<?php echo $user['profile_pic']; ?>"></a>

			<div class="user_details_left_right">

				<a href="<?php echo $userLoggedIn; ?>">
				<?php 
				echo $user['first_name'] . " " . $user['last_name']."<br>";

				?>
				</a>

				<?php echo "Posts: ". $user['num_posts'] ."<br>";
				echo "Likes: ". $user['num_likes'];
				?>
			
			</div>

	</div>

	<div class="main_column column">
		<form class="post_form" action="index.php" method="POST">
			<textarea name="post_text" id="post_text" placeholder="Say something to your flock..."></textarea>
			<input type="submit" name="post" id="post_button" value="Post">
			<!-- <hr> -->

		</form>

		<?php 

		$post = new Post($con, $userLoggedIn);
		$post->loadPostsFriends();

		// $user_obj = new User($con, $userLoggedIn);
		// echo $user_obj->getFirstandLastName();
		?>
		
	<!-- </div> -->

		<img id="#loading" src="assets/images/icons/loading.gif">

	</div>

	<script>
	var userLoggedIn = '<?php echo $userLoggedIn; ?>';

	$(document).ready(function() {
		$('#loading').show();

		// Original ajax request for loading first posts
		$.ajax({
			url : "includes/handlers/ajax_load_posts.php",
			type: "POST",
			data: "page=1&userLoggedIn=" +userLoggedIn,
			cache: false,
		});
	}):
	</script>


	<!-- closing tag for the wrapper from header.php -->
	</div>
</body>
</html>