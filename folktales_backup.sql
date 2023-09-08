-- MySQL dump 10.13  Distrib 8.0.32, for Linux (x86_64)
--
-- Host: localhost    Database: folktales
-- ------------------------------------------------------
-- Server version	8.0.32

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (3,'admin2@rgu','admin','admin@rgu','2023-04-04 05:44:53','2023-04-04 05:44:53'),(4,'admin@rgu','admin','admin@rgu','2023-04-04 05:46:40','2023-04-04 05:46:40');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `continents`
--

DROP TABLE IF EXISTS `continents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `continents` (
  `continent_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`continent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `continents`
--

LOCK TABLES `continents` WRITE;
/*!40000 ALTER TABLE `continents` DISABLE KEYS */;
INSERT INTO `continents` VALUES (1,'Africa','Known as the cradle of civilization, Africa is a continent steeped in ancient myths and legends. From the powerful deities of Egyptian mythology to the shape-shifting spirits of West African folklore, Africa\'s tales are as diverse as its people.',NULL),(2,'Antarctica','A land of ice and mystery, Antarctica is a continent like no other. With its starkly beautiful landscapes and harsh climate, it is a place where only the most intrepid explorers dare to venture. But beneath the surface of this frozen world, there are secrets waiting to be uncovered - stories of lost civilizations, hidden treasures, and ancient legends that have yet to be fully discovered.',NULL),(3,'Australia','A land of natural wonders and ancient tales, Australia is a continent of diverse landscapes and vibrant cultures. From the dreamtime stories of the indigenous peoples to the modern tales of adventure and discovery, Australia is a place where myths and legends come to life.',NULL),(4,'Asia','From the majestic mountains of the Himalayas to the bustling cities of Tokyo and Mumbai, Asia is a continent of contrasts. It is also home to some of the world\'s most enduring myths and legends, such as the ancient Chinese tale of the Monkey King and the Hindu epic, the Ramayana.',NULL),(5,'Europe','The birthplace of Western civilization, Europe has a rich history of myth and legend. From the heroic exploits of Greek gods and heroes to the mystical legends of Arthurian England, Europe\'s myths and legends have inspired artists and storytellers for centuries.',NULL),(6,'North America','From the thundering waterfalls of Niagara to the barren deserts of the Southwest, North America is a land of diverse landscapes and cultures. It is also home to a rich tradition of myths and legends, from the shape-shifting tricksters of Native American folklore to the chilling ghost stories of colonial New England.',NULL),(7,'South America','From the ancient ruins of Machu Picchu to the vibrant streets of Rio de Janeiro, South America is a continent of incredible diversity and beauty. Its myths and legends reflect this diversity, ranging from the shape-shifting spirits of the Amazon rainforest to the epic tales of the Inca Empire.',NULL);
/*!40000 ALTER TABLE `continents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `homepage_stories`
--

DROP TABLE IF EXISTS `homepage_stories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `homepage_stories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `story_id` int NOT NULL,
  `position` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_homepage_stories` (`position`),
  KEY `fk_homepage_stories_id` (`story_id`) USING BTREE,
  CONSTRAINT `fk_homepage_stories_story_id` FOREIGN KEY (`story_id`) REFERENCES `stories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `homepage_stories`
--

