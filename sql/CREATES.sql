CREATE TABLE lugar (
  id_lug SERIAL,
  nombre_lug VARCHAR(32) NOT NULL,
  tipo_lug VARCHAR(32) NOT NULL,
  fk_lugar INT,
  CONSTRAINT pk_lugar PRIMARY KEY(id_lug)
);

CREATE TABLE cliente (
  rif_cli VARCHAR(10) NOT NULL,
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
  fk_lugar INT,
  CONSTRAINT pk_cliente PRIMARY KEY(rif_cli)
);

CREATE TABLE lug_jur (
  id_lug SERIAL,
  fk_lug int REFERENCES lugar(id_lug),
  fk_cli varchar(10) REFERENCES cliente(rif_cli),
  CONSTRAINT pk_lug_jur PRIMARY KEY(id_lug,fk_lug,fk_cli)
);

CREATE TABLE punto (
  id_pun SERIAL,
  valor_pun BIGINT NOT NULL,
  fecha_pun DATE NOT NULL,
  fk_cli INT REFERENCES cliente(id_cli) NOT NULL,
  CONSTRAINT pk_punto PRIMARY KEY(id_punto)
);

CREATE TABLE per_con (
  cedula_per VARCHAR(10),
  nombre_per VARCHAR(32) NOT NULL,
  apellido_per VARCHAR(32) NOT NULL,
  fk_cli INT REFERENCES cliente(id_cli) NOT NULL,
  fk_tel INT REFERENCES telefono(id_tel) NOT NULL,
  CONSTRAINT pk_percon PRIMARY KEY(cedula_per)
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
  fk_tip INT references tipo_car(id_tip) NOT NULL,
  CONSTRAINT pk_caramelo PRIMARY KEY(id_car)
);

CREATE TABLE ingrediente (
  id_ing SERIAL,
  desc_ing VARCHAR(128) NOT NULL,
  fk_car INT references caramelo(id_car) NOT NULL,
  CONSTRAINT pk_ingrediente PRIMARY KEY(id_ing)
);

CREATE TABLE tienda (
  id_tie SERIAL,
  nombre_tie VARCHAR(64) NOT NULL,
  tipo_tie VARCHAR(8) NOT NULL,
  fk_lug INT REFERENCES lugar(id_lug),
  CONSTRAINT pk_tienda PRIMARY KEY(id_tie)
);

CREATE TABLE zona (
  id_zon SERIAL,
  letra_zon CHAR(1) NOT NULL,
  fk_tie INT REFERENCES tienda(id_tie) NOT NULL,
  CONSTRAINT pk_zona PRIMARY KEY(id_zon)
);

CREATE TABLE pasillo (
  id_pas SERIAL,
  numero_pas SMALLINT NOT NULL,
  fk_zon INT REFERENCES zona(id_zon) NOT NULL,
  CONSTRAINT pk_pasillo PRIMARY KEY(id_pas)
);

CREATE TABLE inventario (
  id_inv SERIAL,
  fecha_inv DATE NOT NULL,
  fk_tie INT REFERENCES tienda(id_tie) NOT NULL,
  CONSTRAINT pk_inventario PRIMARY KEY(id_inv)
);

CREATE TABLE inv_car (
  id_icr SERIAL,
  cantidad_inv BIGINT NOT NULL,
  fk_inv INT REFERENCES inventario(id_inv),
  fk_car INT REFERENCES caramelo(id_car),
  CONSTRAINT pk_invcar PRIMARY KEY(id_icr,fk_inv,fk_car)
);

CREATE TABLE departamento (
  id_dep SERIAL,
  nombre_dep VARCHAR(64) NOT NULL,
  fk_tie INT REFERENCES tienda(id_tie) NOT NULL,
  CONSTRAINT pk_departamento PRIMARY KEY(id_dep)
);

CREATE TABLE personal (
  cedula_per VARCHAR(10),
  nombre_1 VARCHAR(16) NOT NULL,
  nombre_2 VARCHAR(16) NOT NULL,
  apellido_1 VARCHAR(16) NOT NULL,
  apellido_2 VARCHAR(16),
  fecha_ingreso_per DATE NOT NULL,
  salario_per BIGINT NOT NULL,
  fk_tie INT references tienda(id_tie) NOT NULL,
  fk_dep INT references departamento(id_dep) NOT NULL,
  CONSTRAINT pk_personal PRIMARY KEY(cedula_per)
);

CREATE TABLE telefono (
  id_tel SERIAL,
  numero_tel VARCHAR(12) NOT NULL,
  fk_id_cli REFERENCES cliente(id_cliente),
  fk_id_pco REFERENCES per_con(cedula_per),
  fk_id_per REFERENCES persona(cedula_per),
  CONSTRAINT pk_telefono PRIMARY KEY(id_tel)
);

CREATE TABLE horario (
  id_hor SERIAL,
  hora_ent_hor TIME NOT NULL,
  hora_sal_hor TIME NOT NULL,
  dia_hor DATE NOT NULL,
  fk_per INT references personal(cedula_per) NOT NULL,
  CONSTRAINT pk_horario PRIMARY KEY(id_hor)
);

