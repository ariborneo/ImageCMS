<?php
use \CallbacksTester;

class EditingCallbackCest
{
//    public function _before()
//    {
//    }
//
//    public function _after()
//    {
//    }

   public function Autorization(CallbacksTester $I)
    {
        InitTest::Login($I);
        $I->amOnPage("/admin/components/run/shop/callbacks");
        $I->waitForText("Список обратных звонков");
    } 
    
    
    public function NamesInEditing(CallbacksTester $I)
    {
        $I->amOnPage('/admin/components/run/shop/callbacks');
        $I->click('.//*[@id="callbacks_all"]/table/tbody/tr[1]/td[3]/a');
        $I->waitForElement('.//*[@id="editCallbackForm"]/div[2]/label');
        $I->see('Тема вопроса:', './/*[@id="editCallbackForm"]/div[2]/label');
        $I->see('Редактирование обратного звонка', 'span.title.w-s_n');
        $I->see('Информация', './/*[@id="mainContent"]/section/div[2]/table/thead/tr/th');
        $I->see('Статус:', './/*[@id="editCallbackForm"]/div[1]/label');
        $I->see('Имя пользователя:', './/*[@id="editCallbackForm"]/div[3]/label');
        $I->see('Телефон:', './/*[@id="editCallbackForm"]/div[4]/label');
        $I->see('Комментарий:', './/*[@id="editCallbackForm"]/div[5]/label');
        $I->see('Дата создания:', './/*[@id="editCallbackForm"]/div[6]/label');
        $I->see('Вернуться', CallbacksPage::$GoBackButton);
        $I->see('Сохранить', CallbacksPage::$SaveButton);
        $I->see('Сохранить и выйти', CallbacksPage::$SaveAndExitButton);
    } 
    
    /**
     * @guy CallbacksTester\CallbacksSteps
     */
    
    public function RequiredFieldsInEditingAndSaveButton(CallbacksTester\CallbacksSteps $I)
    {
        $name='';
        $phone='';
        $comment='';
        $I->EditCallback($name, $phone, $comment);
        $I->see('Это поле обязательное.', './/*[@id="editCallbackForm"]/div[3]/div/label');
        $I->see('Это поле обязательное.', './/*[@id="editCallbackForm"]/div[4]/div/label');
        $I->click(CallbacksPage::$GoBackButton);
        $I->waitForText('Список обратных звонков');
        InitTest::ClearAllCach($I);
    } 
    
    /**
     * @guy CallbacksTester\CallbacksSteps
     */
    
    public function RequiredFieldsInEditingAndSaveAndExitButton(CallbacksTester\CallbacksSteps $I)
    {
        $name='';
        $phone='';
        $comment='';
        $I->EditCallback($name, $phone, $comment, $save='saveexit');
        $I->see('Это поле обязательное.', './/*[@id="editCallbackForm"]/div[3]/div/label');
        $I->see('Это поле обязательное.', './/*[@id="editCallbackForm"]/div[4]/div/label');
    } 
    
    /**
     * @guy CallbacksTester\CallbacksSteps
     */
    
