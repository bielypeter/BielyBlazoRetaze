CREATE TYPE "user_role" AS ENUM (
  'admin',
  'user'
);

CREATE TYPE "order_delivery_method" AS ENUM (
  'address',
  'personal collection'
);

CREATE TYPE "order_payment_method" AS ENUM (
  'card',
  'cash',
  'apple pay'
);

CREATE TABLE "user" (
  "id" integer PRIMARY KEY,
  "role" user_role,
  "first_name" varchar,
  "last_name" varchar,
  "email" varchar,
  "phone_number" varchar,
  "password" varchar,
  "created_at" timestamp,
  "updated_at" timestamp
);

CREATE TABLE "category" (
  "id" integer PRIMARY KEY,
  "name" varchar,
  "created_at" timestamp,
  "updated_at" timestamp
);

CREATE TABLE "products_category" (
  "id" integer PRIMARY KEY,
  "category_id" integer,
  "product_id" integer
);

CREATE TABLE "product" (
  "id" integer PRIMARY KEY,
  "name" varchar,
  "description" text,
  "price" integer,
  "image_path" varchar[],
  "color" varchar,
  "brand" varchar,
  "created_at" timestamp,
  "updated_at" timestamp
);

CREATE TABLE "cart" (
  "id" integer PRIMARY KEY,
  "user_id" integer,
  "created_at" timestamp,
  "updated_at" timestamp
);

CREATE TABLE "cart_product" (
  "id" integer PRIMARY KEY,
  "cart_id" integer,
  "product_id" integer,
  "quantity" integer
);

CREATE TABLE "order" (
  "id" integer PRIMARY KEY,
  "user_id" integer,
  "address_id" integer,
  "total_price" integer,
  "delivery_method" order_delivery_method,
  "payment_method" order_payment_method,
  "first_name" varchar,
  "last_name" varchar,
  "email" varchar,
  "phone_number" varchar,
  "created_at" timestamp,
  "updated_at" timestamp
);

CREATE TABLE "address" (
  "id" integer PRIMARY KEY,
  "street" varchar,
  "city" varchar,
  "postalcode" varchar,
  "created_at" timestamp,
  "updated_at" timestamp
);

CREATE TABLE "order_product" (
  "id" integer PRIMARY KEY,
  "order_id" integer,
  "product_id" integer,
  "quantity" integer
);

ALTER TABLE "user" ADD FOREIGN KEY ("id") REFERENCES "cart" ("user_id");

ALTER TABLE "products_category" ADD FOREIGN KEY ("product_id") REFERENCES "product" ("id");

ALTER TABLE "products_category" ADD FOREIGN KEY ("category_id") REFERENCES "category" ("id");

ALTER TABLE "cart_product" ADD FOREIGN KEY ("cart_id") REFERENCES "cart" ("id");

ALTER TABLE "cart_product" ADD FOREIGN KEY ("product_id") REFERENCES "product" ("id");

ALTER TABLE "order_product" ADD FOREIGN KEY ("order_id") REFERENCES "order" ("id");

ALTER TABLE "order_product" ADD FOREIGN KEY ("product_id") REFERENCES "product" ("id");

ALTER TABLE "order" ADD FOREIGN KEY ("address_id") REFERENCES "address" ("id");

ALTER TABLE "order" ADD FOREIGN KEY ("user_id") REFERENCES "user" ("id");
