CREATE TABLE "news" (
  "id" serial,
  "name" character varying(100) NOT NULL,
  "author" character varying(100) NOT NULL,
  "tags" character varying(100)  NOT NULL,
  "text" text,
  "created_at" integer DEFAULT NULL,
  CONSTRAINT news_pkey PRIMARY KEY (id )
);