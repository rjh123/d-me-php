<!--Drupalize.me Advanced Theming -->

<?php

// Resources:
// https://drupalize.me/drupal-themer
// https://drupalize.me/videos/using-theme-developer-module?p=1151
//turn on xdebug in MAMP
//dsm();


// preprocess functions:

// intro:

themename_preprocess(&$vars, $hook){
	if ($hook == 'page'){
		$vars['my_new_variable'] = 'some value';
	}
}

// or more specific:

themename_preprocess_hook(&$vars){
	$vars['my_new_variable'] = 'some value';
}

// ----------------
// php:
// The second thing references do is to pass variables by reference. This is done by making a local variable in a function and a variable in the calling scope referencing the same content. Example:

function foo(&$var)
{
    $var++;
}
	$a=5;
	foo($a);

// <!-- will make $a to be 6. This happens because in the function foo the variable $var refers to the same content as $a. For more information on this, read the passing by reference section. -->

// <!-- 

//overriding theme functions:
function theme_username($object){
	//...
	return $output;
}

/*  ------------ end -------------*/

// use this syntax to call theme functions:
theme('username', $object);

// when to use template.php  vs. page.tpl.php:
// tpl's are for markup as in HTML markup
// logic, for template.php

/*  ------------ end -------------*/

// Themes:
// .info file
// template files
// template.php

/*  ------------ end -------------*/

//PHP for themers (2 in series)

// arrays map values to keys
// associative arrays:
// ex. 
array('red' => 'cherries', 'green' => 'apple');

//objects: (with properties)
//ex. 
$robot->color;
// objects can have methods also: 
$robot->action();

// chained together:
// ex. 
print $node->links['blog_usernames_blog']['href'];
//$node = an object
//links = a property ( a 2 dimensional array)
//blog_usernames_blog = key
//href = key

//conditionals:
if(...){
//...
}
elseif(...){
//...
}
else{
//...
}

// syntax variations:
// ex. 1 (if a equals be then print "it's equal")
if($a==$b) : 
	print "It's equal";
endif;

//ex. 2 (shorthand)
print ($a == $b) ? "It's equal!" : ''; 
/* 
translation: 
print = do this
($a == $b) = if
? = then
: = else
*/

// switch:
// way to write long if/else statements
// ex.
switch($time_of_day){
	case 'morning':
	print "Eat breakfast.";
	break;
	case 'afternoon' :
	print "Lunch time.";
	break;
	default :
	print "zzzzz...";
}

//break is to stop the  statement from executing

//loops:
// while loops
//ex. $i=0;
while($i < 10){
	print "Love you";
	$i++;
}

//for loops:
//ex. 
for($i = 0;$i < 10; $i++){
	print "Love you";
}

// foreach: (execute something on each item in the array)
foreach($stuff as $item){
	print $item;
}

//functions:
function my_function($a, $b){
	$c = $a + $b;
	return $c;
}


//***************************** PASS BY REFERENCE *****************************//
function my_function(&$a, $b){
	$c = $a + $b;
	$a = $a + 1;
	return $c;
// what this means is that if value of, say 4, is passed in for variable $a, then it gets updated based on what happens in the function, namely, 1 gets added to it ($a = $a + 1); if "&" wasn't there, then $a would remain as four after the function has run;
// when value is changed inside the function, that value persists outside the function	
}
//************************ END OF PASS BY REFERENCE **************************//


/*  ------------ end -------------*/

// Altering variables with preprocess functions: (3 in series)
// NO CLOSING PHP TAG IS USED ON PHP FILES IN DRUPAL
// devel function kpr(); ex. kpr($hook);

// if add new file or function to theme (as in template.php) clear cache
function themename_preprocess(&$variables, $hook){
	static $i;
	kpr($i . ' ' . $hook);
	$i++;
}


/*  ------------ end -------------*/

function themename_preprocess_page(&$variables){
	$variables['site-slogan'] = 'a new slogan'; //site_slogan is a page variable
	kpr($vaiables);
}

/*  ------------ end -------------*/

function themename_preprocess_page(&$variables){
	$slogans = array();
	$slogans[] = t('life is good'); // t function: if write output in strings, use this function
	kpr($variables);
}
	$slogan = $slogans[array_rand($slogans)]; //pick a random slogan
	$variables['site_slogan'] = $slogan; // 

// whole list of functions for all sorts of things: page.tpl, node.tpl, comment.tpl, search-result.tpl,html.tpl,  etc.

// every contributed module could add its own template file, so I can add a preprocess function for each one

/*  ------------ end -------------*/

// Adding new variables with preprocess functions (4 in series)

// task: show different message based on whether user is logged in or not
// (start with using previous example, and add...)
$variables['variable_name'] = t('hello');
kpr($variables);

// write conditional for logged in or not
// //BTW: variable was created in template.php: 
$variables['footer_message'] = t('Welcome');

