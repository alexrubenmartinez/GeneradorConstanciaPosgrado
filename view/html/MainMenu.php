<div class="br-logo"><a href="../UsuHome/"><span>[</span>Posgrado UNSCH<span>]</span></a></div>

<div class="br-sideleft overflow-y-auto">
  <label class="sidebar-label pd-x-15 mg-t-20">Menu</label>
  <div class="br-sideleft-menu">

    <a href="../UsuHome/" class="br-menu-link">
      <div class="br-menu-item">
        <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
        <span class="menu-item-label">Inicio</span>
      </div>
    </a>

    <?php
      if($_SESSION["rol_id"]==1){
        ?>
          <a href="../UsuDocumento/" class="br-menu-link">
            <div class="br-menu-item">
              <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-24"></i>
              <span class="menu-item-label">Mis Documentos</span>
            </div>
          </a>
        <?php
      }else{
        ?>
          <a href="../AdminMntUsuario/" class="br-menu-link">
            <div class="br-menu-item">
              <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-24"></i>
              <span class="menu-item-label">Mnt. Estudiantes</span>
            </div>
          </a>

          <a href="../AdminMntDocumento/" class="br-menu-link">
            <div class="br-menu-item">
              <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-24"></i>
              <span class="menu-item-label">Mnt. Documento</span>
            </div>
          </a>

          <a href="../AdminMntEncargado/" class="br-menu-link">
            <div class="br-menu-item">
              <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-24"></i>
              <span class="menu-item-label">Mnt. Encargado</span>
            </div>
          </a>

          <a href="../AdminMntCategoria/" class="br-menu-link">
            <div class="br-menu-item">
              <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-24"></i>
              <span class="menu-item-label">Mnt. Categoria</span>
            </div>
          </a>

          <a href="../AdminMntFacultad/" class="br-menu-link">
            <div class="br-menu-item">
              <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-24"></i>
              <span class="menu-item-label">Mnt. Facultad</span>
            </div>
          </a>

          <a href="../AdminDetalleProgramaEstudio/" class="br-menu-link">
            <div class="br-menu-item">
              <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-24"></i>
              <span class="menu-item-label">Mnt. Programa de Estudios</span>
            </div>

          <a href="../AdminMntSemestre/" class="br-menu-link">
            <div class="br-menu-item">
              <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-24"></i>
              <span class="menu-item-label">Mnt. Semestre</span>
            </div>
          </a>
        <br>
          <a href="../AdminDetalleCertificado/" class="br-menu-link">
            <div class="br-menu-item">
              <i class="menu-item-icon ionicons ion-ios-paper tx-24"></i>
              <span class="menu-item-label">Generar Constancia</span>
            </div>

    
          </a>
   
          <a href="../AdminCargaDatos/" class="br-menu-link">
            <div class="br-menu-item">
              <i class="menu-item-icon icon ionicons ion-upload tx-24"></i>
              <span class="menu-item-label">Cargar datos</span>
            </div>

    
          </a>
        <?php
      }
    ?>
<br>

    <a href="../UsuPerfil/" class="br-menu-link">
      <div class="br-menu-item">
        <i class="menu-item-icon icon ion-ios-gear-outline tx-20"></i>
        <span class="menu-item-label">Perfil</span>
      </div>
    </a>

    <a href="../html/Logout.php" class="br-menu-link">
      <div class="br-menu-item">
        <i class="menu-item-icon icon ion-power tx-20"></i>
        <span class="menu-item-label">Cerrar Sesion</span>
      </div>
    </a>

  </div>
</div>