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

create table type_fish(
    id_type_fish varchar(8) primary key,
    name_type_fish varchar(40) not null,
    maturity_period decimal(3, 1) not null, --en mois
    maturity_size int not null -- en cm
);

create table type_plantation(
    id_type_plantation varchar(8) primary key,
    name_type_plantation varchar(40) not null
);

create table pond(
    id_pond varchar(8) primary key,
    capacity int not null
);

create table pond_details(
    id_pond_details int primary key,
    id_pond varchar(8) references pond(id_pond),
    id_type_fish varchar(8) references type_fish(id_type_fish),
    max_quantity int not null -- max quantity of type fish it can take
);

create table field(
    id_field varchar(8) primary key,
    max_plant int not null
);

create table field_plantation(
    id_field_plantation int primary key,
    id_field varchar(8) references field(id_field),
    id_type_plantation varchar(8) references type_plantation(id_type_plantation),
    plant_number int not null
    insertion_date date not null
);

create table fish_pond(
    id_fish_pond int primary key,
    id_type_fish varchar(8) references type_fish(id_type_fish),
    id_pond varchar(8) references pond(id_pond),
    fish_gender boolean not null, -- true:femelle, false:male
    quantity int not null,
    insertion_date date not null
);

create table report_pond(
    id_report_pond int primary key,
    id_fish_pond int references fish_pond(id_fish_pond),
    report_date_pond date not null,
    alive_fish_number int,
    dead_fish_number int
);

create table report_field(
    id_report_field int primary key,
    id_field_plantation int references field_plantation(id_field_plantation),
    report_date_field date not null,
    one_plant_weight decimal(10,2) not null, --en gramme : masse d'un tige
    plant_per_squaremeter decimal(10,2) not null, -- Noter seulement le nombre de plante par metre carre
    surface_covered decimal(10,2) not null --A calculer grace au deux donnees precedent
);

create table sale_fish(
    id_sale_fish int primary key,
    id_fish_pond int references fish_pond(id_fish_pond),
    quantity_sold int not null, -- nombre de tige vendue
    sale_date date not null
);

create table sale_plantation(
    id_sale_plantation int primary key,
    id_field_plantation int references field_plantation(id_field_plantation),
    quantity_sold int not null, --nombre de tige vendue
    sale_date date not null
);