<?php
namespace App\Test\TestCase\Controller;

use App\Controller\MigrationsParametersController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\MigrationsParametersController Test Case
 */
class MigrationsParametersControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.migrations_parameters',
        'app.migrations',
        'app.scenarios',
        'app.parameters',
        'app.parameters_scenarios',
        'app.tasks',
        'app.parameters_tasks',
        'app.scenarios_tasks'
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
