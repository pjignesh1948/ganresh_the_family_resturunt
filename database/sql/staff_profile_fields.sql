-- Run in phpMyAdmin on database: ganesh_restaurant

ALTER TABLE `staff`
    ADD COLUMN `photo` VARCHAR(255) NULL AFTER `role`,
    ADD COLUMN `aadhar_number` VARCHAR(12) NULL AFTER `photo`,
    ADD COLUMN `aadhar_card` VARCHAR(255) NULL AFTER `aadhar_number`,
    ADD COLUMN `state` VARCHAR(255) NULL AFTER `aadhar_card`,
    ADD COLUMN `city` VARCHAR(255) NULL AFTER `state`;
