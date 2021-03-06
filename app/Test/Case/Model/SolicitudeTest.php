<?php
App::uses('Solicitude', 'Model');

/**
 * Solicitude Test Case
 */
class SolicitudeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.solicitude',
		'app.usuario',
		'app.empresa'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Solicitude = ClassRegistry::init('Solicitude');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Solicitude);

		parent::tearDown();
	}

}
