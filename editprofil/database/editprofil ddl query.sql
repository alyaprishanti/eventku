create schema eventku;

create table eventku.UMKM(
    id_umkm INT AUTO_INCREMENT PRIMARY KEY,
    nama_pemilik_umkm VARCHAR(100) NOT NULL,
    nmr_telepon_umkm VARCHAR(15),
    email_umkm VARCHAR(100) UNIQUE,
    nama_usaha_umkm VARCHAR(100) NOT NULL,
    bidang_usaha_umkm VARCHAR(100),
    alamat_umkm TEXT
);

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