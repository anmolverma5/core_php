<?php

  include 'include/config.php';
  // include '../include/functions.php';

    @ini_set( 'upload_max_size' , '64M' );
    @ini_set( 'post_max_size', '64M');
    @ini_set( 'max_execution_time', '300' );

function random_string($length) {
    $key = '';
    $keys = array_merge(range(0, 9), range('a', 'z'));

    for ($i = 0; $i < $length; $i++) {
        $key .= $keys[array_rand($keys)];
    }

    return $key;
}

function get_all_category(){

	//echo $ids; die();
	include 'include/config.php';
	

		  $query = "SELECT * FROM `categories` WHERE status = 1";

			$stmt = $conn->prepare($query);
			$stmt->execute();		
			$num = $stmt->rowCount();
			// $res = array();
			if($num>0){
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){			  
			    extract($row);			
			     $res[] = array('id' => $id, 
			     				'category_name' => $title
			     			);


				}
			}
			
			return $res;
			
			
	

}

function get_category_name($category_ids){

	//echo $ids; die();
	include 'include/config.php';
	if (!empty($category_ids)) {

		  $query = "SELECT * FROM `categories` WHERE id in (".$category_ids.")"; //die();

			$stmt = $conn->prepare($query);
			$stmt->execute();		
			$num = $stmt->rowCount();
			// $res = array();
			if($num>0){
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){			  
			    extract($row);			
			     $res[] = array('id' => $id, 
			     				'category_name' => $title
			     			);


				}
			}
			
			return $res;
			
			
	}

}

function get_topic_name($topics_ids){
	include 'include/config.php';
	$img_dir = "http://test.defuzed.in/sci/admin/uploads/topics/";

	if (!empty($topics_ids)) {

		 $query = "SELECT * FROM `topics` WHERE id in (".$topics_ids.")";

			$stmt = $conn->prepare($query);
			$stmt->execute();		
			$num = $stmt->rowCount();
			// $res = array();
			if($num>0){
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){			  
			    extract($row);			
			     $res[] = array("id" => $id, 
			     				"topic_name" => $title,
			     				"topic_image" => $img_dir . $thumbnail,
			     			);


				}
			}
			
			return $res;
			
			
	}
}


function get_tag_name($tag_ids){

	include 'include/config.php';
	if (!empty($tag_ids)) {

		 $query = "SELECT * FROM `tags` WHERE id in (".$tag_ids.")";

			$stmt = $conn->prepare($query);
			$stmt->execute();		
			$num = $stmt->rowCount();
			// $res = array();
			if($num>0){
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){			  
			    extract($row);			
			     $res[] = array("id" => $id, 
			     				"tag_name" => $title
			     			);


				}
			}
			
			return $res;
			
			
	}

}
function get_article_by_id($article_id){
	include 'include/config.php';
		
		

	if(!empty($article_id))
		{	
		  $id = $article_id;						
							 
			// select all data
		  $query = "SELECT a.id, a.title ,a.image, a.content,a.no_of_upvotes, a.upvote_users, a.is_premium, a.added_by, a.categories, a.topics, a.scientific, a.views, a.tags, a.created_on, a.status 
											    FROM articles as a                                                
											    WHERE a.id=$id ";
			$stmt = $conn->prepare($query);
			$stmt->execute();		
			$num = $stmt->rowCount();
			// $res = array();
			$res = '';
			if($num>0){
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){			  
			    extract($row);			
			    // echo $categories; 
			     $res = array("id" => $id, 
			     				"title" => $title,	
			     				"content" => $content,		
			     				"image"=> $image,
			     				"no_of_upvotes" => $no_of_upvotes,
			     				"is_premium" => $is_premium,  
			     				"upvote_users" => $upvote_users,
			     				"added_by" => $added_by,
			     				     				
			     				"categories" => get_category_name($categories),
			     				"topics" => get_topic_name($topics), 	
			     				"tags" => get_tag_name($tags), 			     				
			     				"view" => $views, 
			     				"scientific" => $scientific, 	
			     				"created_on" => Date('d M y', strtotime($created_on)), 	
			     				"status" => $status
			     			);



				}
			}


	 	}			
	 	return $res;
}
function get_no_of_views($article_id){
	include 'include/config.php';

	if (!empty($article_id)) {

		 $query = "SELECT * FROM `articles` WHERE id = '$article_id' LIMIT 1";		 	
				$stmt = $conn->prepare($query);
				$stmt->execute();		
				$num = $stmt->rowCount();
				
				$res = '';
				if($num>0){
					while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){			  
					    extract($row);	
			
					    $res = $views;
						}
					}
	return $res;
	}


}

