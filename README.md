<!-- sql for create students table -->

CREATE TABLE `students` (
  `id` int(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `nic` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
);
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `students`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

<!-- sql for Create users table -->

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_name` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `user_type` int(11) DEFAULT 1,
  `password` varchar(200) DEFAULT NULL
)