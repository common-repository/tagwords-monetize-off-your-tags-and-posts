<?php
/*
Plugin Name: tagwords - monetize off of your posts and tags
Plugin URI: http://tagwords.uintu.com/2010/05/17/tagwords-with-tagsoda-and-wordpress-documentation/
Description: Monetize off of your tags and posts. When a person clicks on your tags a product listing related to that tag appears on your blog. When a person clicks or buys something from your listing you earn money. Also sell your posts to merchants looking to advertise with content.
Version: 1.2.2
Author: tagsoda llc
Author URI: http://www.tagsoda.com/content/about
License: GPL2
    Copyright 2010  tagsoda llc  (email : support@tagsoda.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

*/

function tgs_options() {
  add_menu_page('tagsoda', 'tagsoda', 8, basename(__FILE__), 'tgs_options_page');
  add_submenu_page(basename(__FILE__), 'Settings', 'Settings', 8, basename(__FILE__), 'tgs_options_page');
}

function tgs_options_page() {
?>
    <div class="wrap">
    <div class="icon32" id="icon-options-general"><br/></div><h2>Settings for tagsoda Integration</h2>
    <p>To monetize off of your tags use tagsodas tagwords. tagwords link to product listings of related tags that you use in your posts. Every time someone clicks on a product listing and buys a product from your blog posts you earn a commission from that sale.  You will need an active tagsoda account to use. To open a free account <a href="http://www.tagsoda.com/content/about/" target="_blank">click here</a>  Its free and easy.
    </p>
    <form method="post" action="options.php">
    <?php
        // New way of setting the fields, for WP 2.7 and newer
        if(function_exists('settings_fields')){
            settings_fields('tgs-options');
        } else {
            wp_nonce_field('update-options');
            ?>
            <input type="hidden" name="action" value="update" />
            <input type="hidden" name="page_options" value="tgs_user_id,tgs_add_posts,tgs_add_tags,tgs_catalog_url,tgs_add_url,tgs_style,tgs_cost,tgs_forsale,tgs_where,tgs_word,tgs_powered,tgs_links,tgs_tagwords" />
            <?php
        }
    ?>
        <table class="form-table">
            <tr>
               <th scope="row">
                    <label for="tgs_add_tags"><b>Instructions</b></label>
                </th>
                <td>
                   <p>tagsoda allows you to commercial off of your tagged posts.  You can either use a tag group from your account to display on your post or only tags used with in the post itself that you add to your account.</p>
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="tgs_user_id">tagsoda API Token</label>
                </th>
                <td>
                  <p>This can be retrieved by logging into your tagsoda account and clicking on My Profile</p>
                    <p>
                        <input type="text" value="<?php echo get_option('tgs_user_id'); ?>" name="tgs_user_id" id="tgs_user_id" />
                    </p>
                    <span class="setting-description">Your tagsoda User ID, available from <a href="http://www.tagsoda.com/content/about" target="_blank">tagsoda</a></span>
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="tgs_user_id">tagsoda Secret Word</label>
                </th>
                <td>
                  <p>This can be set by logging into your tagsoda account and clicking on My Profile</p>
                    <p>
                        <input type="password" value="<?php echo get_option('tgs_word'); ?>" name="tgs_word" id="tgs_word" />
                    </p>
                    <span class="setting-description">Your tagsoda Secret Word, available from <a href="http://www.tagsoda.com/content/about" target="_blank">tagsoda</a></span>
                </td>
            </tr>
            <tr>
            <th scope="row">
                    Position
                </th>
                <td>
                <p>This tells us where to put the tagwords links on your post</p>
                  <p>
                    <select name="tgs_where">
                      <option <?php if (get_option('tgs_where') == 'before') echo 'selected="selected"'; ?> value="before">Before</option>
                      <option <?php if (get_option('tgs_where') == 'after') echo 'selected="selected"'; ?> value="after">After</option>
                      <option <?php if (get_option('tgs_where') == 'beforeandafter') echo 'selected="selected"'; ?> value="beforeandafter">Before and After</option>
                      <option <?php if (get_option('tgs_where') == 'shortcode') echo 'selected="selected"'; ?> value="shortcode">Shortcode [tagwords]</option>
                      <option <?php if (get_option('tgs_where') == 'manual') echo 'selected="selected"'; ?> value="manual">Manual</option>
                    </select>
                  </p>
                </td>
             </tr>
             <tr>
                <th scope="row"><label for="tm_style">Styling</label></th>
                <td>
                    <input type="text" value="<?php echo htmlspecialchars(get_option('tgs_style')); ?>" name="tgs_style" id="tgs_style" />
                    <span class="setting-description">Add style to the div that surrounds the tagword code E.g. <code>float: left; margin-right: 10px;</code></span>
                </td>
            </tr>   
            <tr>
               <th scope="row">
                    <label for="tgs_add_posts">Add Post to tagsoda searchable database</label>
                </th>
                <td>
                  <p>This will allow others to find your blog post and give your blog greater exposure.</p>
                    <p>
                        <input type="checkbox" value="1" <?php if(get_option("tgs_add_posts")==1) echo "checked"?> name="tgs_add_posts" id="tgs_add_posts" />
                    </p>
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="tgs_add_tags">Add tags to tagsoda searchable database</label>
                </th>
                <td>
                  <p>When you enter your tags into the post tag field. Those tags along with your url will be added to your account and searchable from tagsodas database.</p>
                    <p>
                        <input type="checkbox" value="1" <?php if(get_option("tgs_add_tags")==1) echo "checked"?> name="tgs_add_tags" id="tgs_add_tags" />
                    </p>
                </td>
            </tr>
            <tr>
            <th scope="row">
                    by tagsoda
                </th>
                <td>
                <p>Show "by tagsoda" link on your listing and tagwords codes</p>
                  <p>
                    <select name="tgs_powered">
                      <option <?php if (get_option('tgs_powered') == '0') echo 'selected="selected"'; ?> value="0">No</option>
                      <option <?php if (get_option('tgs_powered') == '1') echo 'selected="selected"'; ?> value="1">Yes</option>
                    </select>
                  </p>
                </td>
             </tr>
             <tr>
            <th scope="row">
                    have tagsoda analyzer 
                </th>
                <td>
                <p>Have tagsoda analyze your title, and content for matching tagwords.</p>
                  <p>
                    <select name="tgs_tagwords">
                      <option <?php if (get_option('tgs_tagwords') == '0') echo 'selected="selected"'; ?> value="0">No</option>
                      <option <?php if (get_option('tgs_tagwords') == '1') echo 'selected="selected"'; ?> value="1">Yes</option>
                    </select>
                  </p>
                </td>
             </tr>
              <tr>
            <th scope="row">
                    tagsoda links
                </th>
                <td>
                <p>Create links in your content on tagwords to earn even more money.  Better click through rate.</p>
                  <p>
                    <select name="tgs_links">
                      <option <?php if (get_option('tgs_links') == '0') echo 'selected="selected"'; ?> value="0">No</option>
                      <option <?php if (get_option('tgs_links') == '1') echo 'selected="selected"'; ?> value="1">Yes</option>
                    </select>
                  </p>
                </td>
             </tr>
            <tr>
               <th scope="row">
                    <label for="tgs_forsale">Sell my Posts</label>
                </th>
                <td>
                  <p>This allows you to sell your posts to merchants selling products that relate to your post.  Merchants can then distribute your post too 5 different affiliates.  Credit for the post will always be attributed to you.</p>
                    <p>
                      <select name="tgs_forsale">
                      <option <?php if (get_option('tgs_forsale') == 'searchable') echo 'selected="selected"'; ?> value="searchable">Searchable</option>
                      <option <?php if (get_option('tgs_forsale') == 'free') echo 'selected="selected"'; ?> value="free">Free</option>
                      <option <?php if (get_option('tgs_forsale') == 'money') echo 'selected="selected"'; ?> value="money">Sell my Post</option>
                                          </select>  
                    </p>
                </td>
            </tr>
            <tr>
               <th scope="row">
                    <label for="tgs_cost">Cost of Posts</label>
                </th>
                <td>
                  <p>If selling your posts, set the price you are willing to sell your post at. <code>format: 0.00</code>Do not include $</p>
                    <p>
                     <input type="text" value="<?php echo get_option("tgs_cost");?>" name="tgs_cost" id="tgs_cost" />
                    </p>
                </td>
            </tr>
             <tr>
                <th scope="row">
                    <label for="tgs_user_id">tagsoda listing page url</label>
                </th>
                <td>
                  <p>If you would like to keep the product listing that matches the tag clicked from your posts.  You will need to add the full url of your listing page otherwise the tags will link back to tagsoda. URL must include http:// or https://. The listing page must include the shortcode [tagwords-listing] where you want your products to appear.</p>
                    <p>
                        <input type="text" value="<?php echo get_option('tgs_catalog_url'); ?>" name="tgs_catalog_url" size="65" id="tgs_catalog_url" />
                    </p>
                </td>
            </tr>
        </table>
        <p class="submit">
            <input type="submit" name="Submit" value="<?php _e('Save Changes') ?>" />
        </p>
    </form>
    </div>
<?php
}

