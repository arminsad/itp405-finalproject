
-- -----------------------------------------------------
-- Table `public`.`food`
-- -----------------------------------------------------
DROP TABLE IF EXISTS "public"."foods" ;

CREATE SEQUENCE IF NOT EXISTS foods_id_seq;

CREATE TABLE IF NOT EXISTS "public"."foods" (
  "id" int8 NOT NULL DEFAULT nextval('foods_id_seq'::regclass),
  "name" varchar(255) NOT NULL,
  "created_at" timestamp(0),
  "updated_at" timestamp(0),
  PRIMARY KEY ("id")
  );


-- -----------------------------------------------------
-- Table `public`.`ingredient`
-- -----------------------------------------------------
DROP TABLE IF EXISTS "public"."ingredients";

CREATE SEQUENCE IF NOT EXISTS ingredients_id_seq;

CREATE TABLE IF NOT EXISTS "public"."ingredients" (
  "id" int8 NOT NULL DEFAULT nextval('ingredients_id_seq'::regclass),
  "name" varchar(255) NOT NULL,
  "created_at" timestamp(0),
  "updated_at" timestamp(0),
  PRIMARY KEY ("id")
  );


-- -----------------------------------------------------
-- Table `public`.`food_ingredient`
-- -----------------------------------------------------
DROP TABLE IF EXISTS "public"."food_ingredient";

CREATE TABLE IF NOT EXISTS "public"."food_ingredient" (
  "food_id" int8 NOT NULL,
  "ingredient_id" int8 NOT NULL,
  "created_at" timestamp(0),
  "updated_at" timestamp(0)
  );

-- -----------------------------------------------------
-- Data for table `public`.`food`
-- -----------------------------------------------------
INSERT INTO "public"."foods" ("id", "name") VALUES (1, 'Garlic Bread');
INSERT INTO "public"."foods" ("id", "name") VALUES (2, 'Chicken Parmesan');
INSERT INTO "public"."foods" ("id", "name") VALUES (3, 'Penne');
INSERT INTO "public"."foods" ("id", "name") VALUES (4, 'Fettuccini Pasta');


-- -----------------------------------------------------
-- Data for table `public`.`ingredient`
-- -----------------------------------------------------
INSERT INTO "public"."ingredients" ("id", "name") VALUES (1, 'Wheat Flour');
INSERT INTO "public"."ingredients" ("id", "name") VALUES (2, 'Water');
INSERT INTO "public"."ingredients" ("id", "name") VALUES (3, 'Garlic');
INSERT INTO "public"."ingredients" ("id", "name") VALUES (4, 'Olive Oil');
INSERT INTO "public"."ingredients" ("id", "name") VALUES (5, 'Salt');
INSERT INTO "public"."ingredients" ("id", "name") VALUES (6, 'Barley Flour');
INSERT INTO "public"."ingredients" ("id", "name") VALUES (7, 'Yeast');
INSERT INTO "public"."ingredients" ("id", "name") VALUES (8, 'Tomatoes');
INSERT INTO "public"."ingredients" ("id", "name") VALUES (9, 'Chicken');
INSERT INTO "public"."ingredients" ("id", "name") VALUES (10, 'Durum Semolina');
INSERT INTO "public"."ingredients" ("id", "name") VALUES (11, 'Mozzarella Cheese');
INSERT INTO "public"."ingredients" ("id", "name") VALUES (12, 'Cracker Crumbs');
INSERT INTO "public"."ingredients" ("id", "name") VALUES (13, 'Onions');
INSERT INTO "public"."ingredients" ("id", "name") VALUES (14, 'Eggs');
INSERT INTO "public"."ingredients" ("id", "name") VALUES (15, 'Parmesan Cheese');
INSERT INTO "public"."ingredients" ("id", "name") VALUES (16, 'Soybean Oil');
INSERT INTO "public"."ingredients" ("id", "name") VALUES (17, 'Corn Starch');
INSERT INTO "public"."ingredients" ("id", "name") VALUES (18, 'Betacarotene');


-- -----------------------------------------------------
-- Data for table `public`.`food_ingredient`
-- -----------------------------------------------------
INSERT INTO "public"."food_ingredient" ("food_id", "ingredient_id") VALUES (1, 1);
INSERT INTO "public"."food_ingredient" ("food_id", "ingredient_id") VALUES (1, 2);
INSERT INTO "public"."food_ingredient" ("food_id", "ingredient_id") VALUES (1, 3);
INSERT INTO "public"."food_ingredient" ("food_id", "ingredient_id") VALUES (1, 4);
INSERT INTO "public"."food_ingredient" ("food_id", "ingredient_id") VALUES (1, 5);
INSERT INTO "public"."food_ingredient" ("food_id", "ingredient_id") VALUES (1, 6);
INSERT INTO "public"."food_ingredient" ("food_id", "ingredient_id") VALUES (1, 7);
INSERT INTO "public"."food_ingredient" ("food_id", "ingredient_id") VALUES (2, 8);
INSERT INTO "public"."food_ingredient" ("food_id", "ingredient_id") VALUES (2, 9);
INSERT INTO "public"."food_ingredient" ("food_id", "ingredient_id") VALUES (2, 2);
INSERT INTO "public"."food_ingredient" ("food_id", "ingredient_id") VALUES (2, 10);
INSERT INTO "public"."food_ingredient" ("food_id", "ingredient_id") VALUES (2, 11);
INSERT INTO "public"."food_ingredient" ("food_id", "ingredient_id") VALUES (2, 12);
INSERT INTO "public"."food_ingredient" ("food_id", "ingredient_id") VALUES (2, 16);
INSERT INTO "public"."food_ingredient" ("food_id", "ingredient_id") VALUES (2, 13);
INSERT INTO "public"."food_ingredient" ("food_id", "ingredient_id") VALUES (2, 14);
INSERT INTO "public"."food_ingredient" ("food_id", "ingredient_id") VALUES (2, 15);
INSERT INTO "public"."food_ingredient" ("food_id", "ingredient_id") VALUES (2, 1);
INSERT INTO "public"."food_ingredient" ("food_id", "ingredient_id") VALUES (2, 17);
INSERT INTO "public"."food_ingredient" ("food_id", "ingredient_id") VALUES (2, 4);
INSERT INTO "public"."food_ingredient" ("food_id", "ingredient_id") VALUES (2, 5);
INSERT INTO "public"."food_ingredient" ("food_id", "ingredient_id") VALUES (2, 3);
INSERT INTO "public"."food_ingredient" ("food_id", "ingredient_id") VALUES (3, 2);
INSERT INTO "public"."food_ingredient" ("food_id", "ingredient_id") VALUES (3, 10);
INSERT INTO "public"."food_ingredient" ("food_id", "ingredient_id") VALUES (3, 16);
INSERT INTO "public"."food_ingredient" ("food_id", "ingredient_id") VALUES (4, 1);
INSERT INTO "public"."food_ingredient" ("food_id", "ingredient_id") VALUES (4, 14);
INSERT INTO "public"."food_ingredient" ("food_id", "ingredient_id") VALUES (4, 18);

SELECT setval('foods_id_seq', (SELECT MAX(id) from foods), true);
SELECT setval('ingredients_id_seq', (SELECT MAX(id) from ingredients), true);