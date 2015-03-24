<?php
	if (!current_user_can('manage_options'))  {
		wp_die( __('You do not have sufficient permissions to access this page.') );
	}
?>

<table width = "60%">
<tr><td>
<div class="wrap">
<h2>VideoJS Pro User Guide</h2>
<br />
<blockquote>
1. <a href = "#1">Configuring VideoJS Pro</a><br />
2. <a href = "#2">Using Shortcode</a><br />
3. <a href = "#3">Overriding Defaults</a><br /> 
4. <a href = "#4">Creating Skins</a><br />
5. <a href = "#5">Google Analytics</a><br />
</blockquote>
<br />
<b>About VideoJS Pro</b>

<p>&nbsp &nbsp VideoJS Pro is a plugin for Wordpress that provides an easy to use interface for <a href = "http://www.videojs.com/" target = "_blank">VideoJS</a>, developed by <a href = "http://www.steveheffernan.com/" target = "_blank">Steve Heffernan</a>.<br />
&nbsp &nbsp VideoJS is an HTML5 Video Player with 3 core parts: An embed code (<a href = "http://camendesign.com/code/video_for_everybody" target = "_blank">Video for Everybody</a>), a Javascript library (video.js), and a pure HTML/CSS skin (video-js.css).<br />
&nbsp &nbsp Using Video for Everybody as the embed code means you know it’s compatible with many devices (including ones without javascript).  The javascript library fixes browser & device bugs, and makes sure your video is even more compatible across different browser versions.<br />
&nbsp &nbsp The pure HTML5/CSS skin ensures a consistent look between HTML5 browsers, and easy custom skinning if you want to give it a specific look, or brand it with your own colors. See the skins page for examples of custom skins.<br />
Please visit <a href = "http://www.videojs.com" target = "_blank">VideoJS.com</a> and support the project and learn more about VideoJS.<br /><br />
VideoJS Pro is developed by Doug Stanford for the website <a href = "http://www.auxsend.tv/" target = "_blank">http://auxsend.tv</a>.  Visit to see examples of VideoJS Pro in action.
</p>

<b id="1">Configuring VideoJS Pro</b>

<p>&nbsp &nbsp VideoJS Pro allows you to specify attributes of a default player in order to avoid having to declare a long list of variables in the shortcode.  In VideoJS Pro Settings, you can define the dimensions, skin, and behavior of the default player; all of these options can be overriden, however, on a per-player basis through the short code if you so desire.<br />
&nbsp &nbsp VideoJS tends to perform at its best when video scaling is not required, particularly when playing ogg and webm format videos.  Therefore it's best to set up your player to the dimensions of the video you'll be playing back.</p>

<b id="2">Using Shortcode</b>

<p>&nbsp &nbsp To insert a player in a post, use the shortcode [video].  You'll need to specify a few values in each instance.  Here is a list of the necessary variables:
<blockquote><b>poster=</b> The poster image for the player, the image that will load upon the page loading and remain there until the viewer presses play.<br />
<b>googleid=</b> The unique ID of this video player.  Each player needs a unique ID within a page, this ID is also used for event tracking with Google Analytics if tracking is turned on.<br />
<b>mp4=</b> The url of the MP4 video file.<br />
<b>mobile=</b> The url of the M4V video file.  You can create this version easily by using QuickTime Player 7 and exporting using "Movie to iPhone" with "Default Settings".  This version is necessary for playback on iOS devices and makes the load a little lighter on other mobile platforms.<br />
<b>ogg=</b> The url of the Ogg/Vorbis video file.<br />
<b>webm=</b> The url of the WebM video file.<br /><br />
<b>Example Shortcode:</b><br />
[video poster="http://www.mysite.com/video/myposter.jpg" mp4="http://www.mysite.com/video/myvideo.mp4" mobile="http://www.mysite.com/video/myvideo.m4v" ogg="http://www.mysite.com/video/myvideo.ogv" webm="http://www.mysite.com/video/myvideo.webm" googleid="My Video"]
</blockquote>
&nbsp &nbsp You do not need to provide all four formats of video files for the player to function, however the more formats you include the greater the compatibility of your player.
</p>

<b id="3">Overriding Defaults</b>

