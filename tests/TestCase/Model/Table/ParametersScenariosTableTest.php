<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ParametersScenariosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ParametersScenariosTable Test Case
 */
class ParametersScenariosTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.parameters_scenarios',
        'app.parameters',
        'app.scenarios',
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
        $config = TableRegistry::exists('ParametersScenarios') ? [] : ['className' => 'App\Model\Table\ParametersScenariosTable'];
        $this->ParametersScenarios = TableRegistry::get('ParametersScenarios', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ParametersScenarios);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