function tgs_add_core_tags($tag){
  //add the tags
   
   $user_id=get_option("tgs_user_id");
    $secret_word=get_option("tgs_word");
    if($user_id && $tag && get_option("tgs_add_tags")){
      $type=7;  //comes from tagsoda documentation
      
      $send_data="user_id=".$user_id."&secret_word=".$secret_word."&type=".$type."&tags=".urlencode($tag);
      send_get_tagsoda($send_data);
    }

}

function tgs_get_post_tags($post_id){
       global $wpdb;
       $html ="";
       $tags = $wpdb->get_results("SELECT DISTINCT terms2.name as tag_name FROM $wpdb->posts as p2 LEFT JOIN $wpdb->term_relationships as r2 ON p2.ID = r2.object_ID LEFT JOIN $wpdb->term_taxonomy as t2 ON r2.term_taxonomy_id = t2.term_taxonomy_id LEFT JOIN $wpdb->terms as terms2 ON t2.term_id = terms2.term_id WHERE (t2.taxonomy = 'post_tag' AND p2.post_status = 'publish' AND p2.ID = $post_id) ORDER BY tag_name");
       
       foreach($tags as $tag){
          if(strlen($html)==0){
            $html=addslashes($tag->tag_name);
          }else{
            $html=",".addslashes($tag->tag_name);
          }
       }
       
       return $html;

}