<p>&nbsp &nbsp In the event you have a video or post that you would like to set up an instance of the video player that deviates from the default, you can override any of the settings you configured in the VideoJS Pro Settings menu.  Here is a full list of available variables you can add to the shortcode:<br />
<blockquote><b>poster=</b> The poster image for the player, the image that will load upon the page loading and remain there until the viewer presses play.<br />
<b>googleid=</b> The unique ID of this video player.  Each player needs a unique ID within a page, this ID is also used for event tracking with Google Analytics if tracking is turned on.<br />
<b>mp4=</b> The url of the MP4 video file.<br />
<b>mobile=</b> The url of the M4V video file.  You can create this version easily by using QuickTime Player 7 and exporting using "Movie to iPhone" with "Default Settings".  This version is necessary for playback on iOS devices and makes the load a little lighter on other mobile platforms.<br />
<b>ogg=</b> The url of the Ogg/Vorbis video file.<br />
<b>webm=</b> The url of the WebM video file.<br />
<b>width=</b> The width of the player, in pixels.<br />
<b>height=</b> The height of the player, in pixels.<br />
<b>preload=</b> The player will begin downloading the video on page load, can be set to true or false.<br />
<b>autoplay=</b> The video will begin playing on page load, can be set to true or false.<br />
<b>download=</b> Show or hide download links for the video sources below the player, can be set to true or false.<br />
<b>skin=</b> The url of the .CSS custom skin for the player.  If left blank and not set in the VideoJS Pro Settings page, it will load the default VideoJS skin.<br />
<b>Example Shortcode:</b><br />
[video poster="http://www.mysite.com/video/myposter.jpg" mp4="http://www.mysite.com/video/myvideo.mp4" mobile="http://www.mysite.com/video/myvideo.m4v" ogg="http://www.mysite.com/video/myvideo.ogv" webm="http://www.mysite.com/video/myvideo.webm" width = "1920" height = "1080" preload="true" autoplay="false" download="true" skin="http://www.mysite.com/wp-content/plugins/video-js-pro/video-js/skins/myskin.css" googleid="My Video"]
</blockquote>
</p>

<b id="4">Creating Skins</b>

<p>&nbsp &nbsp Visit <a href="http://www.videojs.com/" target = "_blank">VideoJS.com</a> for access to a library of skins and information on creating your own custom skin.  The only detail you need to know on designing skins for use with VideoJS Pro is that the class name you use within your .CSS file must be the same as the filename of your skin with "-css" added to it.  For example:<br />
<blockquote>
<i>filename:</i> <b>vim.css</b> <i>class name:</i> <b>.vim-css</b><br />
</blockquote>
</p>

<b id="5">Google Analytics</b>

<p>&nbsp &nbsp VideoJS Pro has made integrating powerful Google Analytics event tracking extremely easy.  To enable this feature, first you must register an account with Google Analytics <a href = "http://www.google.com/analytics/" target = "_blank">here</a>.  Next, in the VideoJS Pro Settings page enter your account number in the field specified.  VideoJS Pro will automatically enter the required tracking code into the header of each of your pages (regardless as to if they contain an instance of a video player or not) if you check the box marked "Insert Analytics Header Code".  If you have already entered your header code manually, leave this box unchecked.  The final step is to check the box next to "Track Player Events" to begin tracking the activity of video players on your blog.<br />
&nbsp &nbsp To view the tracked statistics, log into your Google Analytics account and navigate to Content->Event Tracking.  You will see two categories of Events, "Videos Viewed to Completion" and "Viewing Data".  When a viewer on your blog allows a player to reach the end of the video before stopping it or navigating away from the page, that event is registered as a video viewed to completion.  The alternative is that a viewer navigates away from the page before the end of the video is reached, either by stopping it and clicking on a link or entering a new url, or just cliking a link or entering a new url while the video plays; these events are recorded under viewing data and will contain the time in h:m:s format of where in the video the user was when they left the page.<br />
&nbsp &nbsp Under each category, you will see a list of "Event Actions" with the names you specified with the "googleid=" variable in the shortcode.  Click on a video title will bring you to its list of "Event Labels", which record each event that has happened on your page during the specified date range.<br />
&nbsp &nbsp It can take several minutes for an event to register on your Analytics page, so don't worry if you don't immediately see records of your activity in a player.
</p>
</tr></td>
</table>
<br />
<br />