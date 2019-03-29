<?php 
class Post {
	private $user_obj;
	private $con;

	public function __construct($con, $user){
		$this->con = $con;
		// creates an instance of User class
		$this->user_obj = new User($con, $user);

	}
	public function submitPost($body, $user_to) {

		// removes html tags
		$body = strip_tags($body);
		// escapes the single quotes
		$body = mysqli_real_escape_string($this->con, $body);
		// deletes all spaces
		$check_empty = preg_replace('/\s+/', '', $body);

		if($check_empty !="") {

			// current date and time
			$date_added = date("Y-m-d H:i:s");
			// get username
			$added_by = $this->user_obj->getUsername();

			// if user is on own profile, user_to is 'none'
			if($user_to == $added_by) {
				//  plan to allow the user to send posts even from someone else's profile
				$user_to = "none";

			}

			// insert post
			$query = mysqli_query($this->con, "INSERT INTO posts VALUES('','$body','added_by','$user_to','date_added','no','no','0')");
			
			// returns the id of the post
			$returned_id = mysqli_insert_id($this->con);

			// insert notification if the user is posting to someone else's profile


			// update post count for user
			$num_posts = $this->user_obj->getNumPosts();
			$num_posts++;
			$update_query = mysqli_query($this->con, "UPDATE users SET num_posts='$num_posts' WHERE username='$added_by'"); 

		}

		
		
	}
}

?>