<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

// TABLES
defined('COUNTRIES_TABLE')      OR define('COUNTRIES_TABLE', "shkalah_countries");
defined('COMPANY_TABLE')      OR define('COMPANY_TABLE', "shkalah_company");
defined('DEPARTMENT_TABLE')      OR define('DEPARTMENT_TABLE', "shkalah_department");
defined('EDUCATION_TABLE')      OR define('EDUCATION_TABLE', "shkalah_education");
defined('FAVOURITE_TABLE')      OR define('FAVOURITE_TABLE', "shkalah_favourite");
defined('LANGUAGE_TABLE')      OR define('LANGUAGE_TABLE', "shkalah_language");


defined('PROFILE_SLIDER_TABLE')      OR define('PROFILE_SLIDER_TABLE', "shkalah_profile_slider");
defined('SKILL_TABLE')      OR define('SKILL_TABLE', "shkalah_skill");

defined('SLIDER_TABLE')      OR define('SLIDER_TABLE', "shkalah_slider");
defined('SYSTEM_SETTINGS_TABLE')      OR define('SYSTEM_SETTINGS_TABLE', "shkalah_system_settings");
defined('TRANSACTION_TABLE')      OR define('TRANSACTION_TABLE', "shkalah_transaction");
defined('USERS_TABLE')      OR define('USERS_TABLE', "shkalah_users");
defined('USERS_ROLES_TABLE')      OR define('USERS_ROLES_TABLE', "shkalah_users_roles");
defined('USER_TABLE')      OR define('USER_TABLE', "shkalah_user");
defined('WORKER_TABLE')      OR define('WORKER_TABLE', "shkalah_worker");
defined('NOTIFICATION_TABLE')      OR define('NOTIFICATION_TABLE', "shkalah_notification");
defined('UNIQUE_VISIT_TABLE')      OR define('UNIQUE_VISIT_TABLE', "shkalah_unique_visit");
defined('USER_IPS_TABLE')      OR define('USER_IPS_TABLE', "shkalah_user_ips");
defined('COMPLAIN_TABLE')      OR define('COMPLAIN_TABLE', "shkalah_complains");
defined('RESERVATION_TABLE')      OR define('RESERVATION_TABLE', "shkalah_reservation");
defined('ACCOUNT_TYPE_TABLE')      OR define('ACCOUNT_TYPE_TABLE', "shkalah_account_type");

// ALIAS
defined('COUNTRIES_ALS')      OR define('COUNTRIES_ALS', "country");
defined('COMPANY_ALS')      OR define('COMPANY_ALS', "company");
defined('DEPARTMENT_ALS')      OR define('DEPARTMENT_ALS', "dept");
defined('EDUCATION_ALS')      OR define('EDUCATION_ALS', "edu");
defined('FAVOURITE_ALS')      OR define('FAVOURITE_ALS', "favourite");
defined('LANGUAGE_ALS')      OR define('LANGUAGE_ALS', "phrase");

defined('PROFILE_SLIDER_ALS')      OR define('PROFILE_SLIDER_ALS', "slider_profile");
defined('SKILL_ALS')      OR define('SKILL_ALS', "skill");
defined('SLIDER_ALS')      OR define('SLIDER_ALS', "slider");
defined('SYSTEM_SETTINGS_ALS')      OR define('SYSTEM_SETTINGS_ALS', "system_settings");
defined('TRANSACTION_ALS')      OR define('TRANSACTION_ALS', "transaction");
defined('USERS_ROLES_ALS')      OR define('USERS_ROLES_ALS', "users_role");
defined('USER_ALS')      OR define('USER_ALS', "user");
defined('WORKER_ALS')      OR define('WORKER_ALS', "worker");
defined('NOTIFICATION_ALS')      OR define('NOTIFICATION_ALS', "notification");
defined('UNIQUE_VISIT_ALS')      OR define('UNIQUE_VISIT_ALS', "unique_visit");
defined('USER_IPS_ALS')      OR define('USER_IPS_ALS', "user_ips");
defined('COMPLAIN_ALS')      OR define('COMPLAIN_ALS', "complain");
defined('RESERVATION_ALS')      OR define('RESERVATION_ALS', "reservation");
defined('ACCOUNT_TYPE_ALS')      OR define('ACCOUNT_TYPE_ALS', "type");

// $config['base_url']
//defined('NOTIFY_IMGS')      OR define('NOTIFY_IMGS', base_url()."/uploads/imgs/");

