<?php
include ("includes/header.php");
//session_destroy();
?>
	<div class="user_details column">
			<a href="#"><img src="<?php echo $user['profile_pic']; ?>"></a>

				<div class="user_details_left_right">

				<a href="#">
				<?php 
				echo $user['first_name'] . " " . $user['last_name']."<br>";

				?>
			</a>

			<?php echo "Posts: ". $user['num_posts'] ."<br>";
			echo "Likes: ". $user['num_likes'];
			?>
			
			</div>

	</div>



	<!-- closing tag for the wrapper from header.php -->
	</div>
</body>
</html>