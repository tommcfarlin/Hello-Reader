<?php

require_once '../../plugin.php';

class Hello_Reader_Tests extends WP_UnitTestCase {

	/** A referene to the actual plugin that we're testing. */
	private $plugin;

	/**
	 * Fired before each test and retrieves a reference to the plugin and assigns it
	 * to the local instance variable.
	 */
	function setUp() {
				
		parent::setUp();
		$this->plugin = $GLOBALS['hello-reader'];			
	
	} // end setup
	
	/**
	 * Verifies that the plugin isn't null and was properly retrieved in setup.
	 */
	function testPluginInitialization() {
		$this->assertFalse( null == $this->plugin );
	} // end testPluginInitialization
	
	/**
	 * Tests to verify the plugin responds appropriately when coming from Twitter.
	 */ 
	function testIsComingFromTwitter() {
	
		// Spoofing the HTTP_REFERER for purposes of this test and the companion blog post
		$_SERVER['HTTP_REFERER'] = 'http://twitter.com';
		$this->assertTrue( $this->plugin->is_from_twitter(), 'is_from_twitter() will return true when the referring site is Twitter.' );
		
	} // end testIsComingFromTwitter

	/**
	 * Tests to verify the plugin responds appropriately when is not coming from Twitter.
	 */
	function testIsNotComingFromTwitter() {
	
		// Spoofing the HTTP_REFERER for purposes of this test and the companion blog post
		$_SERVER['HTTP_REFERER'] = 'http://facebook.com';
		$this->assertFalse( $this->plugin->is_from_twitter(), 'is_from_twitter() will return true when the referring site is Twitter.' );
		
	} // end testIsNotComingFromTwitter
	
	/**
	 * Tests to verify the plugin responds appropriately when coming from Google.
	 */
	function testIsComingFromGoogle() {
	
		// Spoofing the HTTP_REFERER for purposes of this test and the companion blog post
		$_SERVER['HTTP_REFERER'] = 'http://google.com';
		$this->assertTrue( $this->plugin->is_from_google(), 'is_from_google() will return true when the referring site is Google.' );
		
	} // end testIsComingFromGoogle

	/**
	 * Tests to verify the plugin responds appropriately when is not coming from Google.
	 */
	function testIsNotComingFromGoogle() {
	
		// Spoofing the HTTP_REFERER for purposes of this test and the companion blog post
		$_SERVER['HTTP_REFERER'] = 'http://bing.com';
		$this->assertFalse( $this->plugin->is_from_google(), 'is_from_google() will return true when the referring site is Google.' );
		
	} // end testIsNotComingFromGoogle

	/**
	 * Verifies the proper messge is displayed when the user arrives from Twitter.
	 */
	function testDisplayTwitterWelcome() {
		
		// Spoof the HTTP_REFERER for Twitter
		$_SERVER['HTTP_REFERER'] = 'http://twitter.com';
		$this->assertContains( 'Welcome from Twitter!', $this->plugin->add_welcome_message( 'This is example post content. This simulates that WordPress would return when viewing a blog post.' ), 'add_welcome_message() appends welcome message to the post content.' );			
		
	} // end testDisplayTwitterWelcome

	/**
	 * Verifies the proper messge is displayed when the user arrives from Google.
	 */
	function testDisplayGoogleWelcome() {
		
		// Spoof the HTTP_REFERER for Google
		$_SERVER['HTTP_REFERER'] = 'http://google.com';
		$this->assertContains( 'Welcome from Google!', $this->plugin->add_welcome_message( 'This is example post content. This simulates that WordPress would return when viewing a blog post.' ), 'add_welcome_message() appends welcome message to the post content.' );			
		
	} // end testDisplayGoogleWelcome

} // end class

?>