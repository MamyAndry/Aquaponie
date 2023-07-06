--
-- PostgreSQL database dump
--

-- Dumped from database version 15.3
-- Dumped by pg_dump version 15.3

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: f_actual_pond_state(); Type: FUNCTION; Schema: public; Owner: rakharrs
--

CREATE FUNCTION public.f_actual_pond_state() RETURNS TABLE(actual_pond_state bigint)
    LANGUAGE plpgsql
    AS $$
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


ALTER FUNCTION public.f_actual_pond_state() OWNER TO rakharrs;

--
-- Name: f_get_actual_fish_pond_number(character varying); Type: FUNCTION; Schema: public; Owner: rakharrs
--

CREATE FUNCTION public.f_get_actual_fish_pond_number(id_recent_fish_pond character varying) RETURNS TABLE(fish_actual_number bigint)
    LANGUAGE plpgsql
    AS $$
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


ALTER FUNCTION public.f_get_actual_fish_pond_number(id_recent_fish_pond character varying) OWNER TO rakharrs;

--
-- Name: f_get_count_last_fish_pond_saling(character varying); Type: FUNCTION; Schema: public; Owner: rakharrs
--

CREATE FUNCTION public.f_get_count_last_fish_pond_saling(id_recent_fish_pond character varying) RETURNS TABLE(fish_sale bigint)
    LANGUAGE plpgsql
    AS $$
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


ALTER FUNCTION public.f_get_count_last_fish_pond_saling(id_recent_fish_pond character varying) OWNER TO rakharrs;

--
-- Name: f_get_last_fish_pond_report(character varying); Type: FUNCTION; Schema: public; Owner: rakharrs
--

CREATE FUNCTION public.f_get_last_fish_pond_report(id_recent_fish_pond character varying) RETURNS TABLE(id_report_pond character varying, id_fish_pond character varying, report_date_pond date, fish_number integer, category integer)
    LANGUAGE plpgsql
    AS $$
    begin
        return query 
        select r.id_report_pond,r.id_fish_pond,r.report_date_pond,r.alive_fish_number-r.dead_fish_number,r.category
         from  report_pond r
        where r.id_fish_pond= id_recent_fish_pond 
        order by report_date_pond desc limit 1;
    end;
    $$;


ALTER FUNCTION public.f_get_last_fish_pond_report(id_recent_fish_pond character varying) OWNER TO rakharrs;

--
-- Name: f_get_recent_fish_pond(character varying); Type: FUNCTION; Schema: public; Owner: rakharrs
--

CREATE FUNCTION public.f_get_recent_fish_pond(id_pond_seak character varying) RETURNS TABLE(id_fish_pond character varying)
    LANGUAGE plpgsql
    AS $$
BEGIN
    RETURN QUERY
    SELECT COALESCE(f.id_fish_pond, '0') FROM fish_pond f
    WHERE f.id_pond = id_pond_seak
    ORDER BY insertion_date DESC
    LIMIT 1;
END;
$$;


ALTER FUNCTION public.f_get_recent_fish_pond(id_pond_seak character varying) OWNER TO rakharrs;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: aqua_user; Type: TABLE; Schema: public; Owner: rakharrs
--

CREATE TABLE public.aqua_user (
    id_user character varying(8) NOT NULL,
    id_profile character varying(8),
    name character varying(20),
    identifier character varying(20),
    password character varying(200)
);


ALTER TABLE public.aqua_user OWNER TO rakharrs;

--
-- Name: field_plantation; Type: TABLE; Schema: public; Owner: rakharrs
--

CREATE TABLE public.field_plantation (
    id_field_plantation character varying(8) NOT NULL,
    id_field character varying(8),
    id_type_plantation character varying(8),
    density integer,
    surface_covered numeric(10,2),
    plant_weight numeric(10,2),
    insertion_date date NOT NULL
);


ALTER TABLE public.field_plantation OWNER TO rakharrs;

--
-- Name: type_plantation; Type: TABLE; Schema: public; Owner: rakharrs
--

CREATE TABLE public.type_plantation (
    id_type_plantation character varying(8) NOT NULL,
    name_type_plantation character varying(40) NOT NULL,
    weight_max_baby double precision NOT NULL,
    weight_max_semi_mature double precision NOT NULL
);


ALTER TABLE public.type_plantation OWNER TO rakharrs;

--
-- Name: details_fields; Type: VIEW; Schema: public; Owner: rakharrs
--

CREATE VIEW public.details_fields AS
 SELECT t_p.id_type_plantation,
    t_p.name_type_plantation,
    t_p.weight_max_baby,
    t_p.weight_max_semi_mature,
    f_p.id_field_plantation,
    f_p.id_field,
    f_p.density,
    f_p.surface_covered,
    f_p.plant_weight,
    f_p.insertion_date
   FROM (public.field_plantation f_p
     JOIN public.type_plantation t_p ON (((f_p.id_type_plantation)::text = (t_p.id_type_plantation)::text)));


ALTER TABLE public.details_fields OWNER TO rakharrs;

--
-- Name: fish_pond; Type: TABLE; Schema: public; Owner: rakharrs
--

CREATE TABLE public.fish_pond (
    id_fish_pond character varying(8) NOT NULL,
    id_type_fish character varying(8),
    id_pond character varying(8),
    fish_gender boolean NOT NULL,
    quantity integer NOT NULL,
    insertion_date date NOT NULL
);


ALTER TABLE public.fish_pond OWNER TO rakharrs;

--
-- Name: pond; Type: TABLE; Schema: public; Owner: rakharrs
--

CREATE TABLE public.pond (
    id_pond character varying(8) NOT NULL,
    capacity integer NOT NULL
);


ALTER TABLE public.pond OWNER TO rakharrs;

--
-- Name: pond_details; Type: TABLE; Schema: public; Owner: rakharrs
--

CREATE TABLE public.pond_details (
    id_pond_details character varying(8) NOT NULL,
    id_pond character varying(8),
    id_type_fish character varying(8),
    max_quantity integer NOT NULL
);


ALTER TABLE public.pond_details OWNER TO rakharrs;

--
-- Name: sale_fish; Type: TABLE; Schema: public; Owner: rakharrs
--

CREATE TABLE public.sale_fish (
    id_sale_fish character varying(8) NOT NULL,
    id_fish_pond character varying(8),
    quantity_sold integer NOT NULL,
    sale_date date NOT NULL
);


ALTER TABLE public.sale_fish OWNER TO rakharrs;

--
-- Name: type_fish; Type: TABLE; Schema: public; Owner: rakharrs
--

