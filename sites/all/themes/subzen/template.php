<?php
/**
 * @file
 * Contains the theme's functions to manipulate Drupal's default markup.
 *
 * Complete documentation for this file is available online.
 * @see https://drupal.org/node/1728096
 */
 // function hook_theme(&$variables){
 //  dpm($variables);
 // }


// basic preprocess functions NOT for page or node, etc.
function subzen_preprocess($variables, $hook){
  //kpr($hook);
  //$variables['footer_message'] = 'hike';
  //dpm($variables['view']);
}
/************************************************************
***************** OVERRIDING THEME FUNCTIONS *****************
************************************************************/

// get name of theme functions I want to override by using devel theme developer tool; click the name of the function in theme developer tool and go to api for drupal's docs on that function and then grab the code that's there and use it in template.php, modifying it with my theme name
function subzen_breadcrumb(&$variables){
  $breadcrumb = $variables['breadcrumb'];
  if(!empty($breadcrumb)){
    // provide nav heading to give context for breadcrumb links to 
    // screen reader users. Make the heading invisible with .element-invisible
    $output = '<h2 class="element-visible">' . t('You are here') . '</h2>';
    // get the page title to use at the end of the breadcrumbs
    $title = drupal_get_title();
    $output = '<div class="breadcrumb">' . implode(' &raquo; ', $breadcrumb) . ' &raquo; ' . $title . '</div>';
    return $output;
  }
}

//Overriding them functions, use:
// theme('username',$object) and NOT themename_unsername($object)


// put commas un between each taxonomy tag term
//function subzen_field__field_tags($variables){
// function subzen_field__field_tags($variables){
//   //  $output = "";
//   // //print variables with kpr()
//   //  //kpr($variables);

//   //  $links = array();
//   // foreach($variables['$items'] as $delta => $item){
//   //   $links[] = drupal_render($item);
//   // }
//   // $output .= implode(', ', $links);
//   // return $output;
// }

/************************************************************
***************** USING PREPROCESS THEME FUNCTIONS *****************
************************************************************/

// Can override theme functions with preprocess functions
// theme_username();
function subzen_preprocess_username(&$variables){
  // don't know where user_load comes from
  $account = user_load($variables['account']->uid);
  if(isset($account->field_real_name[LANGUAGE_NONE][0]['safe_value'])){
    $variables['name'] = $account->field_real_name[LANGUAGE_NONE][0]['safe_value'];    
  }
}

// function subzen_preprocess_field(&$variables){
//   //kpr($variables);
//  // $me = $variables['element']['#title'];
//   // if($variables['element']['#title'] == 'body'){
//   //   print $me;
//   // }
//   //print $me;
// }

/**
 * Override or insert variables into the maintenance page template.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("maintenance_page" in this case.)
 */
/* -- Delete this line if you want to use this function
function subzen_preprocess_maintenance_page(&$variables, $hook) {
  // When a variable is manipulated or added in preprocess_html or
  // preprocess_page, that same work is probably needed for the maintenance page
  // as well, so we can just re-use those functions to do that work here.
  subzen_preprocess_html($variables, $hook);
  subzen_preprocess_page($variables, $hook);
}
// */

/**
 * Override or insert variables into the html templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("html" in this case.)
 */
/* -- Delete this line if you want to use this function
function subzen_preprocess_html(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');

  // The body tag's classes are controlled by the $classes_array variable. To
  // remove a class from $classes_array, use array_diff().
  //$variables['classes_array'] = array_diff($variables['classes_array'], array('class-to-remove'));
}
// */

/**
 * Override or insert variables into the page templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("page" in this case.)
 */
/* -- Delete this line if you want to use this function
function subzen_preprocess_page(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');
}
// */

/************************************************************
***************** PAGE PREPROCESS FUNCTIONS *****************
************************************************************/


// sample function to print out variables
// function subzen_preprocess(&$variables, $hook) {
//     static $i;
//     kpr($i . ' ' . $hook);
//     $i++;
// }

// sample function to print out page variable
// function subzen_preprocess(&$variables, $hook) {
//  if($hook == 'page'){
//     static $i;
//     kpr($i . ' ' . $hook);
//     $i++;
//  }
// }

// sample function to print out page variable using different function name
// function subzen_preprocess_page(&$variables) {
//     print 'This is the page variable.';
// }

// show variables on the page, then alter the site slogan variable
// function subzen_preprocess_page(&$variables){
//   //kpr($variables);
//   //$variables['site_slogan'] = t('howdy, man');
// }


// show site slogan variable, and create array of slogans and pick one to display randomly
// function subzen_preprocess_page(&$variables){
//   $slogan = array(
//     t('Hi Jeeves'),
//     t('Hey Joe, where ya goin\''),
//     t('Baby, come back!')
//   );
//   //can use one of the next 2 lines to make random
//   //$variables['site_slogan'] = $slogan[rand(0,2)];
//   $variables['site_slogan'] = $slogan[array_rand($slogan)];
// }
// another way to do it
// function subzen_preprocess_page(&$variables){
//   $slogan = array(
//     t('Hi Jeeves'),
//     t('Hey Joe, where ya goin\''),
//     t('Baby, come back!')
//   );
//   $slogan = $slogan[array_rand($slogan)];

//   $variables['site_slogan'] = $slogan;
// }

