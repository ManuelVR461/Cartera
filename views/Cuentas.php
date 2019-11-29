
<div class="content">
	<div class="row">
		<div class="col-md-4">
			<form action='Cuentas/listarCuentas' method="POST" class="formAjax" autocomplete="off" enctype="text/html; charset=utf-8">
				<div class="form-group">
					<label for="cuenta" >Nombre de Cuenta</label>
					<input class="form-control" type="text" name="txtcuenta" id="cuenta" placeholder="Ej. Cartera">
				</div>
				<div class="form-group">
					<label for="saldo" >Saldo Inicial</label>
					<input class="form-control text-right" type="text" name="txtsaldo" id="saldo" placeholder="0.0">
				</div>
				<button class="btn btn-primary float-right" type="submit">Guardar</button>
				<input type="hidden" name="mensaje" value="Se va a agregar una Cuenta nueva">
			</form>
		</div>
		<div class="col-md-8 CuadroListas">
			
		</div>
	</div>
</div>

