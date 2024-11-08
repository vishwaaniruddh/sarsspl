<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2024-09-11 00:15:01 --> Unable to connect to the database
ERROR - 2024-09-11 00:15:01 --> Query error: Resource temporarily unavailable - Invalid query: SELECT *
FROM `tracker_device_battery_notifications`
WHERE `is_notification_sent` = 0
ORDER BY `id` DESC
ERROR - 2024-09-11 00:15:01 --> Severity: error --> Exception: Call to a member function result_array() on bool /home/u444388293/domains/sarsspl.com/public_html/captainIndia/backend/application/controllers/Api.php 10639
