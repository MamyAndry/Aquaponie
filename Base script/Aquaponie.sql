-- database name : 
    --aquaponie

create sequence s_type_fish start with 1 increment by 1;
create sequence s_type_plantation start with 1 increment by 1;
create sequence s_pond start with 1 increment by 1;
create sequence s_field start with 1 increment by 1;
create sequence s_pond_details start with 1 increment by 1;
create sequence s_field_plantation start with 1 increment by 1;
create sequence s_fish_pond start with 1 increment by 1;
create sequence s_report_pond start with 1 increment by 1;
create sequence s_report_field start with 1 increment by 1;
create sequence s_sale_fish start with 1 increment by 1;
create sequence s_sale_plantation start with 1 increment by 1;
create sequence s_price_fish start with 1 increment by 1;
create sequence s_price_plantation start with 1 increment by 1;

create table type_fish(
    id_type_fish varchar(8) primary key,
    name_type_fish varchar(40) not null,
    maturity_period decimal(3, 1) not null, --en mois
    maturity_size int not null, -- en cm
    weight_max_little double precision not null, -- en gramme // Taille maximale pour la categorie petit
    weight_max_average double precision not null,
    size_max_little double precision not null, --en cm // Taille maximale pour la categorie moyenne
    size_max_average double precision not null
);

create table type_plantation(
    id_type_plantation varchar(8) primary key,
    name_type_plantation varchar(40) not null,
    weight_max_baby double precision not null, -- en gram 
    weight_max_semi_mature double precision not null
);

create table pond(
    id_pond varchar(8) primary key,
    capacity int not null
);

create table pond_details(
    id_pond_details varchar(8) primary key,
    id_pond varchar(8) references pond(id_pond),
    id_type_fish varchar(8) references type_fish(id_type_fish),
        max_quantity int not null -- max quantity of type fish it can take
);

create table field(
    id_field varchar(8) primary key
);

create table field_plantation(
    id_field_plantation varchar(8) primary key,
    id_field varchar(8) references field(id_field),
    id_type_plantation varchar(8) references type_plantation(id_type_plantation),
    density int, --nombre de plante ou fruit par metre carree en moyenne
    surface_covered decimal(10,2), --surface totale couverte de plante ou fruit
    plant_weight decimal(10,2), --en gramme : masse d'une unite plante ou fruit
    insertion_date date not null
);

create table fish_pond(
    id_fish_pond varchar(8) primary key,
    id_type_fish varchar(8) references type_fish(id_type_fish),
    id_pond varchar(8) references pond(id_pond),
    fish_gender boolean not null, -- true:femelle, false:male
    quantity int not null,
    insertion_date date not null
);

create table report_pond(
    id_report_pond varchar(8) primary key,
    id_fish_pond varchar(8) references fish_pond(id_fish_pond),
    report_date_pond date not null,
    alive_fish_number int,
    dead_fish_number int,
    category int -- Gros:21, moyen:11 ou petit:1 ilay taille
);

create table report_field(
    id_report_field varchar(8) primary key,
    id_field_plantation varchar(8) references field_plantation(id_field_plantation),
    report_date_field date not null,
    plant_weight decimal(10,2) not null, --en gramme : masse umitaire d'une plante ouu fruit
    density decimal(10,2) not null, -- Noter seulement le nombre de plante par metre carre
    surface_covered decimal(10,2) not null --A calculer grace au deux donnees precedent
);

create table sale_fish(
    id_sale_fish varchar(8) primary key,
    id_fish_pond varchar(8) references fish_pond(id_fish_pond),
    quantity_sold int not null, -- Quantite de fish vendue en nombre satria tsy manapaka tsonjo
    sale_date date not null
);

create table sale_plantation(
    id_sale_plantation varchar(8) primary key,
    id_field_plantation varchar(8) references field_plantation(id_field_plantation),
    quantity_sold int not null, --nombre de plant (ou fruit) vendue
    sale_date date not null
);

create table price_fish( -- Le prix untaire designe pour une VENTE de fish
    id_price_fish varchar(8) primary key,
    id_type_fish varchar(8) references type_fish(id_type_fish),
    unit_fish_price double precision not null,
    price_category int not null --gros:21 moyen:11 ou petit:1 
);

create table price_plantation( -- Le prix untaire designe pour une VENTE de plantation
    id_price_plantation varchar(8) primary key,
    id_type_plantation varchar(8) references type_plantation(id_type_plantation),
    unit_plant_price double precision not null --Prix par gramme
);


-- Authentification

-- Authentification

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

select * from profile;

select * from sale_fish ;

SELECT SUM(quantity_sold) FROM sale_fish WHERE EXTRACT('year' from sale_date) = 2023;


drop view v_fish_month_statistic;
create or replace view v_fish_month_statistic as
SELECT
    id_type_fish,
    to_char(sale_date,'mm') || '-' || extract('year' from sale_date) as identifier,
    SUM(quantity_sold) AS quantity_sold
FROM
    (select sale_fish.*, fp.id_type_fish from sale_fish
    join public.fish_pond fp on sale_fish.id_fish_pond = fp.id_fish_pond) a
GROUP BY
    id_type_fish,
    to_char(sale_date,'mm'),
    extract('year' from sale_date)
ORDER BY
    to_char(sale_date,'mm'),
    extract('year' from sale_date),
    id_type_fish;

select * from profile;
insert into aqua_user(id_user, id_profile, name, identifier, password) values ('AUR0001', 'PRO0001', 'rakharrs', 'rakharrs', 'pixel');
select * from fish_pond;


select sale_fish.*, fp.id_type_fish from sale_fish
    join public.fish_pond fp on sale_fish.id_fish_pond = fp.id_fish_pond

select * from sale_fish;

select * from type_fish;
select * from v_fish_month_statistic;