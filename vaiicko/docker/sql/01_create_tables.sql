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

insert ignore into user (id, username, email, password_hash)
values (1, 'demo', 'demo@example.com', 'not-used');
