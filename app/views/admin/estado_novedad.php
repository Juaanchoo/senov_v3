<div id="estado_novedad">

 <div class="container mt-5">
		<div class="card shadow">
			<h5 class="card-header t-card">Novedades</h5>
			<div class="card-body">
				<div class="search-form">
					<span>Buscar:</span>
					<input type="text" placeholder="Buscar...">
				</div>
				<div class="table-responsive">
					<table class="table table-bordered table-striped">
						<thead class="text-center">
							<tr>
								<th>Documento</th>
								<th>Nombre</th>
								<th>Apellido</th>
								<th>Tipo novedad</th>
								<th>Estado</th>
								<th>Archivos</th>
								<th>Opciones</th>
							</tr>
						</thead>
						<tbody class="text-center">

							<tr v-for="item in arrayNovedades" :key="item.id">
								<td v-text="item.documento"></td>
								<td v-text="item.nombre"></td>
								<td v-text="item.apellido"></td>
								<td v-text="item.novedad"></td>
								<td>
									<span v-if="item.estado == 'En tramite'" class="badge badge-info" v-text="item.estado">...</span>
									<span v-if="item.estado == 'Aprobado'" class="badge badge-success" v-text="item.estado">...</span>
									<span v-if="item.estado == 'No Aprobado'" class="badge badge-danger" v-text="item.estado">...</span>
								</td>
								<td>
									pdf :v
								</td>
								<td>

									<div class="btn-group dropleft">
										<button type="button" class="btn btn-secondary " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<i class="fas fa-cog"></i>
										</button>
										<div class="dropdown-menu" x-placement="right-start" style="position: absolute; transform: translate3d(112px, 0px, 0px); top: 0px; left: 0px; will-change: transform;">
											<a @click="verNovedad(item)" data-toggle="modal" data-target="#exampleModal" class="dropdown-item" href="#">Ver toda la novedad</a>
											<div class="dropdown-divider"></div>
											<a @click="verActualizarEstado(item)" data-toggle="modal" data-target="#modalActualizarNov" class="dropdown-item" href="#">Actualizar Estado</a>
										</div>
									</div>
 
								</td>
							</tr>

						</tbody>
					</table>
				</div>
			<nav aria-label="...">
				<ul class="pagination">
					<li class="page-item disabled">
						<span class="page-link">Previous</span>
					</li>
					<li class="page-item active"><a class="page-link" href="#">1</a></li>
					<li class="page-item">
						<span class="page-link">
							2
							<span class="sr-only">(current)</span>
						</span>
					</li>
					<li class="page-item"><a class="page-link" href="#">3</a></li>
					<li class="page-item">
						<a class="page-link" href="#">Next</a>
					</li>
				</ul>
			</nav>
			</div>
		</div>
	</div>
  
<!-- Modal ver -->

<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header mh">
        <p class="modal-title mt" id="exampleModalLabel">Información Novedad</p>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -5px;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <hr>
      <div class="row">
      	<div class="col divM">Tipo Documento</div>
      		<div class="col divM" v-text="novedades.tipo_documento"> </div>
      </div> 
      <hr>
      	<div class="row">
      		<div class="col divM">Documento</div>
      		<div class="col divM" v-text="novedades.documento">...</div>
      	</div>
      	<hr>
      	<div class="row">
      		<div class="col divM">Nombre</div>
      		<div class="col divM" v-text="novedades.nombre">...</div>
      	</div>
      	<hr>
      	<div class="row">
      		<div class="col divM">Apellido</div>
      		<div class="col divM" v-text="novedades.apellido">...</div>
      	</div>
      	<hr>
      	<div class="row">
      		<div class="col divM">Email</div>
      		<div class="col divM" v-text="novedades.email">...</div>
      	</div>
      	<hr>
      	<div class="row">
      		<div class="col divM">Telefono</div>
      		<div class="col divM" v-text="novedades.telefono">...</div>
      	</div>
      	<hr>
      	<div class="row">
      		<div class="col divM">Codigo Ficha</div>
      		<div class="col divM" v-text="novedades.codigo_ficha">...</div>
      	</div>
      	<hr>
      	<div class="row">
      		<div class="col divM">Novedad</div>
      		<div class="col divM" v-text="novedades.novedad">...</div>
      	</div>
      	<hr>
      	<div class="row">
      		<div class="col divM">Acta Novedad</div>
      		<div class="col divM" v-text="novedades.acta_novedad">...</div>
      	</div>
      	<hr>
      	<div class="row">
      		<div class="col divM">Fecha Inicio</div>
			<div class="col divM" v-text="novedades.fecha_inicio">...</div>
      	</div>
      	<hr>
      	<div class="row">
      		<div class="col divM">Fecha Final</div>
      		<div class="col divM" v-text="novedades.fecha_final">...</div>
      	</div>
      	<hr>
      	<div class="row">
      		<div class="col divM">Estado</div>
      		<div class="col divM">
			  <span v-if="novedades.estado == 'En tramite'" class="badge badge-info" v-text="novedades.estado">...</span>
			  <span v-if="novedades.estado == 'Aprobado'" class="badge badge-success" v-text="novedades.estado">...</span>
			  <span v-if="novedades.estado == 'No Aprobado'" class="badge badge-danger" v-text="novedades.estado">...</span>
			</div>
      	</div>
      </div>
	  <div class="modal-footer justify-content-center">
		<button type="button" class="btn btn-outline-dark" data-dismiss="modal">Cerrar</button>
	  </div>
    </div>
  </div>