    public function TypesOfSymbolsInEditing(CallbacksTester\CallbacksSteps $I)
    {
        $name='qwert12345!@#$%^&*()_+|}{:?></.,;[]`йцуке';
        $phone='qwert12345!@#$%^&*()_+|}{:?></.,;[]`йцуке';
        $comment='qwert12345!@#$%^&*()_+|}{:?></.,;[]`йцуке';
        $I->EditCallback($name, $phone, $comment);        
        $I->waitForElementVisible('.alert.in.fade.alert-success');
        $I->see('Поле Телефон должно содержать только цифры.');
        $I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $I->fillField(CallbacksPage::$TelephoneEdit, 'qwert1');
        $I->click(CallbacksPage::$SaveButton);
        $I->waitForElementVisible('.alert.in.fade.alert-success');
        $I->see('Поле Телефон должно содержать только цифры.');
        $I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $I->fillField(CallbacksPage::$TelephoneEdit, '2345!@#$%^&*()_+|}{');
        $I->click(CallbacksPage::$SaveButton);
        $I->waitForElementVisible('.alert.in.fade.alert-success');
        $I->see('Поле Телефон должно содержать только цифры.');
        $I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $I->fillField(CallbacksPage::$TelephoneEdit, '65йцуке');
        $I->click(CallbacksPage::$SaveButton);
        $I->waitForElementVisible('.alert.in.fade.alert-success');
        $I->see('Поле Телефон должно содержать только цифры.');
        $I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $phone1='12345';
        $I->fillField(CallbacksPage::$TelephoneEdit, $phone1);
        $I->click(CallbacksPage::$SaveButton);
        $I->CheckFieldsEditCallback($name, $phone1, $comment);        
        $I->click(CallbacksPage::$GoBackButton);
        $I->waitForText('Список обратных звонков');
        $I->see('qwert12345!@#$%^&*()_+|}{:?></.,;[]`йцуке', './/*[@id="callbacks_all"]/table/tbody/tr[1]/td[3]/a');
        $I->see('12345', './/*[@id="callbacks_all"]/table/tbody/tr[1]/td[4]');
        InitTest::ClearAllCach($I);
    } 
    
    /**
     * @guy CallbacksTester\CallbacksSteps
     */
    
    public function OneSymbolsEditing(CallbacksTester\CallbacksSteps $I)
    {
        $name='a';
        $phone='1';
        $comment='s';
        $I->EditCallback($name, $phone, $comment);
        $I->CheckFieldsEditCallback($name, $phone, $comment);
    } 
    
    /**
     * @guy CallbacksTester\CallbacksSteps
     */
    
    public function ICMS_1480_Symbols128Editing(CallbacksTester\CallbacksSteps $I)
    {
        $name='12345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678';
        $phone='12345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678';
        $comment='12345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678';
        $I->EditCallback($name, $phone, $comment);
        $I->waitForElementVisible('.alert.in.fade.alert-success');
        $I->see('Поле Телефон не может превышать 50 символов в длину.');
        $I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $phone1='12345678901234567890123456789012345678901234567890';
        $I->fillField(CallbacksPage::$TelephoneEdit, '123456789012345678901234567890123456789012345678901');
        $I->click(CallbacksPage::$SaveButton);
        $I->waitForElementVisible('.alert.in.fade.alert-success');
        $I->see('Поле Телефон не может превышать 50 символов в длину.');
        $I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $I->fillField(CallbacksPage::$TelephoneEdit, $phone1);
        $I->click(CallbacksPage::$SaveButton);
        $I->CheckFieldsEditCallback($name, $phone1, $comment);
        $status=$I->grabValueFrom(CallbacksPage::$StatusSelEdit);
        $I->comment($status);
        $tema=$I->grabValueFrom(CallbacksPage::$ThemeSelEdit);
        $I->comment($tema);
        $date=$I->grabValueFrom(CallbacksPage::$DateEdit);
        $I->comment($date);
        $I->click(CallbacksPage::$GoBackButton);
        $I->waitForText('Список обратных звонков');
        $I->see('12345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678', './/*[@id="callbacks_all"]/table/tbody/tr[1]/td[3]/a');
        $I->see('12345678901234567890123456789012345678901234567890', './/*[@id="callbacks_all"]/table/tbody/tr[1]/td[4]');
        $stat1=$I->grabValueFrom(CallbacksPage::StatusSelListLandingLine('1'));
        $tema1=$I->grabValueFrom(CallbacksPage::ThemeSelListLandingLine('1'));
        $date1=$I->grabTextFrom('.//*[@id="callbacks_all"]/table/tbody/tr[1]/td[7]');
        $I->comment($date1);
        $I->assertEquals($status, $stat1);
        $I->assertEquals($tema, $tema1);
        $I->assertEquals($date, $date1);
        InitTest::ClearAllCach($I);
    } 
    
    /**
     * @guy CallbacksTester\CallbacksSteps
     */
    
