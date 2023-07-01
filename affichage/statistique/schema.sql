create table unite (
    id_unite varchar(8) primary key ,
    nom varchar(255) not null
);
create sequence s_unite start 1 increment 1;
insert into unite values ('UNIT000'||nextval('s_unite'),'Kg'), ('UNIT000'||nextval('s_unite'),'Mois'), ('UNIT000'||nextval('s_unite'),'cm');

create or replace view v_details_ponds
    as
    select t_f.*, d_p.id_pond_details, d_p.id_pond, d_p.max_quantity, p.capacity
    from pond_details as d_p
    join type_fish as t_f
    on d_p.id_type_fish = t_f.id_type_fish
    join pond as p
    on p.id_pond = d_p.id_pond;

create or replace view v_fishs_ponds
    as
    select p.*, f_p.id_fish_pond, f_p.fish_gender, f_p.quantity, f_p.insertion_date
    from v_details_ponds as p
    join fish_pond as f_p
    on p.id_pond = f_p.id_pond and f_p.id_type_fish = p.id_type_fish;

create or replace view details_fields
as
select t_p.*,f_p.id_field_plantation, f_p.id_field, f_p.density, f_p.surface_covered, f_p.plant_weight, f_p.insertion_date
from field_plantation as f_p
         join type_plantation as t_p
              on f_p.id_type_plantation = t_p.id_type_plantation;