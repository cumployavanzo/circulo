@extends('layouts.AdminLTE.index')

@section('title', 'Index')

@section('content')
    
<div class="card">
    <div class="card-header with-border">
        <h3 class="card-title">Comercial</h3>
    </div>
    <div class="card-body">
        <section class="content">
            <div class="container-fluid">
              <!-- Small boxes (Stat box) -->
              <div class="row">
                <div class="col-lg-3 col-6">
                  <div class="small-box bg-warning">
                    <div class="inner">
                      <h3>{{$rutas}}</h3><p>Rutas</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-map"></i>
                    </div>
                    <a href="#" class="small-box-footer">TOTAL</a>
                  </div>
                </div>
                <div class="col-lg-3 col-6">
                  <div class="small-box bg-danger">
                      <div class="inner">
                        <h3>{{$productos}}</h3><p>Productos</p>
                      </div>
                      <div class="icon">
                          <i class="ion ion-bag"></i>
                      </div>
                      <a href="#" class="small-box-footer">TOTAL</a>
                    </div>
                  </div>
                  <div class="col-lg-3 col-6">
                    <div class="small-box bg-pink">
                      <div class="inner">
                        <h3>{{$avales}}</h3><p>Avales</p>
                      </div>
                      <div class="icon">
                        <i class="ion ion-person"></i>
                      </div>
                      <a href="#" class="small-box-footer">TOTAL</a>
                    </div>
                  </div>
                  <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                      <div class="inner">
                        <h3>{{$clientes}}</h3><p>Clientes</p>
                      </div>
                      <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                      </div>
                      <a href="#" type="button" class="small-box-footer">TOTAL</a>
                    </div>
                  </div>
              </div>
              <!-- /.row -->
              <!-- Main row -->
            </div><!-- /.container-fluid -->
          </section>
    </div>
</div>
<div class="card">
    <div class="card-header with-border">
        <h3 class="card-title">Captación</h3>
    </div>
    <div class="card-body">
        <section class="content">
            <div class="container-fluid">
              <div class="row">
                  <div class="col-lg-3 col-6">
                    <div class="small-box bg-olive">
                      <div class="inner">
                        <h3>{{$solicitudes}}</h3><p>Solicitudes</p>
                      </div>
                      <div class="icon">
                        <i class="ion ion-clipboard"></i>
                      </div>
                      <a href="#" class="small-box-footer">TOTAL</a>
                    </div>
                  </div>
                  <div class="col-lg-3 col-6">
                    <div class="small-box bg-orange">
                      <div class="inner">
                        <h3>{{$solAutorizadas}}</h3><p>Solic. Autorizadas</p>
                      </div>
                      <div class="icon">
                        <i class="ion ion-laptop"></i>
                      </div>
                      <a href="#" class="small-box-footer">TOTAL</a>
                    </div>
                  </div>
                  <div class="col-lg-3 col-6">
                    <div class="small-box bg-purple">
                      <div class="inner">
                        <h3>{{$solDesembolsadas}}</h3><p>Solic. Desembolsadas</p>
                      </div>
                      <div class="icon">
                          <i class="ion ion-cash"></i>
                      </div>
                      <a href="#" class="small-box-footer">TOTAL</a>
                    </div>
                  </div>
                  
              </div>
              <!-- /.row -->
              <!-- Main row -->
            </div><!-- /.container-fluid -->
          </section>
    </div>
</div>
<div class="card">
    <div class="card-header with-border">
        <h3 class="card-title">Recursos Humanos</h3>
    </div>
    <div class="card-body">
        <section class="content">
            <div class="container-fluid">
              <!-- Small boxes (Stat box) -->
              <div class="row">
                 
                  <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                      <div class="inner">
                        <h3>{{$empleados}}</h3><p>Empleados</p>
                      </div>
                      <div class="icon">
                        <i class="ion ion-person-add"></i>
                      </div>
                      <a href="#" class="small-box-footer">Activos</a>
                    </div>
                  </div>
                 
                 
              </div>
              <!-- /.row -->
              <!-- Main row -->
            </div><!-- /.container-fluid -->
          </section>
    </div>
</div>
@endsection