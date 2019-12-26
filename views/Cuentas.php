<div class="content">
	<div class="row">
		<div class="col-md-3 form-content">
			<fieldset class="fieldset-border">
				<form method="POST" class="formAjax" autocomplete="off">
					<legend class="fieldset-border">Registro de Cuentas</legend>
						<div class="form-group">
							<input class="form-control" type="text" name="txtcuenta" id="txtcuenta" placeholder="Ej. Cartera" title="Nombre de la Cuenta">
						</div>
						<div class="form-group">
							<input class="form-control text-right" type="text" name="txtsaldo" id="txtsaldo" placeholder="0.0" title="Saldo Inicial">
							<input class="form-control text-right" type="text" name="txtsimbolo" id="txtsimbolo" placeholder="$" title="Simbolo Moneda">
						</div>
						<button class="btn btn-primary float-right" name="btn-form" data-action="Cuentas/crearCuentas" type="button">Guardar</button>
						<input type="hidden" id="msg-Guardar" value="Se va a agregar una Cuenta Nueva">
						<input type="hidden" id="txtid" name="txtid" value="Se va a agregar una Cuenta Nueva">
				</form>
			</fieldset>
		</div>
		<div class="col-md-9 content-list">
			<div class="row header-list">
				<div class="col-12">
					<button class="btn btn-success btn-list float-right" name="btn-list" data-action="Cuentas/listarCuentas" type="button">Ver</button>
				</div>
			</div>
			<div class="row CuadroListas"></div>
		</div>
	</div>
</div>

