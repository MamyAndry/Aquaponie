--get all pond id

create or replace view v_get_pond as 
    select id_pond from pond;

--get the recent fish_pond of one pond
    create  or replace function f_get_recent_fish_pond(id_pond_seak varchar(8))
    returns table (id_fish_pond varchar(8))
    language plpgsql
    as 
    $$
    begin
        return query
        select f.id_fish_pond from fish_pond f
        where f.id_pond=id_pond_seak  
        order by insertion_date
         desc limit 1;
    end;
    $$;


--get the last report of one fish_pond
create or replace function f_get_last_fish_pond_report(id_recent_fish_pond varchar(8))
    returns table (
        id_report_pond varchar(8),
        id_fish_pond varchar(8) ,
        report_date_pond date,
        fish_number int,
        category int
    )
    language plpgsql
    as 
    $$
    begin
        return query 
        select r.id_report_pond,r.id_fish_pond,r.report_date_pond,r.alive_fish_number-r.dead_fish_number,r.category
         from  report_pond r
        where r.id_fish_pond= id_recent_fish_pond 
        order by report_date_pond desc limit 1;
    end;
    $$;

--get all the saling after the date report of one fish_pond
    create or replace function f_get_count_last_fish_pond_saling( id_recent_fish_pond varchar(8))
        returns table (fish_sale bigint)

        language plpgsql
        as 
        $$
        declare
            last_date_report_pond date;
            quantity bigint;
        begin
            select report_date_pond into last_date_report_pond from f_get_last_fish_pond_report(id_recent_fish_pond);
            select sum(quantity_sold)  into quantity from sale_fish where id_fish_pond = id_recent_fish_pond and sale_date > last_date_report_pond;
            if quantity is null then
                quantity = 0;
            end if;
            return query
            select quantity;
            
        end;
        $$;

--get actual number of fish in one fish_pond including those are saling
create or replace function f_get_actual_fish_pond_number(id_recent_fish_pond varchar(8))
    returns table(fish_actual_number bigint)

    language plpgsql
    as 
    $$
    declare
        last_report_pond_number int;
        fish_sale_number bigint;
    begin
        select fish_number into last_report_pond_number from f_get_last_fish_pond_report(id_recent_fish_pond);
        select fish_sale into fish_sale_number from f_get_count_last_fish_pond_saling(id_recent_fish_pond);

        return query
        select last_report_pond_number - fish_sale_number;
        
    end;
    $$;

create or replace function f_actual_pond_state()
    returns table(actual_pond_state bigint)
    language plpgsql
    as 
    $$
    declare
        fish_number bigint = 0;
        temp_number bigint;
        fish_pond varchar(8);
        pond_id VARCHAR(8);
    begin
        FOR pond_id IN (SELECT id_pond FROM v_get_pond)
        LOOP
            select id_fish_pond into fish_pond from f_get_recent_fish_pond(pond_id);
            RAISE NOTICE 'Fish Pond: %', fish_pond;
            IF fish_pond IS NULL THEN
                CONTINUE;
            END IF;
            select fish_actual_number into temp_number from f_get_actual_fish_pond_number(fish_pond);
            IF temp_number IS NULL THEN
                CONTINUE;
            END IF;
            fish_number = fish_number + temp_number;

        END LOOP;
        
        return query
        select fish_number;
    end;
    $$;