CREATE TABLE public.type_fish (
    id_type_fish character varying(8) NOT NULL,
    name_type_fish character varying(40) NOT NULL,
    maturity_period numeric(3,1) NOT NULL,
    maturity_size integer NOT NULL,
    weight_max_little double precision NOT NULL,
    weight_max_average double precision NOT NULL,
    size_max_little double precision NOT NULL,
    size_max_average double precision NOT NULL
);


ALTER TABLE public.type_fish OWNER TO rakharrs;

--
-- Name: v_details_ponds; Type: VIEW; Schema: public; Owner: rakharrs
--

CREATE VIEW public.v_details_ponds AS
 SELECT t_f.id_type_fish,
    t_f.name_type_fish,
    t_f.maturity_period,
    t_f.maturity_size,
    t_f.weight_max_little,
    t_f.weight_max_average,
    t_f.size_max_little,
    t_f.size_max_average,
    d_p.id_pond_details,
    d_p.id_pond,
    d_p.max_quantity,
    p.capacity
   FROM ((public.pond_details d_p
     JOIN public.type_fish t_f ON (((d_p.id_type_fish)::text = (t_f.id_type_fish)::text)))
     JOIN public.pond p ON (((p.id_pond)::text = (d_p.id_pond)::text)));


ALTER TABLE public.v_details_ponds OWNER TO rakharrs;

--
-- Name: v_fishs_ponds; Type: VIEW; Schema: public; Owner: rakharrs
--

CREATE VIEW public.v_fishs_ponds AS
 SELECT p.id_type_fish,
    p.name_type_fish,
    p.maturity_period,
    p.maturity_size,
    p.weight_max_little,
    p.weight_max_average,
    p.size_max_little,
    p.size_max_average,
    p.id_pond_details,
    p.id_pond,
    p.max_quantity,
    p.capacity,
    f_p.id_fish_pond,
    f_p.fish_gender,
    f_p.quantity,
    f_p.insertion_date
   FROM (public.v_details_ponds p
     JOIN public.fish_pond f_p ON ((((p.id_pond)::text = (f_p.id_pond)::text) AND ((f_p.id_type_fish)::text = (p.id_type_fish)::text))));


ALTER TABLE public.v_fishs_ponds OWNER TO rakharrs;

--
-- Name: details_fish_sold; Type: VIEW; Schema: public; Owner: rakharrs
--

CREATE VIEW public.details_fish_sold AS
 SELECT v.id_pond,
    v.name_type_fish,
    s_f.quantity_sold,
    s_f.sale_date
   FROM (public.v_fishs_ponds v
     JOIN public.sale_fish s_f ON (((v.id_fish_pond)::text = (s_f.id_fish_pond)::text)));


ALTER TABLE public.details_fish_sold OWNER TO rakharrs;

--
-- Name: sale_plantation; Type: TABLE; Schema: public; Owner: rakharrs
--

CREATE TABLE public.sale_plantation (
    id_sale_plantation character varying(8) NOT NULL,
    id_field_plantation character varying(8),
    quantity_sold integer NOT NULL,
    sale_date date NOT NULL
);


ALTER TABLE public.sale_plantation OWNER TO rakharrs;

--
-- Name: details_plantation_sold; Type: VIEW; Schema: public; Owner: rakharrs
--

CREATE VIEW public.details_plantation_sold AS
 SELECT v.id_field_plantation,
    v.name_type_plantation,
    s_f.quantity_sold,
    s_f.sale_date
   FROM (public.details_fields v
     JOIN public.sale_plantation s_f ON (((v.id_field_plantation)::text = (s_f.id_field_plantation)::text)));


ALTER TABLE public.details_plantation_sold OWNER TO rakharrs;

--
-- Name: details_pond_fish_pond; Type: VIEW; Schema: public; Owner: rakharrs
--

CREATE VIEW public.details_pond_fish_pond AS
 SELECT p.id_pond,
    f_p.id_fish_pond,
    f_p.id_type_fish,
    f_p.fish_gender,
    f_p.quantity,
    p.capacity,
    f_p.insertion_date
   FROM (public.fish_pond f_p
     JOIN public.pond p ON (((f_p.id_pond)::text = (p.id_pond)::text)))
  WHERE (f_p.quantity > 0);


ALTER TABLE public.details_pond_fish_pond OWNER TO rakharrs;

--
-- Name: details_pond_fish_pond_v2; Type: VIEW; Schema: public; Owner: rakharrs
--

CREATE VIEW public.details_pond_fish_pond_v2 AS
 SELECT det.id_pond,
    det.id_fish_pond,
    ty.name_type_fish,
    det.quantity,
    det.insertion_date
   FROM (public.details_pond_fish_pond det
     JOIN public.type_fish ty ON (((det.id_type_fish)::text = (ty.id_type_fish)::text)));


ALTER TABLE public.details_pond_fish_pond_v2 OWNER TO rakharrs;

--
-- Name: field; Type: TABLE; Schema: public; Owner: rakharrs
--

CREATE TABLE public.field (
    id_field character varying(8) NOT NULL
);


ALTER TABLE public.field OWNER TO rakharrs;

--
-- Name: month; Type: TABLE; Schema: public; Owner: rakharrs
--

CREATE TABLE public.month (
    id_month integer NOT NULL,
    name character varying(20)
);


ALTER TABLE public.month OWNER TO rakharrs;

--
-- Name: month_id_month_seq; Type: SEQUENCE; Schema: public; Owner: rakharrs
--

CREATE SEQUENCE public.month_id_month_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.month_id_month_seq OWNER TO rakharrs;

--
-- Name: month_id_month_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: rakharrs
--

ALTER SEQUENCE public.month_id_month_seq OWNED BY public.month.id_month;


--
-- Name: price_fish; Type: TABLE; Schema: public; Owner: rakharrs
--

CREATE TABLE public.price_fish (
    id_price_fish character varying(8) NOT NULL,
    id_type_fish character varying(8),
    unit_fish_price double precision NOT NULL,
    price_category integer NOT NULL
);


ALTER TABLE public.price_fish OWNER TO rakharrs;

--
-- Name: price_plantation; Type: TABLE; Schema: public; Owner: rakharrs
--

CREATE TABLE public.price_plantation (
    id_price_plantation character varying(8) NOT NULL,
    id_type_plantation character varying(8),
    unit_plant_price double precision NOT NULL
);


ALTER TABLE public.price_plantation OWNER TO rakharrs;

--
-- Name: profile; Type: TABLE; Schema: public; Owner: rakharrs
--

CREATE TABLE public.profile (
    id_profile character varying(8) NOT NULL,
    name character varying(20)
);