function tgs_add_post(){
    $post_id=$_REQUEST['post_ID'];
    
    //user_id
    $user_id=get_option("tgs_user_id");
    $secret_word=get_option("tgs_word");
    $mon_type=get_option("tgs_forsale");
   
    if($user_id){
      //add article
      $type=3;  //add articles to tagsoda api docs
      
      //title
       $title = $_REQUEST['post_title'];
       
      //description
       $description=$_REQUEST['content']; 
     
       //tags
       $tags = $_REQUEST['tax_input']['post_tag']; 
       
       if($mon_type=="searchable"){
         $money=1;
       }elseif($mon_type="money"){
         $money=3;
       }else{
         $money=1;
       }
      //url
      if($post_id)
        $url = get_permalink($post_id);
      else
        $url = get_permalink();
      
      $send_data="user_id=".$user_id."&secret_word=".$secret_word."&type=".$type."&title=".urlencode($title)."&description=".urlencode($description)."&url=".urlencode($url)."&post_id=".$post_id."&tags=".urlencode($tags)."&monetize_type=".$money."&cost_of_article=".get_option("tgs_cost")."&analyze=".get_option("tgs_tagwords");
      send_get_tagsoda($send_data);
      
    }
}

function ts_get_tagwords($content){
    $user_id=get_option("tgs_user_id");
    $secret_word=get_option("tgs_word");
    
    if($user_id){
      //get tagwords from account
      $send_data = "user_id=".$user_id."&secret_word=".$secret_word."&type=6";
      $tags=send_get_tagsoda($send_data);
     
      //parse content of post and create 
      $tags = explode(",",$tags);
      $found_tags = array();
      $key = 0;
      if(count($tags)>0){
        foreach($tags as $tag){
          if(strlen($tag)>0){
           if(strpos($content,$tag)>0){
            $found_tags[$key]=$tag;
             $key++;
           }
         }
        }
      }
      
      if(count($found_tags)>0){
        $content=tgs_get_tagword_display($found_tags,$content);
      }     
    }
    return $content;  
}


