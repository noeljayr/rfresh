
CREATE TABLE post (
    post_id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    post_name varchar(255) not null,
    content TEXT NOT NULL,
    category VARCHAR(50),
    user_id INT NOT NULL,
    creation_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    modification_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    post_status varchar(50)
);

CREATE TABLE thumbnail (
    thumbnail_id INT PRIMARY KEY AUTO_INCREMENT,
    post_id INT NOT NULL,
    path VARCHAR(255) NOT NULL,
    alt VARCHAR(255),
    FOREIGN KEY (post_id) REFERENCES post(post_id) ON DELETE CASCADE
);
CREATE TABLE platform (
    platform_id INT PRIMARY KEY AUTO_INCREMENT,
    post_id INT NOT NULL,
    platform_name VARCHAR(50) NOT NULL,
    link VARCHAR(255) NOT NULL,
    FOREIGN KEY (post_id) REFERENCES post(post_id) ON DELETE CASCADE
);
CREATE TABLE tags (
    tag_id INT AUTO_INCREMENT PRIMARY KEY,
    tag_name VARCHAR(255) NOT NULL,
    post_id INT,
    FOREIGN KEY (post_id) REFERENCES post(post_id) ON DELETE CASCADE
);
CREATE TABLE events (
    event_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    event_date DATE NOT NULL,
    description TEXT,
    imgPath VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
create table users(
	user_id  int(10) auto_increment primary key,
  	first_name varchar(250) not null,
  	last_name varchar(250) not null,
  	phone_number varchar(20) not null,
  	email varchar(100) not null,
  	role varchar(100) not null,
    creation_date varchar(30) not null,
    modification_date varchar(30),
	last_login_date varchar(30),
    status varchar(15) not null,
	password varchar(100) not null
);