ALTER TABLE public.profile OWNER TO rakharrs;

--
-- Name: report_field; Type: TABLE; Schema: public; Owner: rakharrs
--

CREATE TABLE public.report_field (
    id_report_field character varying(8) NOT NULL,
    id_field_plantation character varying(8),
    report_date_field date NOT NULL,
    plant_weight numeric(10,2) NOT NULL,
    density numeric(10,2) NOT NULL,
    surface_covered numeric(10,2) NOT NULL
);


ALTER TABLE public.report_field OWNER TO rakharrs;

--
-- Name: report_pond; Type: TABLE; Schema: public; Owner: rakharrs
--

CREATE TABLE public.report_pond (
    id_report_pond character varying(8) NOT NULL,
    id_fish_pond character varying(8),
    report_date_pond date NOT NULL,
    alive_fish_number integer,
    dead_fish_number integer,
    category integer
);


ALTER TABLE public.report_pond OWNER TO rakharrs;

--
-- Name: s_field; Type: SEQUENCE; Schema: public; Owner: rakharrs
--

CREATE SEQUENCE public.s_field
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.s_field OWNER TO rakharrs;

--
-- Name: s_field_plantation; Type: SEQUENCE; Schema: public; Owner: rakharrs
--

CREATE SEQUENCE public.s_field_plantation
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.s_field_plantation OWNER TO rakharrs;

--
-- Name: s_fish_pond; Type: SEQUENCE; Schema: public; Owner: rakharrs
--

CREATE SEQUENCE public.s_fish_pond
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.s_fish_pond OWNER TO rakharrs;

--
-- Name: s_pond; Type: SEQUENCE; Schema: public; Owner: rakharrs
--

CREATE SEQUENCE public.s_pond
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.s_pond OWNER TO rakharrs;

--
-- Name: s_pond_details; Type: SEQUENCE; Schema: public; Owner: rakharrs
--

CREATE SEQUENCE public.s_pond_details
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.s_pond_details OWNER TO rakharrs;

--
-- Name: s_price_fish; Type: SEQUENCE; Schema: public; Owner: rakharrs
--

CREATE SEQUENCE public.s_price_fish
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.s_price_fish OWNER TO rakharrs;

--
-- Name: s_price_plantation; Type: SEQUENCE; Schema: public; Owner: rakharrs
--

CREATE SEQUENCE public.s_price_plantation
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.s_price_plantation OWNER TO rakharrs;

--
-- Name: s_report_field; Type: SEQUENCE; Schema: public; Owner: rakharrs
--

CREATE SEQUENCE public.s_report_field
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.s_report_field OWNER TO rakharrs;

--
-- Name: s_report_pond; Type: SEQUENCE; Schema: public; Owner: rakharrs
--

CREATE SEQUENCE public.s_report_pond
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.s_report_pond OWNER TO rakharrs;

--
-- Name: s_sale_fish; Type: SEQUENCE; Schema: public; Owner: rakharrs
--

CREATE SEQUENCE public.s_sale_fish
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.s_sale_fish OWNER TO rakharrs;

--
-- Name: s_sale_plantation; Type: SEQUENCE; Schema: public; Owner: rakharrs
--

CREATE SEQUENCE public.s_sale_plantation
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.s_sale_plantation OWNER TO rakharrs;

--
-- Name: s_type_fish; Type: SEQUENCE; Schema: public; Owner: rakharrs
--

CREATE SEQUENCE public.s_type_fish
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.s_type_fish OWNER TO rakharrs;

--
-- Name: s_type_plantation; Type: SEQUENCE; Schema: public; Owner: rakharrs
--

CREATE SEQUENCE public.s_type_plantation
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.s_type_plantation OWNER TO rakharrs;

--
-- Name: s_unite; Type: SEQUENCE; Schema: public; Owner: rakharrs
--

CREATE SEQUENCE public.s_unite
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.s_unite OWNER TO rakharrs;

--
-- Name: unite; Type: TABLE; Schema: public; Owner: rakharrs
--

CREATE TABLE public.unite (
    id_unite character varying(8) NOT NULL,
    nom character varying(255) NOT NULL
);


ALTER TABLE public.unite OWNER TO rakharrs;

--
-- Name: v_fish_month_statistic; Type: VIEW; Schema: public; Owner: rakharrs
--

CREATE VIEW public.v_fish_month_statistic AS
 SELECT a.id_type_fish,
    ((to_char((a.sale_date)::timestamp with time zone, 'mm'::text) || '-'::text) || EXTRACT(year FROM a.sale_date)) AS identifier,
    sum(a.quantity_sold) AS quantity_sold
   FROM ( SELECT sale_fish.id_sale_fish,
            sale_fish.id_fish_pond,
            sale_fish.quantity_sold,
            sale_fish.sale_date,
            fp.id_type_fish
           FROM (public.sale_fish
             JOIN public.fish_pond fp ON (((sale_fish.id_fish_pond)::text = (fp.id_fish_pond)::text)))) a
  GROUP BY a.id_type_fish, (to_char((a.sale_date)::timestamp with time zone, 'mm'::text)), (EXTRACT(year FROM a.sale_date))
  ORDER BY (to_date(((to_char((a.sale_date)::timestamp with time zone, 'mm'::text) || '-'::text) || EXTRACT(year FROM a.sale_date)), 'mm-yyyy'::text));


ALTER TABLE public.v_fish_month_statistic OWNER TO rakharrs;

--
-- Name: v_fish_pond_quantity_date; Type: VIEW; Schema: public; Owner: rakharrs
--

CREATE VIEW public.v_fish_pond_quantity_date AS
 SELECT max((fish_pond.id_fish_pond)::text) AS id_fish_pond,
    fish_pond.id_pond,
    fish_pond.id_type_fish,
    tf.name_type_fish,
    fish_pond.insertion_date,
    sum(fish_pond.quantity) AS quantity
   FROM (public.fish_pond
     JOIN public.type_fish tf ON (((fish_pond.id_type_fish)::text = (tf.id_type_fish)::text)))
  GROUP BY fish_pond.id_type_fish, fish_pond.id_pond, tf.name_type_fish, fish_pond.insertion_date;


ALTER TABLE public.v_fish_pond_quantity_date OWNER TO rakharrs;

--
-- Name: v_fish_sold; Type: VIEW; Schema: public; Owner: rakharrs
--

