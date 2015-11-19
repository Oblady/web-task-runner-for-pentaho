<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ScenariosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ScenariosTable Test Case
 */
class ScenariosTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.scenarios',
        'app.parameters',
        'app.scenarios_parameters',
        'app.tasks',
        'app.parameters_tasks',
        'app.scenarios_tasks'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Scenarios') ? [] : ['className' => 'App\Model\Table\ScenariosTable'];
        $this->Scenarios = TableRegistry::get('Scenarios', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Scenarios);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
