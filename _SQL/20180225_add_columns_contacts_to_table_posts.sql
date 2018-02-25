ALTER TABLE posts ADD COLUMN (
  contact_name varchar(191) NOT NULL, 
  contact_phone varchar(30) NOT NULL, 
  contact_email varchar(100), 
  contact_address varchar(191) NOT NULL, 
  contact_address_map_coordinate varchar(191) NOT NULL
);