function tgs_get_tagword_display($tags,$content){
   $links=get_option("tgs_links");
  if ((get_option('tgs_where') == 'manual') && !($links)) {
        return $content;
  }
  
   if($links==1){
      $content=get_tgs_links($content);
   }
   
  $where = get_option('tgs_where');
  $code = tgs_get_tagword_code($tags);
  
  if ($where == 'shortcode') {
    return str_replace('[tagwords]', $code, $content);
  } else if ($where == 'beforeandafter') {
        return $code . $content . $code;
  } else if ($where == 'before') {
        return $code . $content;
  } else if($where == 'after') {
        return $content . $code;
  } else {
      return $content;
  }
  
  return $content;
}

function get_tgs_links($content){
    $title = the_title();
    $data['type']=10;
    $data['secret_word']=get_option("tgs_word");
    $data['user_id']=get_option("tgs_user_id");
    $data['description']=$content;
    $send = "type=".$data['type']."&secret_word=".$data['secret_word']."&user_id=".$data['user_id']."&description=".urlencode($data['description'])."&title=".urlencode($title);
    
    $content=send_get_tagsoda($send);
    
    return $content;
}

function tgs_get_tagword_code($tags){
   if(get_option('tgs_catalog_url')){
     $base_url=get_option('tgs_catalog_url');
   }else{
     $base_url="http://www.tagsoda.com/tag/";
   }
    $user_id=get_option("tgs_user_id");
   $code ="<div style=\"".get_option('tgs_style')."\">";
   $code .="tagwords: ";
   foreach($tags as $id => $tag){
     $url=$base_url."?afid=".$user_id."&tagword=".urlencode($tag);  
     $code .="<a href='".$url."'>".$tag."</a>&nbsp;&nbsp;";
   }
   if(get_option('tgs_powered')==1)
   $code .="<a href='http://www.tagsoda.com/content/about/?afid=".$user_id."' target='_blank'>by tagsoda</a>";
   $code .="</div>";
   
   return $code;
}

function tgs_update(){
  if(get_option("tgs_add_posts")==1){
    tgs_add_post($post_id);
  }
}


