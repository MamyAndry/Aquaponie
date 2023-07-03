create DATABASE aquaponie;

\c aquaponie

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
    id_type_fish varchar(10) primary key,
    name_type_fish varchar(40) not null,
    maturity_period decimal(3, 1) not null, --en mois
    maturity_size int not null, -- en cm
    weight_max_little double precision not null, -- en gramme // Taille maximale pour la categorie petit
    weight_max_average double precision not null,
    size_max_little double precision not null, --en cm // Taille maximale pour la categorie moyenne
    size_max_average double precision not null
);

create table type_plantation(
    id_type_plantation varchar(10) primary key,
    name_type_plantation varchar(40) not null,
    weight_max_baby double precision not null, -- en gram 
    weight_max_semi_mature double precision not null
);

create table pond(
    id_pond varchar(10) primary key,
    capacity int not null
);

create table pond_details(
    id_pond_details varchar(10) primary key,
    id_pond varchar(8) references pond(id_pond),
    id_type_fish varchar(8) references type_fish(id_type_fish),
        max_quantity int not null -- max quantity of type fish it can take
);

create table field(
    id_field varchar(10) primary key
);

create table field_plantation(
    id_field_plantation varchar(10) primary key,
    id_field varchar(8) references field(id_field),
    id_type_plantation varchar(8) references type_plantation(id_type_plantation),
    density int, --nombre de plante ou fruit par metre carree en moyenne
    surface_covered decimal(10,2), --surface totale couverte de plante ou fruit
    plant_weight decimal(10,2), --en gramme : masse d'une unite plante ou fruit
    insertion_date date not null
);

create table fish_pond(
    id_fish_pond varchar(10) primary key,
    id_type_fish varchar(8) references type_fish(id_type_fish),
    id_pond varchar(8) references pond(id_pond),
    fish_gender boolean not null, -- true:femelle, false:male
    quantity int not null,
    insertion_date date not null
);

create table report_pond(
    id_report_pond varchar(10) primary key,
    id_fish_pond varchar(8) references fish_pond(id_fish_pond),
    report_date_pond date not null,
    alive_fish_number int,
    dead_fish_number int,
    category int -- Gros:21, moyen:11 ou petit:1 ilay taille
);

create table report_field(
    id_report_field varchar(10) primary key,
    id_field_plantation varchar(8) references field_plantation(id_field_plantation),
    report_date_field date not null,
    plant_weight decimal(10,2) not null, --en gramme : masse umitaire d'une plante ouu fruit
    density decimal(10,2) not null, -- Noter seulement le nombre de plante par metre carre
    surface_covered decimal(10,2) not null --A calculer grace au deux donnees precedent
);

create table sale_fish(
    id_sale_fish varchar(10) primary key,
    id_fish_pond varchar(8) references fish_pond(id_fish_pond),
    quantity_sold int not null, -- Quantite de fish vendue en nombre satria tsy manapaka tsonjo
    sale_date date not null
);

create table sale_plantation(
    id_sale_plantation varchar(10) primary key,
    id_field_plantation varchar(8) references field_plantation(id_field_plantation),
    quantity_sold int not null, --nombre de plant (ou fruit) vendue
    sale_date date not null
);

create table price_fish( -- Le prix untaire designe pour une VENTE de fish
    id_price_fish varchar(10) primary key,
    id_type_fish varchar(8) references type_fish(id_type_fish),
    unit_fish_price double precision not null,
    price_category int not null --gros:21 moyen:11 ou petit:1 
);

create table price_plantation( -- Le prix untaire designe pour une VENTE de plantation
    id_price_plantation varchar(10) primary key,
    id_type_plantation varchar(8) references type_plantation(id_type_plantation),
    unit_plant_price double precision not null --Prix par gramme
);

