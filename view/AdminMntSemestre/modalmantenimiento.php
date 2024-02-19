<div id="modalmantenimiento" class="modal fade" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content bd-0">
            <div class="modal-header pd-y-20 pd-x-25">
                <h6 id="lbltitulo" class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold"></h6>
            </div>
            
            <form method="post" id="semestre_form">
                <div class="modal-body">
                    <input type="hidden" name="sem_id" id="sem_id"/>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Denominación: <span class="tx-danger">*</span></label>
                            <input class="form-control tx-uppercase" id="nom" type="text" name="nom" required/>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Fecha de inicio: <span class="tx-danger">*</span></label>
                            <input class="form-control tx-uppercase" id="fech_inicio" type="date" name="fech_inicio" required/>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Fecha de inicio: <span class="tx-danger">*</span></label>
                            <input class="form-control tx-uppercase" id="fech_fin" type="date" name="fech_fin" required/>
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