function tgs_listing(){
  $tag=urldecode($_REQUEST['tagword']);
  $user_id=get_option("tgs_user_id");
  $secret_word=get_option("tgs_word");
  $html ="";  
  
    if($user_id && $tag){
      $send_data = "user_id=".$user_id."&secret_word=".$secret_word."&type=5&tag=".urlencode($tag);
      $data = send_get_tagsoda($send_data);
      
      $count=0;
     
      if(!empty($data)){
        $xmlparse = simplexml_load_string($data);
        
        $html ="<table border=0 width=100% cellpadding=3 cellspacing=3>";
        foreach($xmlparse as $product){
           $html .= "<tr>";
           $html .="<td><a href='".html_entity_decode($product->url)."'><img src='" .$product->image_url. "' height=200 width=200 border=0></a></td>";    
            $html .="<td><a href='".html_entity_decode($product->url)."'>".stripslashes(html_entity_decode($product->name))."</a><br>".stripslashes(html_entity_decode($product->summary))."</td>";
            if($product->sale_price>0){
              $html .="<td>$<del>".$product->regular_price."</del> &nbsp;&nbsp;".$product->sale_price."</td>";
            }else{
              $html .="<td>$".$product->regular_price."</td>";
            }
            $html .="</tr>";
            $html .="<tr><td colspan=3><b>Related Tags:</b> ".tgs_related_tags($product)."</td></tr>";
            $html .= "<tr><td colspan=3><hr width=95%></td></tr>";
            $count++;
        }
        if($count==0){
          $html .="<tr><td>No listings found for tagword: ".$tag."</td></tr>";
        }
        if(get_option('tgs_powered')==1)
        $html .="<tr><td colspan='30'><a href='http://www.tagsoda.com/content/about?afid=".$user_id."' target='_blank'>by tagsoda</a></td</tr>";
        $html .="</table>";
      }else{
          
           $html .="<div align='center'>No listings found for tagword: ".$tag."</div>";
          
      }  
    } 
   
   return $html; 
}


function tgs_related_tags($tags){
    
    $user_id=get_option("tgs_user_id");
  $html ="";
  if(get_option('tgs_catalog_url')){
     $base_url=get_option('tgs_catalog_url');
   }else{
     $base_url="http://www.tagsoda.com/tag/";
   }
   $tag_arry = explode(",",$tags->related_tags);
  
    foreach($tag_arry as $id => $tag){
     $url=$base_url."?afid=".$user_id."&tagword=".urlencode($tag);  
     $html .="<a href=".$url.">".$tag."</a>,&nbsp;&nbsp;";
    }
   
   return $html;
}

function send_get_tagsoda($send_data){
  
  if (function_exists('curl_init')) {
      $ch = curl_init();

    // set URL and other appropriate options
        curl_setopt($ch, CURLOPT_URL, 'https://secure.tagsoda.com/api/?'.$send_data);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
        curl_setopt($ch, CURLOPT_TIMEOUT, 3);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // grab URL and pass it to the browser
        $data = curl_exec($ch);
        // close cURL resource, and free up system resources
        curl_close($ch);

        return $data;
    }
  return false;
}
// On access of the admin page, register these variables (required for WP 2.7 & newer)
function tgs_init(){
    if(function_exists('register_setting')){
        register_setting('tgs-options','tgs_user_id','tgs_sanitize_username');
        register_setting('tgs-options','tgs_add_posts');
        register_setting('tgs-options','tgs_add_tags');
        register_setting('tgs-options','tgs_catalog_url');
        register_setting('tgs-options','tgs_add_url');
        register_setting('tgs-options','tgs_style');
        register_setting('tgs-options','tgs_where');
        register_setting('tgs-options','tgs_forsale');
        register_setting('tgs-options','tgs_cost');
        register_setting('tgs-options','tgs_word');
        register_setting('tgs-options','tgs_links');
        register_setting('tgs-options','tgs_tagwords');
        register_setting('tgs-options','tgs_powered');
    }
}

function tgs_sanitize_username($username){
    return preg_replace('/[^0-9_]/','',$username);
}

// Only all the admin options if the user is an admin
if(is_admin()){
    add_action('admin_menu', 'tgs_options');
    add_action('admin_init', 'tgs_init');
}

// Set the default options when the plugin is activated
function tgs_activate(){
    register_setting('tgs-options', 'tgs_user_id');
}

if($_REQUEST['action']=='add-tag'){
  tgs_add_core_tags($_REQUEST['name']);
}

add_filter('the_content', 'ts_get_tagwords');
add_action('publish_post', 'tgs_update', 9);
add_shortcode('tagwords-listing', 'tgs_listing');

register_activation_hook( __FILE__, 'tgs_activate');