CREATE VIEW public.v_fish_sold AS
 SELECT EXTRACT(month FROM to_date(v_fish_month_statistic.identifier, 'mm-yyyy'::text)) AS month,
    v_fish_month_statistic.id_type_fish,
    v_fish_month_statistic.identifier,
    sum(v_fish_month_statistic.quantity_sold) AS quantity_sold
   FROM public.v_fish_month_statistic
  GROUP BY v_fish_month_statistic.id_type_fish, (EXTRACT(month FROM to_date(v_fish_month_statistic.identifier, 'mm-yyyy'::text))), v_fish_month_statistic.identifier;


ALTER TABLE public.v_fish_sold OWNER TO rakharrs;

--
-- Name: v_fish_sold_this_year; Type: VIEW; Schema: public; Owner: rakharrs
--

CREATE VIEW public.v_fish_sold_this_year AS
 SELECT v_fish_sold.month,
    v_fish_sold.id_type_fish,
    v_fish_sold.identifier,
    v_fish_sold.quantity_sold,
    month.id_month,
    month.name
   FROM (public.v_fish_sold
     JOIN public.month ON (((month.id_month)::numeric = v_fish_sold.month)))
  WHERE ((EXTRACT(year FROM to_date(v_fish_sold.identifier, 'mm-yyyy'::text)))::double precision = date_part('year'::text, CURRENT_DATE));


ALTER TABLE public.v_fish_sold_this_year OWNER TO rakharrs;

--
-- Name: v_get_pond; Type: VIEW; Schema: public; Owner: rakharrs
--

CREATE VIEW public.v_get_pond AS
 SELECT pond.id_pond
   FROM public.pond;


ALTER TABLE public.v_get_pond OWNER TO rakharrs;

--
-- Name: v_quantity_fish_sold_month; Type: VIEW; Schema: public; Owner: rakharrs
--

CREATE VIEW public.v_quantity_fish_sold_month AS
 SELECT month.id_month,
    month.name,
    COALESCE(v_fish_sold_this_year.quantity_sold, (0)::numeric) AS "coalesce"
   FROM (public.month
     LEFT JOIN public.v_fish_sold_this_year ON (((month.id_month)::numeric = v_fish_sold_this_year.month)));


ALTER TABLE public.v_quantity_fish_sold_month OWNER TO rakharrs;

--
-- Name: month id_month; Type: DEFAULT; Schema: public; Owner: rakharrs
--

ALTER TABLE ONLY public.month ALTER COLUMN id_month SET DEFAULT nextval('public.month_id_month_seq'::regclass);


--
-- Data for Name: aqua_user; Type: TABLE DATA; Schema: public; Owner: rakharrs
--

COPY public.aqua_user (id_user, id_profile, name, identifier, password) FROM stdin;
AUR0001	PRO0001	admin	admin	admin
\.


--
-- Data for Name: field; Type: TABLE DATA; Schema: public; Owner: rakharrs
--

COPY public.field (id_field) FROM stdin;
FILD0001
FILD0002
FILD0003
FILD0004
\.


--
-- Data for Name: field_plantation; Type: TABLE DATA; Schema: public; Owner: rakharrs
--

COPY public.field_plantation (id_field_plantation, id_field, id_type_plantation, density, surface_covered, plant_weight, insertion_date) FROM stdin;
FIL1	FILD0001	PLNT0001	1	0.01	1.00	2015-04-20
FIL2	FILD0002	PLNT0001	1	0.01	1.00	2015-04-20
FIL3	FILD0001	PLNT0001	1	0.01	1.00	2015-04-20
FIL4	FILD0002	PLNT0001	1	0.01	1.00	2015-04-20
FIL5	FILD0003	PLNT0002	1	0.01	1.00	2015-04-20
FIL6	FILD0004	PLNT0002	1	0.01	1.00	2015-04-20
FIL7	FILD0003	PLNT0002	1	0.01	1.00	2015-04-20
FIL8	FILD0004	PLNT0002	1	0.01	1.00	2015-04-20
FIL9	FILD0001	PLNT0001	1	0.01	1.00	2021-05-15
FIL10	FILD0002	PLNT0001	1	0.01	1.00	2021-05-15
FIL11	FILD0001	PLNT0001	1	0.01	1.00	2021-05-15
FIL12	FILD0002	PLNT0001	1	0.01	1.00	2021-05-15
FIL13	FILD0003	PLNT0002	1	0.01	1.00	2021-05-15
FIL14	FILD0004	PLNT0002	1	0.01	1.00	2021-05-15
FIL15	FILD0003	PLNT0002	1	0.01	1.00	2021-05-15
FIL16	FILD0004	PLNT0002	1	0.01	1.00	2021-05-15
FIL17	FILD0001	PLNT0001	1	0.01	1.00	2022-05-10
FIL18	FILD0002	PLNT0001	1	0.01	1.00	2022-05-10
FIL19	FILD0001	PLNT0001	1	0.01	1.00	2022-05-10
FIL20	FILD0002	PLNT0001	1	0.01	1.00	2022-05-10
FIL21	FILD0003	PLNT0002	1	0.01	1.00	2022-05-10
FIL22	FILD0004	PLNT0002	1	0.01	1.00	2022-05-10
FIL23	FILD0003	PLNT0002	1	0.01	1.00	2022-05-10
FIL24	FILD0004	PLNT0002	1	0.01	1.00	2022-05-10
FIL25	FILD0001	PLNT0001	1	0.01	1.00	2023-06-15
FIL26	FILD0002	PLNT0001	1	0.01	1.00	2023-06-15
FIL27	FILD0001	PLNT0001	1	0.01	1.00	2023-06-15
FIL28	FILD0002	PLNT0001	1	0.01	1.00	2023-06-15
FIL29	FILD0003	PLNT0002	1	0.01	1.00	2023-06-15
FIL30	FILD0004	PLNT0002	1	0.01	1.00	2023-06-15
FIL31	FILD0003	PLNT0002	1	0.01	1.00	2023-06-15
FIL32	FILD0004	PLNT0002	1	0.01	1.00	2023-06-15
\.


--
-- Data for Name: fish_pond; Type: TABLE DATA; Schema: public; Owner: rakharrs
--

