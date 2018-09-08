<form action="#" class="form-horizontal">
      <div class="form-group">
        <label for="formGroup" class="col-sm-2 control-label">Cédula</label>
        <div class="col-sm-4">
          <input type="text" name="cedula" class="form-control" id="formGroup" placeholder="Cedula" >
        </div>
      </div>
      
      <div class="form-group">
        <label for="formGroup" class="col-sm-2 control-label">Nombre</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" id="formGroup" placeholder="Nombre" name="nombre">
        </div>
      </div>

      <div class="form-group">
        <label for="formGroup" class="col-sm-2 control-label">Apellido</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" id="formGroup" placeholder="Apellido" name="apellido" >
        </div>
      </div>

      <div class="form-group">
        <label for="formGroup" class="col-sm-2 control-label" id="tel">Teléfono</label>
        <div class="input-group col-sm-3">
          <span class="input-group-addon"><span class="glyphicon glyphicon-phone"></span></span>
          <input type="text" class="form-control" id="formGroup" placeholder="Teléfono" name="telefono" >
        </div>
      </div>

      <div class="form-group">
        <label for="formGroup" class="col-sm-2 control-label" id="tel">Correo Electrónico</label>
        <div class="input-group col-sm-3">
          <span class="input-group-addon">@</span></span>
          <input type="text" class="form-control" id="formGroup" placeholder="Email" name="email" >
        </div>
      </div>

      <div class="form-group">
        <label for="formGroup" class="col-sm-2 control-label">Dirección de Habitación</label>
        <div class="col-sm-4">
          <textarea class="form-control" rows="4" placeholder="Dirección" name="direccion"></textarea>
        </div>
      </div>      

      <div class="form-group">
        <label for="formGroup" class="col-sm-2 control-label">Estado</label>
        <div class="col-sm-4">

          <select name="estado" id="sel" class="form-control">
            <option value="1">Administrador</option>  
            <option value="2">Estudiante</option>           
            <option value="3">Profesor</option> 
            <option value="4">Analista</option>  
          </select>
        </div>
      </div>
      
           <div class="form-group">
        <label for="formGroup" class="col-sm-2 control-label">Carrera</label>
        <div class="col-sm-4">

          <select name="carrera" id="sel" class="form-control">
            <option value="1">Ing. Sistemas</option>  
            <option value="2">Ing. Industrial</option>           
            <option value="3">Ing. Mecanica</option>  
          </select>
        </div>
      </div>
  
      <div class="form-group">
        <label for="formGroup" class="col-sm-2 control-label">Cuenta</label>
        <div class="col-sm-4">
          <label for="x" class="radio-inline">
            <input type="radio" name="radio" id="inlineRadio1" value="option1" checked>Activar
          </label>
          <label for="x" class="radio-inline">
            <input type="radio" name="radio" id="inlineRadio1" value="option2" >Desctivar
          </label>
        </div>
      </div>
     
      <br>

      <div class="form-group">
        <label for="formGroup" class="col-sm-2 control-label"></label>
        <div class="col-sm-4">
          <button type="submit" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-floppy-saved"></span>Guardar</button>
          <button type="submit" class="btn btn-danger btn-lg"><span class="glyphicon glyphicon-remove-circle"></span>Cancelar</button>  

        </div>
      </div>
    </form> 