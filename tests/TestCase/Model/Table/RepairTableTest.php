<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RepairTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RepairTable Test Case
 */
class RepairTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\RepairTable
     */
    public $Repair;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.repair'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Repair') ? [] : ['className' => 'App\Model\Table\RepairTable'];
        $this->Repair = TableRegistry::get('Repair', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Repair);

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
