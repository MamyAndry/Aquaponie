--get the recent field_plantation of one field
create or replace function f_get_recent_field_plantation(id_field_seak varchar(8))
    returns table (id_field_plantation varchar(8))
    language plpgsql
    as 
    $$
    begin
        return query
        select f.id_field_plantation from field_plantation f
        where f.id_field = id_field_seak  
        order by f.id_field_plantation
         desc limit 1;
    end;
    $$;

-- select * from f_get_recent_field_plantation('FILD0001');
--get the last report of one field_plantation
create or replace function f_get_last_field_plantation_report(id_recent_field_plantation varchar(8))
    returns table (
        id_report_field varchar(8),
        id_field_plantation varchar(8),
        report_date_field date ,
        plant_weight decimal(10,2) , 
        density decimal(10,2),
        surface_covered decimal(10,2),
        actual_quantity decimal(10,2)

    )
    language plpgsql
    as 
    $$
    begin
        return query 
        select r.id_report_field,
        r.id_field_plantation,
        r.report_date_field,
        r.plant_weight,
        r.density,
        r.surface_covered,
        r.surface_covered*r.density 
         from  report_field r
        where r.id_field_plantation= id_recent_field_plantation 
        order by report_date_field desc limit 1;
    end;
    $$;
-- select * from f_get_last_field_plantation_report('FIL2');

--get all the saling after the date report of one field_plantation
    create or replace function f_get_count_last_field_plantation_saling(id_recent_field_plantation varchar(8))
        returns table (plantation_sale bigint)

        language plpgsql
        as 
        $$
        declare
            last_date_report_field date;
            quantity bigint;
        begin
            select report_date_field into last_date_report_field from f_get_last_field_plantation_report(id_recent_field_plantation);
            select  sum(quantity_sold) into quantity from sale_plantation where id_field_plantation = id_recent_field_plantation and sale_date > last_date_report_field;
            if quantity is null then 
                quantity = 0;
            end if;
            return query
            select quantity;

        end;
        $$;

-- select * from f_get_count_last_field_plantation_saling('FIL2');
    
--get actual number of plant in one field_plantation including those are saling
create or replace function f_get_actual_field_plantation_number(id_recent_field_plantation varchar(8))
    returns table(plant_actual_number decimal(10,2))

    language plpgsql
    as 
    $$
    declare
        last_report_field_number decimal(10,2);
        plant_sale_number decimal(10,2);
    begin
        select actual_quantity into last_report_field_number from f_get_last_field_plantation_report(id_recent_field_plantation);
        select plantation_sale into plant_sale_number from f_get_count_last_field_plantation_saling(id_recent_field_plantation);

        return query
        select last_report_field_number - plant_sale_number;
        
    end;
    $$;
-- select * from f_get_actual_field_plantation_number('FIL2');


create or replace function f_actual_field_state()
    returns table(actual_field_state decimal(10,2))

    language plpgsql
    as 
    $$
    declare
        plant_number decimal(10,2) = 0;
        temp_number decimal(10,2);
        field_plantation varchar(8);
        field VARCHAR(8); 
    begin
        for field in select id_field from field
        loop
            select id_field_plantation into field_plantation from f_get_recent_field_plantation(field);
          
            select plant_actual_number into temp_number from f_get_actual_field_plantation_number(field_plantation);
            plant_number = plant_number + temp_number;
        end loop;
        
        return query
        select plant_number;
    end;
    $$;

-- select * from  f_actual_field_state();

