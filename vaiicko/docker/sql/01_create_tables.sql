create table if not exists user(
    id int primary key auto_increment,
    username varchar(50) not null unique,
    email varchar(100) not null unique,
    password_hash varchar(255) not null,
    created_at timestamp default current_timestamp
);

create table if not exists exercise(
    id int primary key auto_increment,
    user_id int not null,
    name varchar(100) not null,
    description text,
    created_at timestamp default current_timestamp,
    foreign key (user_id) references user(id)
);

create table if not exists workout(
    id int primary key auto_increment,
    user_id int not null,
    name varchar(100) not null,
    created_at timestamp default current_timestamp,
    foreign key (user_id) references user(id)
);

create table if not exists workout_exercise(
    id int primary key auto_increment,
    workout_id int not null,
    exercise_id int not null,
    unique key unique_workout_exercise (workout_id, exercise_id),
    foreign key (workout_id) references workout(id) on delete cascade,
    foreign key (exercise_id) references exercise(id) on delete cascade
);

insert ignore into user (id, username, email, password_hash)
values (1, 'demo', 'demo@example.com', 'not-used');