function update_view_status($article_id){
		include 'include/config.php';

	$no_of_views = get_no_of_views($article_id);
	$views = $no_of_views +1;


 	$sql="UPDATE articles SET views ='$views' WHERE id = $article_id";
  	if ($conn->query($sql)) {
   		return true;
    } 
    else {
    return false;
    }
}

function get_up_votes_by_article($article_id){
	include 'include/config.php';
	if (!empty($article_id)) {

		 $query = "SELECT * FROM `upvotes` WHERE article_id = $article_id";

			$stmt = $conn->prepare($query);
			$stmt->execute();		
			$num = $stmt->rowCount();
			// $res = array();
			if($num>0){
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){			  
			    extract($row);			
			     $res[] = array("id" => $id, 
			     				"tag_name" => $title
			     			);


				}
			}
			
			return $res;
			
			
	}	
}

function get_upvotes_by_user_id($user_id){
	include 'include/config.php';
	if (!empty($user_id)) {
		$res = array();
	$query = "SELECT upvotes FROM `users` WHERE id = $user_id";
			$stmt = $conn->prepare($query);
			$stmt->execute();		
			$num = $stmt->rowCount();
			if($num>0){
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){			  
			    extract($row);	
			    $res = $upvotes;
				 }
			}
			
			return $res;
			
			
	}	

}
function get_article_detail_by_id($article_id){
	$article_id;
	include 'include/config.php';
	if (!empty($article_id)) {

		 $query = "SELECT * FROM `articles` WHERE id =".$article_id;

			$stmt = $conn->prepare($query);
			$stmt->execute();		
			$num = $stmt->rowCount();
			 $res = array();
			if($num>0){
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){			  
			    extract($row);		
			    
			     $res[] = array("id" => $id, 
			     				"title" => $title,
			     				"content" => $content
			     			);


				}
			}
			
			return $res;
			
			
	}

}
function get_bookmarks_by_user_id($user_id){
	include 'include/config.php';
	if (!empty($user_id)) {

	$query = "SELECT bookmarks FROM `users` WHERE id = $user_id";
			$stmt = $conn->prepare($query);
			$stmt->execute();		
			$num = $stmt->rowCount();
			if($num>0){
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){			  
			    extract($row);	
			    $res = $bookmarks;
			 }
			}
		return $res;
		
			}	
	}

function add_bookmark_in_user($user_id, $article_id){
		include 'include/config.php';
	$upvotes = get_bookmarks_by_user_id($user_id); 	
 	$value_to_add = $article_id;

 	if (!empty($upvotes)) {
 		$newString = addtoString($upvotes, $value_to_add);
 	}
 	else{
 		$newString = $article_id;
 	}

 	// $newString = addtoString($upvotes, $value_to_add);
	$query = "UPDATE users SET bookmarks ='$newString' WHERE id = $user_id";
		$stmt = $conn->prepare($query);
		//$stmt->execute();
		 if ($stmt->execute()) {
			 	$json = array(
			        "status" => 1,
			        "msg" => "success"
				);
		        //echo $conn->error;
		    }
	    else{
	    	$json = array(
	        "status" => 0,
	        "msg" => "failed"
			);
		}

		return $json;


}