COPY public.fish_pond (id_fish_pond, id_type_fish, id_pond, fish_gender, quantity, insertion_date) FROM stdin;
FIP5	FISH0001	POND0001	t	56	2015-02-25
FIP6	FISH0001	POND0002	f	50	2015-02-25
FIP7	FISH0002	POND0003	t	44	2015-02-25
FIP8	FISH0002	POND0004	f	48	2015-02-25
FIP9	FISH0001	POND0001	t	60	2021-01-15
FIP10	FISH0001	POND0002	f	58	2021-01-15
FIP11	FISH0002	POND0003	t	52	2021-01-15
FIP12	FISH0002	POND0004	f	70	2021-01-15
FIP13	FISH0001	POND0001	t	45	2022-02-19
FIP14	FISH0001	POND0002	f	50	2022-02-19
FIP15	FISH0002	POND0003	t	55	2022-02-19
FIP16	FISH0002	POND0004	f	47	2022-02-19
FIP17	FISH0001	POND0001	t	60	2023-03-01
FIP18	FISH0001	POND0002	f	55	2023-03-01
FIP19	FISH0002	POND0003	t	49	2023-03-01
FIP20	FISH0002	POND0004	f	50	2023-03-01
FIP1	FISH0001	POND0001	t	50	2023-06-20
FIP2	FISH0001	POND0002	f	50	2023-06-20
FIP3	FISH0001	POND0001	t	70	2023-06-25
FIP4	FISH0001	POND0001	f	70	2023-06-25
FIP0001	FISH0001	POND0002	t	95	2023-07-25
FIP0002	FISH0001	POND0002	t	95	2023-07-25
FIP0003	FISH0001	POND012	t	200	2023-07-07
FIP0004	FISH0001	POND011	t	1000	2023-07-12
FIP0005	FISH0001	POND001	f	20	2023-07-19
FIP0006	FISH0001	POND013	f	20	2023-07-06
\.


--
-- Data for Name: month; Type: TABLE DATA; Schema: public; Owner: rakharrs
--

COPY public.month (id_month, name) FROM stdin;
1	January
2	February
3	March
4	April
5	May
6	June
7	July
\.


--
-- Data for Name: pond; Type: TABLE DATA; Schema: public; Owner: rakharrs
--

COPY public.pond (id_pond, capacity) FROM stdin;
POND0001	4500
POND0002	6000
POND0003	3500
POND0004	4000
POND001	30
POND002	30
POND003	30
POND004	30
POND005	30
POND006	30
POND007	30
POND008	30
POND009	30
POND010	100
POND011	200
POND012	500
POND013	20
\.


--
-- Data for Name: pond_details; Type: TABLE DATA; Schema: public; Owner: rakharrs
--

COPY public.pond_details (id_pond_details, id_pond, id_type_fish, max_quantity) FROM stdin;
DPO1	POND0001	FISH0001	180
DPO2	POND0002	FISH0001	300
DPO3	POND0003	FISH0002	175
DPO4	POND0004	FISH0002	200
DPO0005	POND004	FISH0001	20
DPO0006	POND005	FISH0001	20
DPO0007	POND006	FISH0001	20
DPO0008	POND009	FISH0001	20
DPO0009	POND010	FISH0001	200
DPO0010	POND011	TYF0001	300
DPO0011	POND012	FISH0001	200
DPO0012	POND012	FISH0001	300
DPO0013	POND012	FISH0002	100
DPO0014	POND013	FISH0002	20
\.


--
-- Data for Name: price_fish; Type: TABLE DATA; Schema: public; Owner: rakharrs
--

COPY public.price_fish (id_price_fish, id_type_fish, unit_fish_price, price_category) FROM stdin;
PFSH0001	FISH0001	7000	1
PFSH0002	FISH0001	65000	11
PFSH0003	FISH0001	100000	21
\.


--
-- Data for Name: price_plantation; Type: TABLE DATA; Schema: public; Owner: rakharrs
--

COPY public.price_plantation (id_price_plantation, id_type_plantation, unit_plant_price) FROM stdin;
PPLT0001	PLNT0001	1000
PPLT0002	PLNT0001	1500
\.


--
-- Data for Name: profile; Type: TABLE DATA; Schema: public; Owner: rakharrs
--

COPY public.profile (id_profile, name) FROM stdin;
PRO0001	Admin
PRO0002	Pond manager
\.


--
-- Data for Name: report_field; Type: TABLE DATA; Schema: public; Owner: rakharrs
--

COPY public.report_field (id_report_field, id_field_plantation, report_date_field, plant_weight, density, surface_covered) FROM stdin;
RPF1	FIL1	2023-07-20	20.00	22.00	9.12
RPF2	FIL2	2023-07-20	15.00	24.00	9.10
RPF3	FIL3	2023-07-20	21.00	21.00	9.90
RPF4	FIL4	2023-07-20	14.00	23.00	8.90
RPF5	FIL5	2023-07-20	12.00	26.00	9.40
RPF6	FIL6	2023-07-20	20.00	25.00	8.90
RPF7	FIL7	2023-07-20	19.00	27.00	9.10
RPF8	FIL8	2023-07-20	11.00	29.00	8.50
\.


--
-- Data for Name: report_pond; Type: TABLE DATA; Schema: public; Owner: rakharrs
--

