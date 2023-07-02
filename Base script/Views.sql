--get all pond id
create view v_get_pond as 
    select id_pond from pond

--get the recent fish_pond of one pond
    create function f_get_recent_fish_pond(id_pond_seak varchar(8))
    returns table (id_fish_pond int)
    language plpgsql
    as 
    $$
    begin
        return query
        select f.id_fish_pond from fish_pond f
        where f.id_pond=id_pond_seak  
        order by id_fish_pond
         desc limit 1;
    end;
    $$;


--get the last report of one fish_pond
create function f_get_last_fish_pond_report(id_recent_fish_pond int)
    returns table (
        id_report_pond int,
        id_fish_pond int ,
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
    create function f_get_count_last_fish_pond_saling(id_recent_fish_pond int)
        returns table (fish_sale bigint)

        language plpgsql
        as 
        $$
        declare
            last_date_report_pond date;
        begin
            select report_date_pond into last_date_report_pond from f_get_last_fish_pond_report(id_recent_fish_pond);
            return query
            select sum(quantity_sold)  from sale_fish where id_fish_pond = id_recent_fish_pond and sale_date > last_date_report_pond;

        end;
        $$;

--get actual number of fish in one fish_pond including those are saling
create function f_get_actual_fish_pond_number(id_recent_fish_pond int)
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

create function f_actual_pond_state()
    returns table(actual_pond_state bigint)

    language plpgsql
    as 
    $$
    declare
        fish_number bigint = 0;
        temp_number bigint;
        fish_pond int;
        pond VARCHAR(8); 
    begin
        for pond in select id_pond from v_get_pond
        loop
            select id_fish_pond into fish_pond from f_get_recent_fish_pond(pond);
          
            select fish_actual_number into temp_number from f_get_actual_fish_pond_number(fish_pond);
            fish_number = fish_number + temp_number;
        end loop;
        
        return query
        select fish_number;
    end;
    $$;
