INSERT INTO genres(genre) VALUES 
('homme'),
('femme');


CREATE OR REPLACE VIEW v_athlete AS 
SELECT
    a.nom,a.date_naissance, a.longueur, a.poids,
    p.pays,
    g.genre,
    d.nom AS discipline
FROM
    athletes a 
INNER JOIN 
    pays p ON a.pays_id = p.id
INNER JOIN
    genres g ON a.genre_id = g.id
INNER JOIN
    disciplines d ON a.discipline_id = d.id;


CREATE OR REPLACE VIEW v_calendrier AS 
SELECT
    d.nom,
    s.site,
    c.date
FROM
    calendriers c 
INNER JOIN 
    sites s ON c.site_id = s.id
INNER JOIN
    disciplines d ON c.discipline_id = d.id;


CREATE OR REPLACE VIEW v_resultat AS 
SELECT
    r.rang,
    r.medaille,
    p.pays,
    d.nom AS discipline
FROM
    resultats r 
INNER JOIN 
    pays p ON r.pays_id = p.id
INNER JOIN
    disciplines d ON r.discipline_id = d.id;
-- v_resultat avec type de discipline
select r.rang, r.medaille, r.pays, r.discipline, d.type from disciplines d left join v_resultat r on d.nom = r.discipline;

CREATE OR REPLACE VIEW recette AS
select 
d.nom AS discipline, nr.montant_recette AS montant_recette, r.type_recette AS type_recette 
FROM newrecettes nr 
INNER JOIN disciplines d ON nr.code_discipline = d.code_discipline
INNER JOIN recettes r ON nr.code_recette = r.code;

CREATE OR REPLACE VIEW depense AS
SELECT
    d.nom AS discipline, 
    nd.montant_depense AS montant_depense, 
    dp.type_depense AS type_depense
FROM newdepenses nd 
INNER JOIN disciplines d ON nd.code_discipline = d.code_discipline
INNER JOIN depenses dp ON nd.code_depense = dp.code;

-- view table 
CREATE VIEW v_tableau AS
SELECT 
    COALESCE(rec.discipline, dep.discipline) AS discipline, 
    COALESCE(rec.recette_total, 0) AS recette, 
    COALESCE(dep.depense_total, 0) AS depense,
    COALESCE(rec.recette_total, 0) - COALESCE(dep.depense_total, 0) AS difference
FROM 
    (
        SELECT 
            discipline,
            SUM(montant_recette) AS recette_total
        FROM 
            recette
        GROUP BY 
            discipline
    ) AS rec
FULL JOIN 
    (
        SELECT 
            discipline,
            SUM(montant_depense) AS depense_total
        FROM 
            depense
        GROUP BY 
            discipline
    ) AS dep
ON rec.discipline = dep.discipline;

-----------------------------------------------------------------------------------------------------
-- RAHA ILAINA
-- NO NO NO 
-- Pour rang et pour les medailles
CREATE OR REPLACE VIEW v_medaille_rang AS
SELECT 
    pays,
    SUM(CASE WHEN medaille = 'or' THEN 1 ELSE 0 END) AS gold,
    SUM(CASE WHEN medaille = 'argent' THEN 1 ELSE 0 END) AS silver,
    SUM(CASE WHEN medaille = 'bronze' THEN 1 ELSE 0 END) AS bronze
FROM 
    v_resultat
GROUP BY 
    pays
ORDER BY 
    gold DESC, 
    silver DESC, 
    bronze DESC;

-- RAHA ILAINA
-- With rank TENA IZY
CREATE OR REPLACE VIEW v_medaille_rang AS
SELECT 
    pays,
    SUM(CASE WHEN medaille = 'or' THEN 1 ELSE 0 END) AS gold,
    SUM(CASE WHEN medaille = 'argent' THEN 1 ELSE 0 END) AS silver,
    SUM(CASE WHEN medaille = 'bronze' THEN 1 ELSE 0 END) AS bronze,
    ROW_NUMBER() OVER(ORDER BY 
                        SUM(CASE WHEN medaille = 'or' THEN 1 ELSE 0 END) DESC, 
                        SUM(CASE WHEN medaille = 'argent' THEN 1 ELSE 0 END) DESC, 
                        SUM(CASE WHEN medaille = 'bronze' THEN 1 ELSE 0 END) DESC
                     ) AS rang
