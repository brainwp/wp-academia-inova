<?php
/**
 * @package VideoJS Pro
 * @version 1.0.0
 */
/*
Plugin Name: VideoJS Pro
Plugin URI: http://videojs.com/
Description: A video plugin for Wordpress built on the VideoJS HTML5 video player.  This plugin features professionally oriented features including the integration of a maintenence panel, mobile device detection, and Google Analytics support.  Much of this plugin is heavily based on and borrows code from the original VideoJS HTML5 Player for Wordpress plugin by Steve Heffernan, http://steveheffernan.com.
Author: Doug Stanford
Version: 1.0.0
Author URI: http://auxsend.tv
License: LGPLv3
*/

if (is_admin()){
    add_action('admin_menu', 'vjspro_settings');
    add_action('admin_init', 'register_vjspro_settings');
	add_action('admin_head', 'add_vjspro_admin_header');
}
	
function add_vjspro_admin_header () {
	echo "<script type=\"text/javascript\">\n";
	echo "<!--\n";
	echo "function numbersOnly(myfield, e, dec) {\n";
	echo "  var key;\n";
	echo "  var keychar;\n";
	echo "  if (window.event)\n";
	echo "    key = window.event.keyCode;\n";
	echo "	else if (e)\n";
	echo "    key = e.which;\n";
	echo "	else\n";
	echo "    return true;\n";
	echo "  keychar = String.fromCharCode(key);\n";
	echo "  if ((key==null) || (key==0) || (key==8) || (key==9) || (key==13) || (key==27) )\n";
	echo "   return true;\n";
	echo "	else if (((\"0123456789\").indexOf(keychar) > -1))\n";
	echo "   return true;\n";
	echo "  else if (dec && (keychar == \".\"))\n";
	echo "   {\n";
	echo "     myfield.form.elements[dec].focus();\n";
	echo "      return false;\n";
	echo "      }\n";
	echo "  else\n";
	echo "     return false;\n";
	echo "     }\n";	
	echo "function updateDimensions (whatGotUpdated) {\n";
	echo "	var theWidth = document.getElementById(\"dimWidth\").value;\n";
	echo "	var theHeight = document.getElementById(\"dimHeight\").value;\n";
	echo "	theAspectRatio = document.getElementById(\"theFrameAspect\").value;\n";
	echo "	if (theAspectRatio == \"16:9\") {\n";
	echo "		if (whatGotUpdated == \"width\") {\n";
	echo "			theUpdatedHeight = Math.round(theWidth * 9 / 16);\n";
	echo "			document.getElementById(\"dimHeight\").value = theUpdatedHeight;\n";
	echo "			}\n";		
	echo "		else if (whatGotUpdated == \"height\") {\n";
	echo "			theUpdatedWidth = Math.round(theHeight * 16 / 9);\n";
	echo "			document.getElementById(\"dimWidth\").value = theUpdatedWidth;\n";
	echo "			}\n";
	echo "		return;\n";
	echo "		}\n";
	echo "	else if (theAspectRatio == \"4:3\") {\n";
	echo "		if (whatGotUpdated == \"width\") {\n";
	echo "			theUpdatedHeight = Math.round(theWidth * 3 / 4);\n";
	echo "			document.getElementById(\"dimHeight\").value = theUpdatedHeight;\n";
	echo "			}\n";
	echo "		if (whatGotUpdated == \"height\") {\n";
	echo "			theUpdatedWidth = Math.round(theHeight * 4 / 3);\n";
	echo "			document.getElementById(\"dimWidth\").value = theUpdatedWidth;\n";
	echo "			}\n";
	echo "		return;\n";
	echo "		}\n";
	echo "	else if (theAspectRatio == \"custom\") {\n";
	echo "		return;\n";
	echo "		}\n";
	echo "	}\n";	
	echo "//-->\n";
	echo "</script>\n";	
	}

