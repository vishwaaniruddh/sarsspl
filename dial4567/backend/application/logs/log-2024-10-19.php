<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2024-10-19 05:47:48 --> Query error: Table 'u444388293_dial4567.followme_safe' doesn't exist - Invalid query: SELECT `id`, `user_id`, `followme_id`, `status`, `user_lat`, `user_long`, `created_at`, `updated_at`
FROM `followme_safe`
WHERE `followme_id` = '5106'
ORDER BY `id` DESC
ERROR - 2024-10-19 05:47:48 --> Severity: error --> Exception: Call to a member function row() on bool /home/u444388293/domains/sarsspl.com/public_html/dial4567/backend/application/models/User_model.php 2478
ERROR - 2024-10-19 05:47:57 --> Severity: Warning --> Attempt to read property "content_type" on null /home/u444388293/domains/sarsspl.com/public_html/dial4567/backend/application/controllers/User.php 1195
ERROR - 2024-10-19 05:47:57 --> Severity: Warning --> Attempt to read property "module_type" on null /home/u444388293/domains/sarsspl.com/public_html/dial4567/backend/application/controllers/User.php 1196
ERROR - 2024-10-19 05:48:12 --> Severity: Warning --> Attempt to read property "content_type" on null /home/u444388293/domains/sarsspl.com/public_html/dial4567/backend/application/controllers/User.php 1195
ERROR - 2024-10-19 05:48:12 --> Severity: Warning --> Attempt to read property "module_type" on null /home/u444388293/domains/sarsspl.com/public_html/dial4567/backend/application/controllers/User.php 1196
ERROR - 2024-10-19 06:25:00 --> Query error: Table 'u444388293_dial4567.qr_code' doesn't exist - Invalid query: SELECT `qr_code`.`id`, `qr_code`.`user_id`, `qr_code`.`code`, `qr_code`.`type`, `qr_code`.`type_title`, `qr_code`.`code_for`, `qr_code`.`missing_status`, `qr_code`.`is_deleted`, `qr_code`.`created_at`, `qr_code`.`updated_at`, `users`.`first_name`, `users`.`last_name`, `users`.`mobile_no`
FROM `qr_code`
LEFT JOIN `users` ON `users`.`id` = `qr_code`.`user_id`
WHERE `qr_code`.`is_deleted` = '0'
AND `qr_code`.`missing_status` = '2'
ORDER BY `qr_code`.`updated_at` DESC
ERROR - 2024-10-19 06:25:00 --> Severity: error --> Exception: Call to a member function result_array() on bool /home/u444388293/domains/sarsspl.com/public_html/dial4567/backend/application/models/Qrcode_model.php 453
ERROR - 2024-10-19 06:32:45 --> Query error: Table 'u444388293_dial4567.followme_safe' doesn't exist - Invalid query: SELECT `id`, `user_id`, `followme_id`, `status`, `user_lat`, `user_long`, `created_at`, `updated_at`
FROM `followme_safe`
WHERE `followme_id` = '5106'
ORDER BY `id` DESC
ERROR - 2024-10-19 06:32:45 --> Severity: error --> Exception: Call to a member function row() on bool /home/u444388293/domains/sarsspl.com/public_html/dial4567/backend/application/models/User_model.php 2478
ERROR - 2024-10-19 06:40:37 --> Severity: Warning --> Attempt to read property "content_type" on null /home/u444388293/domains/sarsspl.com/public_html/dial4567/backend/application/controllers/User.php 1195
ERROR - 2024-10-19 06:40:37 --> Severity: Warning --> Attempt to read property "module_type" on null /home/u444388293/domains/sarsspl.com/public_html/dial4567/backend/application/controllers/User.php 1196
ERROR - 2024-10-19 08:16:23 --> Severity: Warning --> Attempt to read property "content_type" on null /home/u444388293/domains/sarsspl.com/public_html/dial4567/backend/application/controllers/User.php 1195
ERROR - 2024-10-19 08:16:23 --> Severity: Warning --> Attempt to read property "module_type" on null /home/u444388293/domains/sarsspl.com/public_html/dial4567/backend/application/controllers/User.php 1196
ERROR - 2024-10-19 08:16:32 --> Severity: Warning --> Attempt to read property "content_type" on null /home/u444388293/domains/sarsspl.com/public_html/dial4567/backend/application/controllers/User.php 1195
ERROR - 2024-10-19 08:16:32 --> Severity: Warning --> Attempt to read property "module_type" on null /home/u444388293/domains/sarsspl.com/public_html/dial4567/backend/application/controllers/User.php 1196
ERROR - 2024-10-19 08:16:51 --> Severity: Warning --> Attempt to read property "content_type" on null /home/u444388293/domains/sarsspl.com/public_html/dial4567/backend/application/controllers/User.php 1195
ERROR - 2024-10-19 08:16:51 --> Severity: Warning --> Attempt to read property "module_type" on null /home/u444388293/domains/sarsspl.com/public_html/dial4567/backend/application/controllers/User.php 1196
ERROR - 2024-10-19 08:17:01 --> Severity: Warning --> Attempt to read property "content_type" on null /home/u444388293/domains/sarsspl.com/public_html/dial4567/backend/application/controllers/User.php 1195
ERROR - 2024-10-19 08:17:01 --> Severity: Warning --> Attempt to read property "module_type" on null /home/u444388293/domains/sarsspl.com/public_html/dial4567/backend/application/controllers/User.php 1196