--------------------------------------------------------------------------------------- DATA  ---------------------------------------------------------------------------------
    INSERT INTO type_fish (id_type_fish, name_type_fish, maturity_period, maturity_size, weight_max_little, weight_max_average, size_max_little, size_max_average)VALUES
        ('FISH0001', 'Carpes', 7, 30, 200, 1000, 40, 60),
        ('FISH0002', 'Tilapia', 5, 25, 150, 800, 35, 50);


    -- insert into type_fish (id_type_fish, name_type_fish, maturity_period, maturity_size, weight_max_little, weight_max_average, size_max_little, size_max_average) values 
    --     ('FISH0001', 'Tilapia', 24, 15, 250, 500, 5, 10); --valeur min : 24 mois -> 15 cm

    INSERT INTO type_plantation (id_type_plantation, name_type_plantation, weight_max_baby, weight_max_semi_mature)VALUES
        ('PLNT0001', 'Fraise', 10, 50),
        ('PLNT0002', 'Laitue', 5, 25);
    INSERT INTO pond (id_pond, capacity)VALUES
        ('POND0001', 4500),
        ('POND0002', 6000),
        ('POND0003', 3500),
        ('POND0004', 4000);  --capicity est le volume supporter par le basssin pour faire l'aquaponie

    insert into pond_details (id_pond_details, id_pond, id_type_fish, max_quantity) values
        ('DPO'||nextval('s_pond_details'), 'POND0001', 'FISH0001', 180),
        ('DPO'||nextval('s_pond_details'), 'POND0002', 'FISH0001', 300),
        ('DPO'||nextval('s_pond_details'), 'POND0003', 'FISH0002', 175),
        ('DPO'||nextval('s_pond_details'), 'POND0004', 'FISH0002', 200);

    insert into field(id_field) values 
        ('FILD0001'),
        ('FILD0002'),
        ('FILD0003'),
        ('FILD0004');



    INSERT INTO field_plantation (id_field_plantation, id_field, id_type_plantation, density, surface_covered, plant_weight, insertion_date) VALUES
        ('FIL'||nextval('s_field_plantation'), 'FILD0001', 'PLNT0001', 1, 0.01, 1, TO_DATE('06-20-2023', 'MM-dd-YYYY')),
        ('FIL'||nextval('s_field_plantation'), 'FILD0002', 'PLNT0001', 1, 0.01, 1, TO_DATE('06-20-2023', 'MM-dd-YYYY')),
        ('FIL'||nextval('s_field_plantation'), 'FILD0001', 'PLNT0001', 1, 0.01, 1, TO_DATE('06-20-2023', 'MM-dd-YYYY')),
        ('FIL'||nextval('s_field_plantation'), 'FILD0002', 'PLNT0001', 1, 0.01, 1, TO_DATE('06-20-2023', 'MM-dd-YYYY')),
        ('FIL'||nextval('s_field_plantation'), 'FILD0003', 'PLNT0002', 1, 0.01, 1, TO_DATE('06-20-2023', 'MM-dd-YYYY')),
        ('FIL'||nextval('s_field_plantation'), 'FILD0004', 'PLNT0002', 1, 0.01, 1, TO_DATE('06-20-2023', 'MM-dd-YYYY')),
        ('FIL'||nextval('s_field_plantation'), 'FILD0003', 'PLNT0002', 1, 0.01, 1, TO_DATE('06-20-2023', 'MM-dd-YYYY')),
        ('FIL'||nextval('s_field_plantation'), 'FILD0004', 'PLNT0002', 1, 0.01, 1, TO_DATE('06-20-2023', 'MM-dd-YYYY'));


    INSERT INTO fish_pond (id_fish_pond, id_type_fish, id_pond, fish_gender, quantity, insertion_date) VALUES
    ('FIP1','FISH0001','POND0001',TRUE,56,TO_DATE('06-20-220023', 'MM-dd-YYYY')),
    ('FIP2','FISH0001','POND002002',FALSE,50,TO_DATE('06-20-2023', 'MM-dd-YYYY')),
    ('FIP3','FISH0002','POND0003',TRUE,44,TO_DATE('06-20-2023', 'MM-dd-YYYY')),
    ('FIP4','FISH0002','POND0004',FALSE,48,TO_DATE('06-20-2023', 'MM-dd-YYYY'));

    insert into report_pond (id_report_pond, id_fish_pond, report_date_pond, alive_fish_number, dead_fish_number) values
        ('RPD'||nextval('s_report_pond'), 'FIP1', to_date('2023-07-20','yyyy-mm-dd'), 50, 6),
        ('RPD'||nextval('s_report_pond'), 'FIP2', to_date('2023-07-20','yyyy-mm-dd'), 45, 5),
        ('RPD'||nextval('s_report_pond'), 'FIP3', to_date('2023-07-20','yyyy-mm-dd'), 44, 2),
        ('RPD'||nextval('s_report_pond'), 'FIP4', to_date('2023-07-20','yyyy-mm-dd'), 40, 8);

    insert into report_field (id_report_field, id_field_plantation, report_date_field, plant_weight, density, surface_covered) values 
        ('RPF'||nextval('s_report_field'), 'FIL1', to_date('2023-07-20', 'yyyy-mm-dd'), 20, 22, 9.12),
        ('RPF'||nextval('s_report_field'), 'FIL2', to_date('2023-07-20', 'yyyy-mm-dd'), 15, 24, 9.10),
        ('RPF'||nextval('s_report_field'), 'FIL3', to_date('2023-07-20', 'yyyy-mm-dd'), 21, 21, 9.9),
        ('RPF'||nextval('s_report_field'), 'FIL4', to_date('2023-07-20', 'yyyy-mm-dd'), 14, 23, 8.9),
        ('RPF'||nextval('s_report_field'), 'FIL5', to_date('2023-07-20', 'yyyy-mm-dd'), 12, 26, 9.4),
        ('RPF'||nextval('s_report_field'), 'FIL6', to_date('2023-07-20', 'yyyy-mm-dd'), 20, 25, 8.9),
        ('RPF'||nextval('s_report_field'), 'FIL7', to_date('2023-07-20', 'yyyy-mm-dd'), 19, 27, 9.1),
        ('RPF'||nextval('s_report_field'), 'FIL8', to_date('2023-07-20', 'yyyy-mm-dd'), 11, 29, 8.5);
        
 
    insert into sale_fish (id_sale_fish, id_fish_pond, quantity_sold, sale_date) values 
        ('SFS'||nextval('s_sale_fish'), 'FIP1', 14, to_date('2023-08-20', 'yyyy-mm-dd')),
        ('SFS'||nextval('s_sale_fish'), 'FIP2', 5, to_date('2023-08-20', 'yyyy-mm-dd')),
        ('SFS'||nextval('s_sale_fish'), 'FIP3', 9, to_date('2023-08-20', 'yyyy-mm-dd')),
        ('SFS'||nextval('s_sale_fish'), 'FIP4', 4, to_date('2023-08-20', 'yyyy-mm-dd'));

    insert into sale_plantation (id_sale_plantation, id_field_plantation, quantity_sold, sale_date) values
        ('SPL'||nextval('s_sale_plantation'), 'FIL1', 32, TO_DATE('08-12-2023', 'MM-dd-YYYY')), -- Nombre de plant (ou fruit) vendue ilay 62
        ('SPL'||nextval('s_sale_plantation'), 'FIL2', 20, TO_DATE('08-12-2023', 'MM-dd-YYYY')),
        ('SPL'||nextval('s_sale_plantation'), 'FIL3', 15, TO_DATE('08-12-2023', 'MM-dd-YYYY')), -- Nombre de plant (ou fruit) vendue ilay 62
        ('SPL'||nextval('s_sale_plantation'), 'FIL4', 10, TO_DATE('08-12-2023', 'MM-dd-YYYY')),
        ('SPL'||nextval('s_sale_plantation'), 'FIL5', 18, TO_DATE('08-12-2023', 'MM-dd-YYYY')), -- Nombre de plant (ou fruit) vendue ilay 62
        ('SPL'||nextval('s_sale_plantation'), 'FIL6', 13, TO_DATE('08-12-2023', 'MM-dd-YYYY')),
        ('SPL'||nextval('s_sale_plantation'), 'FIL7', 17, TO_DATE('08-12-2023', 'MM-dd-YYYY')), -- Nombre de plant (ou fruit) vendue ilay 62
        ('SPL'||nextval('s_sale_plantation'), 'FIL8', 20, TO_DATE('08-12-2023', 'MM-dd-YYYY'));

    insert into price_fish (id_price_fish, id_type_fish, unit_fish_price, price_category) values
        ('PFSH0001', 'FISH0001', 7000, 1),
        ('PFSH0002', 'FISH0001', 65000, 11),
        ('PFSH0003', 'FISH0001', 100000, 21);

    insert into price_plantation (id_price_plantation, id_type_plantation, unit_plant_price) values
        ('PPLT0001', 'PLNT0001', 1000),
        ('PPLT0002', 'PLNT0001', 1500);