function register_vjspro_settings() {
	register_setting('vjspro-settings-group', 'vjs_width');
	register_setting('vjspro-settings-group', 'vjs_height');
	register_setting('vjspro-settings-group', 'vjs_frameaspect');
	register_setting('vjspro-settings-group', 'vjs_preload');
	register_setting('vjspro-settings-group', 'vjs_autoplay');
	register_setting('vjspro-settings-group', 'vjs_googleaccount');
	register_setting('vjspro-settings-group', 'vjs_skin');
	register_setting('vjspro-settings-group', 'vjs_download');
	register_setting('vjspro-settings-group', 'vjs_googlehead');
	register_setting('vjspro-settings-group', 'vjs_googleevents');
	}
	
function vjspro_init() {
	add_option('vjs_width', '864');
	add_option('vjs_height', '480');
	add_option('vjs_frameaspect', '16:9');
    add_option('vjs_preload', 'true');
    add_option('vjs_autoplay', 'false');
    add_option('vjs_googleaccount', '');
    add_option('vjs_googlehead', 'false');
    add_option('vjs_googleevents', 'false');    
    add_option('vjs_skin', 'none');
    add_option('vjs_download','false');
    
    $vjspro_preset['width'] = get_option ('vjs_width');
    $vjspro_preset['height'] = get_option ('vjs_height');
    $vjspro_preset['frameaspect'] = get_option ('vjs_frameaspect');
    $vjspro_preset['preload'] = get_option ('vjs_preload');
    $vjspro_preset['autoplay'] = get_option ('vjs_autoplay');
    $vjspro_preset['googleaccount'] = get_option ('vjs_googleaccount');
    $vjspro_preset['googlehead'] = get_option ('vjs_googlehead');
    $vjspro_preset['googleevents'] = get_option ('vjs_googleevents');
    $vjspro_preset['skin'] = get_option ('vjs_skin');
    $vjspro_preset['download'] = get_option ('vjs_download');
	return ($vjspro_preset);
    }
    
function vjspro_settings() {
	$icon =  WP_CONTENT_URL . '/plugins/videojs-pro/vjs-pro-logo.png';

    add_menu_page( 'VideoJS Pro', 'VideoJS Pro', 8, __FILE__, 'vjspro_settings_page', $icon, 30 );

//  Future functionality, yet to be implimented	
//	add_submenu_page( __FILE__, 'VideoJS Pro Skins', 'Skins', 8, 'videojspro_skins', 'vjspro_skins_page');
//	add_submenu_page( __FILE__, 'VideoJS Pro Media', 'Media', 8, 'videojspro_media', 'vjspro_media_page');

	add_submenu_page( __FILE__, 'VideoJS Pro User Guide', 'User Guide', 8, 'videojspro_media', 'vjspro_manual_page');

	}

function add_vjspro_header(){
  $vjspro_preset = vjspro_init();  
  $dir = WP_PLUGIN_URL.'/videojs-pro';
  
  echo "<link rel=\"stylesheet\" href=\"$dir/video-js/video-js.css\" type=\"text/css\" media=\"screen\" title=\"Video JS\" charset=\"utf-8\">\n"; // Load default skin
  if ($vjspro_preset['skin']) {
    echo "<link rel=\"stylesheet\" href=\"$dir/video-js/skins/{$vjspro_preset['skin']}\">\n"; // Load custom skin
    }
  echo "<script src=\"$dir/video-js/video.js\" type=\"text/javascript\" charset=\"utf-8\"></script>\n";
  echo "<script type=\"text/javascript\" charset=\"utf-8\">\n";
  echo "  VideoJS.setupAllWhenReady();\n";
  echo "</script>\n";
  echo "<script type=\"text/javascript\" src=\"$dir/flowplayer/flowplayer-3.2.6.min.js\"></script>\n"; // Flowplayer Flash fallback includes
  // Add analytics header code, if enabled
  if ($vjspro_preset['googlehead'] && $vjspro_preset['googleaccount']) {
    echo "<script type=\"text/javascript\">\n"; // Google Analytics Header
    echo "  var _gaq = _gaq || [];\n";
    echo "  _gaq.push(['_setAccount', '{$vjspro_preset['googleaccount']}']);\n"; // Set Google account
    echo "  _gaq.push(['_trackPageview']);\n";
    echo "  (function() {\n";
    echo "    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;\n";
    echo "    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';\n";
    echo "    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);\n";
    echo "  })();\n";
    echo "</script>\n";
    }
}
add_action('wp_head','add_vjspro_header');

