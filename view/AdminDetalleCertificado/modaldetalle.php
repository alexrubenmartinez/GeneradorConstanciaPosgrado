<div id="modaldetalle" class="modal fade" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content bd-0">
            <div class="modal-header pd-y-20 pd-x-25">
                <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Llenar Datos del Documento:</h6>
            </div>

            <div class="modal-body">
                <form id="form_datos_documento" class="row">

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Encargado: <span class="tx-danger">*</span></label>
                            <select class="form-control select2" style="width:100%" name="enca_id" id="enca_id" data-placeholder="Seleccione">
                                <option label="Seleccione"></option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="num_boleta">Número de Boleta:</label>
                            <input type="text" class="form-control" id="num_boleta" name="num_boleta">
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="unidad_perteneciente">Unidad Perteneciente:</label>
                            <input type="text" class="form-control" id="unidad_perteneciente" name="unidad_perteneciente">
                        </div>
                    </div>

                </form>
            </div>

            <div class="modal-footer">
                <button name="action" onclick="guardarDatosDocumento()" class="btn btn-outline-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium"><i class="fa fa-check"></i> Guardar</button>
                <button type="reset" class="btn btn-outline-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" aria-label="Close" aria-hidden="true" data-dismiss="modal"><i class="fa fa-close"></i> Cancelar</button>
            </div>
        </div>
    </div>
</div>
