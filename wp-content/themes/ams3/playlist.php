<?php /** Template Name: Playlist */ get_header(); ?>
<?php

if (!class_exists('S3')) require_once 'includes/s3/S3.php';

// AWS access info
if (!defined('awsAccessKey')) define('awsAccessKey', 'AKIAITQQDYV5WK4LLYWQ');
if (!defined('awsSecretKey')) define('awsSecretKey', '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');

$s3 = new S3(awsAccessKey, awsSecretKey);

$folder = $_GET['name']; 

$bucket_contents = $s3->getBucket('isdsam',$folder); 
 
?>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.jplayer.min.js"></script>
<script type="text/javascript">

//<![CDATA[

$(document).bind("mobileinit", function(){
  //apply overrides here
});

$(document).ready(function() {
 
	 // audio player
	 
	 var Playlist = function(instance, playlist, options) {

		var self = this;

		this.instance = instance; // String: To associate specific HTML with this playlist

		this.playlist = playlist; // Array of Objects: The playlist

		this.options = options; // Object: The jPlayer constructor options for this playlist

		this.current = 0;

		this.cssId = {

			jPlayer: "jquery_jplayer_",

			interface: "jp_interface_",

			playlist: "jp_playlist_"

		};

		this.cssSelector = {};



		$.each(this.cssId, function(entity, id) {

			self.cssSelector[entity] = "#" + id + self.instance;

		});

		if(!this.options.cssSelectorAncestor) {

			this.options.cssSelectorAncestor = this.cssSelector.interface;

		}

		$(this.cssSelector.jPlayer).jPlayer(this.options);



		$(this.cssSelector.interface + " .jp-previous").click(function() {

			self.playlistPrev();

			$(this).blur();

			return false;

		});

		$(this.cssSelector.interface + " .jp-next").click(function() {

			self.playlistNext();

			$(this).blur();

			return false;

		});

	};

	Playlist.prototype = {

		displayPlaylist: function() {

			var self = this;

			$(this.cssSelector.playlist + " ul").empty();

			for (i=0; i < this.playlist.length; i++) { 
				var listItem = (i === this.playlist.length-1) ? '<li data-theme="a" class="ui-btn ui-btn-icon-right ui-li ui-btn-up-a"><div class="ui-btn-inner ui-li"><div class="ui-btn-text">' : '<li data-theme="a" class="ui-btn ui-btn-icon-right ui-li ui-btn-up-a"><div class="ui-btn-inner ui-li"><div class="ui-btn-text">';

				listItem += "<a class='ui-link-inherit' href='#' id='" + this.cssId.playlist + this.instance + "_item_" + i +"' tabindex='1'>"+ this.playlist[i].name +"</a>";



				// Create links to free media

				if(this.playlist[i].free) {

					var first = true;

					listItem += "<div class='jp-free-media'>(";

					$.each(this.playlist[i], function(property,value) {

						if($.jPlayer.prototype.format[property]) { // Check property is a media format.

							if(first) {

								first = false;

							} else {

								listItem += " | ";

							}

							listItem += "<a id='" + self.cssId.playlist + self.instance + "_item_" + i + "_" + property + "' href='" + value + "' tabindex='1'>" + property + "</a>";

						}

					});

					listItem += ")</span>";

				}

				listItem += '</div><span class="ui-icon ui-icon-arrow-r"></span></div></li>';

				// Associate playlist items with their media

				$(this.cssSelector.playlist + " ul").append(listItem);

				$(this.cssSelector.playlist + "_item_" + i).data("index", i).click(function() {

					var index = $(this).data("index");

					if(self.current !== index) {

						self.playlistChange(index);

					} else {

						$(self.cssSelector.jPlayer).jPlayer("play");

					}

					$(this).blur();

					return false;

				});

				// Disable free media links to force access via right click

				if(this.playlist[i].free) {

					$.each(this.playlist[i], function(property,value) {

						if($.jPlayer.prototype.format[property]) { // Check property is a media format.

							$(self.cssSelector.playlist + "_item_" + i + "_" + property).data("index", i).click(function() {

								var index = $(this).data("index");

								$(self.cssSelector.playlist + "_item_" + index).click();

								$(this).blur();

								return false;

							});

						}

					});

				}

			}

		},

		playlistInit: function(autoplay) {

			if(autoplay) {

				this.playlistChange(this.current);

			} else {

				this.playlistConfig(this.current);

			}

		},

		playlistConfig: function(index) {

			$(this.cssSelector.playlist + "_item_" + this.current).removeClass("jp-playlist-current").parent().removeClass("jp-playlist-current");

			$(this.cssSelector.playlist + "_item_" + index).addClass("jp-playlist-current").parent().addClass("jp-playlist-current");

			this.current = index;

			$(this.cssSelector.jPlayer).jPlayer("setMedia", this.playlist[this.current]);

		},

		playlistChange: function(index) {

			this.playlistConfig(index);

			$(this.cssSelector.jPlayer).jPlayer("play");

		},

		playlistNext: function() {

			var index = (this.current + 1 < this.playlist.length) ? this.current + 1 : 0;

			this.playlistChange(index);

		},

		playlistPrev: function() {

			var index = (this.current - 1 >= 0) ? this.current - 1 : this.playlist.length - 1;

			this.playlistChange(index);

		}

	};

	var audioPlaylist = new Playlist("2", [
	
	<?php foreach ($bucket_contents as $file){ $fname = $file['name']; $furl = "http://isdmusic.s3.amazonaws.com/".urlencode($fname);
	
	//if(preg_match("/\.mp3$/i", $furl)) { ?>
	{

			name:"<?php echo basename($fname); ?>",

			m4a:"<?php echo $furl; ?>",

			oga:"<?php echo $furl; ?>"

		},
<?php }//} ?>

	], {

		ready: function() {

			audioPlaylist.displayPlaylist();

			audioPlaylist.playlistInit(false); // Parameter is a boolean for autoplay.

		},

		ended: function() {

			audioPlaylist.playlistNext();

		},

		play: function() {

			$(this).jPlayer("pauseOthers");

		},

		swfPath: "../js",

		supplied: "oga, m4a, ,mp3"

	});



	$("#jplayer_inspector_1").jPlayerInspector({jPlayer:$("#jquery_jplayer_1")});

	$("#jplayer_inspector_2").jPlayerInspector({jPlayer:$("#jquery_jplayer_2")});
  
	
});



