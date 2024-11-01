-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 01, 2024 at 06:21 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wanderlust`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`) VALUES
(1, 'faiz', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `total_room` int(11) NOT NULL,
  `special_requests` text DEFAULT NULL,
  `booking_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) DEFAULT NULL,
  `status` enum('Pending','Accepted','Rejected') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `first_name`, `last_name`, `email`, `phone`, `check_in`, `check_out`, `total_room`, `special_requests`, `booking_date`, `user_id`, `status`) VALUES
(48, 'Ariq', 'Nakal', 'mohammadariqhaikal@gmail.com', '0123432434', '2024-10-04', '2024-10-11', 1, '', '2024-10-23 14:49:08', 33, 'Accepted'),
(49, 'AHMAD', 'AB HALIM', 'hisyam.ahmad0311@gmail.com', '01158975365', '2024-10-09', '2024-10-09', 1, '', '2024-10-28 19:22:30', 36, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `destinations`
--

CREATE TABLE `destinations` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `highlights` text NOT NULL,
  `itinerary` text NOT NULL,
  `included` text NOT NULL,
  `excluded` text NOT NULL,
  `address` varchar(1234) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `destinations`
--

INSERT INTO `destinations` (`id`, `name`, `location`, `image`, `description`, `highlights`, `itinerary`, `included`, `excluded`, `address`) VALUES
(7, 'Langkawi Island', 'Kedah', 'images/langkawi.jpg', 'Langkawi, an archipelago of 99 islands off the coast of Malaysia, is known for its stunning beaches, lush rainforests, and vibrant culture. It\'s a popular destination for both relaxation and adventure seekers alike.', 'Pristine Beaches: Explore beautiful beaches like Pantai Cenang and Tanjung Rhu.\r\nSky Bridge: Visit the Langkawi Sky Bridge for breathtaking views of the rainforest canopy.\r\nIsland Hopping: Discover neighboring islands on a boat tour, including Pulau Payar Marine Park.\r\nDuty-Free Shopping: Enjoy tax-free shopping at Kuah Town and various duty-free outlets.', 'Day 1: Relax on Pantai Cenang Beach and explore local eateries.\r\nDay 2: Take a cable car ride to Langkawi Sky Bridge and visit Oriental Village.\r\nDay 3: Go island hopping to nearby islets and enjoy snorkeling or diving activities.', 'Accommodation in selected hotels/resorts.\r\nTransportation for tours and activities as mentioned.\r\nGuided tours with local experts.', 'Meals not specified.\r\nPersonal expenses and gratuities.\r\nOptional tours and activities.', 'Langkawi, Kedah, Malaysia'),
(8, 'Genting Highland', 'Pahang', 'images/genting.jpg', 'Genting Highlands is a vibrant hill resort in Malaysia\'s Titiwangsa Mountains. Known as the \"City of Entertainment,\" it offers a refreshing escape with its cool climate, thrilling theme parks, lively casinos, and breathtaking views. Whether you\'re seeking adventure or relaxation, Genting Highlands provides a perfect blend of excitement and tranquility.', 'Genting Skyway: Ride the Genting Skyway cable car for panoramic views of the surrounding mountains and rainforest.\r\nCasino de Genting: Visit Southeast Asia\'s largest casino for gaming and entertainment.\r\n\r\n\r\nTheme Parks: Enjoy family-friendly attractions at Genting Highlands Theme Park, including outdoor and indoor rides.\r\n\r\n\r\nShopping and Dining: Explore shopping malls like SkyAvenue for retail therapy and a variety of dining options.\r\nGenting Highlands Premium Outlets: Shop for designer brands at discounted prices.', 'Day 1: Ride the Genting Skyway, visit the casino, and explore entertainment options.\r\nDay 2: Spend a day at the theme park enjoying rides and attractions.\r\nDay 3: Shop at Genting Highlands Premium Outlets and relax in the cool mountain air.', 'Diverse Experiences: Malaysia offers an incredible mix of urban excitement and natural beauty, providing something for every traveler\r\n\r\n+ Rich Culture: With a harmonious blend of cultures, Malaysia offers rich traditions and vibrant festivals year-round.\r\n\r\n', 'Weather Conditions: Be prepared for occasional rain and humidity; the tropical climate can be unpredictable.                                \r\nPeak Season Crowds: Popular destinations can become crowded during peak tourist seasons, influencing the travel experience.', 'Genting Highlands, Pahang, Malaysia'),
(9, ' Bukit Fraser (Fraser\'s Hill)', 'Pahang', 'images/bukitfraser.jpg', 'Bukit Fraser, also known as Fraser\'s Hill, is a hill station in Malaysia renowned for its cool climate, lush greenery, and colonial charm. Located in the state of Pahang, it offers a peaceful retreat from urban life amidst picturesque landscapes and rich biodiversity.', 'Nature Trails: Explore scenic walking trails amidst tropical rainforests, ideal for birdwatching and nature photography.\r\nFraser\'s Hill Clock Tower: Visit the iconic clock tower, a historical landmark dating back to the colonial era.\r\nGolfing: Enjoy a round of golf at the Fraser\'s Hill Golf Club, surrounded by panoramic mountain views.\r\nBird Watching: Spot a variety of bird species, including endemic and migratory birds, in the Fraser\'s Hill Bird Sanctuary.\r\nColonial Architecture: Admire the quaint colonial-style buildings and cottages that add to the hill station\'s charm.', 'Day 1: Arrive at Bukit Fraser and explore the town center, including the clock tower and local shops.\r\nDay 2: Engage in outdoor activities such as hiking, birdwatching, or golfing.\r\nDay 3: Relax and enjoy the cool mountain climate before departing.', 'Accommodation in Bukit Fraser\'s hotels, resorts, or guesthouses.\r\nAccess to nature trails and bird watching spots.\r\nMeals included in selected packages.', 'Personal expenses and optional activities.\r\nTransportation to and from Bukit Fraser.\r\nAdditional fees for golfing and specific guided tours.', 'Bukit Fraser, Raub District, Pahang, Malaysia'),
(10, 'Mount Kinabalu', 'Sabah', 'images/kinabalu.jpg', 'Mount Kinabalu is the highest peak in Southeast Asia, standing at 4,095 meters (13,435 feet) above sea level. Located in the Malaysian state of Sabah on the island of Borneo, it is renowned for its stunning biodiversity, rich flora and fauna, and challenging hiking trails. Mount Kinabalu is a UNESCO World Heritage Site and a popular destination for adventurers and nature enthusiasts alike.', 'Climbing: Embark on a trek to conquer the summit via various trails, such as the popular Ranau Trail and Mesilau Trail.\r\nPinnacles: Marvel at the unique granite pinnacles on Mount Kinabalu, a geological wonder.\r\nBotanical Gardens: Explore Kinabalu Park Botanical Garden, home to diverse plant species endemic to Borneo.', 'Day 1: Arrive at Kinabalu Park, acclimatize, and explore the botanical gardens.\r\nDay 2: Begin your ascent of Mount Kinabalu, overnight at Laban Rata base camp.\r\nDay 3: Summit climb to catch sunrise, descend back to Kinabalu Park.', 'Accommodation in Kinabalu Park or Laban Rata base camp.\r\nEntrance fees to Mount Kinabalu Park and attractions.\r\nGuided tours and necessary permits for climbing.', 'Meals not included in the package.\r\nPersonal expenses and optional activities.\r\nAdditional fees for climbing equipment rental and porter services.', 'Mount Kinabalu, Kinabalu Park, Ranau, Sabah, Malaysia'),
(11, 'A Famosa, Malacca (Melaka),', 'Melaka', 'images/afamosa.jpg', 'A Famosa is a historical fortress located in Malacca, Malaysia, and is one of the oldest European architectural remains in Southeast Asia. Built by the Portuguese in the early 16th century, A Famosa has witnessed the colonial history and cultural exchange of the region. Today, it stands as a UNESCO World Heritage Site and a prominent tourist attraction in Malacca.', 'Porta de Santiago: Explore the iconic gatehouse of A Famosa, known as Porta de Santiago, which remains as a symbol of the Portuguese era.\r\nSt. Paul\'s Hill: Climb St. Paul\'s Hill to visit St. Paul\'s Church, a historic church with panoramic views of Malacca City.\r\nMalacca Sultanate Palace Museum: Discover the history of the Malacca Sultanate and traditional Malay culture at the nearby museum.\r\nRiver Cruise: Enjoy a scenic river cruise along the Malacca River, passing by historical landmarks and colorful murals.', 'Day 1:\r\n\r\nExplore A Famosa and St. Paul\'s Hill.\r\nVisit Malacca Sultanate Palace Museum.\r\nEnjoy a river cruise.\r\nExperience Jonker Street Night Market.\r\nDay 2:\r\n\r\nVisit Cheng Hoon Teng Temple and Baba Nyonya Heritage Museum.\r\nOptional visit to Malacca Straits Mosque.\r\nFree time for shopping and leisure.', 'Guided tour of A Famosa and surrounding historical sites.\r\nEntrance fees to A Famosa and museums (if included in the tour package).\r\nTransportation to and from Malacca City (if applicable).', 'Meals and beverages not included in the tour package.\r\nPersonal expenses and optional activities.', 'A Famosa, Jalan Parameswara, Bandar Hilir, 75000 Malacca City, Malacca, Malaysia'),
(17, 'Cameron Highland', 'Pahang', 'images/cameron.jpg', 'Cameron Highlands is a picturesque hill station in Malaysia, known for its cool climate, lush tea plantations, and vibrant floral gardens. It\'s a popular destination for those seeking a peaceful retreat amidst nature.', 'Tea Plantations: Visit the famous Boh Tea Plantation for a tour and enjoy fresh tea with stunning views.\r\n\r\nStrawberry Farms: Pick your own strawberries at one of the many farms.\r\n\r\nMossy Forest: Explore the mystical Mossy Forest with its unique flora and fauna.\r\n\r\nFlower Gardens: Discover the colorful blooms at the Cameron Lavender Garden and other floral attractions.', 'Day 1: Arrive and explore the tea plantations. Visit the tea factory and enjoy a cup of tea at the café.\r\nDay 2: Spend the day at the strawberry farms and flower gardens. Enjoy a leisurely walk in the Mossy Forest.\r\nDay 3: Visit the local markets for fresh produce and souvenirs. Relax and enjoy the cool mountain air.', 'Scenic Beauty: Stunning landscapes and cool climate make it a perfect getaway.\r\nCultural Experiences: Engage with local culture and traditions.\r\nOutdoor Activities: Plenty of hiking trails and nature walks.', 'Crowded During Peak Seasons: Can be busy during holidays and weekends.\r\nLimited Nightlife: Focused more on nature and relaxation.\r\nChallenging Roads: Winding roads can be difficult to navigate.', 'Cameron Highland, Pahang'),
(19, 'Taman Negara', 'Pahang', 'images/tamanNegara.png', 'Taman Negara is Malaysia\'s premier national park, renowned for its stunning biodiversity and ancient rainforest, dating back over 130 million years. It offers an array of activities such as jungle trekking, canopy walks, river cruises, and wildlife observation. Visitors can explore the rich flora and fauna, including rare species like the Malayan tiger and Asian elephant, making it a must-visit destination for nature enthusiasts and adventure seekers.', 'Test', 'Enjoy the flora and Fauna', 'Diverse Experiences Malaysia offer', 'Meal not included', 'Asia Camp Kuala Tahan, Taman Negara Pahang.'),
(21, 'Gunung Jerai', 'Kedah', 'images/jerai.jpg', 'Gunung Jerai, one of Kedah\'s highest peaks, offers breathtaking views of paddy fields, lush forests, and the Andaman Sea from its 1,217-meter height. A popular spot for nature lovers, it provides a cool mountain retreat and stunning scenery that includes the Jerai Hill Resort and the Muzium Perhutanan.\r\n', '- Panoramic views of paddy fields and coastal areas  \r\n- Cool mountain air and scenic trails  \r\n- The enchanting Jerai Hill Resort and nearby historical attractions  \r\n', '- Day 1: Arrival, check-in at Jerai Hill Resort, free time to explore the resort surroundings, enjoy sunset views  \r\n- Day 2: Guided trek to Gunung Jerai summit, visit Muzium Perhutanan, lunch, exploration of nearby waterfalls, return to resort  \r\n- Day 3: Breakfast, free time for photo-taking and short hikes, check-out and departure  ', '- 2-night accommodation at Jerai Hill Resort  \r\n- Daily breakfast and lunch on Day 2  \r\n- Guided trekking experience  \r\n- Entry fees to Muzium Perhutanan', '- Transportation to/from Gunung Jerai  \r\n- Personal expenses  \r\n- Dinner and additional meals', '08300 Yan, Kedah'),
(24, 'Wang Kelian', 'perlis', 'images/WangKelian.jpg', 'Wang Kelian is known for its unique border market and scenic mountainous landscape, located near the Malaysia-Thailand border. The weekly market attracts visitors from both countries, while the surrounding Perlis State Park offers hiking trails, limestone hills, and rich biodiversity.', '- Unique border market with Thai and Malaysian goods  \r\n- Scenic limestone hills and Perlis State Park  \r\n- Caving and hiking experiences in the forested landscape  \r\n', '- Day 1: Arrival, check-in at a nearby homestay, free time to explore Wang Kelian market  \r\n- Day 2: Early morning market visit, breakfast, guided trek to limestone hills, lunch, explore caves in Perlis State Park  \r\n- Day 3: Breakfast, visit to a nearby Thai temple (Wat Siam), free time before check-out and departure', '- 2-night accommodation at a local homestay  \r\n- Daily breakfast and lunch on Day 2  \r\n- Entry fee and guide for Perlis State Park  \r\n- Access to Wang Kelian Market  ', '- Transportation to/from Wang Kelian  \r\n- Personal expenses  \r\n- Dinner and additional meals  ', 'Kampung Wang Kelian\r\n02200 Kaki Bukit\r\nPerlis'),
(31, 'Pantai Cahaya Bulan', 'kelantan', 'images/Pantai Cahaya Bulan.jpg', 'Pantai Cahaya Bulan, also known as \"Moonlight Beach,\" is a popular seaside destination in Kelantan. This wide, sandy beach with gentle waves is a favorite among locals and visitors for picnics, kite flying, and watching the sunset. Nearby stalls offer local treats like keropok lekor and coconut shakes.', '\r\n- Long sandy beach with gentle waves  \r\n- Local food stalls offering traditional Kelantanese snacks  \r\n- Beautiful sunset views and relaxed beach atmosphere', '- Day 1: Arrival, check-in at a nearby beach resort, enjoy the beach, explore local food stalls, relax in the evening  \r\n- Day 2: Morning beach walk, breakfast, kite flying and beach activities, lunch, explore nearby fishing village, return to resort for sunset views  \r\n- Day 3: Breakfast, free time for beach activities, check-out and departure', '- 2-night accommodation at a beach resort  \r\n- Daily breakfast  \r\n- Access to the beach and resort facilities', '- Transportation to/from Pantai Cahaya Bulan  \r\n- Meals aside from breakfast  \r\n- Personal expenses', '15350, Kelantan'),
(32, ' Desaru Coast', 'johor', 'images/DesaruCoast.jpg', 'Desaru Coast is a popular beach and resort destination offering a mix of luxury resorts, golf courses, and theme parks. It’s ideal for both relaxation and adventure, with activities like golfing, watersports, and river cruises.', 'Gorgeous beaches with soft sands  \r\n- Adventure Waterpark and golf courses  \r\n- High-end resorts and hotels  ', '  ', 'Variety of activities for all ages  \r\n- Peaceful and relaxing beach vibes  \r\n- Family-friendly attractions', 'Resorts can be pricey  \r\n- Limited public transport options', 'Jalan Desaru Coast, Desaru, 81300 Bandar Penawar, Johor'),
(33, 'Port Dickson  ', 'negeri sembilan', 'images/PortDickson.jpg', 'Port Dickson is a beach town popular for weekend getaways from Kuala Lumpur, offering sandy beaches, seaside resorts, and family-friendly activities. It’s known for its calm waters and is ideal for swimming and picnics.', '- Popular beaches like Blue Lagoon and Teluk Kemang  \r\n- Scenic seafront hotels and resorts  \r\n- Family-oriented activities', '', ' Easy access from Kuala Lumpur  \r\n- Variety of water activities and beachside facilities  \r\n- Relaxed vibe  ', '- Beaches can be crowded, especially on weekends  \r\n- Some areas may have litter and less pristine waters  \r\n', 'Jalan Baru Kemang, 71050 Port Dickson, Negeri Sembilan'),
(34, ' Seremban Lake Gardens', 'negeri sembilan', 'images/SerembanLakeGardens.jpg', ' Seremban Lake Gardens is a beautiful public park with lush greenery, picturesque lakes, and walking trails, ideal for relaxation or a family picnic. This peaceful area is a favorite spot for locals to unwind.', '- Scenic lake with walking and jogging paths  \r\n- Playground and picnic spots  \r\n- Free entry and accessible to all  ', '', '- Beautiful and serene environment  \r\n- Suitable for family outings and exercise  \r\n- Well-maintained and clean  ', '\r\n- Limited dining options nearby  \r\n- Can be crowded during weekends  ', 'Jalan Taman Bunga, Taman Tasek Seremban, 70100 Seremban, Negeri Sembilan'),
(35, 'Petronas Twin Towers, Kuala Lumpur', 'wilayah persekutuan', 'images/twintower.jpg', ' The iconic Petronas Twin Towers are a must-visit landmark in Malaysia, featuring impressive architecture, a sky bridge, and an observation deck with panoramic views of Kuala Lumpur. It’s a symbol of Malaysia’s modernity and economic growth.', '- Tallest twin towers in the world  \r\n- Sky bridge and observation deck with stunning city views  \r\n- Suria KLCC mall at the base with dining and shopping  \r\n', '', '\r\n- Unique architectural marvel  \r\n- Centrally located with easy access to public transportation  \r\n- Many attractions around KLCC, including parks and fountains', 'Cons:  \r\n- Observation deck tickets can be pricey  \r\n- Crowded, especially around sunset  ', 'Petronas Twin Tower, Lower Ground (Concourse) Level, Kuala Lumpur City Centre, 50088 Kuala Lumpur');

-- --------------------------------------------------------

--
-- Table structure for table `destination_clicks`
--

CREATE TABLE `destination_clicks` (
  `destination_name` varchar(255) NOT NULL,
  `click_count` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `destination_clicks`
--

INSERT INTO `destination_clicks` (`destination_name`, `click_count`) VALUES
('Kedah', 2),
('Kelantan', 3),
('Pahang', 32),
('Penang', 5),
('Perak', 2),
('Perlis', 11),
('Terengganu', 4),
('Wilayah Persekutuan Kuala Lumpur', 2);

-- --------------------------------------------------------

--
-- Table structure for table `hoteldetails`
--

CREATE TABLE `hoteldetails` (
  `id` int(11) NOT NULL,
  `hotel_id` int(11) DEFAULT NULL,
  `room_name` varchar(255) NOT NULL,
  `price_per_night` varchar(255) DEFAULT NULL,
  `amenities_bed` int(11) DEFAULT NULL,
  `amenities_bath` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hoteldetails`
--

INSERT INTO `hoteldetails` (`id`, `hotel_id`, `room_name`, `price_per_night`, `amenities_bed`, `amenities_bath`, `description`, `image`) VALUES
(40, 79, 'Standard Queen Room', '171', 1, 2, '1 large double bed + Good breakfast included + Non-refundable', 'images/roomSpring.jpg'),
(41, 79, 'Superior King Room', '205', 1, 2, '1 extra-large double bed  + Good breakfast MYR 30  + Free cancellation before 11 November 2024', 'images/superiorkingSpring.jpg'),
(42, 79, 'Family Studio', '300', 3, 3, '2 single beds  and 1 extra-large double bed +  Good breakfast MYR 30 + Non-refundable', 'images/familyStudSpring.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `hotels`
--

CREATE TABLE `hotels` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `rating` float NOT NULL,
  `location` varchar(255) NOT NULL,
  `price` int(254) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `destination_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hotels`
--

INSERT INTO `hotels` (`id`, `name`, `rating`, `location`, `price`, `image`, `destination_name`) VALUES
(51, 'Concorde Hotel Kuala Lumpur', 5, 'Kuala Lumpur', 199, 'images/hotel-2.jpeg', 'Highland Tower'),
(79, 'SPRINGHILL RESORT', 4, 'Pahang', 171, 'images/springhill.png', 'Cameron Highland'),
(80, 'Merits Hotel Cameron Highlands', 2, 'Pahang', 116, 'images/mesits.jpg', 'Cameron Highland'),
(81, ' Century Pines Resort Cameron Highlands', 5, 'Pahang', 218, 'images/centurypines.jpg', 'Cameron Highland'),
(82, ' Avillion Cameron Highlands', 5, 'Pahang', 232, 'images/avillion.jpg', 'Cameron Highland'),
(83, 'Nova Highlands Hotel', 3, 'Pahang', 160, 'images/nova.jpg', 'Cameron Highland');

-- --------------------------------------------------------

--
-- Table structure for table `individual_clicks`
--

CREATE TABLE `individual_clicks` (
  `id` int(11) NOT NULL,
  `destination_name` varchar(255) NOT NULL,
  `click_time` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `individual_clicks`
--

INSERT INTO `individual_clicks` (`id`, `destination_name`, `click_time`) VALUES
(1, 'Kedah', '2024-10-11 01:33:35'),
(2, 'Kedah', '2024-10-11 01:34:33'),
(3, 'Penang', '2024-10-11 01:36:36'),
(4, 'Penang', '2024-10-11 01:40:47'),
(5, 'Kelantan', '2024-10-11 01:40:54'),
(6, 'Perlis', '2024-10-11 01:42:39'),
(7, 'Pahang', '2024-10-11 01:47:43'),
(8, 'Sabah', '2024-10-11 01:48:34'),
(9, 'Sabah', '2024-10-11 01:48:43'),
(10, 'Terengganu', '2024-10-11 01:49:30'),
(11, 'Terengganu', '2024-10-11 01:49:50'),
(12, 'Sabah', '2024-10-11 01:51:13'),
(13, 'Perlis', '2024-10-11 01:54:05'),
(14, 'Wilayah Persekutuan Kuala Lumpur', '2024-10-11 01:54:11'),
(15, 'Sabah', '2024-10-11 01:57:17'),
(16, 'Perlis', '2024-10-11 03:03:17'),
(17, 'Perlis', '2024-10-22 15:28:28'),
(18, 'Kedah', '2024-10-22 15:28:38'),
(19, 'Perlis', '2024-10-22 15:28:56'),
(20, 'Perlis', '2024-10-22 16:08:54'),
(21, 'Perak', '2024-10-23 21:44:21'),
(22, 'Pahang', '2024-10-23 21:44:58'),
(23, 'Perlis', '2024-10-23 22:44:29'),
(24, 'Penang', '2024-10-23 22:44:33'),
(25, 'Kedah', '2024-10-23 22:44:36'),
(26, 'Perak', '2024-10-23 22:44:40'),
(27, 'Kelantan', '2024-10-23 22:44:42'),
(28, 'Terengganu', '2024-10-23 22:44:46'),
(29, 'Sabah', '2024-10-23 22:44:49'),
(30, 'Sabah', '2024-10-23 22:45:02'),
(31, 'Perlis', '2024-10-23 23:09:49'),
(32, 'Perlis', '2024-10-23 23:11:20'),
(33, 'Perlis', '2024-10-23 23:13:30'),
(34, 'Kelantan', '2024-10-23 23:16:25'),
(35, 'Perlis', '2024-10-24 02:30:38'),
(36, 'Perlis', '2024-10-28 14:03:15'),
(37, 'Pahang', '2024-10-29 02:11:43'),
(38, 'Pahang', '2024-10-29 03:48:23'),
(39, 'Perlis', '2024-10-29 03:48:34'),
(40, 'Pahang', '2024-10-29 04:15:04'),
(41, 'Terengganu', '2024-10-31 00:08:57'),
(42, 'Penang', '2024-10-31 00:09:01'),
(43, 'Perlis', '2024-10-31 00:09:03'),
(44, 'Pahang', '2024-10-31 00:16:25'),
(45, 'Kelantan', '2024-10-31 00:16:42'),
(46, 'Pahang', '2024-10-31 00:16:46'),
(47, 'Penang', '2024-10-31 00:16:55'),
(48, 'Perlis', '2024-10-31 00:16:59'),
(49, 'Pahang', '2024-10-31 00:18:17'),
(50, 'Perlis', '2024-10-31 00:21:55'),
(51, 'Penang', '2024-10-31 00:23:40'),
(52, 'Pahang', '2024-10-31 00:23:43'),
(53, 'Terengganu', '2024-10-31 00:23:52'),
(54, 'Perlis', '2024-10-31 00:24:14'),
(55, 'Kedah', '2024-10-31 00:26:38'),
(56, 'Pahang', '2024-10-31 00:26:42'),
(57, 'Pahang', '2024-10-31 00:34:18'),
(58, 'Terengganu', '2024-10-31 00:35:16'),
(59, 'Pahang', '2024-10-31 00:35:24'),
(60, 'Terengganu', '2024-10-31 00:37:44'),
(61, 'Pahang', '2024-10-31 00:37:48'),
(62, 'Pahang', '2024-10-31 00:40:02'),
(63, 'Pahang', '2024-10-31 00:41:30'),
(64, 'Pahang', '2024-10-31 00:45:53'),
(65, 'Pahang', '2024-10-31 00:47:03'),
(66, 'Pahang', '2024-10-31 01:02:00'),
(67, 'Pahang', '2024-10-31 01:03:18'),
(68, 'Pahang', '2024-10-31 01:03:55'),
(69, 'Pahang', '2024-10-31 01:04:39'),
(70, 'Penang', '2024-10-31 02:09:26'),
(71, 'Pahang', '2024-10-31 02:09:30'),
(72, 'Pahang', '2024-10-31 02:44:32'),
(73, 'Pahang', '2024-10-31 02:46:06'),
(74, 'Pahang', '2024-10-31 02:51:09'),
(75, 'Pahang', '2024-10-31 02:51:21'),
(76, 'Wilayah Persekutuan Kuala Lumpur', '2024-10-31 02:53:45'),
(77, 'Pahang', '2024-10-31 02:53:50'),
(78, 'Wilayah Persekutuan Kuala Lumpur', '2024-10-31 02:55:27'),
(79, 'Pahang', '2024-10-31 02:55:31'),
(80, 'Pahang', '2024-10-31 03:36:18'),
(81, 'Pahang', '2024-10-31 04:08:49'),
(82, 'Pahang', '2024-10-31 04:08:57'),
(83, 'Pahang', '2024-10-31 12:52:19'),
(84, 'Pahang', '2024-10-31 16:09:17'),
(85, 'Pahang', '2024-10-31 16:32:56'),
(86, 'Perak', '2024-10-31 18:02:07'),
(87, 'Perlis', '2024-11-01 08:45:40'),
(88, 'Penang', '2024-11-01 08:45:45'),
(89, 'Kedah', '2024-11-01 08:45:48'),
(90, 'Perak', '2024-11-01 08:46:00'),
(91, 'Kelantan', '2024-11-01 08:46:04');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `username`, `password`) VALUES
(24, 'faiz hakimi', 'd20221104446@siswa.upsi.edu.my', 'faiz', '1234'),
(25, 'Muhammad Abu', 'abu123@gmail.com', 'abu', '12345'),
(26, 'Sufi', 'sufi@gmail.com', 'sufi', '12345'),
(27, 'HAKIMI BIN MAZLAN', 'hakimi12@gmail.com', 'hakimi', '12345'),
(28, 'adbul', 'abdul@gmail.com', 'abdul', '$2y$10$DCOy2tY5nCvgzJhOjdn.qeA/arsV0Qion9ytDQAtkD8L6A6fXaegu'),
(29, 'danial', 'danial@gmail.com', 'danial', '11111'),
(30, 'mimi', 'mimi@gmail.com', 'mimi', '123'),
(31, 'nan', 'nana@gmail.com', 'nana', '1234'),
(32, 'Muhammad', 'sufilulu17@gmail.com', 'fifi', '12345'),
(33, 'Ariq', 'mohammadariqhaikal@gmail.com', 'AriqNakal', '12345'),
(34, 'kuro', 'kuro@gmail.com', 'kuro', '12345'),
(35, 'hahahaa', 'haha@gmail.com', 'hahaha', '12345'),
(36, 'keke', 'kuro1@gmail.com', 'kurosann', '1234'),
(37, 'ken', 'ken@gmail.com', 'ken', 'ken');

-- --------------------------------------------------------

--
-- Table structure for table `user_registration_counts`
--

CREATE TABLE `user_registration_counts` (
  `id` int(11) NOT NULL,
  `total_users` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_registration_counts`
--

INSERT INTO `user_registration_counts` (`id`, `total_users`) VALUES
(1, 8);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `destinations`
--
ALTER TABLE `destinations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `destination_clicks`
--
ALTER TABLE `destination_clicks`
  ADD PRIMARY KEY (`destination_name`);

--
-- Indexes for table `hoteldetails`
--
ALTER TABLE `hoteldetails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hotel_id` (`hotel_id`);

--
-- Indexes for table `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `individual_clicks`
--
ALTER TABLE `individual_clicks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_registration_counts`
--
ALTER TABLE `user_registration_counts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `destinations`
--
ALTER TABLE `destinations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `hoteldetails`
--
ALTER TABLE `hoteldetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `hotels`
--
ALTER TABLE `hotels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `individual_clicks`
--
ALTER TABLE `individual_clicks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `user_registration_counts`
--
ALTER TABLE `user_registration_counts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `hoteldetails`
--
ALTER TABLE `hoteldetails`
  ADD CONSTRAINT `hoteldetails_ibfk_1` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