if($variables['logged_in']){
	$variables['footer_message'] = t('logged in');
}
else{
	$variables['footer_message'] = t('logged out');
}

//t function
//t function allows variables to be typed in- ex.@username
t('Welcome @username',array('@username' => $variables['user']->name));

/* end */

// Adding new variables to s specific node type (5 in series)

function test_preprocess_node(&$variables){
	// show node variables
	//kpr($variables); 
	//show variables in the content type of article
	if($variables['type'] == 'article'{
		// made $node only about article nodes object
		$node = $variables['node'];
		kpr('node'); //show me everything about article node object
		//create variable "submitted_day" and put in variables array; use api reference for function format_date and see parameters, and use that on the node object's property "created"
		$variable['submitted_day'] = format_date($node->created, 'custom','j');
	}
}

Adding conditional CSS and JS (5 in series)

// conditional CSS or JS
//can use preprocess functions at node or page level
function themename_preprocess_page(&$variables){
	if($variables[is_front] == TRUE){
 //go to drupal.org to see drupal_add_css function parameters ($data and $options)
		drupal_add_css(path_to_theme(). 'css/front.css', array(group=>CSS_THEME,'weight'=>30);
	// path_to_theme
		// api.drupal.org (also had $options look for group to get front.css to show at end of css files- option for weight, etc.)
	}
	// another function is drupal_add_js
}

 Dynamic Templates with Theme Hook Suggestion (6 in series)
// see template.php file for exercises

/*  ------------ end -------------*/

OVERRIDING THEME FUNCTIONS

/*
Use the theme developer tool, you can find the theme function controlling the part of the page I want to affect. click the name of the function and it goes to api.drupal.org. After making changes, make sure to clear cache.  
*/
/* FUNCTION NAME SUGGESTIONS
better to use the theme_field_ suggestions (https://api.drupal.org/api/drupal/modules%21field%21field.module/function/theme_field/7) for a function in template.php than to write/edit the field.tpl.php file which would have to get called for every field on a page.
ex.: THEMENAME_field__body__article() for the body field on an article content type
*/
// in template.php, what below does is to put what's in the first part <', "> in between the elements in the #links array
$output .= implode(', ', $links);
// whole thing:
fucntion my_function_field__field_tags($variables){
	$output = "";
	// print variables with kpr()
	//kpr($variables);
	
	foreach($variables['$items'] as $delta => $item){
		$links[] = drupal_render($item);
	}
	$output .= implode(', ', $links);
}

// using render function to render arrays


/********************************************************************************************
***************************************from Definitive Guide ********************************
********************************************************************************************/

// scenario 1

// RESULTS: read more link on page says "me no" and goes to yahoo.com

/* in block.tpl.php
 <div><?php print theme('more_link',array('url'=> 'http://yahoo.com','title'=>'me no')); ?></div>
*/

/* IMPORTANT: 
- it gets 'more_link' above from Drupal, so if I commented the function below out, I'd get "More" as per: https://api.drupal.org/api/drupal/includes%21theme.inc/function/theme_more_link/7.x
- also, I'm creating an array right in the block.tpl.php
*/

function subzen_more_link($variables) {
  //dpm($variables);
  //drupal_set_message('got here');
  return '<div class="more-link">' . l(t($variables['title']), $variables['url'], array('attributes' => array('title' => $variables['title']))) . '</div>';
}

// https://api.drupal.org/api/drupal/modules!block!block.module/function/template_preprocess_block/7.x
/*
above link shows using the "&" before $variables
function template_preprocess_block
7.x block.module	template_preprocess_block(&$variables)...
*/

function subzen_preprocess_block(&$variables){
  //drupal_set_message('got here');
  $variables['more_link']['url'] = 'http://google.com';
  $variables['more_link']['title'] = t('go here');

}

// anywhere where an image is being called return "hello" if for example in my block.tpl.php, I wrote: 
// <div><?php print theme('image'); ...></div>
function subzen_image($variables){
  return "hello";
}
/**********************************/

// scenario 2

// RESULTS:  read more link "go here" and takes me to google.com
// in block.tpl.php
// <div><?php print subzen_more_link($variables['more_link']); ></div>

function subzen_more_link($variables) {
  //dpm($variables);
  drupal_set_message('got here');
  return '<div class="more-link">' . l(t('read more books'), $variables['url'], array('attributes' => array('title' => $variables['title']))) . '</div>';
}
function subzen_preprocess_block(&$variables){
  //drupal_set_message('got here');
  $variables['more_link']['url'] = 'http://google.com';
  $variables['more_link']['title'] = t('go here');

}

// EXTRA: if your not using "return" in the function I need to use &$variables
// EXTRA: can use drupal_set_message("hi") to see it function is actually getting called
/* EXTRA: 
in commented out part of  template filem so not in html part: print_r($variables);
or in template can use:
<pre>
<?php print_r($variables); ?>
</pre>
*/


