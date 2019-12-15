
<div class="content">
	<div class="row">
		<div class="col-md-4 form-content">
			<form method="POST" class="formAjax" autocomplete="off">
				<div class="form-group">
					<label for="cuenta" >Nombre de Cuenta</label>
					<input class="form-control" type="text" name="txtcuenta" id="cuenta" placeholder="Ej. Cartera">
				</div>
				<div class="form-group">
					<label for="saldo" >Saldo Inicial</label>
					<input class="form-control text-right" type="text" name="txtsaldo" id="saldo" placeholder="0.0">
				</div>
				<button class="btn btn-primary float-right" id="btnGuardar" type="button" data-action="Cuentas/crearCuentas">Guardar</button>
				<input type="hidden" name="mensaje" value="Se va a agregar una Cuenta nueva">
			</form>
		</div>
		<div class="col-md-8">
			<div class="row header-list">
				<div class="col-12">
					<button class="btn btn-success btn-list float-right" type="submit">Ver Lista</button>
				</div>
				
			</div>
			<div class="row CuadroListas"></div>
		</div>
	</div>
</div>

