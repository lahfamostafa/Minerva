USE menava;

create table users(
    id int auto_increment primary key,
    name varchar(255) not null,
    email varchar(255) unique not null,
    password varchar(255) not null,
    role ENUM('teacher','student') not null,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
create table teachers(
    id int auto_increment primary key,
    user_id int unique not null,
    speciality varchar(255) not null,
    foreign key(user_id) REFERENCES users(id)
);
create table classes(
    id int auto_increment primary key,
    name varchar(255) not null,
    teacher_id int not null,
    foreign key(teacher_id) REFERENCES teachers(id)
);
create table students(
    id int auto_increment primary key,
    user_id int unique not null,
    class_id int not null,
    foreign key(user_id) REFERENCES users(id),
    foreign key(class_id) REFERENCES classes(id)
);
create table works(
    id int auto_increment primary key,
    title varchar(255) not null,
    description text not null,
    file_path varchar(255) ,
    class_id int not null,
    teacher_id int not null,
    deadline datetime not null,
    foreign key(class_id) REFERENCES classes(id) on delete cascade,
    foreign key(teacher_id) REFERENCES teachers(id)
);
create table submissions(
    id int auto_increment primary key,
    work_id int not null,
    student_id int not null,
    content varchar(255) ,
    submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ,
    foreign key(work_id) REFERENCES works(id) on delete cascade,
    foreign key(student_id) REFERENCES students(id)
);
create table grades(
    id int auto_increment primary key,
    submission_id int not null,
    grade int not null,
    comment text not null,
    foreign key(submission_id) REFERENCES submissions(id) on delete cascade
);
create table attendance(
    id int auto_increment primary key,
    class_id int not null,
    student_id int not null,
    date_attendance date not null,
    status ENUM('present','absent'),
    UNIQUE (student_id, date_attendance),
    foreign key(class_id) REFERENCES classes(id) on delete cascade,
    foreign key(student_id) REFERENCES students(id)
);
create table chat_messages(
    id int auto_increment primary key,
    class_id int not null,
    user_id int not null,
    message text not null,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    foreign key(class_id) REFERENCES classes(id) on delete cascade,
    foreign key(user_id) REFERENCES users(id)
);