// add custom css style sheet for front page
function subzen_preprocess_page(&$variables){
  // print a little footer message based on the user name
  $variables['footer_message'] = t('<p>Hey there ' . $variables['user']->name . ' </p>');

  //echo "help";
  if($variables['is_front'] == TRUE){
    $themebase = drupal_get_path('theme','subzen');

    //check output of $themebase
    //print $themebase;

    // api page: https://api.drupal.org/api/drupal/includes%21common.inc/function/drupal_add_css/7
    drupal_add_css($themebase . '/front.css',array('group'=>CSS_THEME));
    // CSS_THEME is a constant that equals 100, so could have put "100" as below:
    //drupal_add_css($themebase . '/front.css',array('group'=>100));
    // you can set the "group" which sets where (in what order) this stylesheet will load
    // can add other array elements like weight, see below:
    //drupal_add_css($themebase . '/front.css',array('group'=>CSS_THEME,'weight'=>-10));
    // path_to_theme is a good way to get the path, as below:
    //drupal_add_css(path_to_theme(). '/css/front.css');
  }
} 

/**
 * Override or insert variables into the node templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("node" in this case.)
 */
/* -- Delete this line if you want to use this function
function subzen_preprocess_node(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');

  // Optionally, run node-type-specific preprocess functions, like
  // subzen_preprocess_node_page() or subzen_preprocess_node_story().
  $function = __FUNCTION__ . '_' . $variables['node']->type;
  if (function_exists($function)) {
    $function($variables, $hook);
  }
}
// */


/************************************************************
***************** NODE PREPROCESS FUNCTIONS *****************
************************************************************/

// look at node variables
// function subzen_preprocess_node(&$variables){
//   kpr($variables);
// }

// function subzen_preprocess_node(&$variables){
//   kpr($variables);
// }

// get variables for article node type, then use "created" property of node object and create variables for day, month, year and use custom date parts (had to create the node--article.tpl.php)
function subzen_preprocess_node(&$variables){
  //dpm($variables);

  if($variables['type'] == 'article'){
   // $variables['classes_array'][] = "rick";
    $node = $variables['node'];
    $variables['classes_array'][] = "rick";
    
    $variables['submitted_day'] = format_date($node->created,'custom','j');
    $variables['submitted_month'] = format_date($node->created,'custom','M');
    $variables['submitted_year'] = format_date($node->created,'custom','Y');
  }
  else if($variables['type'] !== 'article'){
    $variables['classes_array'][] = "not-article";
  }

// // figure out rti sub image of none for some resources
//    if ($variables['type'] == 'resource'){
//      $items = field_get_items('node', $node, 'field_resource_image');
//   //   if(empty($field){
//       print "mistake";
//   //   }
//    }

  // else{
  //   $variables['classes_array'][] = "not-article";
  // }
  //if($variables['type'] == 'page'){
    //kpr($variables);
/* found theme_hook_suggestions in variables array and added to this array:
$variables['theme_hook_suggestions'][] = 'node_wednesday';
- then added a dynamic variable:
$today = strtolower(date('l'));
$variables['theme_hook_suggestions'][] = 'node_$today';
- then added new node templates- one for each day of week (ex.node--wednesday.tpl.php)
- now create a new varible to templates, to dynamically use day of week:
$variables['day_of_week'] = $today; 
- add it to node template:
<div> Hey, it's <?php print $day_of_week ?>! </div> 

*/
  //}
}

/********************** From definitive guide to Drupal *****************************


/************************************************************
***** more link (see Drupalize.me Advanced Theming doc ******
************************************************************/

// this didn't work as expected. dpm call didn't work. don't know what they mean by adding more link to block- the only way I can do that is with a view block or by adding a module that adds a field to do that and they don't mention that, so moving on for now
function subzen_more_link($variables) {
  //dpm($variables);
  //drupal_set_message('got here');
  return '<div class="more-link">' . l(t($variables['title']), $variables['url'], array('attributes' => array('title' => $variables['title']))) . '</div>';
}
function subzen_preprocess_block(&$variables){
  //drupal_set_message('got here');
  $variables['more_link']['url'] = 'http://google.com';
  $variables['more_link']['title'] = t('go here');

}
/************************************************************
***************** Theme hooks (didn't work) *****************
************************************************************/
// function mymodule_theme() {
//   return array(
//     'my_theme_hook' => array(
//       'variables' => array('parameter' => NULL),
//     ),
//   );
// }

// function theme_subzen_my_theme_hook($variables){
//   $parameter = $variables['parameter'];
//   if(!empty($parameter)){
//     echo '<h1 class="my-theme-hook">' . $parameter . '</div>';
//   }
// }

/************************************************************
*****************  *****************
************************************************************/

/**
 * Override or insert variables into the comment templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("comment" in this case.)
 */
/* -- Delete this line if you want to use this function
function subzen_preprocess_comment(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert variables into the region templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("region" in this case.)
 */
/* -- Delete this line if you want to use this function
function subzen_preprocess_region(&$variables, $hook) {
  // Don't use Zen's region--sidebar.tpl.php template for sidebars.
  //if (strpos($variables['region'], 'sidebar_') === 0) {
  //  $variables['theme_hook_suggestions'] = array_diff($variables['theme_hook_suggestions'], array('region__sidebar'));
  //}
}
// */

/**
 * Override or insert variables into the block templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("block" in this case.)
 */
/* -- Delete this line if you want to use this function
function subzen_preprocess_block(&$variables, $hook) {
  // Add a count to all the blocks in the region.
  // $variables['classes_array'][] = 'count-' . $variables['block_id'];

  // By default, Zen will use the block--no-wrapper.tpl.php for the main
  // content. This optional bit of code undoes that:
  //if ($variables['block_html_id'] == 'block-system-main') {
  //  $variables['theme_hook_suggestions'] = array_diff($variables['theme_hook_suggestions'], array('block__no_wrapper'));
  //}
}
// */
