<div id="estado_novedad">

    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header t-card">
                <h5 class="float-left" style="font-size: 28px;" >Usuarios</h5>
                <button data-toggle="modal" data-target="#habilitarModal" class="btn btn-md btn-outline-light float-right">Habilitar Usuario <i class="fas fa-user-plus"></i></button>
            </div>
            <div class="card-body">
                    
                    <div class="search-form float-right col-md-12">
                        <select @change="filtro(textFilter)" v-model="textFilter" class="form-control-sm float-left">
                            <option selected disabled>Filtro</option>

                            <option value="registrados">Registrados</option>
                            <option value="no_registrados">No Registrados</option>
                        </select>


                        <span>Buscar:</span>
                        <input type="text" placeholder="Buscar...">
                    </div>
                </div>
                <!-- Tabla Usuarios Registrados -->
                
                <div v-if="vistaTabla == 0">
                    <div class="table-responsive p-2">
                        <table class="table table-bordered table-striped">
                            <thead class="text-center">
                                <tr>
                                    <th>Opciones</th>
                                    <th>Tipo Documento</th>
                                    <th>Documento</th>
                                    <th>Nombres</th>
                                    <th>Correo</th>
                                    <th>Teléfono</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody class="">

                                <tr v-for="item in arrayUsuarios" :key="item.id">
                                    <td>
                                        <button title="Editar" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </button>&nbsp;

                                        <button v-if="item.estado == 1" @click="desactivarUsuario(item.documento)" title="Desactivar" class="btn btn-sm btn-danger">
                                            <i class="fas fa-times-circle"></i>
                                        </button>

                                        <button v-else @click="activarUsuario(item.documento)" title="Desactivar" class="btn btn-sm btn-success">
                                            <i class="fas fa-check-square"></i>
                                        </button>
                                    </td>
                                    <td v-text="item.tipo_documento"></td>
                                    <td v-text="item.documento"></td>
                                    <td v-text="item.nombre + ' ' + item.apellido"></td>
                                    <td v-text="item.email"></td>
                                    <td v-text="item.telefono"></td>
                                    <td>
                                        <span v-if="item.estado == 1" class="badge badge-success">Habilitado</span>
                                        <span v-else class="badge badge-danger">Desabilitado</span>
                                    </td>
                                    
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Tabla Usuarios No Registrados -->

                <div v-if="vistaTabla == 1">
                    <div class="table-responsive p-2">
                        <table class="table table-bordered table-striped">
                            <thead class="text-center">
                                <tr>
                                    <th>Opciones</th>
                                    <th>Tipo Documento</th>
                                    <th>Documento</th>
                                    <th>Fecha de Ingreso</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody class="">

                                <tr v-for="item in arrayUsuarios" :key="item.id">
                                    <td>
                                        <button v-if="item.estado == 1" @click="desactivarUsuario(item.documento)" title="Desactivar" class="btn btn-sm btn-danger">
                                            <i class="fas fa-times-circle"></i>
                                        </button>

                                        <button v-else @click="activarUsuario(item.documento)" title="Desactivar" class="btn btn-sm btn-success">
                                            <i class="fas fa-check-square"></i>
                                        </button>
                                    </td>
                                    <td v-text="item.tipo_documento"></td>
                                    <td v-text="item.documento"></td>
                                    <td>hoy :v</td>
                                    <td>
                                        <span v-if="item.estado == 1" class="badge badge-success">Habilitado</span>
                                        <span v-else class="badge badge-danger">Desabilitado</span>
                                    </td>
                                    
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>

            <nav aria-label="...">
                <ul class="pagination">
                    <li class="page-item disabled">
                        <span class="page-link">Previous</span>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item active">
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

    <!-- Modal -->

    <div class="modal fade" id="habilitarModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-header t-card">
                    <h5 class="modal-title" id="exampleModalLongTitle">Habilitar Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="input-group p-2">
                        <label>Numero de Documento: &nbsp;</label>
                        <input @keyup.enter="habilitarUsuarios()" v-model="docHab" type="text" class="form-control form-control-sm">
                        <br>
                        <div class="p-2">
                            <small class="text-muted"><b>Nota:</b> El documento ingresado tendrá acceso a registrarse (verifique bien la información)</small>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button @click="habilitarUsuarios()" type="button" class="btn btn-primary">Habilitar Usuario</button>
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
			
		},
        docHab: '',
        textFilter: 'Filtro',
        vistaTabla: 0,
        arrayUsuarios: []
	},
	methods:{
		getUsuarios(){
			var me = this;
			axios.get('/senov_v3/usuario/index')
			.then(function (response) {
				var res = response.data;
				me.arrayUsuarios = res.usuarios;		
			})
			.catch(function (error) {
				console.error(error);
			});
		},
        habilitarUsuarios(){
            var me = this;
            if (me.docHab.length > 0) {
                swal({
                    title: '¿Esta Seguro?',
                    text: "¡No podrá modificar el documento!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Confirmar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                                       
                    $('#habilitarModal').modal('toggle');
                    var url = '/senov_v3/usuario/habilitarUsuario';
                    
                    axios.post(url,{
                        dni: me.docHab
                    })
                    .then(function (response) {
                       if (result.value) {
                            swal(
                                '¡Habilitado!',
                                'La transacción ha sido un éxito.',
                                'success'
                            )
                        }
                        me.docHab = '';
                    })
                    .catch(function (error) {
                        // console.error(error.response.data);
                        var res = error.response.data;
                        swal(
                            '¡'+ res.data.text +'!',
                            'Compruebe la inforación de nuevo.',
                            'error'
                        )
                    });
                    
                })
            } else {
                swal({
                    position: 'top',
                    type: 'error',
                    title: 'Ingrese un Documento Válido!',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        },
        desactivarUsuario(id){
            swal({
                title: '¿Esta seguro de Desactivar el Usuario?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Desactivarlo!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.value) {
                    let me = this;
                    var url = '/senov_v3/usuario/desactivar';
                    
                    axios.put(url,{id : id})
                    .then(function (response) {
                        me.getUsuarios();
                        swal(
                            '¡Desctivado!',
                            'El Usuario a sido Desactivado.',
                            'success'
                        )
                        
                    })
                    .catch(function (error) {
                        // Manejar el fallo
                        swal(
                            'Error!',
                            'El Usuario NO a sido Desactivado.',
                            'error'
                        )
                        console.error(error);
                    });
                    
                }
            }) 
        },
        activarUsuario(id){
            swal({
                title: '¿Esta seguro de Activar el Usuario?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Activarlo!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.value) {
                    let me = this;
                    var url = '/senov_v3/usuario/activar';
                    
                    axios.put(url,{id : id})
                    .then(function (response) {
                        me.getUsuarios();
                        swal(
                            '¡Activado!',
                            'El Usuario a sido Activado.',
                            'success'
                        )
                        
                    })
                    .catch(function (error) {
                        // Manejar el fallo
                        swal(
                            'Error!',
                            'El Usuario NO a sido Activado.',
                            'error'
                        )
                        console.error(error);
                    });
                    
                }
            }) 
        },
        filtro(data){
            let me = this;
            if(data == 'no_registrados'){
                me.vistaTabla = 1;
            }else{
                me.vistaTabla = 0;
            }
            
        }
	},
	mounted() {
		this.getUsuarios();
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
</style>