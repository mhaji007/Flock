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

	public function loadPostsFriends() {
		// string to return
		$str = "" 
		$data = mysqli_query($this->con, "SELECT * FROM posts WHERE deleted = 'no' ORDER BY id DESC");

		while($row = mysqli_fetch_array($data)) {
			$id=$row ['id'];
			$body = $row['body'];
			$added_by = $row['added_by'];
			$date_time = $row['date_added'];
		}

		// prepare user-to string so it can be included even if not posted to a user
		if($row['user_to']=="none") {
			$user_to = "";

		}
		else {
			$user_to_obj = new User($con, $row['user_to']);
			$user_to_name = $user_to_obj->getFirstAndLastName();
			$user_to = "<a href='" . $row['user_to'] ."'>" . $user_to_name . "</a>"
		}

		// check if user who posted, has their account closed
		$added_by_obj = new User($con, $added_by);
		if($added_by_obj->isClosed()) {
			continue;
		}

		$user_details_query = mysqli_query($this->con, "SELECT first_name, last_name, profile_pic FROM users WHERE username='$added_by'");
		$user_row = mysqli_fetch_array($user_details_query);

		// timeframe
		$date_time_now = date("Y-m-d H:i:s");
		// time of post
		$start_date = new DateTime($date_time);
		// current time
		$end_date = new DateTime($date_time_now);
		// difference between two ddates
		$interval = $start_date->diff($end_date);
		if($interval->y >= 1) {
			if ($interval ==1) 
				// 1 year ago
				$time_message = $interval->y . " year ago"; 
			else
				// 1+ years ago
				$time_message = $interval->y . "years ago";
		}
		else if ($interval->m >=1) {
			if($interval->d == 0) {
				$days = " ago";
			}
			else if ($interval->d == 1) {
				$days = $interval->d . " day ago";
			}
			else {
				$days = $interval->d . " days ago";

				}

			if ($interval->m == 1) {
				$time_message = $interval->m . " month" . $days;
				}
			else {
				$time_message = $interval ->m . " months" . $days;
				}

		}
		else if ($interval->d >= 1) {
			if ($interval->d == 1) {
				$time_message = "Yesterday";
			}
			else {
				$time_message = $interval->d . " days ago";

				}
		else if($interval->h >= 1) {
			if ($interval->h == 1) {
				$time_message = $interval->h . " hour ago";
				}
			else {
				$time_message = $interval->h . " hours ago";

				}

		else if($interval->i >= 1) {
			if ($interval->i == 1) {
				$time_message = $interval->i . " minute ago";
				}
			else {
				$time_message = $interval->i . " minutes ago";

				}

		else {
			if ($interval->s < 30) {
				$time_message = "Just now";
				}
			else {
				$time_message = $interval->s . " seconds ago";

				}

			}
		}



	}
}

?>