FROM 
    v_resultat
GROUP BY 
    pays;

-- RAHA ILAINA :
-- RESULTAT MEDAILLES
SELECT
    pays.pays,
    SUM(CASE WHEN medaille = 'or' THEN 1 ELSE 0 END) AS gold,
    SUM(CASE WHEN medaille = 'argent' THEN 1 ELSE 0 END) AS silver,
    SUM(CASE WHEN medaille = 'bronze' THEN 1 ELSE 0 END) AS bronze,
    ROW_NUMBER() OVER(
        ORDER BY 
            SUM(CASE WHEN medaille = 'or' THEN 1 ELSE 0 END) DESC,
            SUM(CASE WHEN medaille = 'argent' THEN 1 ELSE 0 END) DESC,
            SUM(CASE WHEN medaille = 'bronze' THEN 1 ELSE 0 END) DESC
    ) AS rang
FROM 
    pays
LEFT JOIN 
    v_resultat ON pays.pays = v_resultat.pays
GROUP BY 
    pays.pays;

---------------------------------------------------------------------------------------------------


select count(rang) AS nbr_medaille,medaille,pays FROM v_resultat group by rang, medaille, pays;

insert into newrecettes(date, code_discipline, code_recette, montant_recette) values
('2022-06-06', 'JDO', 'BLT', 10000);
insert into newrecettes(date, code_discipline, code_recette, montant_recette) values
('2022-06-06', 'KRT', 'BLT', 20000);
insert into newrecettes(date, code_discipline, code_recette, montant_recette) values
('2022-06-06', 'JDO', 'BLT', 60000);
insert into newdepenses(date, code_discipline, code_depense, montant_depense) values
('2022-06-06', 'JDO', 'TSP', 5000);

-- select discipline,sum(montant) FROM 
-- create or replace view v_union_discipline AS

-- full join
create or replace view a AS
select 
d.nom AS discipline, nr.montant_recette AS montant_recette, r.type_recette AS type_recette 
FROM newrecettes nr 
INNER JOIN disciplines d on nr.code_discipline = d.code_discipline
INNER JOIN recettes r on nr.code_recette = r.code;
-- union
create or replace view b AS
select 
d.nom AS discipline, nd.montant_depense AS montant_depense, dp.type_depense AS type_depense
FROM newdepenses nd 
INNER JOIN disciplines d on nd.code_discipline = d.code_discipline
INNER JOIN depenses dp on nd.code_depense = dp.code;
select * FROM a full join b on a.discipline=b.discipline;
select a.discipline,sum(a.montant), b.montant FROM a full join b on a.discipline=b.discipline group by a.discipline, a.montant, b.montant;

-- drop view v_union_discipline;

select a.discipline, a.montant AS recette, b.montant AS depense FROM a full join b on a.discipline=b.discipline;
------------------------------------------------------------------------------
select 
*
FROM newrecettes nr 
INNER JOIN disciplines d on nr.code_discipline = d.code_discipline
union
select 
*
FROM newdepenses nd 
INNER JOIN disciplines d on nd.code_discipline = d.code_discipline;

select discipline, sum(montant) FROM v_union_discipline group by discipline;

select 
*
FROM newrecettes nr 
INNER JOIN disciplines d on nr.code_discipline = d.code_discipline
INNER JOIN recettes r on nr.code_recette = r.code;

-- filtre
select r.rang, r.medaille, r.pays, r.discipline from disciplines d left join v_resultat r on d.nom = r.discipline where d.type='collectif';

select r.rang, r.medaille, r.pays, r.discipline from disciplines d left join v_resultat r on d.nom = r.discipline where d.type='individuel';

