-- =====================================================================
-- Win B. A. R. Academy: database update, 2026-11-09
--
-- Run this ONCE on a database you already imported from "online_enroll (2).sql".
-- (For a fresh install, import database/online_enroll.sql instead.)
--
-- phpMyAdmin: select the online_enroll database > Import > choose this file > Import.
--
-- What it does:
--   1. Widens columns that were too short:
--        usertbl.password  11 -> 255  (a hashed password is about 60 characters)
--        usertbl.username  11 -> 50
--        usertbl.fullname  20 -> 100
--        studenttbl.emailaddress 14 -> 100  (emails were being cut off)
--   2. Removes the two old "Dennis" accounts (admin "admins", student "dennis"),
--      the student record linked to "dennis" (2014-052 Karl Macniel Flores),
--      that student's test enrollments, and one enrollment row with no student.
--   3. Adds a sample administrator and a sample student, with hashed passwords:
--        admin    username: admin     password: Admin@2026
--        student  username: 25-1001   password: Student@2026
--      Change both passwords before using the site for anything real.
-- =====================================================================

USE `online_enroll`;

-- 1. Column sizes -------------------------------------------------------
ALTER TABLE `usertbl`
  MODIFY `username` VARCHAR(50)  NOT NULL,
  MODIFY `password` VARCHAR(255) NOT NULL,
  MODIFY `fullname` VARCHAR(100) NOT NULL;

ALTER TABLE `studenttbl`
  MODIFY `emailaddress` VARCHAR(100) NOT NULL;

-- 2. Remove the old Dennis accounts and their test data -----------------
DELETE FROM `student_subject`
 WHERE `studentID` = ''
    OR `studentID` IN (SELECT `studnum` FROM `studenttbl`
                        WHERE `accountID` IN (SELECT `ID` FROM `usertbl` WHERE `username` IN ('admins', 'dennis')));

DELETE FROM `studenttbl`
 WHERE `accountID` IN (SELECT `ID` FROM `usertbl` WHERE `username` IN ('admins', 'dennis'));

DELETE FROM `usertbl` WHERE `username` IN ('admins', 'dennis');

-- 3. Sample accounts (passwords are bcrypt hashes) ----------------------
INSERT INTO `usertbl` (`ID`, `username`, `password`, `fullname`, `user_type`) VALUES
  (NULL, 'admin', '$2y$10$3FWlTR2mQDledQOtjKbEruMVUikYqufWpSdqqMk7O7Ib4a6FGOomy', 'Ana Reyes', 'admin');

INSERT INTO `usertbl` (`ID`, `username`, `password`, `fullname`, `user_type`) VALUES
  (NULL, '25-1001', '$2y$10$Rz6ioHl18SUTMGR/ecMwc.b6q2FhHZm1Zwy/4kvIEyQA257dufWFu', 'Juan P. Dela Cruz', 'student');

SET @student_account = LAST_INSERT_ID();

INSERT INTO `studenttbl`
  (`ID`, `accountID`, `studnum`, `fname`, `minitial`, `lname`, `address`, `contact`, `emailaddress`,
   `birthdate`, `course`, `yearlvl`, `gender`, `fathername`, `mothername`, `guardianname`, `birthplace`,
   `civilstatus`, `elemschool`, `dategradelem`, `hsschool`, `datehsgrad`, `lastgrad`, `datelastgrad`, `addresslastgrad`)
VALUES
  (NULL, @student_account, '25-1001', 'Juan', 'P', 'Dela Cruz', '[Sample address]', '09170000000', 'juan.delacruz@example.com',
   '2006-06-15', 'bsit', 'II-1', 'male', '[Father''s name]', '[Mother''s name]', '[Guardian''s name]', '[Birthplace]',
   'single', '[Elementary school]', '2019', '[High school]', '2025', '[High school]', '2025', '[School address]');