function add_upvote_in_user($user_id, $article_id){
	
	include 'include/config.php';
	$upvotes = get_upvotes_by_user_id($user_id); 	
 	$value_to_add = $article_id;
 	if (!empty($upvotes)) {
 		$newString = addtoString($upvotes, $value_to_add);

 	}
 	else{
 		$newString = $article_id;
 	}
 	
 	

	$query = "UPDATE users SET upvotes ='$newString' WHERE id = $user_id";
		$stmt = $conn->prepare($query);
		//$stmt->execute();
		 if ($stmt->execute()) {
			 	$json = array(
			        "status" => 1,
			        "msg" => "success"
				);
		        //echo $conn->error;
		      add_no_of_upvotes_in_articles($article_id); 
		    }
	    else{
	    	$json = array(
	        "status" => 0,
	        "msg" => "failed"
			);
		}

		return $json;


}


function get_no_of_upvotes_of_article($article_id){
	include 'include/config.php';
	if (!empty($article_id)) {

	$query = "SELECT no_of_upvotes FROM `articles` WHERE id = $article_id";
			$stmt = $conn->prepare($query);
			$stmt->execute();		
			$num = $stmt->rowCount();
			if($num>0){
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){			  
			    extract($row);	
			    $res = $no_of_upvotes;
				 }
			}
			
			return $res;
			
			
	}	

}


// function get_no_of_upvotes_of_article($article_id){

// }

function add_no_of_upvotes_in_articles($article_id){
	include 'include/config.php';

	$no_of_articles = get_no_of_upvotes_of_article($article_id);
	 $no_of_articles = (int)$no_of_articles;
	 $new_value = $no_of_articles + 1;
	
	 $query = "UPDATE articles SET no_of_upvotes ='$new_value' WHERE id = $article_id";
		$stmt = $conn->prepare($query);
		//$stmt->execute();
		 if ($stmt->execute()) {
			 // 	$json = array(
			 //        "status" => 1,
			 //        "msg" => "success"
				// );
		        //echo $conn->error;
		 	return true;
		    }
	    else{
	  //   	$json = array(
	  //       "status" => 0,
	  //       "msg" => "failed"
			// );

			return false;
		}
}

function addtoString($str, $item) {
    $parts = explode(',', $str);
    

    if (!in_array($item, $parts)) {
    	$parts[] = $item;
    }

    return implode(',', $parts);
    }


function get_all_articles(){
	include 'include/config.php';
	$query = "SELECT a.id, a.title,a.image, a.content, a.categories, a.topics, a.scientific, a.views, a.tags, a.created_on, a.status 
											    FROM articles as a                                                
											    ORDER BY id DESC LIMIT 0,20";

			$stmt = $conn->prepare($query);
			$stmt->execute();		
			$num = $stmt->rowCount();
			 $res = array();
			if($num>0){
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){			  
			    extract($row);			
			  array_push($res, array("id" => $id, 
			     				"title" => $title,
			     				"content" => $content,
			     				"image" => $image,		     				
			     				"categories" => get_category_name($categories),
			     				"topics" => get_topic_name($topics), 	
			     				"tags" => get_tag_name($tags), 			     				
			     				"view" => $views, 
			     				"scientific" => $scientific, 	
			     				"created_on" => Date('d M yy', strtotime($created_on)), 	
			     				"status" => $status
			     			));
				}
			}

			//print_r($res);
			return $res;
}


function get_all_trending_articles(){
	include 'include/config.php';
	$query = "SELECT a.id, a.title , a.content, a.categories, a.topics, a.scientific, a.views, a.tags, a.created_on, a.status FROM articles as a WHERE a.created_on > NOW() - INTERVAL 4 WEEK ORDER BY views DESC LIMIT 0,5";

			$stmt = $conn->prepare($query);
			$stmt->execute();		
			$num = $stmt->rowCount();
			 $res = array();
			if($num>0){
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){			  
			    extract($row);			
			  array_push($res, array("id" => $id, 
			     				"title" => $title,
			     						     				
			     				"categories" => get_category_name($categories),
			     				"topics" => get_topic_name($topics), 	
			     				"tags" => get_tag_name($tags), 			     				
			     				"view" => $views, 
			     				"scientific" => $scientific, 	
			     				"created_on" => Date('d M yy', strtotime($created_on)), 	
			     				"status" => $status
			     			));
				}
			}

			//print_r($res);
			return $res;
}



