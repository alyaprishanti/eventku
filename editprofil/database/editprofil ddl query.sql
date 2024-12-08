-- create schema eventku;

-- CREATE TABLE `umkm` (
--   id_umkm int(11) NOT NULL AUTO_INCREMENT,
--   nama_lengkap_umkm varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
--   alamat_umkm varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
--   email_umkm varchar(40) COLLATE utf8mb4_general_ci NOT NULL,
--   nmr_telepon_umkm int(11) NOT NULL,
--   nama_usaha_umkm varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
--   bidang_usaha_umkm varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
--   password_umkm varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
--   role varchar(10) COLLATE utf8mb4_general_ci NOT NULL DEFAULT umkm,
--   verification_code int(11) DEFAULT NULL,
--   is_verified tinyint(1) NOT NULL DEFAULT 0,
--   PRIMARY KEY (id_umkm)
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE eventku.profil_umkm (
    Id_profil INT AUTO_INCREMENT PRIMARY KEY,
    Id_umkm INT,
    foto_profil VARCHAR(255),
    deskripsi_umkm TEXT,
    FOREIGN KEY (Id_umkm) REFERENCES umkm(id_umkm)
);

create table eventku.portofolio_umkm (
	id_portofolio int not null primary key,
	id_profil int not null,
	portofolio_url varchar (255),
	FOREIGN KEY (id_profil) REFERENCES profil_umkm(id_profil) 
);

ALTER TABLE eventku.portofolio_umkm 
MODIFY id_portofolio INT NOT NULL AUTO_INCREMENT;