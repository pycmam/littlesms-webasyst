<?php
/**
 * @connect_module_class_name LittleSMSgw
 */

class LittleSMSgw extends SMSMail
{
    var $language = 'rus';

    function _initVars()
    {
        $this->title = 'Little SMS';
        $this->description = '<a href="http://littlesms.ru/">littlesms.ru</a>';
        $this->sort_order = 0;

        $this->Settings[] = 'CONF_LITTLESMS_LOGIN';
        $this->Settings[] = 'CONF_LITTLESMS_KEY';
        $this->Settings[] = 'CONF_LITTLESMS_ORIGINATOR';
    }
    
    function _initSettingFields()
    {
        $this->SettingsFields['CONF_LITTLESMS_LOGIN'] = array(
            'settings_value'         => '',
            'settings_title'         => 'Логин',
            'settings_description'   => '',
            'settings_html_function' => 'setting_TEXT_BOX(0,',
            'sort_order'             => 1,
        );
        $this->SettingsFields['CONF_LITTLESMS_KEY'] = array(
            'settings_value'         => '0',
            'settings_title'         => 'АPI Ключ',
            'settings_description'   => 'Ваш API Ключ для работы с системой.',
            'settings_html_function' => 'setting_TEXT_BOX(0,',
            'sort_order'             => 1,
        );
        $this->SettingsFields['CONF_LITTLESMS_ORIGINATOR'] = array(
            'settings_value'         => 'Shop-Script',
            'settings_title'         => 'Отправитель сообщения, как он будет выглядеть на телефоне получателя',
            'settings_description'   => 'Строка (от 5 до 11 символов, латиница, цифры).',
            'settings_html_function' => 'setting_TEXT_BOX(0,',
            'sort_order'             => 1,
        );
    }

    function _prepareRequest($_SMSMessage, $_PhonesList, $_Params)
    {
        if(! $_SMSMessage) return null;
        if(! count($_PhonesList)) return null;

        return array(
            'user' => $this->_getSettingValue('CONF_LITTLESMS_LOGIN'),
            'recipients' => implode(',', $_PhonesList),
            'message' => $_SMSMessage,
            'sender' => $this->_translit($this->_getSettingValue('CONF_LITTLESMS_ORIGINATOR')),
        );
    }

    function _sendRequest($_Request)
    {
        require_once 'LittleSMS.class.php';

        $key =  $this->_getSettingValue('CONF_LITTLESMS_KEY');
        $api = new LittleSMS($_Request['user'], $key, true);

        if (strlen($_Request['sender']) > 11) {
            $_Request['sender'] = substr ($_Request['sender'], 0, 11);
        }

        $api->sendSMS($_Request['recipients'], $_Request['message'], $_Request['sender']);
    }
}
?>