
 ALTER TABLE lugar ADD CONSTRAINT fk_id_lugar FOREIGN KEY(fk_lug) REFERENCES lugar(id_lug);
 ALTER TABLE cliente ADD CONSTRAINT fk_cli_lugar FOREIGN KEY(fk_lug) REFERENCES lugar(id_lug);
 ALTER TABLE usuario ADD CONSTRAINT fk_usu_cliente FOREIGN KEY(fk_cli) REFERENCES cliente(id_cli);
 ALTER TABLE cliente ADD CONSTRAINT fk_cli_jur_lugar FOREIGN KEY(fk_lug) REFERENCES lugar(id_lug);
 ALTER TABLE lug_jur ADD CONSTRAINT fk_lug_lugar FOREIGN KEY(fk_lug) REFERENCES lugar(id_lug);
 ALTER TABLE lug_jur ADD CONSTRAINT fk_jur_lugar FOREIGN KEY(fk_cli) REFERENCES cliente(id_cli);
 ALTER TABLE punto ADD CONSTRAINT fk_cli_punto FOREIGN KEY(fk_cli) REFERENCES cliente(id_cli);
 ALTER TABLE punto ADD CONSTRAINT fk_ped_punto FOREIGN KEY(fk_ped) REFERENCES pedido(id_ped);
 ALTER TABLE per_con ADD CONSTRAINT fk_cli_persona FOREIGN KEY(fk_cli) REFERENCES cliente(id_cli);
 ALTER TABLE caramelo ADD CONSTRAINT fk_tip_caramelo FOREIGN KEY(fk_tip) REFERENCES tipo_car(id_tip);
