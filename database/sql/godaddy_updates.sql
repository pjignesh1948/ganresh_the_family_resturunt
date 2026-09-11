-- Run in phpMyAdmin on database: ganesh_restaurant
-- Run each block once. Skip if column already exists.

-- Team Members: Aadhar image
ALTER TABLE `team_members`
    ADD COLUMN `aadhar_card` VARCHAR(255) NULL AFTER `photo`;

-- Staff: photo, aadhar, state, city
ALTER TABLE `staff`
    ADD COLUMN `photo` VARCHAR(255) NULL AFTER `role`,
    ADD COLUMN `aadhar_number` VARCHAR(12) NULL AFTER `photo`,
    ADD COLUMN `aadhar_card` VARCHAR(255) NULL AFTER `aadhar_number`,
    ADD COLUMN `state` VARCHAR(255) NULL AFTER `aadhar_card`,
    ADD COLUMN `city` VARCHAR(255) NULL AFTER `state`;