function get_all_recent_articles(){
	include 'include/config.php';
	$query = "SELECT a.id, a.title , a.content, a.categories, a.topics, a.scientific, a.views, a.tags, a.created_on, a.status FROM articles as a ORDER BY a.created_on DESC LIMIT 0,5";

			$stmt = $conn->prepare($query);
			$stmt->execute();		
			$num = $stmt->rowCount();
			 $res = array();
			if($num>0){
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){			  
			    extract($row);			
			  array_push($res, array("id" => $id, 
			     				"title" => $title,
			     						     				
			     				"categories" => get_category_name($categories),
			     				"topics" => get_topic_name($topics), 	
			     				"tags" => get_tag_name($tags), 			     				
			     				"view" => $views, 
			     				"scientific" => $scientific, 	
			     				"created_on" => Date('d M yy', strtotime($created_on)), 	
			     				"status" => $status
			     			));
				}
			}

			//print_r($res);
			return $res;
}

function get_all_popular_articles(){
	include 'include/config.php';
	$query = "SELECT a.id, a.title , a.content, a.categories, a.topics, a.scientific, a.views, a.tags, a.created_on, a.status FROM articles as a ORDER BY views DESC LIMIT 0,5";

			$stmt = $conn->prepare($query);
			$stmt->execute();		
			$num = $stmt->rowCount();
			 $res = array();
			if($num>0){
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){			  
			    extract($row);			
			  array_push($res, array("id" => $id, 
			     				"title" => $title,
			     						     				
			     				"categories" => get_category_name($categories),
			     				"topics" => get_topic_name($topics), 	
			     				"tags" => get_tag_name($tags), 			     				
			     				"view" => $views, 
			     				"scientific" => $scientific, 	
			     				"created_on" => Date('d M yy', strtotime($created_on)), 	
			     				"status" => $status
			     			));
				}
			}

			//print_r($res);
			return $res;
}


function get_all_topics($limit=NULL){
	include 'include/config.php';

	if ($limit) {
		$query = "SELECT id, title
					    FROM topics WHERE status =1
					    ORDER BY id DESC LIMIT". $limit;
	}
	else{
		$query = "SELECT id, title, description
					    FROM topics WHERE status =1
					    ORDER BY id DESC";
	}
	

			$stmt = $conn->prepare($query);
			$stmt->execute();		
			$num = $stmt->rowCount();
			 $res = array();
			if($num>0){
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){			  
			    extract($row);			
			 array_push($res, array("id" => $id, 
			     			     	"title" => $title,
			     			     	"description" => $description
			     			     				
			     			     			));
				}

			
			}
			return $res;
}

function get_all_categories(){
	include 'include/config.php';
	$query = "SELECT id, title,description,created_on
					    FROM categories WHERE status =1
					    ORDER BY id DESC LIMIT 0,20";

			$stmt = $conn->prepare($query);
			$stmt->execute();		
			$num = $stmt->rowCount();
			 $res = array();
			if($num>0){
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){			  
			    extract($row);			
			 array_push($res, array("id" => $id, 
			     			     	"title" => $title,
			     			     	"description" => $description,
			     			     	"created_on"=>$created_on
			     			     				
			     			     			));
				}

			
			}
			return $res;
}

function get_all_tags(){
	include 'include/config.php';
	$query = "SELECT * FROM tags WHERE status =1
					    ORDER BY id DESC LIMIT 0,20";

			$stmt = $conn->prepare($query);
			$stmt->execute();		
			$num = $stmt->rowCount();
			 $res = array();
			if($num>0){
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){			  
			    extract($row);			
			 array_push($res, array("id" => $id, 
			     			     	"title" => $title,
			     			     	"slug" => $slug
			     			     				
			     			     			));
				}

			
			}
			return $res;
}

