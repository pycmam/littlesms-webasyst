INSERT INTO `SC_settings` (`settingsID`, `settings_groupID`, `settings_constant_name`, `settings_value`, `settings_title`, `settings_description`, `settings_html_function`, `sort_order`) VALUES 
(null, 1, 'CONF_LITTLESMS_LOGIN_10', 'webasyst', 'Логин', 'Ваш логин для работы с системой.', 'setting_TEXT_BOX(0,', 1),
(null, 1, 'CONF_LITTLESMS_KEY_10', 'qwerty1', 'АPI Ключ', 'Ваш API ключ для работы с системой.', 'setting_TEXT_BOX(0,', 1),
(null, 1, 'CONF_LITTLESMS_ORIGINATOR_10', 'При', 'Отправитель сообщения, как он будет выглядеть на телефоне получателя', 'Строка (от 5 до 11 символов, латиница, цифры', 'setting_TEXT_BOX(0,', 1);

INSERT INTO `SC_spmodules` (`module_id`, `module_type`, `module_name`, `ModuleClassName`) VALUES
(10, NULL, 'Little SMS', 'LittleSMSgw');
