CREATE DATABASE roomsurance

use roomsurance

create table users (
userid varchar(200) NOT NULL,
name varchar(30) NOT NULL,
group INT,
points INT,
PRIMARY KEY (userid),
FOREIGN KEY (group) REFERENCES group(groupid),
UNIQUE (userid)
);

create table groups (
groupid INT NOT NULL AUTO_INCREMENT,
group_name varchar(30) NOT NULL,
total_points INT,
PRIMARY KEY (groupid),
UNIQUE (groupid)
);

create table chores (
choreid INT NOT NULL AUTO_INCREMENT,
chore_name varchar(30) NOT NULL,
chore_descrip varchar(200),
diffi INT,
time INT,
sug_points INT,
act_point INT NOT NULL,
due_date DATE,
group INT,
user varchar(200),
PRIMARY KEY (choreid),
FOREIGN KEY (group) REFERENCES group(groupid),
FOREIGN KEY (user) REFERENCES user(userid),
UNIQUE (choreid)
);