    public function Symbols255Editing(CallbacksTester\CallbacksSteps $I)
    {
        $name='123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345';
        $phone='1234567890';
        $comment='123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345';
        $I->EditCallback($name, $phone, $comment);
        $I->CheckFieldsEditCallback($name, $phone, $comment);
    } 
    
    /**
     * @guy CallbacksTester\CallbacksSteps
     */
    
    public function Symbols256Editing(CallbacksTester\CallbacksSteps $I)
    {
        $name='1234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456';
        $phone='1234567890';
        $comment='1234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456';
        $I->EditCallback($name, $phone, $comment);
        $name1='123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345';
        $I->CheckFieldsEditCallback($name1, $phone, $comment);
        InitTest::ClearAllCach($I);
    } 
    
    /**
     * @guy CallbacksTester\CallbacksSteps
     */
    
    /*public function Symbols10000Editing(CallbacksTester\CallbacksSteps $I)
    {
        $name='Fred';
        $phone='5446';
        $comment='1234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890012345678900123456789001234567890012345678900123456789001234567890012345678900123456789001234567890012345678900123456789001234567890012345678900123456789001234567890012345678900123456789001234567890012345678900123456789001234567890012345678900123456789001234567890012345678900123456789001234567890012345678900123456789001234567890012345678900123456789001234567890012345678900123456789001234567890012345678900123456789001234567890012345678900123456789001234567890012345678900123456789001234567890012345678900123456789001234567890012345678900123456789001234567890012345678900123456789001234567890012345678900123456789001234567890012345678900123456789001234567890012345678900123456789001234567890012345678900123456789001234567890012345678900123456789001234567890012345678900123456789001234567890012345678900123456789001234567890012345678900123456789001234567890012345678900123456789001234567890012345678900123456789001234567890012345678900123456789001234567890012345678900123456789001234567890012345678900123456789001234567890012345678900123456789001234567890012345678900123456789001234567890012345678900123456789001234567890012345678900123456789001234567890012345678900123456789001234567890012345678900123456789001234567890012345678900123456789001234567890012345678900123456789001234567890012345678900123456789001234567890012345678900123456789001234567890012345678900123456789001234567890012345678900123456789001234567890012345678900123456789001234567890012345678900123456789001234567890012345678900123456789001234567890012345678900123456789001234567890012345678900123456789001234567890012345678900123456789001234567890012345678900123456789001234567890012345678900123456789001234567890012345678900123456789001234567890012345678900123456789001234567890012345678900123456789001234567890012345678900123456789001234567890012345678900123456789001234567890012345678900123456789001234567890012345678900123456789001234567890012345678900123456789001234567890012345678900123456789001234567890012345678900123456789001234567890012345678900123456789001234567890012345678900123456789001234567890012345678900123456789001234567890012345678900123456789001234567890012345678900123456789001234567890012345678900123456789001234567890012345678900123456789001234567890012345678900123456789001234567890012345678900123456789001234567890012345678900123456789001234567890012345678900123456789001234567890012345678900123456789001234567890012345678900123456789001234567890012345678900123456';
        $I->EditCallback($name, $phone, $comment);
        $I->CheckFieldsEditCallback($name, $phone, $comment);
    }*/
    
    /**
     * @guy CallbacksTester\CallbacksSteps
     */
    
    public function SaveAndExitButton(CallbacksTester\CallbacksSteps $I)
    {
        $name='Karl';
        $phone='898989';
        $comment='Comment by Karl';
        $I->EditCallback($name, $phone, $comment, $save='saveexit');
        $I->waitForElementVisible('.alert.in.fade.alert-success');
        $I->see('Изменения сохранены');
        $I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $I->see('Karl', './/*[@id="callbacks_all"]/table/tbody/tr[1]/td[3]/a');
        $I->see('898989', './/*[@id="callbacks_all"]/table/tbody/tr[1]/td[4]');
        $I->click(CallbacksPage::UserNameLine('1'));
        $I->waitForElement('.//*[@id="editCallbackForm"]/div[2]/label');
        $I->seeInField(CallbacksPage::$CommentEdit, 'Comment by Karl');
        InitTest::ClearAllCach($I);
    } 
    
}