ALTER TABLE tienda ADD CONSTRAINT fk_lug_tienda FOREIGN KEY(fk_lug) REFERENCES lugar(id_lug);
ALTER TABLE zona ADD CONSTRAINT fk_tie_zona FOREIGN KEY(fk_tie) REFERENCES tienda(id_tie);
ALTER TABLE pasillo ADD CONSTRAINT fk_zon_pasillo FOREIGN KEY(fk_zon) REFERENCES zona(id_zon);
ALTER TABLE inventario ADD CONSTRAINT fk_tie_inventario FOREIGN KEY(fk_tie) REFERENCES tienda(id_tie);
ALTER TABLE inv_car ADD CONSTRAINT fk_car_inv FOREIGN KEY(fk_car) REFERENCES caramelo(id_car);
ALTER TABLE inv_car ADD CONSTRAINT fk_inv_car FOREIGN KEY(fk_inv,fk_tie) REFERENCES inventario(id_inv,fk_tie);
ALTER TABLE departamento ADD CONSTRAINT fk_tie_departamento FOREIGN KEY(fk_tie) REFERENCES tienda(id_tie);
ALTER TABLE personal ADD CONSTRAINT fk_tie_personal FOREIGN KEY(fk_tie) REFERENCES tienda(id_tie);
ALTER TABLE personal ADD CONSTRAINT fk_dep_personal FOREIGN KEY(fk_dep) REFERENCES departamento(id_dep);
ALTER TABLE personal ADD CONSTRAINT fk_lug_personal FOREIGN KEY(fk_lugar) REFERENCES lugar(id_lug);
ALTER TABLE telefono ADD CONSTRAINT fk_cli_telefono FOREIGN KEY(fk_cli) REFERENCES cliente(id_cli);
ALTER TABLE telefono ADD CONSTRAINT fk_pco_telefono FOREIGN KEY(fk_pco) REFERENCES per_con(id_pco);
ALTER TABLE telefono ADD CONSTRAINT fk_per_telefono FOREIGN KEY(fk_per) REFERENCES personal(id_per);
ALTER TABLE usuario ADD CONSTRAINT fk_rol_usuario FOREIGN KEY(fk_rol) REFERENCES rol(id_rol);
ALTER TABLE rol_per ADD CONSTRAINT fk_rol_per FOREIGN KEY(fk_per) REFERENCES permiso(id_per);
ALTER TABLE rol_per ADD CONSTRAINT fk_per_rol FOREIGN KEY(fk_rol) REFERENCES rol(id_rol);
ALTER TABLE control ADD CONSTRAINT fk_control FOREIGN KEY(fk_per) REFERENCES personal(id_per);
ALTER TABLE oferta ADD CONSTRAINT fk_per_oferta FOREIGN KEY(fk_per) REFERENCES personal(id_per);
ALTER TABLE ofe_car ADD CONSTRAINT fk_ofe_car FOREIGN KEY(fk_ofe) REFERENCES oferta(id_ofe);
ALTER TABLE ofe_car ADD CONSTRAINT fk_car_ofe FOREIGN KEY(fk_car) REFERENCES caramelo(id_car);
ALTER TABLE hor_per ADD CONSTRAINT fk_hor_per FOREIGN KEY(fk_per) REFERENCES personal(id_per);
ALTER TABLE hor_per ADD CONSTRAINT fk_per_hor FOREIGN KEY(fk_hor) REFERENCES horario(id_hor);
ALTER TABLE presupuesto ADD CONSTRAINT fk_usu_presupuesto FOREIGN KEY(fk_usu) REFERENCES usuario(id_usu);
ALTER TABLE presupuesto ADD CONSTRAINT fk_tie_presupuesto FOREIGN KEY(fk_tie) REFERENCES tienda(id_tie);
ALTER TABLE presupuesto ADD CONSTRAINT fk_cli_presupuesto FOREIGN KEY(fk_cli) REFERENCES cliente(id_cli);
ALTER TABLE pre_car ADD CONSTRAINT fk_pre_car FOREIGN KEY(fk_pre) REFERENCES presupuesto(id_pre);
ALTER TABLE pre_car ADD CONSTRAINT fk_car_pre FOREIGN KEY(fk_car) REFERENCES caramelo(id_car);
ALTER TABLE pedido ADD CONSTRAINT fk_usu_pedido FOREIGN KEY(fk_usu) REFERENCES usuario(id_usu);
ALTER TABLE pedido ADD CONSTRAINT fk_tie_pedido FOREIGN KEY(fk_tie) REFERENCES tienda(id_tie);
ALTER TABLE pedido ADD CONSTRAINT fk_cli_pedido FOREIGN KEY(fk_cli) REFERENCES cliente(id_cli);
ALTER TABLE car_ped ADD CONSTRAINT fk_ped_car FOREIGN KEY(fk_ped) REFERENCES pedido(id_ped);
ALTER TABLE car_ped ADD CONSTRAINT fk_car_ped FOREIGN KEY(fk_car) REFERENCES caramelo(id_car);
ALTER TABLE car_ing ADD CONSTRAINT fk_car_ing FOREIGN KEY(fk_car) REFERENCES caramelo(id_car);
ALTER TABLE car_ing ADD CONSTRAINT fk_ing_car FOREIGN KEY(fk_ing) REFERENCES ingrediente(id_ing);
ALTER TABLE ped_est ADD CONSTRAINT fk_ped_est FOREIGN KEY(fk_est) REFERENCES estatus(id_est);
ALTER TABLE ped_est ADD CONSTRAINT fk_est_ped FOREIGN KEY(fk_ped) REFERENCES pedido(id_ped);
ALTER TABLE pago ADD CONSTRAINT fk_pago_cliente FOREIGN KEY(fk_cli) REFERENCES cliente(id_cli);
ALTER TABLE pag_car_ped ADD CONSTRAINT fk_pago_car FOREIGN KEY(fk_ped_car,fk_car,fk_ped) REFERENCES car_ped(id_car,fk_car,fk_ped);
ALTER TABLE pag_car_ped ADD CONSTRAINT fk_car_pago FOREIGN KEY(fk_pag) REFERENCES pago(id_pag);










