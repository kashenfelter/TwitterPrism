<?php

$query = "SELECT termID,term FROM terms WHERE searched = '0000-00-00 00:00:00' ORDER BY RAND() LIMIT 0,1";

if($result = mysqli_query($link, $query)) {
		
	while ($row = mysqli_fetch_assoc($result)) {

		$termID = $row["termID"];
		$q = $row["term"];

	}

}

$params = array(
	'lang' => 'en',
	'q' => $q,
	'result_type ' => 'recent',
	'rpp' => 2 // fetch only 2 tweets
);

$tweets = $cb->search_tweets($params, true);

$retweets = 0;

foreach($tweets->statuses as $tweet){

	// statuses/retweet
	$retweet = $cb->statuses_retweet_ID('id=$tweet->id');
	
	// returns "Can't find HTTP method to use for 'statuses/retweet'"

	if($retweet->httpstatus == 200){

		$retweets++;

	}

	break;

}

echo date("d-m-y H:i:s") ." Retweeted $retweets tweets with term '$q'";

?>