//]]>

</script>

     <div id="jquery_jplayer_2" class="jp-jplayer"></div>
        <div class="jp-audio">
            <div class="jp-type-playlist">
                <div id="jp_interface_2" class="jp-interface">
                    <ul class="jp-controls">
                        <li><a href="#" class="jp-play" tabindex="1">play</a></li>
                        <li><a href="#" class="jp-pause" tabindex="1">pause</a></li>
                        <li><a href="#" class="jp-stop" tabindex="1">stop</a></li>
                        <li><a href="#" class="jp-mute" tabindex="1">mute</a></li>
                        <li><a href="#" class="jp-unmute" tabindex="1">unmute</a></li>
                        <li><a href="#" class="jp-previous" tabindex="1">previous</a></li>
                        <li><a href="#" class="jp-next" tabindex="1">next</a></li>
                    </ul>
                    <div class="jp-progress">
                        <div class="jp-seek-bar">
                            <div class="jp-play-bar"></div>
                        </div>
                    </div>
                    <div class="jp-volume-bar">
                        <div class="jp-volume-bar-value"></div>
                    </div>
                    <div class="jp-current-time"></div>
                    <div class="jp-duration"></div>
                </div>
                <div id="jp_playlist_2" class="jp-playlist">
                    <ul data-role="listview" data-inset="true" data-theme="c" data-dividertheme="b" class="ui-listview ui-listview-inset ui-corner-all ui-shadow" data-filter="true">
                        
                        <!-- The method Playlist.displayPlaylist() uses this unordered list -->
                        <li data-theme="c" class="ui-btn ui-btn-icon-right ui-li ui-btn-up-c"></li>
                    </ul>
                </div>
            </div>


<?php get_footer(); ?>