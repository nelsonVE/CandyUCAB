CREATE DATABASE candyucab;
\c candyucab;
CREATE TABLE lugar (
  id_lug SERIAL,
  nombre_lug VARCHAR(64) NOT NULL,
  tipo_lug VARCHAR(32) NOT NULL,
  fk_lug INT,
  CONSTRAINT pk_lugar PRIMARY KEY(id_lug)
);

CREATE TABLE cliente (
  id_cli SERIAL,
  rif_cli VARCHAR(10) UNIQUE NOT NULL,
  correo_cli VARCHAR(50) NOT NULL,
  tipo INT NOT NULL,
  cedula_nat VARCHAR(12) UNIQUE,
  nombre_1_nat VARCHAR(16),
  nombre_2_nat VARCHAR(16),
  apellido_1_nat VARCHAR(16),
  apellido_2_nat VARCHAR(16),
  den_com_jur VARCHAR(100),
  raz_soc_jur VARCHAR(100),
  capital_jur DECIMAL(11,2),
  pag_web_jur VARCHAR(64),
  fk_lug INT NOT NULL,
  fk_lug_jur INT,
  CONSTRAINT pk_cliente PRIMARY KEY(id_cli)
);

CREATE TABLE lug_jur (
  id_lug SERIAL,
  fk_lug int,
  fk_cli int,
  CONSTRAINT pk_lug_jur PRIMARY KEY(id_lug,fk_lug,fk_cli)
);

CREATE TABLE punto (
  id_pun SERIAL,
  valor_pun BIGINT NOT NULL,
  fecha_pun DATE NOT NULL,
  fk_cli INT,
  fk_ped int,
  CONSTRAINT pk_punto PRIMARY KEY(id_pun)
);

CREATE TABLE per_con (
  id_pco SERIAL,
  cedula_per VARCHAR(10),
  nombre_per VARCHAR(32) NOT NULL,
  apellido_per VARCHAR(32) NOT NULL,
  fk_cli INT NOT NULL,
  CONSTRAINT pk_percon PRIMARY KEY(id_pco)
);

CREATE TABLE tipo_car (
  id_tip SERIAL,
  desc_tip VARCHAR(128) NOT NULL,
  CONSTRAINT pk_tipo PRIMARY KEY(id_tip)
);

CREATE TABLE caramelo (
  id_car SERIAL,
  nombre_car VARCHAR(32) NOT NULL,
  forma_car VARCHAR(32) NOT NULL,
  tamanho_car VARCHAR(12) NOT NULL,
  desc_car VARCHAR(128) NOT NULL,
  url_car VARCHAR(256) NOT NULL,
  sabor_car VARCHAR(30) NOT NULL,
  precio_car INT NOT NULL,
  fk_tip INT NOT NULL,
  CONSTRAINT pk_caramelo PRIMARY KEY(id_car)
);

CREATE TABLE ingrediente (
  id_ing SERIAL,
  desc_ing VARCHAR(128) NOT NULL,
  CONSTRAINT pk_ingrediente PRIMARY KEY(id_ing)
);

CREATE TABLE tienda (
  id_tie SERIAL,
  nombre_tie VARCHAR(64) NOT NULL,
  tipo_tie INT NOT NULL,
  fk_lug INT NOT NULL,
  CONSTRAINT pk_tienda PRIMARY KEY(id_tie)
);

CREATE TABLE zona (
  id_zon SERIAL,
  letra_zon CHAR(1) NOT NULL,
  fk_pas INT,
  CONSTRAINT pk_zona PRIMARY KEY(id_zon)
);


CREATE TABLE pasillo (
  id_pas SERIAL,
  numero_pas SMALLINT NOT NULL,
  fk_tie INT,
  CONSTRAINT pk_pasillo PRIMARY KEY(id_pas)
);

CREATE TABLE zon_car (
  id_zca SERIAL,
  cantidad_zca BIGINT NOT NULL,
  fecha_zca TIMESTAMP NOT NULL,
  fk_zon INT NOT NULL,
  fk_car INT NOT NULL,
  CONSTRAINT pk_zoncar PRIMARY KEY(id_zca,fk_zon,fk_car)
);

CREATE TABLE departamento (
  id_dep SERIAL,
  nombre_dep VARCHAR(64) NOT NULL,
  fk_tie INT NOT NULL,
  CONSTRAINT pk_departamento PRIMARY KEY(id_dep)
);

CREATE TABLE personal (
  id_per SERIAL,
  cedula_per VARCHAR(10),
  nombre_1 VARCHAR(16) NOT NULL,
  nombre_2 VARCHAR(16) NOT NULL,
  apellido_1 VARCHAR(16) NOT NULL,
  apellido_2 VARCHAR(16),
  fecha_ingreso_per DATE NOT NULL,
  salario_per BIGINT NOT NULL,
  fk_tie INT NOT NULL,
  fk_dep INT NOT NULL,
  fk_lugar INT NOT NULL,
  CONSTRAINT pk_personal PRIMARY KEY(id_per)
);

CREATE TABLE telefono (
  id_tel SERIAL,
  numero_tel VARCHAR(12) NOT NULL,
  fk_cli int,
  fk_pco int,
  fk_per int,
  CONSTRAINT pk_telefono PRIMARY KEY(id_tel)
);

