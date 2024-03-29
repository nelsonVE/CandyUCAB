

<?php $__env->startSection('titulo'); ?>
CandyUcab - ¡Bienvenido!
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contenido'); ?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12 bg-content-main">
			<div class="text-center my-5">
        <h2 class="text-white">¿Qué esperas para registrarte?</h2><hr>
        <div class="row">
          <div class="col-md-4 col-sm-0"></div>
          <div class="col-md-4 col-sm-0">
						<div class="row">
	            <div class="col-md-6 col-sm-12 bg-content t-body p-3  waves-effect" onclick="window.location='/registro/natural';">
								<img src="<?php echo asset('img/natural.svg'); ?>" width="128" height="128"> <hr>
								<h4>Personal</h4>
								<p class="text-center">Ideal para clientes naturales.</p>
	            </div>
							<div class="col-md-6 col-sm-12 bg-content t-body p-3  waves-effect" onclick="window.location='/registro/juridico';">
								<img src="<?php echo asset('img/juridico.svg'); ?>" width="128" height="128"> <hr>
								<h4>Jurídico</h4>
								<p class="text-center">Ideal para clientes los cuales
									necesitan registrar la cuenta a nombre de su empresa.</p>
							</div>
	          </div>
					</div>
          <div class="col-md-4 col-sm-0"></div>
        </div>
			</div>
		</div>
		<div class="col-md-12 bg-content p-5 aos-item">
      <h1 class="text-center tit-main">¿Por qué escojernos?</h1><br>
      <div class="container">
        <div class="row z-depth-1">
          <div class="col-md-4 col-sm-12 p-3 text-white" style="background-color:#ea6485; color:white; word-wrap: break-word;">
            <h2 class="text-center tit-main text-white">
              <i class="far fa-handshake" style="font-size:100px; color:white;"></i>
              <br><br>
              Profesionalismo
              <br><hr>
            </h2>
            <p class="text-justify">Candy UCAB es un grupo multinacional que se especializa en la
            elaboración de caramelos. Sus productos se elaboran bajo los más altos
            estándares de calidad en 47 plantas industriales ubicadas en
            Latinoamérica y desarrolla marcas líderes que disfrutan consumidores
            de todo el mundo.</p>
          </div>
          <div class="col-md-4 p-3" style="background-color:#de8787; color: white; word-wrap: break-word;">
            <h2 class="text-center text-white">
              <i class="far fa-compass" style="font-size:100px;"></i>
              <br><br>
              Accesibilidad
              <br><hr>
            </h2>
            <p class="text-justify">Con oficinas comerciales ubicadas en América, Europa y Asia, Candy
            UCAB es el grupo venezolano con la mayor cantidad de mercados abiertos
            en el mundo, llegando con sus productos a más de 120 países.
            </p>
          </div>
          <div class="col-md-4 p-3" style="background-color:#ea6485; color:white; word-wrap: break-word;">
            <h2 class="text-center">
              <i class="far fa-star" style="font-size:100px;"></i>
              <br><br>
              Variedad
              <br><hr>
            </h2>
            <p class="text-justify">Poseemos actualmente una gran variedad de golosinas a la venta para
              nuestro público, con un exquisito sabor, dulzura y además extremadamente agradables para
              el paladar, lo cual nos diferencia y nos hace tan únicos en el mercado.
            </p>
          </div>
        </div>
      </div>
    </div>
		<div class="col-md-12 bg-content-main text-center p-5">
			<h2 class="text-white">«Soñar con caramelos hace la vida más fácil...»</h2>
			<h4 class="text-white font-italic">-Amelia Farrisiti</h4>
		</div>
		<div class="col-md-12 bg-content p-5">

		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>