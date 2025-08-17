-- Migration to add last_login field to users table
-- Run this script if your database already exists and you need to add the last_login field

ALTER TABLE `users` ADD COLUMN `last_login` timestamp NULL DEFAULT NULL AFTER `profile_image`;