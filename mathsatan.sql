-- phpMyAdmin SQL Dump
-- version 4.0.10
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Сен 03 2015 г., 00:52
-- Версия сервера: 5.5.38-log
-- Версия PHP: 5.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `mathsatan`
--

-- --------------------------------------------------------

--
-- Структура таблицы `mvc_articles`
--

CREATE TABLE IF NOT EXISTS `mvc_articles` (
  `article_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` mediumint(8) unsigned NOT NULL,
  `cat_id` mediumint(8) unsigned NOT NULL,
  `article_title` varchar(64) NOT NULL,
  `article_text` text NOT NULL,
  `article_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `title_pic` tinytext NOT NULL,
  PRIMARY KEY (`article_id`),
  KEY `user_id` (`user_id`),
  KEY `cat_id` (`cat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Дамп данных таблицы `mvc_articles`
--

INSERT INTO `mvc_articles` (`article_id`, `user_id`, `cat_id`, `article_title`, `article_text`, `article_date`, `title_pic`) VALUES
(4, 1, 2, 'Курение это смерть!', '<p>Вред курения на сердечно-сосудистую систему курильщики часто недооценивают. После выкуривания одной сигареты из-за воспаления сужаются дыхательные пути, активизируется выделение мокроты, развивается кашель, чаще возникают приступы астмы. Никотин из сигаретного дыма провоцирует деление и размножение раковых клеток в легких. Страдают органы дыхания.</p>\r\n<p>\r\nПосле выкуривания одной сигареты происходят изменения в слизистой оболочке полости рта, которые провоцируют развитие злокачественных опухолей. Увеличивается вероятность развития рака поджелудочной железы, устранить опухоль которой практически невозможно не хирургическим, не тем более медикаментозным лечением. Нарушается кровообращение сетчатки глаза, происходят изменения глазного дна – ухудшается центральное зрение.</p>', '2015-07-28 17:09:23', '/img/article_pic/small/small_math.png'),
(8, 1, 3, 'Windows', '<p>Windows. Голосовой помощник Cortana стал одним из самых ожидаемых нововведений в Windows 10. Однако доступ к функции получили не все, — пока она работает в США, Великобритании, Китае, Франции, Италии, Германии и Испании, в версиях Windows 10 на соответствующих языках. Чтобы опробовать Cortana на одном из этих языков, необходимо сменить настройки региона и языка в Windows.</p>\r\n<p>\r\nКак рассказал «Ленте.ру» менеджер Microsoft по продвижению Windows в России Сергей Марцынкьян, причина задержки с выпуском русскоязычной Cortana связана с тем, что локализованная версия должна быть интегрирована с российскими онлайн-сервисами.</p>\r\n<p>\r\nКуда пропал Internet Explorer\r\n\r\nБурное обсуждение в комментариях к тестированию Windows 10 вызвал вопрос о том, куда пропал Internet Explorer. Бросив попытки предлагать пользователям установить Internet Explorer браузером по умолчанию, Microsoft заменила его в Windows 10 новым интернет-обозревателем Edge. Новинка куда более приближена по функциональности и по ощущениям к современным браузерам — прежде всего к Chrome.\r\n</p>\r\nMicrosoft заявляет, что Edge будет браузером по умолчанию в Windows 10, а Internet Explorer остался в качестве дополнительного. Загадка, но из нескольких ПК со свежеустановленной Windows 10 нам удалось найти Internet Explorer только в версии для корпоративных пользователей, а на ПК с «домашней» модификацией Windows 10 установлен только Edge. В любом случае для тех, кто скучает по классическому браузеру Microsoft, остается возможность скачать и установить его.</p>\r\n<p>\r\nКак Windows 10 работает с антивирусами\r\n\r\nПо словам специалиста по безопасности Microsoft Андрея Бешкова, в Windows 10 предусмотрен бесплатный антивирус Defender. Кроме того, в платформе появился специальный интерфейс, который проверяет состояние антивирусов на компьютере.</p>', '2015-08-04 14:02:08', '/img/article_pic/small/win.png'),
(9, 5, 1, 'Откуда появились Шумеры', ' <p>Шумеры -  были "черноголовые". Этот народ, появившийся на юге Месопотамии в середине III-го тысячелетия до нашей эры неизвестно откуда, сейчас называют "прародителем современной цивилизации" , а ведь до середины 19-го века никто о нём даже не подозревал. Время стерло Шумер из анналов истории и, если бы не лингвисты, возможно мы бы никогда не узнали о Шумере.</p>\r\n<img src="/img/article_pic/normal/shumeri.png">\r\n<p>\r\nНо начну я , наверное, с 1778-м года, когда датчанин Карстен Нибур, возглавлявший экспедицию в Месопотамию 1761-м года, опубликовал копии клинописной царской надписи из Персеполя. Он первый предположил, что 3 колонки в надписи - это три разных вида клинописи, содержащих один и тот же текст.\r\n \r\nВ 1798-м году ещё один датчанин, Фридрих Христиан Мюнтер высказал гипотезу что письмена 1-го класса - это алфавитная староперсидская письменность (42 знака), 2-го класса - слоговое письмо, 3-го - идеографические знаки. Но первым удалось прочесть текст не датчанину а немцу, преподавателю латыни в Геттингене, Гротенфенду. Внимание его привлекла группа из семи клинописных знаков. Гротенфенд предположил что это слово Царь, а остальные знаки были подобраны исходя из исторических и лингвистических аналогий. В конце концов Гротенфенд сделал следующий перевод :\r\n</p><p>\r\nКсеркс, царь великий, царь царей Дария, царя, сын, Ахеменид.\r\n </p> ', '2015-08-10 14:06:50', '/img/article_pic/small/small_shumeri.png');

-- --------------------------------------------------------

--
-- Структура таблицы `mvc_categories`
--

CREATE TABLE IF NOT EXISTS `mvc_categories` (
  `cat_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(32) NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `mvc_categories`
--

INSERT INTO `mvc_categories` (`cat_id`, `cat_name`) VALUES
(1, 'Искусство'),
(2, 'Математика'),
(3, 'Программирование');

-- --------------------------------------------------------

--
-- Структура таблицы `mvc_comments`
--

CREATE TABLE IF NOT EXISTS `mvc_comments` (
  `comment_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` mediumint(8) unsigned NOT NULL,
  `article_id` mediumint(8) unsigned NOT NULL,
  `comment_text` varchar(256) NOT NULL,
  `comment_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`comment_id`),
  KEY `user_id` (`user_id`),
  KEY `article_id` (`article_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- Дамп данных таблицы `mvc_comments`
--

INSERT INTO `mvc_comments` (`comment_id`, `user_id`, `article_id`, `comment_text`, `comment_date`) VALUES
(25, 1, 4, 'тест!', '2015-08-05 14:02:44'),
(26, 1, 8, 'винда 10', '2015-08-05 14:03:00'),
(27, 3, 9, 'asd', '2015-08-10 14:07:45'),
(28, 1, 9, '123', '2015-09-02 19:28:55');

-- --------------------------------------------------------

--
-- Структура таблицы `mvc_users`
--

CREATE TABLE IF NOT EXISTS `mvc_users` (
  `user_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(32) NOT NULL,
  `pass` varchar(32) NOT NULL,
  `email` varchar(128) NOT NULL,
  `status` tinyint(1) DEFAULT '0',
  `is_active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Дамп данных таблицы `mvc_users`
--

INSERT INTO `mvc_users` (`user_id`, `login`, `pass`, `email`, `status`, `is_active`) VALUES
(1, 'max', '2ffe4e77325d9a7152f7086ea7aa5114', 'max@mail.ru', 1, 1),
(3, 'asd', '7815696ecbf1c96e6894b779456d330e', 'asd@awd.as', 0, 1),
(5, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'asd@awd.as', 1, 0),
(20, 'miha', 'c4ca4238a0b923820dcc509a6f75849b', 'a@sdsd.ty', 0, 1),
(23, 'oleg', '045b9e4d8b96dce053950297a8a39665', 'oleg@mail.ua', 1, 1);

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `mvc_articles`
--
ALTER TABLE `mvc_articles`
  ADD CONSTRAINT `mvc_articles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `mvc_users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mvc_articles_ibfk_2` FOREIGN KEY (`cat_id`) REFERENCES `mvc_categories` (`cat_id`) ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `mvc_comments`
--
ALTER TABLE `mvc_comments`
  ADD CONSTRAINT `mvc_comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `mvc_users` (`user_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `mvc_comments_ibfk_2` FOREIGN KEY (`article_id`) REFERENCES `mvc_articles` (`article_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