CREATE TABLE usuario (
  id_usu SERIAL,
  usuario VARCHAR(16) UNIQUE NOT NULL,
  contrasenha VARCHAR(32) NOT NULL,
  fk_cli INT REFERENCES cliente(rif_cli) NOT NULL,
  CONSTRAINT pk_usuario PRIMARY KEY(id_usu)
);

CREATE TABLE rol (
  id_rol SERIAL,
  tipo SMALLINT UNIQUE NOT NULL,
  fk_usu INT REFERENCES usuario(id_usu) NOT NULL,
  CONSTRAINT pk_rol PRIMARY KEY(id_rol)
);

CREATE TABLE permiso (
  id_per SERIAL,
  desc_per VARCHAR(128) NOT NULL,
  CONSTRAINT pk_permiso PRIMARY KEY(id_per)
);

CREATE TABLE rol_per (
  id_rer SERIAL,
  fk_per INT REFERENCES personal(id_per),
  fk_rol INT REFERENCES rol(id_rol),
  CONSTRAINT pk_rolper PRIMARY KEY(id_rer,fk_per,fk_rol)
);

CREATE TABLE control (
  id_con SERIAL,
  fecha_con DATE NOT NULL,
  hora_ent_con TIME NOT NULL,
  hora_sal_con TIME NOT NULL,
  fk_per INT REFERENCES personal(id_per) NOT NULL,
  CONSTRAINT pk_control PRIMARY KEY(id_con)
);

CREATE TABLE oferta (
  id_ofe SERIAL,
  fecha_ini_ofe DATE,
  fecha_fin_ofe DATE,
  fk_personal VARCHAR(10) REFERENCES personal(cedula_per),
  CONSTRAINT pk_oferta PRIMARY KEY(id_ofe)
);

CREATE TABLE ofe_car (
  id_ofc SERIAL,
  descuento_ofe SMALLINT NOT NULL,
  fk_ofe INT REFERENCES oferta(id_ofe),
  fk_car INT REFERENCES caramelo(id_car),
  CONSTRAINT pk_ofecar PRIMARY KEY(id_ofc,id_ofe,id_car)
);

CREATE TABLE presupuesto (
  id_pre SERIAL,
  fecha_pre DATE NOT NULL,
  fk_usu INT REFERENCES usuario(id_usu),
  fk_tie INT REFERENCES tienda(id_tie),
  fk_cli VARCHAR(10) REFERENCES cliente(rif_cli),
  CONSTRAINT pk_presupuesto PRIMARY KEY(id_pre)
);

CREATE TABLE pre_car (
  id_pre SERIAL,
  fk_pre INT REFERENCES presupuesto(id_pre),
  fK_car INT REFERENCES caramelo(id_car),
  CONSTRAINT pk_precar PRIMARY KEY(id_pre,fk_pre,fk_car)
);

CREATE TABLE pedido (
  id_ped SERIAL,
  fecha_ped DATE NOT NULL,
  hora_ped TIME NOT NULL,
  fk_usu INT REFERENCES usuario(id_usu),
  fK_car INT REFERENCES caramelo(id_car),
  CONSTRAINT pk_pedido PRIMARY KEY(id_ped)
);

CREATE TABLE car_ped (
  id_car SERIAL,
  cantidad_car INT NOT NULL,
  fK_car INT REFERENCES caramelo(id_car),
  fk_ped INT REFERENCES pedido(id_ped),
  CONSTRAINT pk_carped PRIMARY KEY(id_car,fk_car,fk_ped)
);

CREATE TABLE pago (
  id_pag SERIAL,
  efectivo_pag INT,
  num_cuenta_tra BIGINT,
  banco_tra VARCHAR(32),
  referencia_tra VARCHAR(16),
  ult_dig_tip SMALLINT,
  nro_tarjeta_tip BIGINT,
  tipo_tip SMALLINT,
  fecha_ven_tip DATE,
  banco_tip VARCHAR(32),
  tipo_cuenta_tip SMALLINT,
  tipo_tip SMALLINT,
  numero_che BIGINT,
  fecha_che DATE,
  banco_che VARCHAR(32),
  nro_cuenta_che BIGINT,
  fk_cli VARCHAR(10) REFERENCES cliente(rif_cli),
  CONSTRAINT pk_pago PRIMARY KEY(id_pag)
);

CREATE TABLE ped_pag (
  id_ped SERIAL,
  monto_ped BIGINT NOT NULL,
  cantidad_ped BIGINT NOT NULL,
  fk_ped INT REFERENCES pedido(id_ped),
  fk_pag INT REFERENCES pago(id_pag),
  CONSTRAINT pk_pedpag PRIMARY KEY(id_ped, fk_ped, fk_pag)
);

CREATE TABLE factura (
  id_fac SERIAL,
  fecha_fac DATE NOT NULL,
  fk_ppa INT REFERENCES ped_pag(id_ped),
  CONSTRAINT pk_factura PRIMARY KEY(id_fac)
);

CREATE TABLE estatus (
  id_est SERIAL,
  estatus_est INT NOT NULL,
  CONSTRAINT pk_estatus PRIMARY KEY(id_est)
);

CREATE TABLE ped_est (
  id_ped SERIAL,
  fk_est INT REFERENCES estatus(id_est),
  fk_ped INT REFERENCES pedido(id_ped),
  CONSTRAINT pk_pedest PRIMARY KEY(id_ped,fk_est,fk_ped)
);