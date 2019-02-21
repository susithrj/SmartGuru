CREATE DATABASE SmartGuruDB;

USE SmartGuruDB;

CREATE TABLE user(
	username VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL,
    email VARCHAR(100),
    PRIMARY KEY(username)
);

INSERT INTO user VALUES
('saneth', '123456', 'saneth.induwara11@gmail.com');

CREATE TABLE lesson(
	lesson_id VARCHAR(30) NOT NULL,
    lesson_name VARCHAR(50) NOT NULL,
    time INT NOT NULL,
    total_qs INT,
    PRIMARY KEY(lesson_id)
);

CREATE TABLE question(
	question_id VARCHAR(30) NOT NULL,
    lesson_id VARCHAR(30) NOT NULL,
    seq_no INT,
    question_desc VARCHAR(500) NOT NULL,
    difficulty_level VARCHAR(50),
    PRIMARY KEY(question_id),
    FOREIGN KEY (lesson_id) REFERENCES lesson(lesson_id)
);

CREATE TABLE answer(
answer_id VARCHAR(30) NOT NULL,
question_id VARCHAR(30) NOT NULL,
FOREIGN KEY (question_id) REFERENCES question(question_id)
);

CREATE TABLE options(
option_id VARCHAR(30) NOT NULL,
question_id VARCHAR(30) NOT NULL,
option_text VARCHAR(200) NOT NULL,
PRIMARY KEY (option_id),
FOREIGN KEY (question_id) REFERENCES question(question_id)
);

CREATE TABLE user_answers(
	username VARCHAR(50) NOT NULL,
	question_id VARCHAR(30) NOT NULL,
    is_correct BOOLEAN,
    time_taken time,
	FOREIGN KEY (username) REFERENCES user(username),
	FOREIGN KEY (question_id) REFERENCES question(question_id)
);

INSERT INTO lesson VALUES
('ls0001', 'Basics', 10, 5),
('ls0002', 'Loops', 10, 10),
('ls0003', 'Object Oriented Programming', 10, 10),
('ls0004', 'Exception Handeling' , 10, 10),
('ls0005', 'Threads', 10, 10);

INSERT INTO question VALUES
('qs0001', 'ls0001', 1, 'Sample Qestion 1','easy'),
('qs0002', 'ls0001', 2, 'Sample Qestion 2','easy'),
('qs0003', 'ls0001', 3, 'Sample Qestion 3','medium'),
('qs0004', 'ls0001' , 4, 'Sample Qestion 4','easy'),
('qs0005', 'ls0001', 5, 'Sample Qestion 5','hard');

INSERT INTO options VALUES
('op0001', 'qs0001', 'option 1'),
('op0002', 'qs0001', 'answer for qs 1'),
('op0003', 'qs0001', 'option 3'),
('op0004', 'qs0001' , 'option 4'),
('op0005', 'qs0002', 'option 1'),
('op0006', 'qs0002', 'option 2'),
('op0007', 'qs0002', 'option 3'),
('op0008', 'qs0002' , 'answer for qs 2'),
('op0009', 'qs0003', 'answer for qs 3'),
('op0010', 'qs0003', 'option 2'),
('op0011', 'qs0003', 'option 3'),
('op0012', 'qs0003' , 'option 4'),
('op0013', 'qs0004', 'option 1'),
('op0014', 'qs0004', 'option 2'),
('op0015', 'qs0004', 'answer for qs 4'),
('op0016', 'qs0004' , 'option 4'),
('op0017', 'qs0005', 'option 1'),
('op0018', 'qs0005', 'option 2'),
('op0019', 'qs0005', 'option 3'),
('op0020', 'qs0005' , 'answer for qs 5');

INSERT INTO answer VALUES 
('op0002', 'qs0001'),
('op0008', 'qs0002'),
('op0009', 'qs0003'),
('op0015', 'qs0004'),
('op0020', 'qs0005');

DROP DATABASE SmartGuruDB;
