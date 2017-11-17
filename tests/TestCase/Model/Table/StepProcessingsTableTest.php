<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\StepProcessingsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\StepProcessingsTable Test Case
 */
class StepProcessingsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\StepProcessingsTable
     */
    public $StepProcessings;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.step_processings'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('StepProcessings') ? [] : ['className' => StepProcessingsTable::class];
        $this->StepProcessings = TableRegistry::get('StepProcessings', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->StepProcessings);

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