COPY public.report_pond (id_report_pond, id_fish_pond, report_date_pond, alive_fish_number, dead_fish_number, category) FROM stdin;
RPD85	FIP1	2015-02-05	54	2	\N
RPD86	FIP2	2015-02-05	47	3	\N
RPD87	FIP3	2015-02-05	43	1	\N
RPD88	FIP4	2015-02-05	43	5	\N
RPD89	FIP1	2015-04-03	54	0	\N
RPD90	FIP2	2015-04-03	46	1	\N
RPD91	FIP3	2015-04-03	43	0	\N
RPD92	FIP4	2015-04-03	42	1	\N
RPD93	FIP1	2015-04-25	52	2	\N
RPD94	FIP2	2015-04-25	43	3	\N
RPD95	FIP3	2015-04-25	41	1	\N
RPD96	FIP4	2015-04-25	42	0	\N
RPD97	FIP1	2015-05-27	51	1	\N
RPD98	FIP2	2015-05-27	42	1	\N
RPD99	FIP3	2015-05-27	39	2	\N
RPD100	FIP4	2015-05-27	42	0	\N
RPD101	FIP1	2015-06-23	50	1	\N
RPD102	FIP2	2015-06-23	40	0	\N
RPD103	FIP3	2015-06-23	39	0	\N
RPD104	FIP4	2015-06-23	42	0	\N
RPD105	FIP1	2021-03-20	60	0	\N
RPD106	FIP2	2021-03-20	58	0	\N
RPD107	FIP3	2021-03-20	52	0	\N
RPD108	FIP4	2021-03-20	70	0	\N
RPD109	FIP1	2021-04-09	59	1	\N
RPD110	FIP2	2021-04-09	58	0	\N
RPD111	FIP3	2021-04-09	50	2	\N
RPD112	FIP4	2021-04-09	67	3	\N
RPD113	FIP1	2021-04-30	59	0	\N
RPD114	FIP2	2021-04-30	57	1	\N
RPD115	FIP3	2021-04-30	50	0	\N
RPD116	FIP4	2021-04-30	66	1	\N
RPD117	FIP1	2021-05-25	59	0	\N
RPD118	FIP2	2021-05-25	57	0	\N
RPD119	FIP3	2021-05-25	49	1	\N
RPD120	FIP4	2021-05-25	66	0	\N
RPD121	FIP1	2021-06-30	58	1	\N
RPD122	FIP2	2021-06-30	56	1	\N
RPD123	FIP3	2021-06-30	49	0	\N
RPD124	FIP4	2021-06-30	65	1	\N
RPD125	FIP1	2021-07-12	58	0	\N
RPD126	FIP2	2021-07-12	56	0	\N
RPD127	FIP3	2021-07-12	49	0	\N
RPD128	FIP4	2021-07-12	65	0	\N
RPD129	FIP1	2022-03-14	45	0	\N
RPD130	FIP2	2022-03-14	50	0	\N
RPD131	FIP3	2022-03-14	55	0	\N
RPD132	FIP4	2022-03-14	47	0	\N
RPD133	FIP1	2022-04-09	45	0	\N
RPD134	FIP2	2022-04-09	50	0	\N
RPD135	FIP3	2022-04-09	55	0	\N
RPD136	FIP4	2022-04-09	47	0	\N
RPD137	FIP1	2022-05-01	44	1	\N
RPD138	FIP2	2022-05-01	49	1	\N
RPD139	FIP3	2022-05-01	53	2	\N
RPD140	FIP4	2022-05-01	45	2	\N
RPD141	FIP1	2022-05-27	44	0	\N
RPD142	FIP2	2022-05-27	49	0	\N
RPD143	FIP3	2022-05-27	53	0	\N
RPD144	FIP4	2022-05-27	45	0	\N
RPD145	FIP1	2022-06-23	43	1	\N
RPD146	FIP2	2022-06-23	49	0	\N
RPD147	FIP3	2022-06-23	53	0	\N
RPD148	FIP4	2022-06-23	42	3	\N
RPD149	FIP1	2023-03-25	60	0	\N
RPD150	FIP2	2023-03-25	55	0	\N
RPD151	FIP3	2023-03-25	49	0	\N
RPD152	FIP4	2023-03-25	50	0	\N
RPD153	FIP1	2023-04-09	60	0	\N
RPD154	FIP2	2023-04-09	55	0	\N
RPD155	FIP3	2023-04-09	49	0	\N
RPD156	FIP4	2023-04-09	50	0	\N
RPD157	FIP1	2023-04-30	58	2	\N
RPD158	FIP2	2023-04-30	52	3	\N
RPD159	FIP3	2023-04-30	48	1	\N
RPD160	FIP4	2023-04-30	50	0	\N
RPD161	FIP1	2023-05-27	58	0	\N
RPD162	FIP2	2023-05-27	52	0	\N
RPD163	FIP3	2023-05-27	47	1	\N
RPD164	FIP4	2023-05-27	50	0	\N
RPD165	FIP1	2023-06-23	57	1	\N
RPD166	FIP2	2023-06-23	51	1	\N
RPD167	FIP3	2023-06-23	47	0	\N
RPD168	FIP4	2023-06-23	49	1	\N
RPP0169	\N	2023-07-29	10	10	\N
RPP0170	\N	2023-07-29	10	10	\N
RPP0171	\N	2023-07-29	10	10	\N
RPP0172	\N	2023-07-28	10	10	\N
RPP0173	FIP3	2023-07-28	10	10	\N
RPP0174	FIP3	2023-07-28	10	10	\N
RPP0176	FIP3	2023-07-28	10	10	\N
RPP0177	FIP3	2023-07-28	10	10	\N
RPP0178	FIP0001	2023-07-25	95	0	1
RPP0179	FIP0001	2023-07-23	100	0	\N
RPP0180	FIP0003	2023-07-07	200	0	1
RPP0181	FIP0004	2023-07-12	1000	0	1
RPP0182	FIP0005	2023-07-19	20	0	1
RPP0183	FIP0006	2023-07-06	20	0	1
\.


--
-- Data for Name: sale_fish; Type: TABLE DATA; Schema: public; Owner: rakharrs
--

COPY public.sale_fish (id_sale_fish, id_fish_pond, quantity_sold, sale_date) FROM stdin;
SFS1	FIP1	8	2015-08-20
SFS2	FIP2	5	2015-08-20
SFS3	FIP3	9	2015-08-20
SFS4	FIP4	4	2015-08-20
SFS5	FIP1	4	2015-08-23
SFS6	FIP2	2	2015-08-23
SFS7	FIP3	3	2015-08-23
SFS8	FIP4	4	2015-08-23
SFS9	FIP1	2	2021-07-01
SFS10	FIP2	3	2021-07-01
SFS11	FIP3	4	2021-07-01
SFS12	FIP4	8	2021-07-01
SFS13	FIP1	2	2021-08-02
SFS14	FIP2	3	2021-08-02
SFS15	FIP3	4	2021-08-02
SFS16	FIP4	8	2021-08-02
SFS17	FIP1	5	2022-07-08
SFS18	FIP2	4	2022-07-08
SFS19	FIP3	3	2022-07-08
SFS20	FIP4	5	2022-07-08
SFS21	FIP1	4	2022-07-08
SFS22	FIP2	5	2022-07-08
SFS23	FIP3	8	2022-07-08
SFS24	FIP4	2	2022-07-08
SFS25	FIP1	3	2023-07-10
SFS26	FIP2	6	2023-07-10
SFS27	FIP3	7	2023-07-10
SFS28	FIP4	3	2023-07-10
SFS29	FIP1	4	2023-08-02
SFS30	FIP2	6	2023-08-02
SFS31	FIP3	4	2023-08-02
SFS32	FIP4	3	2023-08-02
SFS0033	FIP3	20	2023-02-06
SFS0034	FIP0001	200	2023-02-13
SFS0035	FIP0001	20	2023-01-06
\.


--
-- Data for Name: sale_plantation; Type: TABLE DATA; Schema: public; Owner: rakharrs
--

COPY public.sale_plantation (id_sale_plantation, id_field_plantation, quantity_sold, sale_date) FROM stdin;
SPL1	FIL1	32	2023-08-12
SPL2	FIL2	20	2023-08-12
SPL3	FIL3	15	2023-08-12
SPL4	FIL4	10	2023-08-12
SPL5	FIL5	18	2023-08-12
SPL6	FIL6	13	2023-08-12
SPL7	FIL7	17	2023-08-12
SPL8	FIL8	20	2023-08-12
\.


