<?php
/**  This file is autogenerated, do not edit. Changes will be lost.
 * 
 * This script will safely build or rebuild you database
 * tables. You should never execute this script manually as
 * CarbonPHP will automatically rebuild itself if needed.
 *
 * regenerate this page with
 *
 *     php index.php buildBuildDatabase
 *
 */

print '<h1>Setting up CarbonPHP</h1>';

$db = \CarbonPHP\Database::database();

try {
    print '<html><head><title>Setup or Rebuild Database</title></head><body><h1>STARTING MAJOR CARBON SYSTEMS</h1>' . PHP_EOL;

    $head = <<<HEAD
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
HEAD;

    $foot = <<<FOOT
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
FOOT;
try {
        $db->prepare('SELECT 1 FROM carbon_comments LIMIT 1;')->execute();
        print '<br>Table `carbon_comments` already exists</p>';
    } catch (PDOException $e) {
        print '<br><p style="color: red">Creating `carbon_comments`</p>';
        $sql = <<<END
        $head
    DROP TABLE IF EXISTS `carbon_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `carbon_comments` (
  `parent_id` binary(16) NOT NULL,
  `comment_id` binary(16) NOT NULL,
  `user_id` binary(16) NOT NULL,
  `comment` blob NOT NULL,
  PRIMARY KEY (`comment_id`),
  KEY `entity_comments_entity_parent_pk_fk` (`parent_id`),
  KEY `entity_comments_entity_user_pk_fk` (`user_id`),
  CONSTRAINT `entity_comments_entity_entity_pk_fk` FOREIGN KEY (`comment_id`) REFERENCES `carbons` (`entity_pk`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `entity_comments_entity_parent_pk_fk` FOREIGN KEY (`parent_id`) REFERENCES `carbons` (`entity_pk`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `entity_comments_entity_user_pk_fk` FOREIGN KEY (`user_id`) REFERENCES `carbons` (`entity_pk`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;


        $foot
END;

        print $sql . '<br>';
        $db->exec($sql) === false and die(print_r($db->errorInfo(), true));
        print '<br><p style="color: green">Table `carbon_comments` Created</p>';
    }try {
        $db->prepare('SELECT 1 FROM carbon_locations LIMIT 1;')->execute();
        print '<br>Table `carbon_locations` already exists</p>';
    } catch (PDOException $e) {
        print '<br><p style="color: red">Creating `carbon_locations`</p>';
        $sql = <<<END
        $head
    DROP TABLE IF EXISTS `carbon_locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `carbon_locations` (
  `entity_id` binary(16) NOT NULL,
  `latitude` varchar(225) DEFAULT NULL,
  `longitude` varchar(225) DEFAULT NULL,
  `street` text,
  `city` varchar(40) DEFAULT NULL,
  `state` varchar(10) DEFAULT NULL,
  `elevation` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`entity_id`),
  UNIQUE KEY `entity_location_entity_id_uindex` (`entity_id`),
  CONSTRAINT `entity_location_entity_entity_pk_fk` FOREIGN KEY (`entity_id`) REFERENCES `carbons` (`entity_pk`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;


        $foot
END;

        print $sql . '<br>';
        $db->exec($sql) === false and die(print_r($db->errorInfo(), true));
        print '<br><p style="color: green">Table `carbon_locations` Created</p>';
    }try {
        $db->prepare('SELECT 1 FROM carbon_photos LIMIT 1;')->execute();
        print '<br>Table `carbon_photos` already exists</p>';
    } catch (PDOException $e) {
        print '<br><p style="color: red">Creating `carbon_photos`</p>';
        $sql = <<<END
        $head
    DROP TABLE IF EXISTS `carbon_photos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `carbon_photos` (
  `parent_id` binary(16) NOT NULL,
  `photo_id` binary(16) NOT NULL,
  `user_id` binary(16) NOT NULL,
  `photo_path` varchar(225) NOT NULL,
  `photo_description` text,
  PRIMARY KEY (`parent_id`),
  UNIQUE KEY `entity_photos_photo_id_uindex` (`photo_id`),
  KEY `photos_entity_user_pk_fk` (`user_id`),
  CONSTRAINT `entity_photos_entity_entity_pk_fk` FOREIGN KEY (`photo_id`) REFERENCES `carbons` (`entity_pk`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `photos_entity_entity_pk_fk` FOREIGN KEY (`parent_id`) REFERENCES `carbons` (`entity_pk`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `photos_entity_user_pk_fk` FOREIGN KEY (`user_id`) REFERENCES `carbons` (`entity_pk`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;


        $foot
END;

        print $sql . '<br>';
        $db->exec($sql) === false and die(print_r($db->errorInfo(), true));
        print '<br><p style="color: green">Table `carbon_photos` Created</p>';
    }try {
        $db->prepare('SELECT 1 FROM carbon_reports LIMIT 1;')->execute();
        print '<br>Table `carbon_reports` already exists</p>';
    } catch (PDOException $e) {
        print '<br><p style="color: red">Creating `carbon_reports`</p>';
        $sql = <<<END
        $head
    DROP TABLE IF EXISTS `carbon_reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `carbon_reports` (
  `log_level` varchar(20) DEFAULT NULL,
  `report` text,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `call_trace` text NOT NULL,
  UNIQUE KEY `carbon_reports_date_uindex` (`date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;


        $foot
END;

        print $sql . '<br>';
        $db->exec($sql) === false and die(print_r($db->errorInfo(), true));
        print '<br><p style="color: green">Table `carbon_reports` Created</p>';
    }try {
        $db->prepare('SELECT 1 FROM carbon_tag LIMIT 1;')->execute();
        print '<br>Table `carbon_tag` already exists</p>';
    } catch (PDOException $e) {
        print '<br><p style="color: red">Creating `carbon_tag`</p>';
        $sql = <<<END
        $head
    DROP TABLE IF EXISTS `carbon_tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `carbon_tag` (
  `entity_id` binary(16) NOT NULL,
  `tag_id` varchar(80) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `entity_tag_entity_entity_pk_fk` (`entity_id`),
  KEY `entity_tag_tag_tag_id_fk` (`tag_id`),
  CONSTRAINT `carbon_tag_tags_tag_id_fk` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`tag_id`),
  CONSTRAINT `entity_tag_entity_entity_pk_fk` FOREIGN KEY (`entity_id`) REFERENCES `carbons` (`entity_pk`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;


        $foot
END;

        print $sql . '<br>';
        $db->exec($sql) === false and die(print_r($db->errorInfo(), true));
        print '<br><p style="color: green">Table `carbon_tag` Created</p>';
    }try {
        $db->prepare('SELECT 1 FROM carbon_user_followers LIMIT 1;')->execute();
        print '<br>Table `carbon_user_followers` already exists</p>';
    } catch (PDOException $e) {
        print '<br><p style="color: red">Creating `carbon_user_followers`</p>';
        $sql = <<<END
        $head
    DROP TABLE IF EXISTS `carbon_user_followers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `carbon_user_followers` (
  `follower_table_id` binary(16) NOT NULL,
  `follows_user_id` binary(16) NOT NULL,
  `user_id` binary(16) NOT NULL,
  PRIMARY KEY (`follower_table_id`),
  KEY `followers_entity_entity_pk_fk` (`follows_user_id`),
  KEY `followers_entity_entity_followers_pk_fk` (`user_id`),
  CONSTRAINT `carbon_user_followers_carbons_entity_pk_fk` FOREIGN KEY (`follower_table_id`) REFERENCES `carbons` (`entity_pk`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `followers_entity_entity_follows_pk_fk` FOREIGN KEY (`follows_user_id`) REFERENCES `carbons` (`entity_pk`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `followers_entity_followers_pk_fk` FOREIGN KEY (`user_id`) REFERENCES `carbons` (`entity_pk`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;


        $foot
END;

        print $sql . '<br>';
        $db->exec($sql) === false and die(print_r($db->errorInfo(), true));
        print '<br><p style="color: green">Table `carbon_user_followers` Created</p>';
    }try {
        $db->prepare('SELECT 1 FROM carbon_user_messages LIMIT 1;')->execute();
        print '<br>Table `carbon_user_messages` already exists</p>';
    } catch (PDOException $e) {
        print '<br><p style="color: red">Creating `carbon_user_messages`</p>';
        $sql = <<<END
        $head
    DROP TABLE IF EXISTS `carbon_user_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `carbon_user_messages` (
  `message_id` binary(16) NOT NULL,
  `from_user_id` binary(16) NOT NULL,
  `to_user_id` binary(16) NOT NULL,
  `message` text NOT NULL,
  `message_read` tinyint(1) DEFAULT '0',
  `creation_date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`message_id`),
  KEY `messages_entity_entity_pk_fk` (`message_id`),
  KEY `messages_entity_user_from_pk_fk` (`to_user_id`),
  KEY `carbon_user_messages_carbon_entity_pk_fk` (`from_user_id`),
  CONSTRAINT `carbon_user_messages_carbon_entity_pk_fk` FOREIGN KEY (`from_user_id`) REFERENCES `carbons` (`entity_pk`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `messages_entity_entity_pk_fk` FOREIGN KEY (`message_id`) REFERENCES `carbons` (`entity_pk`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `messages_entity_user_from_pk_fk` FOREIGN KEY (`to_user_id`) REFERENCES `carbons` (`entity_pk`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;


        $foot
END;

        print $sql . '<br>';
        $db->exec($sql) === false and die(print_r($db->errorInfo(), true));
        print '<br><p style="color: green">Table `carbon_user_messages` Created</p>';
    }try {
        $db->prepare('SELECT 1 FROM carbon_user_sessions LIMIT 1;')->execute();
        print '<br>Table `carbon_user_sessions` already exists</p>';
    } catch (PDOException $e) {
        print '<br><p style="color: red">Creating `carbon_user_sessions`</p>';
        $sql = <<<END
        $head
    DROP TABLE IF EXISTS `carbon_user_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `carbon_user_sessions` (
  `user_id` binary(16) NOT NULL,
  `user_ip` binary(16) DEFAULT NULL,
  `session_id` varchar(255) NOT NULL,
  `session_expires` datetime NOT NULL,
  `session_data` text,
  `user_online_status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;


        $foot
END;

        print $sql . '<br>';
        $db->exec($sql) === false and die(print_r($db->errorInfo(), true));
        print '<br><p style="color: green">Table `carbon_user_sessions` Created</p>';
    }try {
        $db->prepare('SELECT 1 FROM carbon_user_tasks LIMIT 1;')->execute();
        print '<br>Table `carbon_user_tasks` already exists</p>';
    } catch (PDOException $e) {
        print '<br><p style="color: red">Creating `carbon_user_tasks`</p>';
        $sql = <<<END
        $head
    DROP TABLE IF EXISTS `carbon_user_tasks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `carbon_user_tasks` (
  `task_id` binary(16) NOT NULL,
  `user_id` binary(16) NOT NULL COMMENT 'This is the user the task is being assigned to',
  `from_id` binary(16) DEFAULT NULL COMMENT 'Keeping this colum so forgen key will remove task if user deleted',
  `task_name` varchar(40) NOT NULL,
  `task_description` varchar(225) DEFAULT NULL,
  `percent_complete` int(11) DEFAULT '0',
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  KEY `user_tasks_entity_entity_pk_fk` (`from_id`),
  KEY `user_tasks_entity_task_pk_fk` (`task_id`),
  CONSTRAINT `tasks_entity_entity_pk_fk` FOREIGN KEY (`task_id`) REFERENCES `carbons` (`entity_pk`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_tasks_entity_entity_pk_fk` FOREIGN KEY (`from_id`) REFERENCES `carbons` (`entity_pk`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_tasks_entity_user_pk_fk` FOREIGN KEY (`user_id`) REFERENCES `carbons` (`entity_pk`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;


        $foot
END;

        print $sql . '<br>';
        $db->exec($sql) === false and die(print_r($db->errorInfo(), true));
        print '<br><p style="color: green">Table `carbon_user_tasks` Created</p>';
    }try {
        $db->prepare('SELECT 1 FROM carbon_users LIMIT 1;')->execute();
        print '<br>Table `carbon_users` already exists</p>';
    } catch (PDOException $e) {
        print '<br><p style="color: red">Creating `carbon_users`</p>';
        $sql = <<<END
        $head
    DROP TABLE IF EXISTS `carbon_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `carbon_users` (
  `user_username` varchar(25) NOT NULL,
  `user_password` varchar(225) NOT NULL,
  `user_id` binary(16) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'Athlete',
  `user_sport` varchar(20) DEFAULT 'GOLF',
  `user_session_id` varchar(225) DEFAULT NULL,
  `user_facebook_id` varchar(225) DEFAULT NULL,
  `user_first_name` varchar(25) NOT NULL,
  `user_last_name` varchar(25) NOT NULL,
  `user_profile_pic` varchar(225) DEFAULT NULL,
  `user_profile_uri` varchar(225) DEFAULT NULL,
  `user_cover_photo` varchar(225) DEFAULT NULL,
  `user_birthday` varchar(9) DEFAULT NULL,
  `user_gender` varchar(25) NOT NULL,
  `user_about_me` varchar(225) DEFAULT NULL,
  `user_rank` int(8) DEFAULT '0',
  `user_email` varchar(50) NOT NULL,
  `user_email_code` varchar(225) DEFAULT NULL,
  `user_email_confirmed` varchar(20) NOT NULL DEFAULT '0',
  `user_generated_string` varchar(200) DEFAULT NULL,
  `user_membership` int(10) DEFAULT '0',
  `user_deactivated` tinyint(1) DEFAULT '0',
  `user_last_login` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_ip` varchar(20) NOT NULL,
  `user_education_history` varchar(200) DEFAULT NULL,
  `user_location` varchar(20) DEFAULT NULL,
  `user_creation_date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `carbon_users_user_username_uindex` (`user_username`),
  UNIQUE KEY `user_user_profile_uri_uindex` (`user_profile_uri`),
  UNIQUE KEY `carbon_users_user_facebook_id_uindex` (`user_facebook_id`),
  CONSTRAINT `user_entity_entity_pk_fk` FOREIGN KEY (`user_id`) REFERENCES `carbons` (`entity_pk`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;


        $foot
END;

        print $sql . '<br>';
        $db->exec($sql) === false and die(print_r($db->errorInfo(), true));
        print '<br><p style="color: green">Table `carbon_users` Created</p>';
    }try {
        $db->prepare('SELECT 1 FROM carbons LIMIT 1;')->execute();
        print '<br>Table `carbons` already exists</p>';
    } catch (PDOException $e) {
        print '<br><p style="color: red">Creating `carbons`</p>';
        $sql = <<<END
        $head
    DROP TABLE IF EXISTS `carbons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `carbons` (
  `entity_pk` binary(16) NOT NULL,
  `entity_fk` binary(16) DEFAULT NULL,
  PRIMARY KEY (`entity_pk`),
  UNIQUE KEY `entity_entity_pk_uindex` (`entity_pk`),
  KEY `entity_entity_entity_pk_fk` (`entity_fk`),
  CONSTRAINT `entity_entity_entity_pk_fk` FOREIGN KEY (`entity_fk`) REFERENCES `carbons` (`entity_pk`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;


        $foot
END;

        print $sql . '<br>';
        $db->exec($sql) === false and die(print_r($db->errorInfo(), true));
        print '<br><p style="color: green">Table `carbons` Created</p>';
    }try {
        $db->prepare('SELECT 1 FROM creation_logs LIMIT 1;')->execute();
        print '<br>Table `creation_logs` already exists</p>';
    } catch (PDOException $e) {
        print '<br><p style="color: red">Creating `creation_logs`</p>';
        $sql = <<<END
        $head
    DROP TABLE IF EXISTS `creation_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `creation_logs` (
  `uuid` binary(16) DEFAULT NULL COMMENT 'not a relation to carbons',
  `resource_type` varchar(40) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `resource_uuid` binary(16) DEFAULT NULL COMMENT 'Was a carbons ref, but no longer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


        $foot
END;

        print $sql . '<br>';
        $db->exec($sql) === false and die(print_r($db->errorInfo(), true));
        print '<br><p style="color: green">Table `creation_logs` Created</p>';
    }try {
        $db->prepare('SELECT 1 FROM history_logs LIMIT 1;')->execute();
        print '<br>Table `history_logs` already exists</p>';
    } catch (PDOException $e) {
        print '<br><p style="color: red">Creating `history_logs`</p>';
        $sql = <<<END
        $head
    DROP TABLE IF EXISTS `history_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `history_logs` (
  `uuid` binary(16) NOT NULL,
  `resource_type` varchar(40) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `resource_uuid` binary(16) DEFAULT NULL,
  `operation_type` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `data` json DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


        $foot
END;

        print $sql . '<br>';
        $db->exec($sql) === false and die(print_r($db->errorInfo(), true));
        print '<br><p style="color: green">Table `history_logs` Created</p>';
    }try {
        $db->prepare('SELECT 1 FROM sessions LIMIT 1;')->execute();
        print '<br>Table `sessions` already exists</p>';
    } catch (PDOException $e) {
        print '<br><p style="color: red">Creating `sessions`</p>';
        $sql = <<<END
        $head
    DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `sessions` (
  `user_id` binary(16) NOT NULL,
  `user_ip` varchar(20) DEFAULT NULL,
  `session_id` varchar(255) NOT NULL,
  `session_expires` datetime NOT NULL,
  `session_data` text,
  `user_online_status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;


        $foot
END;

        print $sql . '<br>';
        $db->exec($sql) === false and die(print_r($db->errorInfo(), true));
        print '<br><p style="color: green">Table `sessions` Created</p>';
    }try {
        $db->prepare('SELECT 1 FROM tags LIMIT 1;')->execute();
        print '<br>Table `tags` already exists</p>';
    } catch (PDOException $e) {
        print '<br><p style="color: red">Creating `tags`</p>';
        $sql = <<<END
        $head
    DROP TABLE IF EXISTS `tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tags` (
  `tag_id` varchar(80) NOT NULL,
  `tag_description` text NOT NULL,
  `tag_name` text,
  UNIQUE KEY `tag_tag_id_uindex` (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;


        $foot
END;

        print $sql . '<br>';
        $db->exec($sql) === false and die(print_r($db->errorInfo(), true));
        print '<br><p style="color: green">Table `tags` Created</p>';
    }Try {
    $sql = <<<END
REPLACE INTO tags (tag_id, tag_description, tag_name) VALUES (?,?,?);
END;
     $tag = [['carbon_comments','','carbon_comments'],['carbon_locations','','carbon_locations'],['carbon_photos','','carbon_photos'],['carbon_reports','','carbon_reports'],['carbon_tag','','carbon_tag'],['carbon_user_followers','','carbon_user_followers'],['carbon_user_messages','','carbon_user_messages'],['carbon_user_sessions','','carbon_user_sessions'],['carbon_user_tasks','','carbon_user_tasks'],['carbon_users','','carbon_users'],['carbons','','carbons'],['creation_logs','','creation_logs'],['history_logs','','history_logs'],['sessions','','sessions'],['tags','','tags'],];
    foreach ($tag as $key => $value) {
            $sql = "SELECT count(*) FROM tags WHERE tag_id = ? AND tag_description = ? AND tag_name = ?;";
            $query = $db->prepare($sql);
            $query->execute($value);
        if (!$query->fetchColumn()) {
            $sql = "INSERT INTO tags (tag_id, tag_description, tag_name) VALUES (?,?,?);";
            $db->prepare($sql)->execute($value);
            print "<br>{$value[0]} :: tags inserted";
        }
    }
    

} catch (PDOException $e) {
    print '<br>' . $e->getMessage();
}

    print '<br><br><h3>Rocking! CarbonPHP setup and/or rebuild is complete.</h3>';

} catch (PDOException $e) {

    print 'Oh no, we failed to insert our databases!! Goto CarbonPHP.com for support and show the following code!<b>' . PHP_EOL;
    print $e->getMessage() . PHP_EOL;

}