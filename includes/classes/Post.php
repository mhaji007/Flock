<?php 
class User {
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
		$body = mysqli_real_escape_string("$this->con, $body");
		// delets all spaces
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
		}

		
		
	}
}

?>