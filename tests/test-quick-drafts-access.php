<?php

class Quick_Drafts_Access_Test extends WP_UnitTestCase {

	function test_class_exists() {
		$this->assertTrue( class_exists( 'c2c_QuickDraftsAccess' ) );
	}

	function test_get_version() {
		$this->assertEquals( '2.0.1', c2c_QuickDraftsAccess::version() );
	}

	function test_hooks_action_admin_init() {
		$this->assertNotFalse( has_action( 'admin_init', array( 'c2c_QuickDraftsAccess', 'admin_init' ) ) );
	}

	function test_hooks_action_admin_menu() {
		$this->assertNotFalse( has_action( 'admin_menu', array( 'c2c_QuickDraftsAccess', 'quick_drafts_access' ) ) );
	}

}
