<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AnswerRecordsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AnswerRecordsTable Test Case
 */
class AnswerRecordsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AnswerRecordsTable
     */
    public $AnswerRecords;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.answer_records',
        'app.form_answers'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('AnswerRecords') ? [] : ['className' => AnswerRecordsTable::class];
        $this->AnswerRecords = TableRegistry::get('AnswerRecords', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AnswerRecords);

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
