create table unite (
    id_unite varchar(8) primary key ,
    nom varchar(255) not null
);
create sequence s_unite start 1 increment 1;
insert into unite values ('UNIT000'||nextval('s_unite'),'Kg'), ('UNIT000'||nextval('s_unite'),'Mois'), ('UNIT000'||nextval('s_unite'),'cm');
