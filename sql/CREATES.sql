CREATE TABLE lugar (
  id_lug SERIAL PRIMARY KEY,
  nombre_lug VARCHAR(32) NOT NULL,
  tipo_lug VARCHAR(32) NOT NULL,
  fk_lug INT references lugar(id_lug)
);

CREATE TABLE cliente (
  rif_cli VARCHAR(10) PRIMARY KEY NOT NULL,
  correo_cli VARCHAR(32) NOT NULL,
  tipo INT NOT NULL,
  cedula_nat VARCHAR(10) UNIQUE,
  nombre_1_nat VARCHAR(16),
  nombre_2_nat VARCHAR(16),
  apellido_1_nat VARCHAR(16),
  apellido_2_nat VARCHAR(16),
  den_com_jur VARCHAR(64),
  raz_soc_jur VARCHAR(32),
  capital_jur BIGINT,
  pag_web_jur VARCHAR(64),
  fk_lug INT references lugar(id_lug) NOT NULL
);

CREATE TABLE lug_jur (
  id_lur SERIAL PRIMARY KEY,
  fk_lug INT REFERENCES lugar(id_lug) NOT NULL,
  fk_cli INT REFERENCES cliente(rif_cli) NOT NULL
);

CREATE TABLE telefono (
  id_tel SERIAL PRIMARY KEY,
  numero_tel VARCHAR(12) NOT NULL
);

CREATE TABLE punto (
  id_pun SERIAL PRIMARY KEY,
  valor_pun BIGINT NOT NULL,
  fecha_pun DATE NOT NULL,
  fk_cli INT REFERENCES cliente(id_cli) NOT NULL
);

CREATE TABLE per_con (
  cedula_per VARCHAR(10) UNIQUE NOT NULL,
  nombre_per VARCHAR(32) NOT NULL,
  apellido_per VARCHAR(32) NOT NULL,
  fk_cli INT REFERENCES cliente(id_cli) NOT NULL,
  fk_tel INT REFERENCES telefono(id_tel) NOT NULL
);

CREATE TABLE fabrica (
  id_fab SERIAL PRIMARY KEY,
  nombre_fab VARCHAR(64) NOT NULL,
  fk_lug INT REFERENCES lugar(id_lug) NOT NULL
)

CREATE TABLE tipo_car (
  id_tip SERIAL PRIMARY KEY,
  desc_tip VARCHAR(128) NOT NULL
);

CREATE TABLE sabor (
  id_sab SERIAL PRIMARY KEY,
  desc_sab VARCHAR(128) NOT NULL
);

CREATE TABLE caramelo (
  id_car SERIAL PRIMARY KEY,
  nombre_car VARCHAR(32) NOT NULL,
  forma_car VARCHAR(32) NOT NULL,
  tamanho_car VARCHAR(12) NOT NULL,
  desc_car VARCHAR(128) NOT NULL,
  fk_sab INT references tipo_car(id_tip) NOT NULL,
  fk_fab INT REFERENCES fabrica(id_fab) NOT NULL
);

CREATE TABLE car_sab (
  id_cab SERIAL PRIMARY KEY,
  fk_sab INT references sabor(id_sab) NOT NULL,
  fk_car INT references caramelo(id_car) NOT NULL
);

CREATE TABLE ingrediente (
  id_ing SERIAL PRIMARY KEY,
  desc_ing VARCHAR(128) NOT NULL,
  fk_car INT references caramelo(id_car) NOT NULL
);

CREATE TABLE tienda (
  id_tie SERIAL PRIMARY KEY,
  nombre_tie VARCHAR(64) NOT NULL,
  tipo_tie VARCHAR(8) NOT NULL,
  fk_lug INT REFERENCES lugar(id_lug)
);

CREATE TABLE zona (
  id_zon SERIAL PRIMARY KEY,
  letra_zon CHAR(1) NOT NULL,
  fk_tie INT REFERENCES tienda(id_tie) NOT NULL
);

CREATE TABLE pasillo (
  id_pas SERIAL PRIMARY KEY,
  numero_pas SMALLINT NOT NULL,
  fk_zon INT REFERENCES zona(id_zon) NOT NULL
);

CREATE TABLE inventario (
  id_inv SERIAL PRIMARY KEY,
  fecha_inv DATE NOT NULL,
  fk_tie INT REFERENCES tienda(id_tie) NOT NULL
);

CREATE TABLE inv_car (
  id_icr SERIAL PRIMARY KEY,
  cantidad_inv BIGINT NOT NULL,
  fk_inv INT REFERENCES inventario(id_inv) NOT NULL,
  fk_car INT REFERENCES caramelo(id_car) NOT NULL
);

CREATE TABLE departamento (
  id_dep SERIAL PRIMARY KEY,
  nombre_dep VARCHAR(64) NOT NULL,
  fk_tie INT REFERENCES tienda(id_tie) NOT NULL
);

CREATE TABLE personal (
  cedula_per VARCHAR(10) UNIQUE PRIMARY KEY,
  nombre_1 VARCHAR(16) NOT NULL,
  nombre_2 VARCHAR(16) NOT NULL,
  apellido_1 VARCHAR(16) NOT NULL,
  apellido_2 VARCHAR(16),
  fecha_ingreso_per DATE NOT NULL,
  salario_per BIGINT NOT NULL,
  fk_tie INT references tienda(id_tie) NOT NULL
);

CREATE TABLE horario (
  id_hor SERIAL PRIMARY KEY,
  hora_ent_hor TIME NOT NULL,
  hora_sal_hor TIME NOT NULL,
  dia_hor DATE NOT NULL,
  fk_per INT references personal(cedula_per) NOT NULL
);

CREATE TABLE usuario (
  id_usu SERIAL PRIMARY KEY,
  usuario VARCHAR(16) UNIQUE NOT NULL,
  contrasenha VARCHAR(32) NOT NULL,
  fk_cli INT REFERENCES cliente(rif_cli) NOT NULL
);

CREATE TABLE rol (
  id_rol SERIAL PRIMARY KEY,
  tipo SMALLINT UNIQUE NOT NULL,
  fk_usu INT REFERENCES usuario(id_usu) NOT NULL
);

CREATE TABLE permiso (
  id_per SERIAL PRIMARY KEY,
  desc_per VARCHAR(128) NOT NULL
);

CREATE TABLE rol_per (
  id_rer SERIAL PRIMARY KEY,
  fk_per INT REFERENCES personal(id_per) NOT NULL,
  fk_rol INT REFERENCES rol(id_rol) NOT NULL
);

CREATE TABLE control (
  id_con SERIAL PRIMARY KEY,
  fecha_con DATE NOT NULL,
  hora_ent_con TIME NOT NULL,
  hora_sal_con TIME NOT NULL,
  fk_per INT REFERENCES personal(id_per) NOT NULL
);
