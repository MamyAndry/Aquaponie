create table unite (
    id_unite varchar(8) primary key ,
    nom varchar(255) not null
);
create sequence s_unite start 1 increment 1;
insert into unite values ('UNIT000'||nextval('s_unite'),'Kg'), ('UNIT000'||nextval('s_unite'),'Mois'), ('UNIT000'||nextval('s_unite'),'cm');

create or replace view details_ponds
    as
    select t_f.*, d_p.id_pond_details, d_p.id_pond, d_p.max_quantity
    from pond_details as d_p
    join type_fish as t_f
    on d_p.id_type_fish = t_f.id_type_fish;