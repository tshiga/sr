<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FormAnswersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FormAnswersTable Test Case
 */
class FormAnswersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\FormAnswersTable
     */
    public $FormAnswers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.form_answers',
        'app.answer_records'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('FormAnswers') ? [] : ['className' => FormAnswersTable::class];
        $this->FormAnswers = TableRegistry::get('FormAnswers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->FormAnswers);

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
}