function get_articles_by_topic_id($topic_id){
	include 'include/config.php';
	if (!empty($topic_id)) {

	 	 $topics = $topic_id;		
	 	
	   $query = "SELECT a.id, a.title , a.content, a.categories, a.topics, a.scientific, a.views, a.tags, a.created_on, a.status 
											    FROM articles as a      
											    WHERE FIND_IN_SET($topics, a.topics)                         
											    ORDER BY id DESC LIMIT 0,20";
			$stmt = $conn->prepare($query);
				$stmt = $conn->prepare($query);
				$stmt->execute();		
				$num = $stmt->rowCount();
				 $res = array();
				if($num>0){
					while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){			  
					    extract($row);			

					     array_push($res, array("id" => $id, 
			     				"title" => $title,	
			     				"content" => $content,		     				
			     				"categories" => get_category_name($categories),
			     				"topics" => get_topic_name($topics), 	
			     				"tags" => get_tag_name($tags), 			     				
			     				"view" => $views, 
			     				"scientific" => $scientific, 	
			     				"created_on" => Date('d M yy', strtotime($created_on)), 	 	
			     				"status" => $status
			     			));
						}

					}

					//print_r($res);

					return $res;
	 		}
}

function get_all_articles_2(){
	include 'include/config.php';
	if (!empty($category_id)) {

	 	 $categories = $category_id;		
	 	
	 	// echo  $query = "SELECT a.id, a.title , a.content, a.categories, a.topics, a.scientific, a.views, a.tags, a.created_on, a.status 
			// 								    FROM articles as a      
			// 								    WHERE a.categories in ($categories)                                            
			// 								    ORDER BY id DESC LIMIT 0,20";


	$query = "SELECT a.id, a.title , a.content, a.categories, a.topics, a.scientific, a.views, a.tags, a.created_on, a.status 
											    FROM articles as a      
											    WHERE status = 1                   
											    ORDER BY id DESC LIMIT 0,20";


			$stmt = $conn->prepare($query);
				$stmt = $conn->prepare($query);
				$stmt->execute();		
				$num = $stmt->rowCount();
				 $res = array();
				if($num>0){
					while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){			  
					    extract($row);			

					     array_push($res, array("id" => $id, 
			     				"title" => $title,	
			     				"content" => $content,		     				
			     				"categories" => get_category_name($categories),
			     				"topics" => get_topic_name($topics), 	
			     				"tags" => get_tag_name($tags), 			     				
			     				"view" => $views, 
			     				"scientific" => $scientific, 	
			     				"created_on" => Date('d M yy', strtotime($created_on)), 	 	
			     				"status" => $status
			     			));
						}

					}

					//print_r($res);

					return $res;
	 		}

}

function get_articles_by_category_id($category_id){
	include 'include/config.php';
	if (!empty($category_id)) {

	 	 $categories = $category_id;		
	 	
	 	// echo  $query = "SELECT a.id, a.title , a.content, a.categories, a.topics, a.scientific, a.views, a.tags, a.created_on, a.status 
			// 								    FROM articles as a      
			// 								    WHERE a.categories in ($categories)                                            
			// 								    ORDER BY id DESC LIMIT 0,20";


	$query = "SELECT a.id, a.title, a.image, a.content, a.categories, a.topics, a.scientific, a.views, a.tags, a.created_on, a.status 
											    FROM articles as a      
											    WHERE FIND_IN_SET($categories, a.categories)                    
											    ORDER BY id DESC LIMIT 0,20";


			$stmt = $conn->prepare($query);
				$stmt = $conn->prepare($query);
				$stmt->execute();		
				$num = $stmt->rowCount();
				 $res = array();
				if($num>0){
					while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){			  
					    extract($row);			

					     array_push($res, array("id" => $id, 
			     				"title" => $title,	
			     				"content" => $content,		     				
			     				"categories" => get_category_name($categories),
			     				"topics" => get_topic_name($topics), 	
			     				"tags" => get_tag_name($tags), 
			     				"image" => $image,			     				
			     				"view" => $views, 
			     				"scientific" => $scientific, 	
			     				"created_on" => Date('d M yy', strtotime($created_on)), 	 	
			     				"status" => $status
			     			));
						}

					}

					//print_r($res);

					return $res;
	 		}

}

