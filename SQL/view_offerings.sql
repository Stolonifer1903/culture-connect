CREATE VIEW view_offerings AS 
SELECT of_id_pk, bus_name, of_name, int_name, loc_name, of_description, of_details, of_cultural_benefits, of_price_range_description
FROM offering o, business b, interests i, location l, offering_prices op 
WHERE o.of_price_range=op.of_price_range AND o.bus_id_pk=b.bus_id_pk AND o.loc_id_pk=l.loc_id_pk AND o.of_category=i.int_id_pk;