CREATE TABLE users (
userid varchar(200) NOT NULL,
name varchar(30) NOT NULL,
group INT(11),
points INT(11),
cash INT(11),
PRIMARY KEY (userid),
FOREIGN KEY (group) REFERENCES group(groupid),
UNIQUE (userid)
);

CREATE TABLE groups (
groupid INT(11) NOT NULL AUTO_INCREMENT,
group_name varchar(30) NOT NULL,
total_points INT(11),
total_cash INT(11),
pass varchar(30) NOT NULL,
PRIMARY KEY (groupid),
UNIQUE (groupid),
UNIQUE (pass)
);

CREATE TABLE chores (
choreid INT(11) NOT NULL AUTO_INCREMENT,
chore_name varchar(30) NOT NULL,
chore_descrip varchar(200),
diffi INT(11),
time INT(11),
sug_points INT(11),
act_point INT(11) NOT NULL,
due_date DATE,
group INT(11),
user varchar(200),
PRIMARY KEY (choreid),
FOREIGN KEY (group) REFERENCES group(groupid),
FOREIGN KEY (user) REFERENCES user(userid),
UNIQUE (choreid)
);