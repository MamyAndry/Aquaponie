    insert into type_fish (id_type_fish, name_type_fish, maturity_period, maturity_size, weight_max_little, weight_max_average, size_max_little, size_max_average) values 
        ('FISH0001', 'Tilapia', 24, 15, 250, 500, 5, 10); --valeur min : 24 mois -> 15 cm

    insert into type_plantation (id_type_plantation, name_type_plantation, weight_max_baby, weight_max_semi_mature) values
        ('PLNT0001', 'Cresson', 5, 20);

    insert into pond(id_pond, capacity) values
        ('POND0001', 3785),
        ('POND0002', 3785);

    insert into pond_details (id_pond_details, id_pond, id_type_fish, max_quantity) values
        (nextval('s_pond_details'), 'POND0001', 'FISH0001', 50),
        (nextval('s_pond_details'), 'POND0002', 'FISH0001', 50);

    insert into field(id_field) values 
        ('FILD0001'),
        ('FILD0002');

    insert into field_plantation (id_field_plantation, id_field, id_type_plantation, density, surface_covered, plant_weight,insertion_date) values
        (nextval('s_field_plantation'), 'FILD0001', 'PLNT0001', 1, 0.01, 1, TO_DATE('06-20-2023', 'MM-dd-YYYY')),
        (nextval('s_field_plantation'), 'FILD0002', 'PLNT0001', 1, 0.01, 1, TO_DATE('06-20-2023', 'MM-dd-YYYY'));

    insert into fish_pond (id_fish_pond, id_type_fish, id_pond, fish_gender, quantity, insertion_date) values

        (nextval('s_fish_pond'), 'FISH0001', 'POND0001', true, 50, TO_DATE('06-20-2023', 'MM-dd-YYYY')),
        (nextval('s_fish_pond'), 'FISH0001', 'POND0002', false, 50, TO_DATE('06-20-2023', 'MM-dd-YYYY'));


    insert into report_pond (id_report_pond, id_fish_pond, report_date_pond, alive_fish_number, dead_fish_number) values
        (nextval('s_report_pond'), 1, to_date('2023-07-20','yyyy-mm-dd'), 44, 6),
        (nextval('s_report_pond'), 2, to_date('2023-07-20','yyyy-mm-dd'), 45, 5);

    insert into report_field (id_report_field, id_field_plantation, report_date_field, plant_weight, density, surface_covered) values 
        (nextval('s_report_field'), 1, to_date('2023-07-20', 'yyyy-mm-dd'), 20, 22, 9.12),
        (nextval('s_report_field'), 2, to_date('2023-07-20', 'yyyy-mm-dd'), 15, 27, 9.5);

    insert into sale_fish (id_sale_fish, id_fish_pond, quantity_sold, sale_date) values 
        (nextval('s_sale_fish'), 1, 14, to_date('2023-07-21', 'yyyy-mm-dd')),
        (nextval('s_sale_fish'), 2, 1, to_date('2023-07-21', 'yyyy-mm-dd'));

    insert into sale_plantation (id_sale_plantation, id_field_plantation, quantity_sold, sale_date) values
        (nextval('s_sale_plantation'), 1, 62, TO_DATE('07-21-2023', 'MM-dd-YYYY')), -- Nombre de plant (ou fruit) vendue ilay 62
        (nextval('s_sale_plantation'), 2, 23, TO_DATE('07-21-2023', 'MM-dd-YYYY'));

    insert into price_fish (id_price_fish, id_type_fish, unit_fish_price, price_category) values
        ('PFSH0001', 'FISH0001', 1000, 1),
        ('PFSH0002', 'FISH0001', 2000, 11),
        ('PFSH0003', 'FISH0001', 4000, 21);

    insert into price_plantation (id_price_plantation, id_type_plantation, unit_plant_price) values
        ('PPLT0001', 'PLNT0001', 30);