LOCK TABLES `homepage_stories` WRITE;
/*!40000 ALTER TABLE `homepage_stories` DISABLE KEYS */;
INSERT INTO `homepage_stories` VALUES (4,47,1),(6,29,2),(7,42,3),(8,38,4),(9,40,5),(10,39,6);
/*!40000 ALTER TABLE `homepage_stories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `legend_region`
--

DROP TABLE IF EXISTS `legend_region`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `legend_region` (
  `legend_id` int NOT NULL,
  `region_id` int NOT NULL,
  PRIMARY KEY (`legend_id`,`region_id`),
  KEY `region_id` (`region_id`),
  CONSTRAINT `legend_region_ibfk_1` FOREIGN KEY (`legend_id`) REFERENCES `legends` (`legend_id`) ON DELETE CASCADE,
  CONSTRAINT `legend_region_ibfk_2` FOREIGN KEY (`region_id`) REFERENCES `regions` (`region_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `legend_region`
--

LOCK TABLES `legend_region` WRITE;
/*!40000 ALTER TABLE `legend_region` DISABLE KEYS */;
/*!40000 ALTER TABLE `legend_region` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `legends`
--

DROP TABLE IF EXISTS `legends`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `legends` (
  `legend_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  `image_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`legend_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `legends`
--

LOCK TABLES `legends` WRITE;
/*!40000 ALTER TABLE `legends` DISABLE KEYS */;
INSERT INTO `legends` VALUES (1,'Greek Myths','Explore the world of Greek gods, heroes, and monsters through these captivating tales from ancient mythology.','images/FtpbCS22/Zeus.jpg'),(2,'Norse Legends','Discover the stories of the mighty gods, fierce warriors, and fantastical creatures of Norse mythology.','images/t4nqJJHj/thor.jpeg'),(3,'African Folktales','Journey through the rich cultural heritage of Africa with these vibrant tales passed down from generation to generation.','images/lasRc8W5/yoruba3.jpg'),(4,'Asian Ghost Stories','Experience the spine-chilling thrill of Asian ghost stories, filled with vengeful spirits, haunted places, and ancient curses.','images/WnNi54Qx/asian.png'),(5,'South American Myths','Delve into the mystical world of South American mythology, featuring powerful deities, legendary heroes, and magical creatures.','images/OAZz5tfF/inca.jpg'),(6,'Roman Mythology','Discover the captivating tales of Roman mythology, filled with powerful gods and goddesses, epic battles, and thrilling adventures that will transport you to ancient times.','images/eu5sMZUl/rome.jpg');
/*!40000 ALTER TABLE `legends` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `regions`
--

DROP TABLE IF EXISTS `regions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `regions` (
  `region_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `continent_id` int NOT NULL,
  PRIMARY KEY (`region_id`),
  KEY `fk_regions_continents` (`continent_id`),
  CONSTRAINT `fk_regions_continents` FOREIGN KEY (`continent_id`) REFERENCES `continents` (`continent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `regions`
--

LOCK TABLES `regions` WRITE;
/*!40000 ALTER TABLE `regions` DISABLE KEYS */;
/*!40000 ALTER TABLE `regions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stories`
--

DROP TABLE IF EXISTS `stories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `stories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `content` text NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `continent_id` int NOT NULL,
  `legend_id` int DEFAULT NULL,
  `author_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `views` int DEFAULT '0',
  `rating` decimal(10,1) DEFAULT '2.5',
  PRIMARY KEY (`id`),
  KEY `fk_legend` (`legend_id`),
  KEY `fk_author` (`author_id`),
  KEY `fk_continent` (`continent_id`),
  CONSTRAINT `fk_author` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT,
  CONSTRAINT `fk_continent` FOREIGN KEY (`continent_id`) REFERENCES `continents` (`continent_id`) ON DELETE RESTRICT,
  CONSTRAINT `fk_legend` FOREIGN KEY (`legend_id`) REFERENCES `legends` (`legend_id`) ON DELETE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stories`
--

LOCK TABLES `stories` WRITE;
/*!40000 ALTER TABLE `stories` DISABLE KEYS */;
INSERT INTO `stories` VALUES (9,'love secrets of a stranger ','story of a riffy gentle man','now it comes to this beautiful place of sorrows\r\n\r\nLove &amp; Secret[1] (Korean: RR: Dalkomhan bimil; lit. Sweet Secret) is a 2014 South Korean daily drama starring Shin So-yul and Kim Heung-soo.[2][3] It aired on KBS2 from November 11, 2014 to April 3, 2015 on Mondays to Fridays at 19:50 for 102 episodes.[4][5]\r\n\r\nPlot\r\nHan Ah-reum, the daughter of the Korean Vice-Minister for Culture, returns home with a child born out of wedlock, a fact that will shame her family and ruin the chances of her father becoming the Minister for Culture. Chun Sung-woon, heir of the Winner fashion and clothing company, is being backed into an arranged marriage that he does not want. When the paths of the two cross and re-cross, initial hostility turns into love. However, the secret of Ah-reum\'s illegitimate daughter may become a barrier to true love.','images/svm2m0xE/love.jpeg',3,1,1,'2023-03-17 16:58:56','2023-03-30 07:33:36',53,2.0),(14,'Hero of the sun','this is super amazing','live of the party',NULL,4,5,4,'2023-03-18 02:29:41','2023-03-29 07:06:04',2,2.5),(15,'fire brand of a songstress','it made a little lilly cry','somehow we get to the best part of the song?\r\n\r\nWomen in music include women as composers, songwriters, instrumental performers, singers, conductors, music scholars, music educators, music critics/music journalists, and in other musical professions. Also, it describes music movements (e.g., women\'s music, which is music written and performed by women for women), events and genres related to women, women\'s issues, and feminism.\r\n\r\nIn the 2010s, while women constitute a significant proportion of popular music and classical music singers, and a significant proportion of songwriters (many of them being singer-songwriters), there are few women record producers, rock critics and rock instrumentalists. Women artists in pop music, such as Björk, Lady Gaga and Madonna, have commented about sexism in the music industry.[2][3][4] Additionally, a recent study led by Dr. Smith announced that &quot;...over the last six years, the representation of women in the music industry has been even lower&quot;.[5][6] In classical music, although there have been a huge number of women composers from the Medieval period to the present day, women composers are significantly underrepresented in the commonly performed classical music repertoire, music history textbooks and music encyclopedias; for example, in the Concise Oxford History of Music, Clara Schumann is one of the only female composers who is mentioned.\r\n\r\n\r\nNavneet Aditya Waiba is an Indian Nepali-language folk singer and the only artist in the Nepali folk music genre who sings and produces authentic traditional Nepali folk songs without adulteration or modernisation using mostly organic and traditional Nepali music instruments.\r\nWomen constitute a significant proportion of instrumental soloists in classical music and the percentage of women in orchestras is increasing. A 2015 article on concerto soloists in major Canadian orchestras, however, indicated that 84% of the soloists with the Orchestre Symphonique de Montreal were men. In 2012, women still made up just 6% of the top-ranked Vienna Philharmonic orchestra. Women are less common as instrumental players in popular music genres such as rock and heavy metal, although there have been various female instrumentalists and all-female bands. Women are particularly underrepresented in extreme metal genres.[7] Women are also underrepresented in orchestral conducting, music criticism/music journalism, music producing, and sound engineering. While women were discouraged from composing in the 19th century, and there are few women musicologists, women became involved in music education &quot;to such a degree that women dominated [this field] during the later half of the 19th century and well into the 20th century.&quot;[8]','images/iEQEV0Xi/firebrand.jpeg',6,2,1,'2023-03-18 23:51:46','2023-04-04 06:22:48',4,4.0),(17,'King Agemba','Okon and the red hair!','he travels along the red bank and is a made man and a very brave man!!!',NULL,1,3,1,'2023-03-19 00:14:02','2023-03-29 22:08:56',2,2.5),(29,'crazy things are happening','This is the closest we have been','and it is all taken away from us...','images/97IEkxI4/disco.jpeg',5,2,6,'2023-03-20 20:24:29','2023-04-04 14:29:47',4,5.0),(34,'be a light','out of the shadow!!!','AGDISTIS A Hermaphroditic God born when Zeus accidentally impregnated Gaia the Earth. Fearful of this strange creature the gods castrated it, and it became the goddess Kybele. [Agdistis and Kybele and their parents were Phrygian gods later identified with Greek counterparts].\r\n\r\nAIGIPAN (Aegipan) A rustic god, son of Zeus and Aix or Boetis \'(the wife of Pan)\'.\r\n\r\nALATHEIA The goddess of truth was a daughter of Zeus.\r\n\r\nAPHRODITE The goddess of love was, according to some, a daughter of Zeus and the Titaness Dione (most accounts, however, say she was born in the sea from the severed genitals of Ouranos).\r\n\r\nAPOLLON (Apollo) The god of music, Prophecy and Healing was a son of Zeus and the Titaness Leto.\r\n\r\nARES The god of war was a son of Zeus and his wife Hera.\r\n\r\nARTEMIS The goddess of hunting and Protectress of Young Girls was a daughter of Zeus and the Titaness Leto.\r\n\r\nASOPOS (Asopus) The god of the river Asopos in Argos (Southern Greece) was, according to some, the son of Zeus and Eurynome (most accounts, however, call him a son of Okeanos and Tethys).\r\n\r\nATE The goddess of blind folly and ruin was, according to some, a daughter of Zeus (others say she was born fatherless to Eris).\r\n\r\nATHENE (Athena) The goddess of warcraft, wisdom and craft was sprung directly from the head of Zeus. Her mother was the Titaness Metis whom Zeus had swallowed whole in pregnancy.\r\n\r\nBRITOMARTIS The goddess of hunting and fishing nets was a daughter of Zeus and the Nymphe Karme.\r\n\r\nDIKE The goddess of justice, one of the three Horai, was a daughter of Zeus and the Titaness Themis.\r\n\r\nDIONYSOS (Dionysus) The god of wine and debauchery was a son of Zeus and Semele (or in a few unorthodox accounts, of Zeus and Demeter or Dione).\r\n\r\nEILEITHYIA The goddess of childbirth was a daughter of Zeus and Hera.\r\n\r\nEIRENE (Irene) The goddess of peace, one of the three Horai, was a daughter of Zeus and the Titaness Themis.','images/Kzm6e6eE/Zeus.jpg',1,2,1,'2023-03-22 09:32:44','2023-04-04 14:29:53',18,3.5),(35,'this is the end','story of Akin!','ABBA (/ˈæbə/ AB-ə, Swedish: [ˈâbːa], formerly named Björn &amp; Benny, Agnetha &amp; Anni-Frid or Björn &amp; Benny, Agnetha &amp; Frida) are a Swedish supergroup formed in Stockholm in 1972 by Agnetha Fältskog, Björn Ulvaeus, Benny Andersson, and Anni-Frid Lyngstad. The group\'s name is an acronym of the first letters of their first names arranged as a palindrome. One of the most popular and successful musical groups of all time,[2] they became one of the best-selling music acts in the history of popular music, topping the charts worldwide from 1974 to 1982, and in 2022.\r\n\r\nIn 1974, ABBA were Sweden\'s first winner of the Eurovision Song Contest with the song &quot;Waterloo,&quot; which in 2005 was chosen as the best song in the competition\'s history as part of the 50th anniversary celebration of the contest.[3] During the band\'s main active years, it consisted of two married couples: Fältskog and Ulvaeus, and Lyngstad and Andersson. With the increase of their popularity, their personal lives suffered, which eventually resulted in the collapse of both marriages. The relationship changes were reflected in the group\'s music, with later compositions featuring darker and more introspective lyrics.[4] After ABBA separated in December 1982, Andersson and Ulvaeus continued their success writing music for multiple audiences including stage, musicals and movies,[5][6] while Fältskog and Lyngstad pursued solo careers.[7][8]\r\n\r\nTen years after the group broke up, a compilation, ABBA Gold, was released, becoming a worldwide best-seller. In 1999, ABBA\'s music was adapted into Mamma Mia!, a stage musical that toured worldwide and, as of April 2022, is still in the top-ten longest running productions on both Broadway (closed in 2015) and the West End (still running). A film of the same name, released in 2008, became the highest-grossing film in the United Kingdom that year. A sequel, Ma','images/Tnm3ceGF/new.jpg',1,2,1,'2023-03-22 09:36:16','2023-03-25 17:29:09',0,2.5),(36,'The Epic of Gilgamesh','Follow the adventures of the legendary king Gilgamesh as he embarks on a journey to discover the secrets of immortality.','The Epic of Gilgamesh (/ˈɡɪlɡəmɛʃ/)[2] is an epic poem from ancient Mesopotamia. The literary history of Gilgamesh begins with five Sumerian poems about Bilgamesh (Sumerian for &quot;Gilgamesh&quot;), king of Uruk, dating from the Third Dynasty of Ur (c. 2100 BC).[1] These independent stories were later used as source material for a combined epic in Akkadian. The first surviving version of this combined epic, known as the &quot;Old Babylonian&quot; version, dates back to the 18th century BC and is titled after its incipit, Shūtur eli sharrī (&quot;Surpassing All Other Kings&quot;). Only a few tablets of it have survived. The later Standard Babylonian version compiled by Sîn-lēqi-unninni dates from the 13th to the 10th centuries BC and bears the incipit Sha naqba īmuru[note 1] (&quot;He who Saw the Abyss&quot;, in unmetaphoric terms: &quot;He who Sees the Unknown&quot;). Approximately two-thirds of this longer, twelve-tablet version have been recovered. Some of the best copies were discovered in the library ruins of the 7th-century BC Assyrian king Ashurbanipal.\r\n\r\nThe first half of the story discusses Gilgamesh, king of Uruk, and Enkidu, a wild man created by the gods to stop Gilgamesh from oppressing the people of Uruk. After Enkidu becomes civilized through sexual initiation with Shamhat, he travels to Uruk, where he challenges Gilgamesh to a test of strength. Gilgamesh wins the contest; nonetheless, the two become friends. Together, they make a six-day journey to the legendary Cedar Forest, where they plan to slay the Guardian, Humbaba the Terrible, and cut down the sacred Cedar.[4] The goddess Ishtar sends the Bull of Heaven to punish Gilgamesh for spurning her advances. Gilgamesh and Enkidu kill the Bull of Heaven after which the gods decide to sentence Enkidu to death and kill him.\r\n\r\nIn the second half of the epic, distress over Enkidu\'s death causes Gilgamesh to undertake a long and perilous journey to discover the secret of eternal life. He eventually learns that &quot;Life, which you look for, you will never find. For when the gods created man, they let death be his share, and life withheld in their own hands&quot;.[5][6] Nevertheless, because of his great building projects, his account of Siduri\'s advice, and what the immortal man Utnapishtim told him about the Great Flood, Gilgamesh\'s fame survived well after his death, with expanding interest in his story. It has been translated into many languages and is featured in several works of popular fiction.\r\n\r\nThe epic is regarded as a foundational work in religion and the tradition of heroic sagas, with Gilgamesh forming the prototype for later heroes like Heracles (Hercules), and the epic itself serving as an influence for Homeric epics','images/IJYGMMSb/epic-gilgamesh.jpg',4,4,7,'2023-03-26 16:00:08','2023-03-29 14:40:57',7,2.5),(37,'Odysseus,  a legendary man','Join the hero Odysseus as he battles monsters, outwits gods, and struggles to find his way home after the Trojan War.','According to Homer, Laertes and Anticleia were the parents of Odysseus. He was married to Penelope and they gave birth to a son, Telemachus. Odysseus was often called &quot;Odysseus the Cunning&quot; because of his clever and quick mind. Autolycus, his grandfather, was a famous skilled thief in the Peloponnese. The Romans transformed the name Odysseus to Ulysses and that is how he is mostly known today all over the world.\r\n\r\nOdysseus had a proud and arrogant character. He was the master of disguise in both appearance and voice. He also excelled as a military commander and ruler, as is evident from the role he played in ensuring to the Greeks the victory over Troy, giving thus an end to the long Trojan War.\r\nThe fall of Troy\r\n\r\nAll began the day Paris of Troy abducted Helen, wife of Menelaus, king of Sparta. Enraged, Menelaus called upon all kings of Greece, including Odysseus, as all had once vowed to defend the honour of Helen, if someone ever tried to insult her. Odysseus, however, tried to escape the promise made to Menelaus by feigning insanity. Agamemnon, the brother of Menelaus proved Odysseus to be lying and henceforth the legendary warrior set out for Troy, along with Agamemnon the lord of men, Achilles the invincible, Nestor he wise and Teucer the master archer, as they were called.\r\n\r\nTen years had passed since the Greeks attacked Troy and they were all still there, outside the strong walls, fighting with the locals, who proved themeselves brave warriors. In the tenth year of the war, Odysseus the Cunning, the most trusted advisor and counsellor of king Agamemnon, the leader of the Greeks, devised a plan to deceive the Trojans. He wanted to make them believe that the Greeks had lost their nerves and had returned back to Greece.\r\n\r\nIn the middle of the night, the Greeks deserted Troy leaving only a gigantic wooden horse on wheels outside the gates of the city. When dawn broke, the Trojans were surprised to see no Greek army surrounding them, only a wooden horse. They indeed believed that the Greeks had gone and had left this horse as a gift to the gods, to give them a good sea trip. Thus they wheeled the wooden horse into their city and started revelry to celebrate the end of the war.\r\n\r\nHowever, unknown to the Trojans, Odysseus had built a hollow into the wooden horse to hide there a few Greek warriors. This plan was the only way to gain entry to the city that had held its defences for so many years. Now that they were inside Odysseus and his men went out the dummy horse and slaughtered the unsuspecting guards. Then they opened the city gates and allowed the entire Greek army, who were hiding some miles away, to enter the city. Thus, thanks to the plan of Odysseus, the Greeks won the Trojan War. With the war over, Odysseus and his men set sail for their homeland, Ithaca, but in the end only one of them would come back.\r\nThe long journey home\r\n\r\nThe journey home for Odysseus and his fellows would be long and full of adventures. Their eyes would see all the strange of the world and Odysseus would come home with more memories and experiences than any other person in the world.\r\nThe Cicones\r\n\r\nOdysseus and his legion set sail from Troy aboard twelve ships. Tranquil waters facilitated the movement of the ships and they were well out to sea. After a few days, they sighted land and Eurylochus, second-in-command to Odysseus, convinced him to weigh anchor, go ashore and devastate the city with the assurance that they would not be harmed.\r\n\r\nSeeing the ships weigh anchor and thenceforth the warriors coming ashore, the Ciconians, the local residents, fled to the nearby mountains. Odysseus and his men plundered and looted the empty city. However, the men of Odysseus resisted his efforts to get them back aboard the ship immediately and after a hearty meal accompanied by wine that flew like water, they fell asleep on the shore.\r\n\r\nBefore the first light, the Ciconians returned with their fierce neighbors and set upon the warriors, killing as many as they could. Odysseus and his men beat a hasty retreat to their ships but heavy damages had already been inflicted on their number. Berating himself for having listened to Eurylochus and thereafter losing so many valuable men, Odysseus and Eurylochus fought with each other but they were separated by their fellow-men and peace was once again established amidst the warriors.\r\n','images/Ti3JjBOQ/Odyssey.jpg',5,1,7,'2023-03-26 16:06:46','2023-03-30 07:36:21',4,0.5),(38,'Charlemagne','Charlemagne (known also as Charles the Great, as well as Charles I) was a King of the Franks, the first ruler of the Holy Roman Empire (though the term \'Holy Roman Empire\' would only be coined after Charlemagne\'s death), and one of the most important figures in the history of early Medieval Europe.','Charlemagne (/ˈʃɑːrləmeɪn, ˌʃɑːrləˈmeɪn/ SHAR-lə-mayn, -⁠MAYN, French: [ʃaʁləmaɲ]) or Charles the Great (Latin: Carolus Magnus; Frankish: Karl;[3] 2 April 747[a] – 28 January 814), a member of the Carolingian dynasty, was King of the Franks from 768, King of the Lombards from 774, and the Emperor of the Romans from 800. Charlemagne succeeded in uniting the majority of western and central Europe and was the first recognized emperor to rule from western Europe after the fall of the Western Roman Empire around three centuries earlier.[4] The expanded Frankish state that Charlemagne founded was the Carolingian Empire, which is considered the first phase in the history of the Holy Roman Empire. He was canonized by Antipope Paschal III—an act later treated as invalid—and he is now regarded by some as beatified (which is a step on the path to sainthood) in the Catholic Church.\r\n\r\nCharlemagne was the eldest son of Pepin the Short and Bertrada of Laon. He was born before their canonical marriage.[5] He became king of the Franks in 768 following his father\'s death, and was initially co-ruler with his brother Carloman I until the latter\'s death in 771.[6] As sole ruler, he continued his father\'s policy towards protection of the papacy and became its sole defender, removing the Lombards from power in northern Italy and leading an incursion into Muslim Spain. He also campaigned against the Saxons to his east, Christianizing them (upon penalty of death) which led to events such as the Massacre of Verden. He reached the height of his power in 800 when he was crowned Emperor of the Romans by Pope Leo III on Christmas Day at Old St. Peter\'s Basilica in Rome.\r\n\r\nCharlemagne has been called the &quot;Father of Europe&quot; (Pater Europae),[7] as he united most of Western Europe for the first time since the classical era of the Roman Empire, as well as uniting parts of Europe that had never been under Frankish or Roman rule. His reign spurred the Carolingian Renaissance, a period of energetic cultural and intellectual activity within the Western Church. The Eastern Orthodox Church viewed Charlemagne less favourably, due to his support of the filioque and the Pope\'s preference of him as emperor over the Byzantine Empire\'s first female monarch, Irene of Athens. These and other disputes led to the eventual split of Rome and Constantinople in the Great Schism of 1054.[8][b]\r\n\r\nCharlemagne died in 814 after contracting an infectious lung disease.[9] He was laid to rest in the Aachen Cathedral, in his imperial capital city of Aachen. He married at least four times,[10][2] and three of his legitimate sons lived to adulthood. Only the youngest of them, Louis the Pious, survived to succeed him. Charlemagne is a direct ancestor of many of Europe\'s royal houses, including the Capetian dynasty,[c] the Ottonian dynasty,[d] the House of Luxembourg,[e] the House of Ivrea[f] and the House of Habsburg.[g] ','images/cPfb68ZY/Charlemagne.jpg',5,6,7,'2023-03-26 16:11:16','2023-03-26 16:11:16',0,2.5),(39,'The Nibelungenlied','Enter the world of Germanic mythology and adventure with the story of the Nibelungenlied, a medieval epic that tells the tale of the dragon-slaying hero Siegfried and his doomed love for the beautiful Kriemhild. Filled with knights, dragons, and treachery, this story is a classic of the genre.','The Nibelungenlied (Middle High German: Der Nibelunge liet or Der Nibelunge nôt), translated as The Song of the Nibelungs, is an epic poem written around 1200 in Middle High German. Its anonymous poet was likely from the region of Passau. The Nibelungenlied is based on an oral tradition of Germanic heroic legend that has some of its origin in historic events and individuals of the 5th and 6th centuries and that spread throughout almost all of Germanic-speaking Europe. Scandinavian parallels to the German poem are found especially in the heroic lays of the Poetic Edda and in the Völsunga saga.\r\n\r\nThe poem is split into two parts. In the first part, the prince Siegfried comes to Worms to acquire the hand of the Burgundian princess Kriemhild from her brother King Gunther. Gunther agrees to let Siegfried marry Kriemhild if Siegfried helps Gunther acquire the warrior-queen Brünhild as his wife. Siegfried does this and marries Kriemhild; however, Brünhild and Kriemhild become rivals, leading eventually to Siegfried\'s murder by the Burgundian vassal Hagen with Gunther\'s involvement. In the second part, the widow Kriemhild is married to Etzel, king of the Huns. She later invites her brother and his court to visit Etzel\'s kingdom intending to kill Hagen. Her revenge results in the death of all the Burgundians who came to Etzel\'s court as well as the destruction of Etzel\'s kingdom and the death of Kriemhild herself.\r\n\r\nThe Nibelungenlied was the first heroic epic put into writing in Germany, helping to found a larger genre of written heroic poetry there. The poem\'s tragedy appears to have bothered its medieval audience, and very early on a sequel was written, the Nibelungenklage, which made the tragedy less final. The poem was forgotten after around 1500 but was rediscovered in 1755. Dubbed the &quot;German Iliad&quot;, the Nibelungenlied began a new life as the German national epic. The poem was appropriated for nationalist purposes and was heavily used in anti-democratic, reactionary, and Nazi propaganda before and during the Second World War. Its legacy today is most visible in Richard Wagner\'s operatic cycle Der Ring des Nibelungen, which, however, is mostly based on Old Norse sources. In 2009, the three main manuscripts of the Nibelungenlied[1] were inscribed in UNESCO\'s Memory of the World Register in recognition of their historical significance.[2] It has been called &quot;one of the most impressive, and certainly the most powerful, of the German epics of the Middle Ages&quot;.[3] ','images/uMg7Nc4A/Nibelungs.jpg',5,2,7,'2023-03-26 16:13:32','2023-03-29 14:40:32',7,4.3),(40,'Ivan Tsarevich, the Firebird, and the Grey Wolf','A king\'s apple tree bore golden apples, but every night, one was stolen. Guards reported that the Firebird stole them. The king told his two oldest sons that the one who caught the bird would receive half his kingdom and be his heir...','A king\'s apple tree bore golden apples, but every night, one was stolen. Guards reported that the Firebird stole them. The king told his two oldest sons that the one who caught the bird would receive half his kingdom and be his heir. They drew lots to see who would be first, but both fell asleep; they tried to claim it had not come, but it had stolen an apple. Finally Ivan Tsarevich, the youngest son, asked to try; his father was reluctant because of his youth but consented. Ivan remained awake the entire time, and upon seeing the bird, tried to catch it by the tail. Unfortunately, Ivan only managed to grasp one feather. The Firebird did not return, but the king longed for the bird. He said that still, whoever caught it would have half his kingdom and be his heir. \r\n\r\nThe older brothers set out. They came to a stone that said whoever took one road would know hunger and cold; whoever took the second would live, though his horse would die; and whoever took the third would die, though his horse would live. They did not know which way to take, and so took up an idle life. \r\n\r\nIvan begged to be allowed to go until his father yielded. He took the second road, and a wolf ate his horse. He walked until he was exhausted, and the wolf offered to carry him. It brought him to the garden where the firebird was and told him to take it out without touching its golden cage. The prince went in, but thought it was a great pity not to take the cage, but when he touched it, bells rang, waking everyone, and he was captured. He told his story, and the First King said he could have had it for the asking, but he could be spared now only if he could present the king with the Horse with the Golden Mane.\r\n\r\nHe met the wolf and admitted to his disobedience. It carried him to the kingdom and stables where he could get the horse and warned him against the golden bridle. Its beauty tempted him, and he touched it, and instruments of brass sounded. He was captured, and the Second King told him that if he had come with the word, he would have given him the horse, but now he would be spared only if he brought him Helen the Beautiful to be his wife.\r\n\r\nIvan went back to the wolf, confessed, and was brought to her castle. The wolf carried her off, but Ivan was able to assuage her fears. Ivan brought her back to the Second King, but wept because they had come to love each other. The wolf turned itself into the form of the princess and had Ivan exchange it for the Horse with the Golden Mane. Ivan and Helen rode off on the Horse. The wolf escaped the king. It reached Ivan and Helen, and Helen rode the horse and Ivan the wolf. Ivan asked the wolf to become like the horse and let him exchange it for the Firebird, so that he could keep the horse as well. The wolf agreed, the exchange was done, and Ivan returned to his own kingdom with Helen, the horse, and the Firebird.\r\n\r\nThe wolf said its service was done when they returned to where it had eaten Ivan\'s horse. Ivan dismounted and lamented their parting. They went on for a time and slept. His older brothers found them, killed Ivan, sliced his body to pieces, and told Helen that they would kill her if she would not say that they had fairly won the horse, the firebird, and her. They brought them to their father, and the second son received half the kingdom, and the oldest was to marry Helen.\r\n\r\nThe Grey Wolf found Ivan\'s body and caught two fledgling crows that would have eaten it. Their mother pleaded for them, and the wolf sent her to fetch the water of death, which restored the body, and the water of life, which revived him. The wolf carried him to the wedding in time to stop it; the older brothers were made servants or killed by the wolf, but Ivan married Helen and lived happily with her. ','images/N7F85mjA/Ivan.jpg',7,5,7,'2023-03-26 16:19:00','2023-04-04 14:25:15',22,3.8),(42,'Baba Yaga','Discover the strange and magical world of Slavic folklore with the story of Baba Yaga, the infamous witch who lives in a house that walks on chicken legs. Follow the brave and resourceful Vasilisa as she journeys to Baba Yaga\'s hut to seek her help, but beware: Baba Yaga is known for her unpredictable and dangerous ways.','In Slavic folklore, Baba Yaga, also spelled Baba Jaga (from Polish), is a supernatural being (or one of a trio of sisters of the same name) who appears as a deformed and/or ferocious-looking woman. In fairy tales Baba Yaga flies around in a mortar, wields a pestle, and dwells deep in the forest in a hut usually described as standing on chicken legs. Baba Yaga may help or hinder those who encounter or seek her out and may play a maternal role. She also has associations with forest wildlife. According to Vladimir Propp\'s folktale morphology, Baba Yaga commonly appears as either a donor or a villain, or may be altogether ambiguous.\r\n\r\nDr. Andreas Johns identifies Baba Yaga as &quot;one of the most memorable and distinctive figures in eastern European folklore&quot;, and observes that she is &quot;enigmatic&quot; and often exhibits &quot;striking ambiguity&quot;.[1] Johns summarizes Baba Yaga as &quot;a many-faceted figure, capable of inspiring researchers to see her as a Cloud, Moon, Death, Winter, Snake, Bird, Pelican or Earth Goddess, totemic matriarchal ancestress, female initiator, phallic mother, or archetypal image&quot;.[2] ','images/7jYVmXQH/baba_yaga.jpg',5,2,7,'2023-03-26 16:24:04','2023-03-27 17:37:58',11,2.5),(43,'Fire Drifters of','they came from a great place of travail and love into the paradise','The Drifters are an American doo-wop and R&amp;B/soul vocal group. They were originally formed as a backing group for Clyde McPhatter, formerly the lead tenor of Billy Ward and his Dominoes in 1953. The second group of Drifters, formed in 1959 and led by Ben E. King, were originally an up-and-coming group named The Five Crowns. After 1965 members drifted in and out of both groups and many of these formed other groups of Drifters as well. Several groups of Drifters can trace roots back to these original groups, but contain few—if any—original members.\r\n\r\nAccording to Rolling Stone, the Drifters were the least stable of the great vocal groups, as they were low-paid musicians[3] hired by George Treadwell, who owned the Drifters\' name from 1955, after McPhatter left. The Treadwell Drifters line has had 60 musicians,[4] including several splinter groups by former Drifters members (not under Treadwell\'s management). These groups are usually identified with a possessive credit such as &quot;Bill Pinkney\'s Original Drifters&quot;, &quot;Charlie Thomas\' Drifters&quot;.\r\n\r\nThe three golden eras of the Drifters were the early 1950s, the 1960s, and the early 1970s (post-Atlantic period). From these, the first Drifters, formed by Clyde McPhatter, were inducted into the Vocal Group Hall of Fame as &quot;The Drifters&quot;.[5] The second Drifters, featuring Ben E. King, were separately inducted into the Vocal Group Hall of Fame as &quot;Ben E. King and the Drifters&quot;.[6] In their induction, the Rock and Roll Hall of Fame selected four members from the first Drifters, two from the second Drifters, and one from the post-Atlantic Drifters.[7] There were other lead singers too, but the group was less successful during those times.[8] ','images/VBPM79PM/hero-image2.jpg',7,5,7,'2023-03-26 18:49:31','2023-03-29 22:35:05',1,2.5),(47,'The chief of Isululand','aaaaaa','fffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffkj;k\r\n;lk;jlkjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjffffffffffffffffffffffffffffffjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjj\r\nfffffffffffffffff\r\nffffffffffffff\r\nffffffffffffffffff','images/t9r1RDzN/globe.jpg',1,3,6,'2023-03-29 21:54:54','2023-03-29 21:54:54',0,2.5);
/*!40000 ALTER TABLE `stories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `story_ratings`
--

DROP TABLE IF EXISTS `story_ratings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `story_ratings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `story_id` int NOT NULL,
  `user_id` int NOT NULL,
  `rating` decimal(10,1) NOT NULL,
  `comment` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_user_story` (`user_id`,`story_id`),
  KEY `fk_story` (`story_id`),
  CONSTRAINT `fk_story` FOREIGN KEY (`story_id`) REFERENCES `stories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `story_ratings`
--

LOCK TABLES `story_ratings` WRITE;
/*!40000 ALTER TABLE `story_ratings` DISABLE KEYS */;
INSERT INTO `story_ratings` VALUES (10,43,7,4.5,'','2023-03-28 05:22:55','2023-03-28 05:22:55'),(13,37,7,0.5,'','2023-03-28 05:55:37','2023-03-28 05:55:37'),(14,34,7,2.0,'','2023-03-28 06:07:39','2023-03-28 06:07:39'),(15,36,7,2.5,'','2023-03-28 09:50:09','2023-03-28 09:50:09'),(19,40,10,2.5,'','2023-03-28 20:56:33','2023-03-28 20:56:33'),(20,39,10,3.5,'','2023-03-29 06:52:52','2023-03-29 06:52:52'),(25,39,11,5.0,'','2023-03-29 14:39:55','2023-03-29 14:39:55'),(26,34,11,5.0,'','2023-03-29 15:18:21','2023-03-29 15:18:21'),(29,9,11,2.0,'','2023-03-30 07:16:13','2023-03-30 07:16:13'),(30,40,11,5.0,'','2023-03-30 07:32:27','2023-03-30 07:32:27'),(31,15,11,4.0,'','2023-04-04 06:22:45','2023-04-04 06:22:45'),(32,29,11,5.0,'','2023-04-04 14:29:43','2023-04-04 14:29:43');
/*!40000 ALTER TABLE `story_ratings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `story_tag`
--

DROP TABLE IF EXISTS `story_tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `story_tag` (
  `story_id` int NOT NULL,
  `tag_id` int NOT NULL,
  PRIMARY KEY (`story_id`,`tag_id`),
  KEY `tag_id` (`tag_id`),
  CONSTRAINT `story_tag_ibfk_1` FOREIGN KEY (`story_id`) REFERENCES `stories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `story_tag_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`tag_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `story_tag`
--

LOCK TABLES `story_tag` WRITE;
/*!40000 ALTER TABLE `story_tag` DISABLE KEYS */;
INSERT INTO `story_tag` VALUES (14,14),(15,14),(17,14),(43,14),(9,15),(14,15),(34,15),(35,15),(47,15),(14,16),(35,16),(47,16),(35,17),(47,17),(39,22),(29,30),(29,31),(34,35),(34,36),(17,37),(36,38),(37,38),(36,39),(36,40),(37,41),(37,42),(38,43),(38,44),(39,45),(39,46),(40,47),(40,48),(40,49),(42,50),(42,51),(42,52),(43,53),(9,54),(9,55),(15,56),(15,57);
/*!40000 ALTER TABLE `story_tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tags` (
  `tag_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  PRIMARY KEY (`tag_id`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags`
--

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
INSERT INTO `tags` VALUES (14,'fire',NULL),(15,'love',NULL),(16,'hate',NULL),(17,'fear',NULL),(18,'happy',NULL),(19,'jkjklt',NULL),(20,'hktl;ks',NULL),(21,'htkl;',NULL),(22,'',NULL),(23,'hot',NULL),(24,'milk',NULL),(25,'candle',NULL),(26,'night',NULL),(27,'theme',NULL),(28,'char',NULL),(29,'aloud',NULL),(30,'closest',NULL),(31,'heroes',NULL),(32,'aa',NULL),(33,'vvvv',NULL),(34,'zzzz',NULL),(35,'fine',NULL),(36,'boy',NULL),(37,'gold',NULL),(38,'battle',NULL),(39,'immortal',NULL),(40,'gods',NULL),(41,'greek',NULL),(42,'legend',NULL),(43,'roman',NULL),(44,'rome',NULL),(45,'german',NULL),(46,'dragon',NULL),(47,'apple',NULL),(48,'firebird',NULL),(49,'folktale',NULL),(50,'witch',NULL),(51,'soccery',NULL),(52,'russia',NULL),(53,'drifters',NULL),(54,'stranger',NULL),(55,'past',NULL),(56,'female',NULL),(57,'singer',NULL),(58,'thor',NULL),(59,'hatet',NULL);
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(20) NOT NULL,
  `is_writer` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `country` varchar(40) DEFAULT NULL,
  `gender` enum('Male','Female','Other') DEFAULT NULL,
  `dob` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Joseph','Emeka','emeka@gmail.com','fast',1,'2023-03-17 14:36:28','2023-03-17 14:36:28','Nigeria','Male','1987-08-25'),(4,'Tobi','Emmanuel','emma@yahoo.com','asdf',1,'2023-03-18 02:25:50','2023-03-18 02:25:50','Afghanistan','Male','2017-02-19'),(5,'OGOCHUKWU','iyi','ogo@gmail.com','obunike',1,'2023-03-19 03:55:55','2023-03-19 03:55:55','Bangladesh','Female','2023-03-17'),(6,'test','test','test@gmail.com','test',1,'2023-03-20 20:06:58','2023-03-20 20:06:58','Taiwan','Male','2022-11-23'),(7,'Jeremiah','Clinton','update@gmail.com','update',1,'2023-03-26 15:53:56','2023-03-29 07:15:48','Iran, Islamic Republic of','Male','1999-08-22'),(8,'festus','lionel','afam@gmail.com','fast',1,'2023-03-28 06:27:39','2023-03-28 06:27:39','Åland Islands','Male','1988-09-22'),(10,'Jacob','Ifeanyi','jacob@gmail.com','fast',0,'2023-03-28 16:18:10','2023-03-28 16:18:10','Algeria','Female','2004-09-13'),(11,'Ngozi','Nwoye','ngozi@gmail.com','fast',0,'2023-03-29 08:45:31','2023-03-29 08:45:31','United Kingdom','Female','2022-12-20'),(26,'Joseph','Jude','jude@gmail.com','fast',1,'2023-03-30 07:29:08','2023-03-30 07:29:08','Afghanistan','Male','1998-08-20');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-09-08 10:49:10
