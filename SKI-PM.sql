create schema skipm_db collate utf8mb4_general_ci;
use skipm_db;

create table admins
(
    id        int auto_increment primary key,
    firstname varchar(255) not null,
    lastname  varchar(255) not null,
    username  varchar(255) not null,
    email     varchar(255) not null,
    password  varchar(255) not null,

    constraint email
        unique (email),
    constraint username
        unique (username)
)default charset=utf8mb4;

create table athletes
(
    id         int auto_increment primary key,
    firstname  varchar(255)      not null,
    lastname   varchar(255)      not null,
    gender     tinyint default 0 not null,
    email      varchar(255)      not null,
    photo_path text              not null,

    constraint email
        unique (email)
)default charset=utf8mb4;

create table categories
(
    id   int auto_increment primary key,
    name varchar(255) not null
)default charset=utf8mb4;

create table clubs
(
    id        int auto_increment primary key,
    name      varchar(255) not null,
    logo_path text         not null,
    location  text         not null,

    constraint location
        unique (location) using hash,
    constraint logo_path
        unique (logo_path) using hash,
    constraint name
        unique (name)
)default charset=utf8mb4;

create table club_members
(
    id        int auto_increment,
    member_id int not null,
    club_id   int not null,

    primary key (id, member_id, club_id),

    constraint fk_club_members_athletes_id
        foreign key (member_id) references athletes (id),
    constraint fk_club_members_clubs_id
        foreign key (club_id) references clubs (id)
)default charset=utf8mb4;

create table races
(
    id          int auto_increment primary key,
    name        varchar(255) not null,
    date        date         not null,
    category_id int          not null,

    constraint fk_races_categories_id
        foreign key (category_id) references categories (id)
)default charset=utf8mb4;

create table news
(
    id        int auto_increment primary key,
    date      datetime     not null,
    author_id int          not null,
    title     varchar(255) not null,
    content   text         not null,

    constraint fk_news_admins_id
        foreign key (author_id) references admins (id)
)default charset=utf8mb4;

create table teams
(
    id      int auto_increment primary key,
    name    varchar(255) not null,
    club_id int          not null,

    constraint fk_teams_club_id
        foreign key (club_id) references clubs (id)
)default charset=utf8mb4;

create table races_results
(
    id          int auto_increment,
    race_id     int  not null,
    athlete_id  int  not null,
    club_id     int  not null,
    team_id     int  null,
    run_1       time not null,
    run_2       time not null,
    run_average time not null,

    primary key (id, athlete_id, club_id, race_id),

    constraint fk_races_results_athlete_id
        foreign key (athlete_id) references athletes (id),
    constraint fk_races_results_club_id
        foreign key (club_id) references clubs (id),
    constraint fk_races_results_races_id
        foreign key (race_id) references races (id),
    constraint fk_races_results_teams_id
        foreign key (team_id) references teams (id)
)default charset=utf8mb4;

create table team_members
(
    id        int auto_increment,
    member_id int not null,
    team_id   int not null,

    primary key (id, member_id, team_id),

    constraint fk_team_members_athletes_id
        foreign key (member_id) references athletes (id),
    constraint fk_team_members_teams_id
        foreign key (team_id) references teams (id)
)default charset=utf8mb4;