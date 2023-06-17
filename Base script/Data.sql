insert into type_fish (id_type_fish, name_type_fish, maturity_period, maturity_size) values 
    ('FISH0001', 'Tilapia', 24, 15); --valeur min : 24 mois -> 15 cm

insert into type_plantation (id_type_plantation, name_type_plantation) values
    ('PLNT0001', 'Cresson');

insert into pond(id_pond, capacity) values
    ('POND0001', 3785),
    ('POND0002', 3785);

insert into pond_details (id_pond_details, id_pond, id_type_fish, max_quantity) values
    (nextval('s_pond_details'), 'POND0001', 'FISH0001', 50),
    (nextval('s_pond_details'), 'POND0002', 'FISH0001', 50);

insert into field (id_field, max_surface) values
    ('FILD0001', 10.15),
    ('FILD0002', 10.00); -- Ie 10 gramma mihitsy ireny @ voalohany 

insert into field_plantation (id_field_plantation, id_field, id_type_plantation, plant_number, insertion_date) values
    (nextval('s_field_plantation'), 'FILD0001', 'PLNT0001', 69 '2023-05-15'),
    (nextval('s_field_plantation'), 'FILD0002', 'PLNT0001', 95 '2023-05-1');

insert into fish_pond(id_fish_pond, id_type_fish, id_pond, fish_gender, quantity, insertion_date) values
    (nextval('s_fish_pond'), 'FISH0001', 'POND0001', true, 44, '2023-05-15'),
    (nextval('s_fish_pond'), 'FISH0001', 'POND0002', false, 50, '2023-05-15');

insert into report_pond(id_report_pond, report_date_pond, id_fish_pond, alive_fish_number, dead_fish_number) values
    (nextval('s_report_pond'), '2023-06-15', 1, 40, 4),
    (nextval('s_report_pond'), '2023-06-15', 2, 40, 10);

insert into report_field(id_report_field, id_field_plantation, report_date_field, one_plant_weight, plant_per_squaremeter, surface_covered) values
    (nextval('s_report_field'), 1, '2023-06-15', 20, 26, 10.2),
    (nextval('s_report_field'), 2, '2023-06-15', 14, 32, 10);

insert into sale_fish(id_sale_fish, id_fish_pond, quantity_sold, sale_date) values
    (nextval('s_sale_fish'), 1, 16, '2023-06-17'),
    (nextval('s_sale_fish'), 2, 22, '2023-06-17');

insert into sale_plantation(id_sale_plantation, id_field_plantation, quantity_sold, sale_date) values
    (nextval('s_sale_plantation'), 1, 25, '2023-06-17' ),
    (nextval('s_sale_plantation'), 2, 25, '2023-06-17' );