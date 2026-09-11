-- Run in phpMyAdmin on database: ganesh_restaurant
ALTER TABLE `team_members`
    ADD COLUMN `aadhar_card` VARCHAR(255) NULL AFTER `photo`;
