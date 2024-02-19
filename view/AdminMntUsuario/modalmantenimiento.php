<div id="modalmantenimiento" class="modal fade" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content bd-0">
            <div class="modal-header pd-y-20 pd-x-25">
                <h6 id="lbltitulo" class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold"></h6>
            </div>
            
            <form method="post" id="usuario_form">
                <div class="modal-body">
                    <input type="hidden" name="usu_id" id="usu_id"/>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Nombre: <span class="tx-danger">*</span></label>
                            <input class="form-control tx-uppercase" id="usu_nom" type="text" name="usu_nom" required/>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Apellido Paterno: <span class="tx-danger">*</span></label>
                            <input class="form-control tx-uppercase" id="usu_apep" type="text" name="usu_apep" required/>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Apellido Materno: <span class="tx-danger">*</span></label>
                            <input class="form-control tx-uppercase" id="usu_apem" type="text" name="usu_apem" required/>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Correo: <span class="tx-danger">*</span></label>
                            <input class="form-control tx-uppercase" id="usu_correo" type="email" name="usu_correo" required/>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Password: <span class="tx-danger">*</span></label>
                            <input class="form-control tx-uppercase" id="usu_pass" type="password" name="usu_pass" required/>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Sexo: <span class="tx-danger">*</span></label>
                            <select class="form-control select2" style="width:100%" name="usu_sex" id="usu_sex" data-placeholder="Seleccione">
                                <option label="Seleccione"></option>
                                <option value="M">Masculino</option>
                                <option value="F">Femenino</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Telefono: <span class="tx-danger">*</span></label>
                            <input class="form-control tx-uppercase" id="usu_telf" type="text" name="usu_telf" required/>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">DNI: <span class="tx-danger">*</span></label>
                            <input class="form-control tx-uppercase" id="usu_dni" type="text" name="usu_dni" required/>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Código de estudiante: <span class="tx-danger">*</span></label>
                            <input class="form-control tx-uppercase" id="usu_cod_estudiante" type="text" name="usu_cod_estudiante" required/>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Maestría/Doctorado: <span class="tx-danger">*</span></label>
                            <select class="form-control select2" style="width:100%"  name="posg_id" id="posg_id" data-placeholder="Seleccione">
                                <option label="Seleccione"></option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">¿Posee Deuda? <span class="tx-danger">*</span></label>
                            <select class="form-control select2" style="width:100%" name="usu_deuda" id="usu_deuda" data-placeholder="Seleccione">
                                <option label="Seleccione"></option>
                                <option value="1">Adeuda</option>
                                <option value="0">No posee deuda</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Semestre que cursa: <span class="tx-danger">*</span></label>
                            <select class="form-control select2" style="width:100%"  name="usu_sem_id_actual" id="usu_sem_id_actual" data-placeholder="Seleccione">
                                <option label="Seleccione"></option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Semestre en que ingresó:: <span class="tx-danger">*</span></label>
                            <select class="form-control select2" style="width:100%"  name="usu_sem_id_ingreso" id="usu_sem_id_ingreso" data-placeholder="Seleccione">
                                <option label="Seleccione"></option>
                            </select>
                        </div>
                    </div>


                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Ciclo Actual: <span class="tx-danger">*</span></label>
                            <select class="form-control select2" style="width:100%" name="ciclo_actual" id="ciclo_actual" data-placeholder="Seleccione">
                                <option label="Seleccione"></option>
                                <option value="1">I</option>
                                <option value="2">II</option>
                                <option value="3">III</option>
                                <option value="4">IV</option>
                                <option value="5">V</option>
                                <option value="6">VI</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="action" value="add" class="btn btn-outline-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium"><i class="fa fa-check"></i> Guardar</button>
                    <button type="reset" class="btn btn-outline-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" aria-label="Close" aria-hidden="true" data-dismiss="modal"><i class="fa fa-close"></i> Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>