CREATE TABLE horario (
  id_hor SERIAL,
  hora_ent_hor TIME NOT NULL,
  hora_sal_hor TIME NOT NULL,
  dia_hor DATE NOT NULL,
  CONSTRAINT pk_horario PRIMARY KEY(id_hor)
);


CREATE TABLE rol (
  id_rol SERIAL,
  tipo varchar(20) NOT NULL,
  CONSTRAINT pk_rol PRIMARY KEY(id_rol)
);


CREATE TABLE usuario (
  id_usu SERIAL,
  usuario VARCHAR(30) UNIQUE NOT NULL,
  contrasenha VARCHAR(32) NOT NULL,
  fk_rol INT,
  fk_cli INT,
  fk_per INT,
  CONSTRAINT pk_usuario PRIMARY KEY(id_usu)
);

CREATE TABLE permiso (
  id_per SERIAL,
  desc_per VARCHAR(128) NOT NULL,
  CONSTRAINT pk_permiso PRIMARY KEY(id_per)
);

CREATE TABLE rol_per (
  id_rer SERIAL,
  fk_per INT ,
  fk_rol INT,
  CONSTRAINT pk_rolper PRIMARY KEY(id_rer,fk_per,fk_rol)
);

CREATE TABLE control (
  id_con SERIAL,
  fecha_con DATE NOT NULL,
  hora_ent_con TIME NOT NULL,
  hora_sal_con TIME NOT NULL,
  fk_per INT,
  CONSTRAINT pk_control PRIMARY KEY(id_con,fk_per)
);

CREATE TABLE oferta (
  id_ofe SERIAL,
  fecha_ini_ofe DATE,
  fecha_fin_ofe DATE,
  fk_per INT,
  CONSTRAINT pk_oferta PRIMARY KEY(id_ofe)
);

CREATE TABLE ofe_car (
  id_ofc SERIAL,
  descuento_ofe SMALLINT NOT NULL,
  fk_ofe INT ,
  fk_car INT ,
  CONSTRAINT pk_ofecar PRIMARY KEY(id_ofc,fk_ofe,fk_car)
);

CREATE TABLE hor_per(
	id_perh SERIAL,
	fk_hor INT,
	fk_per INT,
	CONSTRAINT pk_hor_per PRIMARY KEY(id_perh,fk_hor,fk_per)
);
CREATE TABLE presupuesto (
  id_pre SERIAL,
  fecha_pre DATE NOT NULL,
  fk_usu INT,
  fk_tie INT,
  fk_cli INT,
  total_pre BIGINT NOT NULL,
  CONSTRAINT pk_presupuesto PRIMARY KEY(id_pre)
);

CREATE TABLE pre_car (
  id_pre SERIAL,
  fk_pre INT ,
  fK_car INT ,
  CONSTRAINT pk_precar PRIMARY KEY(id_pre,fk_pre,fk_car)
);

CREATE TABLE pedido (
  id_ped SERIAL,
  fecha_ped DATE NOT NULL,
  hora_ped TIME NOT NULL,
  fk_usu INT ,
  fK_tie INT ,
  fk_cli INT,
  fk_pre INT,
  CONSTRAINT pk_pedido PRIMARY KEY(id_ped)
);

CREATE TABLE car_ped (
  id_car SERIAL,
  cantidad_car INT NOT NULL,
  precio_car INT,
  fK_car INT,
  fk_ped INT,
  CONSTRAINT pk_carped PRIMARY KEY(id_car,fk_car,fk_ped)
);

CREATE TABLE pago (
  id_pag SERIAL,
  efectivo_pag INT,
  ult_tres_digitos_cre VARCHAR(3),
  nro_tarjeta_cre varchar(20),
  tipo_cre INT,
  fecha_venc_cre varchar(10),
  banco_deb varchar(20),
  tipo_deb int,
  fecha_che DATE,
  numero_che VARCHAR(20),
  banco_che VARCHAR(30),
  nro_cuenta_che VARCHAR(20),
  tipo int NOT NULL,
  fk_cli INT,
  CONSTRAINT pk_pago PRIMARY KEY(id_pag)
);
CREATE TABLE pag_car_ped (
  id_ped SERIAL,
  monto_ped BIGINT NOT NULL,
  fk_ped INT,
  fk_pag INT,
  CONSTRAINT pk_pedpag PRIMARY KEY(id_ped, fk_ped, fk_pag)
);



CREATE TABLE estatus (
  id_est SERIAL,
  estatus_est INT NOT NULL,
  CONSTRAINT pk_estatus PRIMARY KEY(id_est)
);

CREATE TABLE ped_est (
  id_ped SERIAL,
  fecha_ini timestamp not null,
  fecha_fin timestamp,
  fk_est INT REFERENCES estatus(id_est),
  fk_ped INT REFERENCES pedido(id_ped),
  CONSTRAINT pk_pedest PRIMARY KEY(id_ped,fk_est,fk_ped)
);

CREATE TABLE car_ing(
	id_cig SERIAL,
	fk_car INT,
	fk_ing INT,
	CONSTRAINT pk_car_ing PRIMARY KEY(id_cig,fk_car,fk_ing)
);

CREATE TABLE diario(
  id_dia SERIAL,
  fk_per INT,
  fecha_emision_dia DATE,
  CONSTRAINT pk_diario PRIMARY KEY(id_dia)
);