--
-- Data for Name: type_fish; Type: TABLE DATA; Schema: public; Owner: rakharrs
--

COPY public.type_fish (id_type_fish, name_type_fish, maturity_period, maturity_size, weight_max_little, weight_max_average, size_max_little, size_max_average) FROM stdin;
FISH0001	Carpes	7.0	30	200	1000	40	60
FISH0002	Tilapia	5.0	25	150	800	35	50
TYF0001	Test	20.0	20	20	20	20	10
\.


--
-- Data for Name: type_plantation; Type: TABLE DATA; Schema: public; Owner: rakharrs
--

COPY public.type_plantation (id_type_plantation, name_type_plantation, weight_max_baby, weight_max_semi_mature) FROM stdin;
PLNT0001	Fraise	10	50
PLNT0002	Laitue	5	25
\.


--
-- Data for Name: unite; Type: TABLE DATA; Schema: public; Owner: rakharrs
--

COPY public.unite (id_unite, nom) FROM stdin;
UNIT0001	Kg
UNIT0002	Mois
UNIT0003	cm
\.


--
-- Name: month_id_month_seq; Type: SEQUENCE SET; Schema: public; Owner: rakharrs
--

SELECT pg_catalog.setval('public.month_id_month_seq', 7, true);


--
-- Name: s_field; Type: SEQUENCE SET; Schema: public; Owner: rakharrs
--

SELECT pg_catalog.setval('public.s_field', 1, false);


--
-- Name: s_field_plantation; Type: SEQUENCE SET; Schema: public; Owner: rakharrs
--

SELECT pg_catalog.setval('public.s_field_plantation', 32, true);


--
-- Name: s_fish_pond; Type: SEQUENCE SET; Schema: public; Owner: rakharrs
--

SELECT pg_catalog.setval('public.s_fish_pond', 6, true);


--
-- Name: s_pond; Type: SEQUENCE SET; Schema: public; Owner: rakharrs
--

SELECT pg_catalog.setval('public.s_pond', 13, true);


--
-- Name: s_pond_details; Type: SEQUENCE SET; Schema: public; Owner: rakharrs
--

SELECT pg_catalog.setval('public.s_pond_details', 14, true);


--
-- Name: s_price_fish; Type: SEQUENCE SET; Schema: public; Owner: rakharrs
--

SELECT pg_catalog.setval('public.s_price_fish', 1, false);


--
-- Name: s_price_plantation; Type: SEQUENCE SET; Schema: public; Owner: rakharrs
--

SELECT pg_catalog.setval('public.s_price_plantation', 1, false);


--
-- Name: s_report_field; Type: SEQUENCE SET; Schema: public; Owner: rakharrs
--

SELECT pg_catalog.setval('public.s_report_field', 8, true);


--
-- Name: s_report_pond; Type: SEQUENCE SET; Schema: public; Owner: rakharrs
--

SELECT pg_catalog.setval('public.s_report_pond', 183, true);


--
-- Name: s_sale_fish; Type: SEQUENCE SET; Schema: public; Owner: rakharrs
--

SELECT pg_catalog.setval('public.s_sale_fish', 35, true);


--
-- Name: s_sale_plantation; Type: SEQUENCE SET; Schema: public; Owner: rakharrs
--

SELECT pg_catalog.setval('public.s_sale_plantation', 8, true);


--
-- Name: s_type_fish; Type: SEQUENCE SET; Schema: public; Owner: rakharrs
--

SELECT pg_catalog.setval('public.s_type_fish', 1, true);


--
-- Name: s_type_plantation; Type: SEQUENCE SET; Schema: public; Owner: rakharrs
--

SELECT pg_catalog.setval('public.s_type_plantation', 1, false);


--
-- Name: s_unite; Type: SEQUENCE SET; Schema: public; Owner: rakharrs
--

SELECT pg_catalog.setval('public.s_unite', 3, true);


--
-- Name: aqua_user aqua_user_pkey; Type: CONSTRAINT; Schema: public; Owner: rakharrs
--

ALTER TABLE ONLY public.aqua_user
    ADD CONSTRAINT aqua_user_pkey PRIMARY KEY (id_user);


--
-- Name: field field_pkey; Type: CONSTRAINT; Schema: public; Owner: rakharrs
--

ALTER TABLE ONLY public.field
    ADD CONSTRAINT field_pkey PRIMARY KEY (id_field);


--
-- Name: field_plantation field_plantation_pkey; Type: CONSTRAINT; Schema: public; Owner: rakharrs
--

ALTER TABLE ONLY public.field_plantation
    ADD CONSTRAINT field_plantation_pkey PRIMARY KEY (id_field_plantation);


--
-- Name: fish_pond fish_pond_pkey; Type: CONSTRAINT; Schema: public; Owner: rakharrs
--

ALTER TABLE ONLY public.fish_pond
    ADD CONSTRAINT fish_pond_pkey PRIMARY KEY (id_fish_pond);


--
-- Name: month month_pkey; Type: CONSTRAINT; Schema: public; Owner: rakharrs
--

ALTER TABLE ONLY public.month
    ADD CONSTRAINT month_pkey PRIMARY KEY (id_month);


--
-- Name: pond_details pond_details_pkey; Type: CONSTRAINT; Schema: public; Owner: rakharrs
--

ALTER TABLE ONLY public.pond_details
    ADD CONSTRAINT pond_details_pkey PRIMARY KEY (id_pond_details);


--
-- Name: pond pond_pkey; Type: CONSTRAINT; Schema: public; Owner: rakharrs
--

ALTER TABLE ONLY public.pond
    ADD CONSTRAINT pond_pkey PRIMARY KEY (id_pond);


--
-- Name: price_fish price_fish_pkey; Type: CONSTRAINT; Schema: public; Owner: rakharrs
--

ALTER TABLE ONLY public.price_fish
    ADD CONSTRAINT price_fish_pkey PRIMARY KEY (id_price_fish);


--
-- Name: price_plantation price_plantation_pkey; Type: CONSTRAINT; Schema: public; Owner: rakharrs
--

ALTER TABLE ONLY public.price_plantation
    ADD CONSTRAINT price_plantation_pkey PRIMARY KEY (id_price_plantation);


--
-- Name: profile profile_pkey; Type: CONSTRAINT; Schema: public; Owner: rakharrs
--

ALTER TABLE ONLY public.profile
    ADD CONSTRAINT profile_pkey PRIMARY KEY (id_profile);


