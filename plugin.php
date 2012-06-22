<?php
/*
Plugin Name: Hello Reader
Plugin URI: http://github.com/tommcfarlin/Hello-Reader
Description: A simple plugin used to help demonstrate unit testing in the context of WordPress.
Version: 0.2
Author: Tom McFarlin
Author URI: http://tom.mcfarl.in
Author Email: tom@tommcfarlin.com
License:

  Copyright 2012 Tom McFarlin (tom@tommcfarlin.com)

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

// Only create an instance of the plugin if it doesn't already exists in GLOBALS
if( ! array_key_exists( 'hello-reader', $GLOBALS ) ) { 

	class Hello_Reader {
		 
		/**
		 * Initializes the plugin by adding a custom filter to the_content hook in WordPress.
		 */
		function __construct() {
			add_filter( 'the_content', array( &$this, 'add_welcome_message' ) );
		} // end constructor
	  
		/**
		 * Prepends a unique welcome message to the top of a post based on the referring
		 * site.
		 *
		 * @params	$content	The Post content.
		 */
		public function add_welcome_message( $content ) {
			
			if( $this->is_from_twitter() ) { 
				$content = 'Welcome from Twitter!' . $content;
			} else if( $this->is_from_google() ) {
				$content = 'Welcome from Google!' . $content;
			} // end if
				
			return $content;
			
		} // end add_welcome_message
		
		/**
		 * Determines if site has been accessed by a link from Twitter.
		 *
		 * @returns	True if the site is coming from Twitter.
		 */
		public function is_from_twitter() {
			return strpos( $_SERVER['HTTP_REFERER'], 'twitter.com' ) > 0;
		} // end is_from_twitter

		/**
		 * Determines if site has been accessed by a link from Google.
		 *
		 * @returns	True if the site is coming from Google.
		 */
		public function is_from_google() {
			return strpos( $_SERVER['HTTP_REFERER'], 'google.com' ) > 0;
		} // end is_from_google
	
	} // end class
	
	// Store a reference to the plugin in GLOBALS so that our unit tests can access it
	$GLOBALS['hello-reader'] = new Hello_Reader();
	
} // end if
?>