function vjspro_video_shortcode($atts){
  $dir = WP_PLUGIN_URL.'/videojs-pro';
  $vjspro_preset = vjspro_init();  // Initialize array for preset settings
  // Load the array with the options menu stuff here
  
  extract(shortcode_atts(array(
    'mp4' => '',
    'mobile' => '',
    'webm' => '',
    'ogg' => '',
    'poster' => '',
    'width' => $vjspro_preset['width'],
    'height' => $vjspro_preset['height'],
    'preload' => $vjspro_preset['preload'],
    'autoplay' => $vjspro_preset['autoplay'],
    'googleid' => 'Unlabeled Video',
    'skin' => $vjspro_preset['skin'],
    'download' => $vjspro_preset['download'],
  ), $atts));
  
    // MP4 Source Supplied
  if ($mp4) {
    $mp4_source = '<source src="'.$mp4.'" type=\'video/mp4; codecs="avc1.42E01E, mp4a.40.2"\'>';
    $mp4_link = '<a href="'.$mp4.'">MP4</a>';
  }

  // Mobile Source Supplied
  if ($mobile) {
    $mobile_source = '<source src="'.$mobile.'" type=\'video/mp4; codecs="avc1.42E01E, mp4a.40.2"\'>';
    $mobile_link = '<a href="'.$mobile.'">M4V</a>';
  }

  // WebM Source Supplied
  if ($webm) {
    $webm_source = '<source src="'.$webm.'" type=\'video/webm; codecs="vp8, vorbis"\'>';
    $webm_link = '<a href="'.$webm.'">WebM</a>';
  }

  // Ogg source supplied
  if ($ogg) {
    $ogg_source = '<source src="'.$ogg.'" type=\'video/ogg; codecs="theora, vorbis"\'>';
    $ogg_link = '<a href="'.$ogg.'">Ogg</a>';
  }

  // Check to see if viewer is using a mobile device
  $useragent=$_SERVER['HTTP_USER_AGENT'];
  if(preg_match('/android|avantgo|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|e\-|e\/|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(di|rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|xda(\-|2|g)|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))) {
    $mp4_source = $mobile_source;
    $mobile_user = TRUE; // Flag that video is being played on a mobile device
  }

  if ($poster) {
    $poster_attribute = 'poster="'.$poster.'"';
    $image_fallback = "<!-- Image Fallback -->\n<img src=\"$poster\" width=\"$width\" height=\"$height\" alt=\"Poster Image\" title=\"No video playback capabilities.\" />";
  }

  if ($preload) {
    $preload_attribute = 'preload';
    $flow_player_preload = 'autoBuffering:true';
  } else {
    $preload_attribute = '';
    $flow_player_preload = 'autoBuffering:false';
  }

  if ($autoplay) {
    $autoplay_attribute = "autoplay";
    $flow_player_autoplay = 'autoPlay:true';
  } else {
    $autoplay_attribute = "";
    $flow_player_autoplay = 'autoPlay:false';
  }
  
  if ($skin && $skin != "none") {
	$name_length = strpos ($skin, '.');
	$skin = substr ($skin, 0, $name_length);
    $skin = 'video-js-box ' . $skin . '-css';
  } else {
    $skin = 'video-js-box';
  }
  
  $vjspro .= "
  <!-- Begin VideoJS -->\n      
  <div class=\"{$skin}\">\n
    <video class=\"video-js\" width=\"{$width}\" height=\"{$height}\" {$poster_attribute} controls {$preload_attribute} {$autoplay_attribute} id=\"{$googleid}\">\n";

  // Check to see if viewing on mobile device, add appropriate file
  if ($mobile_user) {
    $vjspro .= $mp4_source;
    } else {  
  // Only add additional versions and flash fallback if non-mobile
    $vjspro .= $mp4_source . "\n" . $webm_source . "\n" . $ogg_source . "\n" .
    "   <div class=\"vjs-flash-fallback\">\n
       	<a  
			 href=\"$mp4\"
			 style=\"display:block;width:{$width}px;height:{$height}px\"
			 id=\"fallbackplayer\">
		</a>
		<script>
			flowplayer(\"fallbackplayer\", \"{$dir}/flowplayer/flowplayer-3.2.6.swf\", {
            clip:  {
             {$flow_player_autoplay},
             {$flow_player_preload}
            }
           });
		</script>
		</div>";

		if ($vjspro_preset['googleaccount'] && $vjspro_preset['googleevents']) {
  		$vjspro .= "
   		 <!-- Start Google Analytics Flow Player Tracking Code -->\n
  		  <script type=\"text/javascript\" charset=\"utf-8\">\n
			function flashMessage () {
				playHead = Math.round (thisPlayer.getTime());
				if (playHead <= 0) {
					return;
					}
				playSeconds = playHead % 60;
				playMinutes = (playHead / 60) % 60;
				playHours = ((playHead / 60) / 60) % 60;
				timeCode = playHours.toFixed(0) + ':' + playMinutes.toFixed(0) + ':' + playSeconds.toFixed(0);
				timeStamp = Date();
				eventName = timeStamp + ' viewer exited at ' + timeCode;
				_gaq.push(['_trackEvent', 'Viewing Data', '{$googleid}', eventName, 0]);
				}
				
  		    thisFlashPlayer = flowplayer(\"fallbackplayer\");
  		    thisFlashPlayer.onFinish(\"ended\", flashMessage, false);\n
  		  </script>\n
         <!-- End Google Analytics Flow Player Tracking Code -->\n";
         }
	}
	
	// If download option is set to true
	if ($download) {
	$vjspro .= "
	    <!-- Download links provided for devices that can't play video in the browser. -->
        <p class=\"vjs-no-video\"><strong>Download Video:</strong>\n
         {$mp4_link}\n
         {$webm_link}\n
         {$ogg_link}\n";
    }
    
	$vjspro .= "
    </video>\n
  </div>\n";
  
  // Check to see if analytics is turned on, if so add event tracking code
  if ($vjspro_preset['googleaccount'] && $vjspro_preset['googleevents']) {
  $vjspro .= "
    <!-- Start Google Analytics Tracking Code -->
    <script type=\"text/javascript\" charset=\"utf-8\">
		function makeEndedMessage() {
		timeStamp = Date();
		eventName = timeStamp + ' video was played to completion';
		_gaq.push(['_trackEvent', 'Videos Viewed to Completion', '{$googleid}', eventName, 0]);
		}
		
		function makeEventMessage() {
		playHead = Math.round (thisPlayer.video.currentTime);
		if (playHead <= 0) {
			return;
			}
		playSeconds = playHead % 60;
		playMinutes = (playHead / 60) % 60;
		playHours = ((playHead / 60) / 60) % 60;
		timeCode = playHours.toFixed(0) + ':' + playMinutes.toFixed(0) + ':' + playSeconds.toFixed(0);
		timeStamp = Date();
		eventName = timeStamp + ' viewer exited at ' + timeCode;
		_gaq.push(['_trackEvent', 'Viewing Data', '{$googleid}', eventName, 0]);
		}
	
	  thisPlayer = VideoJS.setup (\"{$googleid}\");
      window.addEventListener(\"unload\", makeEventMessage, false);
      thisPlayer.video.addEventListener(\"ended\", makeEndedMessage, false);
    </script>
    <!-- End Google Analytics Tracking Code -->
  <!-- End VideoJS -->\n";
  }
  return $vjspro;
}
add_shortcode('video', 'vjspro_video_shortcode');

function vjspro_settings_page() {
include ("video-js-pro-settings.php");
} 

// function vjspro_skins_page() {
// include ("video-js-pro-skins.php");
// }

// function vjspro_media_page() {
// include ("video-js-pro-media.php");
// }

function vjspro_manual_page() {
include ("video-js-pro-manual.php");
}

?>