function get_articles_by_category($category_id){
	include 'include/config.php';
	if (!empty($category_id)) {

	 	 $categories = $category_id;

		$query = "SELECT a.id, a.title , a.content, a.categories, a.topics, a.scientific, a.views, a.tags, a.created_on, a.status 
											    FROM articles as a      
											    WHERE a.categories = $category_id 
											    ORDER BY id DESC LIMIT 0,20";


			$stmt = $conn->prepare($query);
				$stmt = $conn->prepare($query);
				$stmt->execute();		
				$num = $stmt->rowCount();
				 $res = array();
				if($num>0){
					while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){			  
					    extract($row);			

					     array_push($res, array("id" => $id, 
			     				"title" => $title,	
			     				"content" => $content,		     				
			     				"categories" => get_category_name($categories),
			     				"topics" => get_topic_name($topics), 	
			     				"tags" => get_tag_name($tags), 			     				
			     				"view" => $views, 
			     				"scientific" => $scientific, 	
			     				"created_on" => Date('d M yy', strtotime($created_on)), 	 	
			     				"status" => $status
			     			));
						}

					}

					//print_r($res);

					return $res;
	 		}

}

function get_no_of_articles_by_topics($topics){

	include 'include/config.php';

	$query = "SELECT a.id, a.title , a.content, a.categories, a.topics, a.scientific, a.views, a.tags, a.created_on, a.status 
											    FROM articles as a      
											    WHERE a.topics in ($topics)                                            
											    ORDER BY id DESC LIMIT 0,20";
			$stmt = $conn->prepare($query);
				$stmt = $conn->prepare($query);
				$stmt->execute();		
				$num = $stmt->rowCount();
				// $res = array();
				if($num>0){

					return $num;
				}
				else {
					return 0;
				}

}

// function get_all_podcast_article($category_name){                         
// 											    ORDER BY id DESC LIMIT 0,20";
// 			$stmt = $conn->prepare($query);
// 				$stmt = $conn->prepare($query);
// 				$stmt->execute();		
// 				$num = $stmt->rowCount();
// 				 $res = array();
// 				if($num>0){
// 					while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){			  
// 					    extract($row);			

// 					     array_push($res, array("id" => $id, 
// 			     				"title" => $title,	
// 			     				"content" => $content,		     				
// 			     				"categories" => get_category_name($categories),
// 			     				"topics" => get_topic_name($topics), 	
// 			     				"tags" => get_tag_name($tags), 			     				
// 			     				"view" => $views, 
// 			     				"scientific" => $scientific, 	
// 			     				"created_on" => Date('d M yy', strtotime($created_on)), 	 	
// 			     				"status" => $status
// 			     			));
// 						}

// 					}

// 					//print_r($res);

// 					return $res;
// 	 		}
// }

function get_sign_in($user_id, $user_pass){	

	include 'include/config.php';
	if (!empty($user_id)) {

	 $query = "SELECT * FROM `users` WHERE (name='$user_id' OR email ='$user_id') and password='$user_pass' LIMIT 1";	
			$stmt = $conn->prepare($query);
				$stmt = $conn->prepare($query);
				$stmt->execute();		
				$num = $stmt->rowCount();
				 $res = array();
				if($num>0){
					while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){			  
					    extract($row);			

					   $res = array("id" => $id, 
			     				"name" => $name,	
			     				"scientific" => $scientific, 	
			     				"status" => $status
			     			);
						}

					}

					return $res;
	 		}
}

function base_url(){
    $base_url = "https://dimapur24x7.com/";
    return $base_url;
}





?>