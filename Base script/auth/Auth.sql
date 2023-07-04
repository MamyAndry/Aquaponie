-- Authentification
create sequence s_profile start with 1 increment by 1;
create sequence s_aqua_user start with 1 increment by 1;

create table profile(
    id_profile varchar(8) primary key ,
    name varchar(20)
);

insert into profile(id_profile, name) values('PRO0001', 'Admin');
insert into profile(id_profile, name) values('PRO0002', 'Pond manager');

create table aqua_user(
    id_user varchar(8) primary key ,
    id_profile varchar(8) references profile(id_profile),
    name varchar(20),
    identifier varchar(20),     -- identifiant
    password varchar(200)       -- Mot de passe
);

