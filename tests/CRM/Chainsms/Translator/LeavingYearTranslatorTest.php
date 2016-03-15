<?php

/**
 * Generated by PHPUnit_SkeletonGenerator on 2015-10-14 at 00:05:37.
 */
class CRM_Chainsms_Translator_LeavingYearTranslatorTest extends PHPUnit_Framework_TestCase {
  const TEST_CONTACT_SURNAME = 'Unit Test';

  /**
   * @var CRM_Chainsms_Translator_LeavingYearTranslator
   */
  protected $object;
  var $testEntities = array();

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp() {
    $this->object = new CRM_Chainsms_Translator_LeavingYearTranslator;
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown() {
    TestUtils::deleteTestEntities($this->testEntities);
    //TestUtils::deleteTestContacts(self::TEST_CONTACT_SURNAME);
    parent::tearDown();
  }

  /**
   * @covers CRM_Chainsms_Translator_LeavingYearTranslator::getName
   * @todo   Implement testGetName().
   */
  public function testGetName() {
    // Remove the following lines when you implement this test.
    $this->markTestIncomplete(
        'This test has not been implemented yet.'
    );
  }

  /**
   * @covers CRM_Chainsms_Translator_LeavingYearTranslator::getDescription
   * @todo   Implement testGetDescription().
   */
  public function testGetDescription() {
    // Remove the following lines when you implement this test.
    $this->markTestIncomplete(
        'This test has not been implemented yet.'
    );
  }

  /**
   * @covers CRM_Chainsms_Translator_LeavingYearTranslator::translate
   * @todo   Implement testTranslate().
   */
  public function testTranslate() {
    // Remove the following lines when you implement this test.
    $this->markTestIncomplete(
        'This test has not been implemented yet.'
    );
  }

  /**
   * @covers CRM_Chainsms_Translator_LeavingYearTranslator::update
   * @todo   Implement testUpdate().
   */
  public function testUpdate() {
    // Remove the following lines when you implement this test.
    $this->markTestIncomplete(
        'This test has not been implemented yet.'
    );
  }

  public function testNormalLeavingYear(){
    $createdEntitiesToDelete = CRM_Chainsms_Translator_TestUtils::createContactWithMailing(
        'Email Address Translator',
        'Unit Test',
        '2011'
    );

    $this->testEntities[] = array('Group', $createdEntitiesToDelete['group_id']);
    
    $this->translateLeavingYears($createdEntitiesToDelete['group_id']);
    
    $this->assertContactLeavingYear($createdEntitiesToDelete['contact_id'], '2011-01-01 00:00:00');
  }
  
  
  public function testBrokenLeavingYear(){
    $createdEntitiesToDelete = CRM_Chainsms_Translator_TestUtils::createContactWithMailing(
        'Email Address Translator',
        'Unit Test',
        '201a1'
    );

    $this->testEntities[] = array('Group', $createdEntitiesToDelete['group_id']);
    
    $this->translateLeavingYears($createdEntitiesToDelete['group_id']);
    
    CRM_Chainsms_Translator_TestUtils::assertBrokenConversationActivity();
  }
  
  public function testContainsLeavingYear(){
    $createdEntitiesToDelete = CRM_Chainsms_Translator_TestUtils::createContactWithMailing(
        'Email Address Translator',
        'Unit Test',
        'Sure it\'s 2011'
    );

    $this->testEntities[] = array('Group', $createdEntitiesToDelete['group_id']);
    
    $this->translateLeavingYears($createdEntitiesToDelete['group_id']);
    
    $this->assertContactLeavingYear($createdEntitiesToDelete['contact_id'], '2011-01-01');
  }
  
  
  private function assertContactLeavingYear($contactId, $leavingYear){
    $getLeavingYearApiParams = array(
      'version' => 3,
      'sequential' => 1,
	  	'contact_id' => $contactId,
      'return' => 'custom_32',
    );

    $getLeavingYearApiResults = civicrm_api('Contact', 'getvalue', $getLeavingYearApiParams);
    
    $this->assertEquals($getLeavingYearApiResults, $leavingYear, 'Found: ' . print_r($getLeavingYearApiResults, TRUE));
  }

  private function translateLeavingYears($groupId){
    $translator = new CRM_Chainsms_Translator;
    $translator->setGroups(array($groupId));
    $translator->setStartDate('2015-08-12');
    $translator->setEndDate('2015-08-14');
    $translator->prepare();
    $translator->setTranslatorClass('CRM_Chainsms_Translator_LeavingYearTranslator');
    $translator->setCampaign('Unit Test Email Address Campaign');
    $translator->translate();
    $translator->update();
  }
}
