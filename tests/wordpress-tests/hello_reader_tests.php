<?php

require_once '../../plugin.php';

class Hello_Reader_Tests extends WP_UnitTestCase {

	private $plugin;

	function setUp() {
				
		parent::setUp();
		$this->plugin = $GLOBALS['hello-reader'];			
	
	} // end setup
	
	
	function testPluginInitialization() {
		$this->assertFalse( null == $this->plugin );
	}
	
	function tearDown() {
		
		parent::tearDown();
		$GLOBALS['hello-reader'] = null;
		
	} // end tearDown

} // end class

?>