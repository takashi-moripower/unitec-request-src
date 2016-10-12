<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RepairsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RepairsTable Test Case
 */
class RepairsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\RepairsTable
     */
    public $Repairs;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.repairs'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Repairs') ? [] : ['className' => 'App\Model\Table\RepairsTable'];
        $this->Repairs = TableRegistry::get('Repairs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Repairs);

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
