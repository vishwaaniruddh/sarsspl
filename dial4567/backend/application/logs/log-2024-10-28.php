<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2024-10-28 10:52:46 --> Severity: Warning --> Attempt to read property "status" on null /home/u444388293/domains/sarsspl.com/public_html/dial4567/backend/application/models/Login_model.php 54
ERROR - 2024-10-28 10:52:46 --> Severity: Warning --> Attempt to read property "status" on null /home/u444388293/domains/sarsspl.com/public_html/dial4567/backend/application/models/Login_model.php 56
ERROR - 2024-10-28 10:52:46 --> Severity: Warning --> Attempt to read property "status" on null /home/u444388293/domains/sarsspl.com/public_html/dial4567/backend/application/models/Login_model.php 58
ERROR - 2024-10-28 10:52:53 --> Severity: Warning --> Attempt to read property "status" on null /home/u444388293/domains/sarsspl.com/public_html/dial4567/backend/application/models/Login_model.php 54
ERROR - 2024-10-28 10:52:53 --> Severity: Warning --> Attempt to read property "status" on null /home/u444388293/domains/sarsspl.com/public_html/dial4567/backend/application/models/Login_model.php 56
ERROR - 2024-10-28 10:52:53 --> Severity: Warning --> Attempt to read property "status" on null /home/u444388293/domains/sarsspl.com/public_html/dial4567/backend/application/models/Login_model.php 58
ERROR - 2024-10-28 10:55:43 --> Query error: Table 'u444388293_dial4567.qr_code' doesn't exist - Invalid query: SELECT `qr_code`.`id`, `qr_code`.`user_id`, `qr_code`.`code`, `qr_code`.`type`, `qr_code`.`type_title`, `qr_code`.`code_for`, `qr_code`.`missing_status`, `qr_code`.`is_deleted`, `qr_code`.`created_at`, `users`.`first_name`, `users`.`last_name`, `users`.`mobile_no`
FROM `qr_code`
LEFT JOIN `users` ON `users`.`id` = `qr_code`.`user_id`
WHERE `qr_code`.`is_deleted` = '0'
ORDER BY `qr_code`.`id` DESC
ERROR - 2024-10-28 10:55:43 --> Severity: error --> Exception: Call to a member function result_array() on bool /home/u444388293/domains/sarsspl.com/public_html/dial4567/backend/application/models/Qrcode_model.php 19
ERROR - 2024-10-28 10:55:43 --> Query error: Table 'u444388293_dial4567.qr_code' doesn't exist - Invalid query: SELECT `qr_code`.`id`, `qr_code`.`user_id`, `qr_code`.`code`, `qr_code`.`type`, `qr_code`.`type_title`, `qr_code`.`code_for`, `qr_code`.`missing_status`, `qr_code`.`is_deleted`, `qr_code`.`created_at`
FROM `qr_code`
WHERE qr_code.user_id IS NULL
ORDER BY `qr_code`.`id` DESC
ERROR - 2024-10-28 10:55:43 --> Severity: error --> Exception: Call to a member function result_array() on bool /home/u444388293/domains/sarsspl.com/public_html/dial4567/backend/application/models/Qrcode_model.php 413
ERROR - 2024-10-28 10:55:51 --> Query error: Table 'u444388293_dial4567.qr_code' doesn't exist - Invalid query: SELECT `qr_code_scan_alert`.`id`, `qr_code_scan_alert`.`qr_code_id`, `qr_code_scan_alert`.`latitude`, `qr_code_scan_alert`.`longitude`, `qr_code_scan_alert`.`created_at`, `qr_code`.`code`
FROM `qr_code_scan_alert`
LEFT JOIN `qr_code` ON `qr_code`.`id` = `qr_code_scan_alert`.`qr_code_id`
ORDER BY `qr_code_scan_alert`.`id` DESC
ERROR - 2024-10-28 10:55:51 --> Severity: error --> Exception: Call to a member function result_array() on bool /home/u444388293/domains/sarsspl.com/public_html/dial4567/backend/application/models/Qrcode_model.php 431
ERROR - 2024-10-28 10:56:25 --> Query error: Table 'u444388293_dial4567.qr_code' doesn't exist - Invalid query: SELECT `qr_code_scan_alert`.`id`, `qr_code_scan_alert`.`qr_code_id`, `qr_code_scan_alert`.`latitude`, `qr_code_scan_alert`.`longitude`, `qr_code_scan_alert`.`created_at`, `qr_code`.`code`
FROM `qr_code_scan_alert`
LEFT JOIN `qr_code` ON `qr_code`.`id` = `qr_code_scan_alert`.`qr_code_id`
ORDER BY `qr_code_scan_alert`.`id` DESC
ERROR - 2024-10-28 10:56:25 --> Severity: error --> Exception: Call to a member function result_array() on bool /home/u444388293/domains/sarsspl.com/public_html/dial4567/backend/application/models/Qrcode_model.php 431
ERROR - 2024-10-28 10:56:56 --> Query error: Table 'u444388293_dial4567.qr_code' doesn't exist - Invalid query: SELECT `qr_code_scan_alert`.`id`, `qr_code_scan_alert`.`qr_code_id`, `qr_code_scan_alert`.`latitude`, `qr_code_scan_alert`.`longitude`, `qr_code_scan_alert`.`created_at`, `qr_code`.`code`
FROM `qr_code_scan_alert`
LEFT JOIN `qr_code` ON `qr_code`.`id` = `qr_code_scan_alert`.`qr_code_id`
ORDER BY `qr_code_scan_alert`.`id` DESC
ERROR - 2024-10-28 10:56:56 --> Severity: error --> Exception: Call to a member function result_array() on bool /home/u444388293/domains/sarsspl.com/public_html/dial4567/backend/application/models/Qrcode_model.php 431
ERROR - 2024-10-28 11:05:34 --> Query error: Table 'u444388293_dial4567.followme_safe' doesn't exist - Invalid query: SELECT `id`, `user_id`, `followme_id`, `status`, `user_lat`, `user_long`, `created_at`, `updated_at`
FROM `followme_safe`
WHERE `followme_id` = '5106'
ORDER BY `id` DESC
ERROR - 2024-10-28 11:05:34 --> Severity: error --> Exception: Call to a member function row() on bool /home/u444388293/domains/sarsspl.com/public_html/dial4567/backend/application/models/User_model.php 2478
ERROR - 2024-10-28 11:18:41 --> Query error: Table 'u444388293_dial4567.followme_safe' doesn't exist - Invalid query: SELECT `id`, `user_id`, `followme_id`, `status`, `user_lat`, `user_long`, `created_at`, `updated_at`
FROM `followme_safe`
WHERE `followme_id` = '5106'
ORDER BY `id` DESC
ERROR - 2024-10-28 11:18:41 --> Severity: error --> Exception: Call to a member function row() on bool /home/u444388293/domains/sarsspl.com/public_html/dial4567/backend/application/models/User_model.php 2478