</div>

<!-- Modal estado -->
<div class="modal fade" id="modalActualizarNov" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modificar Estado	</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  	<div class="p-3">
		  <div class="custom-control custom-radio custom-control-inline">
				<input value="1" v-model="estado.status" type="radio" id="customRadioInline1" name="customRadioInline1" class="custom-control-input">
				<label class="custom-control-label" for="customRadioInline1">En tramite</label>
			</div>
		  	<div class="custom-control custom-radio custom-control-inline">
				<input value="2" v-model="estado.status" type="radio" id="customRadioInline1" name="customRadioInline1" class="custom-control-input">
				<label class="custom-control-label" for="customRadioInline1">Aprobado</label>
			</div>
			<div class="custom-control custom-radio custom-control-inline">
				<input value="3" v-model="estado.status" type="radio" id="customRadioInline2" name="customRadioInline1" class="custom-control-input">
				<label class="custom-control-label" for="customRadioInline2">No Aprobado</label>
			</div>
		</div>
		<div>
			<p class="text-muted p-2">
				<b>Nota:</b> Por favor! Verifique toda la información de la novedad antes de cambiar su estado.
			</p>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" @click="actualizarEstado()">Actualizar</button>
      </div>
    </div>
  </div>
</div>

</div>




</div>

<script>
var app = new Vue({
	el: '#estado_novedad',
	data: {
		novedades:{
			id_novedad: 0,
			tipo_documento: '',
			documento: '',
			nombre: '',
			apellido: '',
			email: '',
			telefono: '',
			codigo_ficha: '',
			novedad: '',
			acta_novedad: '',
			fecha_inicio: '',
			fecha_final: '',
			estado: '',
		},
		estado:{
			id: 0,
			status:0
		},
		arrayNovedades:[]
	},
	methods:{
		getNovedades(){
			var me = this;
			axios.get('/senov_v3/novedades/index')
			.then(function (response) {
				var res = response.data;

				me.arrayNovedades = res.novedades;
				// console.log(me.arrayNovedades);
				
			})
			.catch(function (error) {
				console.error(error);
			});
		},
		verNovedad(data){
			let me = this;
			console.log(data);
			
			me.novedades.id_novedad 	= data.id_novedad;
			me.novedades.tipo_documento = data.tipo_documento;
			me.novedades.documento 		= data.documento;
			me.novedades.nombre 		= data.nombre;
			me.novedades.apellido 		= data.apellido;
			me.novedades.email 			= data.email;
			me.novedades.telefono 		= data.telefono;
			me.novedades.codigo_ficha 	= data.codigo_ficha;
			me.novedades.novedad 		= data.novedad;
			me.novedades.acta_novedad 	= data.acta_novedad;
			me.novedades.fecha_inicio 	= data.fecha_inicio;
			me.novedades.fecha_final 	= data.fecha_final;
			me.novedades.estado			= data.estado;			
		},
		verActualizarEstado(data){
			let me = this;
			me.estado.id = data.id_novedad;
			if(data.estado == "En tramite"){
				me.estado.status = 1;
			}
			if(data.estado == "Aprobado"){
				me.estado.status = 2;
			}
			if(data.estado == "No Aprobado"){
				me.estado.status = 3;
			}
		},
		actualizarEstado(){
			let me = this;
			var url = '/senov_v3/novedades/actualizarEstado/' + me.estado.id + '/'+me.estado.status;
			axios.get(url)
			.then(function (response) {
				var res =response.data;
				console.log(res.estado);
				location.href = ("/senov_v3/panel/estado_novedad");
			})
			.catch(function (error) {
				console.error(error);
			});
			
			
		},
	},
	mounted() {
		this.getNovedades();
	},
})
</script>


<style>
	.search-form{
		margin: 10px;
		text-align: right;
	}
	.search-form input{
		width: 120px;
	}
	.search-form button{
		border-radius: 0px;
	}

	/* 
		modal
	*/

	.modal-body:not(.two-col) { padding:0px }
	.glyphicon { margin-right:5px; }
	.glyphicon-new-window { margin-left:5px; }
	.modal-body .radio,.modal-body .checkbox {margin-top: 0px;margin-bottom: 0px;}
	.modal-body .list-group {margin-bottom: 0;}
	.margin-bottom-none { margin-bottom: 0; }
	.modal-body .radio label,.modal-body .checkbox label { display:block; }
	.modal-footer {margin-top: 0px;}
	@media screen and (max-width: 325px){
			.btn-close {
					margin-top: 5px;
					width: 100%;
			}
			.btn-results {
					margin-top: 5px;
					width: 100%;
			}
			.btn-vote{
					margin-top: 5px;
					width: 100%;
			}
			
	}
	.modal-footer .btn+.btn {
			margin-left: 0px;
	}
	.progress {
			margin-right: 10px;
	}
</style>