--
-- Name: report_field report_field_pkey; Type: CONSTRAINT; Schema: public; Owner: rakharrs
--

ALTER TABLE ONLY public.report_field
    ADD CONSTRAINT report_field_pkey PRIMARY KEY (id_report_field);


--
-- Name: report_pond report_pond_pkey; Type: CONSTRAINT; Schema: public; Owner: rakharrs
--

ALTER TABLE ONLY public.report_pond
    ADD CONSTRAINT report_pond_pkey PRIMARY KEY (id_report_pond);


--
-- Name: sale_fish sale_fish_pkey; Type: CONSTRAINT; Schema: public; Owner: rakharrs
--

ALTER TABLE ONLY public.sale_fish
    ADD CONSTRAINT sale_fish_pkey PRIMARY KEY (id_sale_fish);


--
-- Name: sale_plantation sale_plantation_pkey; Type: CONSTRAINT; Schema: public; Owner: rakharrs
--

ALTER TABLE ONLY public.sale_plantation
    ADD CONSTRAINT sale_plantation_pkey PRIMARY KEY (id_sale_plantation);


--
-- Name: type_fish type_fish_pkey; Type: CONSTRAINT; Schema: public; Owner: rakharrs
--

ALTER TABLE ONLY public.type_fish
    ADD CONSTRAINT type_fish_pkey PRIMARY KEY (id_type_fish);


--
-- Name: type_plantation type_plantation_pkey; Type: CONSTRAINT; Schema: public; Owner: rakharrs
--

ALTER TABLE ONLY public.type_plantation
    ADD CONSTRAINT type_plantation_pkey PRIMARY KEY (id_type_plantation);


--
-- Name: unite unite_pkey; Type: CONSTRAINT; Schema: public; Owner: rakharrs
--

ALTER TABLE ONLY public.unite
    ADD CONSTRAINT unite_pkey PRIMARY KEY (id_unite);


--
-- Name: aqua_user aqua_user_id_profile_fkey; Type: FK CONSTRAINT; Schema: public; Owner: rakharrs
--

ALTER TABLE ONLY public.aqua_user
    ADD CONSTRAINT aqua_user_id_profile_fkey FOREIGN KEY (id_profile) REFERENCES public.profile(id_profile);


--
-- Name: field_plantation field_plantation_id_field_fkey; Type: FK CONSTRAINT; Schema: public; Owner: rakharrs
--

ALTER TABLE ONLY public.field_plantation
    ADD CONSTRAINT field_plantation_id_field_fkey FOREIGN KEY (id_field) REFERENCES public.field(id_field);


--
-- Name: field_plantation field_plantation_id_type_plantation_fkey; Type: FK CONSTRAINT; Schema: public; Owner: rakharrs
--

ALTER TABLE ONLY public.field_plantation
    ADD CONSTRAINT field_plantation_id_type_plantation_fkey FOREIGN KEY (id_type_plantation) REFERENCES public.type_plantation(id_type_plantation);


--
-- Name: fish_pond fish_pond_id_pond_fkey; Type: FK CONSTRAINT; Schema: public; Owner: rakharrs
--

ALTER TABLE ONLY public.fish_pond
    ADD CONSTRAINT fish_pond_id_pond_fkey FOREIGN KEY (id_pond) REFERENCES public.pond(id_pond);


--
-- Name: fish_pond fish_pond_id_type_fish_fkey; Type: FK CONSTRAINT; Schema: public; Owner: rakharrs
--

ALTER TABLE ONLY public.fish_pond
    ADD CONSTRAINT fish_pond_id_type_fish_fkey FOREIGN KEY (id_type_fish) REFERENCES public.type_fish(id_type_fish);


--
-- Name: pond_details pond_details_id_pond_fkey; Type: FK CONSTRAINT; Schema: public; Owner: rakharrs
--

ALTER TABLE ONLY public.pond_details
    ADD CONSTRAINT pond_details_id_pond_fkey FOREIGN KEY (id_pond) REFERENCES public.pond(id_pond);


--
-- Name: pond_details pond_details_id_type_fish_fkey; Type: FK CONSTRAINT; Schema: public; Owner: rakharrs
--

ALTER TABLE ONLY public.pond_details
    ADD CONSTRAINT pond_details_id_type_fish_fkey FOREIGN KEY (id_type_fish) REFERENCES public.type_fish(id_type_fish);


--
-- Name: price_fish price_fish_id_type_fish_fkey; Type: FK CONSTRAINT; Schema: public; Owner: rakharrs
--

ALTER TABLE ONLY public.price_fish
    ADD CONSTRAINT price_fish_id_type_fish_fkey FOREIGN KEY (id_type_fish) REFERENCES public.type_fish(id_type_fish);


--
-- Name: price_plantation price_plantation_id_type_plantation_fkey; Type: FK CONSTRAINT; Schema: public; Owner: rakharrs
--

ALTER TABLE ONLY public.price_plantation
    ADD CONSTRAINT price_plantation_id_type_plantation_fkey FOREIGN KEY (id_type_plantation) REFERENCES public.type_plantation(id_type_plantation);


--
-- Name: report_field report_field_id_field_plantation_fkey; Type: FK CONSTRAINT; Schema: public; Owner: rakharrs
--

ALTER TABLE ONLY public.report_field
    ADD CONSTRAINT report_field_id_field_plantation_fkey FOREIGN KEY (id_field_plantation) REFERENCES public.field_plantation(id_field_plantation);


--
-- Name: report_pond report_pond_id_fish_pond_fkey; Type: FK CONSTRAINT; Schema: public; Owner: rakharrs
--

ALTER TABLE ONLY public.report_pond
    ADD CONSTRAINT report_pond_id_fish_pond_fkey FOREIGN KEY (id_fish_pond) REFERENCES public.fish_pond(id_fish_pond);


--
-- Name: sale_fish sale_fish_id_fish_pond_fkey; Type: FK CONSTRAINT; Schema: public; Owner: rakharrs
--

ALTER TABLE ONLY public.sale_fish
    ADD CONSTRAINT sale_fish_id_fish_pond_fkey FOREIGN KEY (id_fish_pond) REFERENCES public.fish_pond(id_fish_pond);


--
-- Name: sale_plantation sale_plantation_id_field_plantation_fkey; Type: FK CONSTRAINT; Schema: public; Owner: rakharrs
--

ALTER TABLE ONLY public.sale_plantation
    ADD CONSTRAINT sale_plantation_id_field_plantation_fkey FOREIGN KEY (id_field_plantation) REFERENCES public.field_plantation(id_field_plantation);


--
-- PostgreSQL database dump complete
--

