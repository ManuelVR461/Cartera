
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
				<button class="btn btn-primary float-right" name="btn" data-action="Cuentas/crearCuentas" type="button" >Guardar</button>
				<input type="hidden" name="mensaje" value="Se va a agregar una Cuenta nueva">
			</form>
		</div>
		<div class="col-md-8">
			<div class="row header-list">
				<div class="col-12">
					<form method="POST" class="listAjax" autocomplete="off">
						<button class="btn btn-success btn-list float-right" name="btn" data-action="Cuentas/listarCuentas" type="button">Ver Lista</button>
					</form>
				</div>
				
			</div>
			<div class="row CuadroListas"></div>
		</div>
	</div>
</div>

