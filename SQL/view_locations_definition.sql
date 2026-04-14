SELECT  l.locationIdPk AS locationIdPk, 
        l.locationName AS locationName, 
        c.councilName AS councilName 
FROM    (location l join council c) 
WHERE   l.councilIdPk = c.councilIdPk 
ORDER BY 3 ASC, 2 ASC ;