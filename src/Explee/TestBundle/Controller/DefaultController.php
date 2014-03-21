<?php

namespace Explee\TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller
{
	private $token = "251831735-WDJKG6geeOzVQt0pnMfm2yjeDtZJQhKVWtnYKmFF";
	private $token_secret = "6p3cb0kzxaeRJyOZfWk16q0n8zNGgIgXm5Nuta17mNJ81";
	
    /**
     * @Route("/index")
     * @Template()
     */
    public function indexAction(){
    /*default action*/
    	
    	//userid 14642331    	  	
    	//$result = $this->searchTwitter($name);
    	//$result = $this->getStatusOfAccount();
    	//$this->twitterSomeone($name,true);
    	//$this->publishTwitter($name);  	
    	//var_dump($result);    
    		
        return array('name' => "");
    }
    
    /**
     * @Route("/list/{con}", name="search_twitter", options={"expose"=true})
     */
    public function listSearchReusultAction($con){
    /*tache--search by tweets*/
    	$result = $this->searchTwitter($con);
    	$result = $result->statuses;
    	$twitter = array();
    	
    	foreach($result as $item){
    		
    		$container = array(
    				'created_at' => $item->created_at,
    				'text'	=> $item->text,
    				'lang'	=> $item->lang
    		);
    		
    		array_push($twitter,$container);
    	}
    	
    	$response = new JsonResponse(json_encode($twitter));
		$response->headers->set('Content-Type', 'application/json');
		
		//var_dump($twitter);
		
		return $response;
    }
    
    /**
     * @Route("/status", name="get_status", options={"expose"=true})
     */
    public function getStatusAction(){
    /*tache--Get status of my account*/
    	
    	$result = $this->getStatusOfAccount();
    	
    	$status = array(
    				"id" => $result->id,
    			    "name" => $result->name,
    				"screen_name" => $result->screen_name,
    				"profile_image_url" => $result->profile_image_url,
    				"created_at" => $result->status->created_at,
    				"text" => $result->status->text,
    			  );
    	
    	
    	//var_dump($status);
    	
    	$response = new JsonResponse(json_encode($status));
    	return $response;
    }
    
    /**
     * @Route("/twittersomeone/{action}", name="twitter_someone", options={"expose"=true})
     */
    public function twitterAction($action){
    /*tache--Follow/Unfollow someone*/
    	
    	//j'ai pas beaucoup d'ami in twitter, donc je n'utilise que un identifiant de compte 
    	//pour vous montrer la fonction follow et unfollow 
    	
    	$name = "14642331";
    	
    	$status = array();
    	if($action=="follow"){
    		$this->twitterSomeone($name,true);
    		$status = array("status"=>"follow");
    	}else if($action=="unfollow"){
    		$this->twitterSomeone($name,false);
    		$status = array("status"=>"unfollow");
    	}else{
    		$status = array("status"=>"error");
    	}
    	
    	$response = new JsonResponse(json_encode($status));
    	return $response;
    }
    
    /**
     * @Route("/publishtwitter/{text}", name="publish_twitter", options={"expose"=true})
     */
    public function publishTwitterAction($text){
    /*tache--Publish a tweet*/
    	
    	$result = $this->publishTwitter($text);
    	
    	if(isset($result->created_at)&&($result->text)){
	    	$status = array(
	    			"created_at"=>$result->created_at,
	    			"text"=>$result->text
	    		    );
    	}else{
    		$status = array(
    				"created_at"=>"today",
    				"text"=>"!text duplicate!"
    		);
    	}
    	
    	$response = new JsonResponse(json_encode($status));
    	return $response;
    }
    
    private function connectTwitter(){
    /*en utilisant fos_twitter-- connect my compte*/
    		
    	$access_token = $this->token;
    	$access_token_secret = $this->token_secret;
    	$twitter = $this->get('fos_twitter.api');
    	$twitter->setOAuthToken($access_token, $access_token_secret);
    	return $twitter;
    }
    
    private function searchTwitter($condition){
    /*en utilisant fos_twitter-- search twitter by condition*/
    	
    	$twitter = $this->connectTwitter();
    	
    	$params = array(
    			"q" => $condition
    	);   	
    	$result = $twitter->get('search/tweets',$params);
    	
    	return $result;   	  	
    }
    
    private function getStatusOfAccount(){
    /*en utilisant fos_twitter-- get status of my compte*/
    	
    	$twitter = $this->connectTwitter();
    	
    	$result = $twitter->get('account/verify_credentials');
    	
    	return $result; 	
    }
    
    private function twitterSomeone($someone, $follow){
    /*en utilisant fos_twitter-- follow someone or unfollow someone*/
    	
    	$twitter = $this->connectTwitter();
    	
    	$params = array(
    			"user_id"=>$someone
    	);
    	
    	if($follow)
       		 $twitter->post('friendships/create',$params);
    	else
    		 $twitter->post('friendships/destroy',$params);
    }
    
    private function publishTwitter($message){
    /*en utilisant fos_twitter-- publish a new twitter*/
    	
    	$twitter = $this->connectTwitter();
    	
    	$params = array(
    			"status"=>$message
    	);
    	
    	return $twitter->post('statuses/update',$params);
    }
    
}
