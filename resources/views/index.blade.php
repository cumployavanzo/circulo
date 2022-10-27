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
                  <div class="small-box bg-success">
                    <div class="inner">
                      <h4>{{$rutas}}</h4><p>Rutas</p>
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
                        <h4>{{$productos}}</h4><p>Productos</p>
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
                        <h4>{{$avales}}</h4><p>Avales</p>
                      </div>
                      <div class="icon">
                        <i class="fas fa-people-arrows"></i>
                      </div>
                      <a href="#" class="small-box-footer">TOTAL</a>
                    </div>
                  </div>
                  <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                      <div class="inner">
                        <h4>{{$clientes}}</h4><p>Clientes</p>
                      </div>
                      <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                      </div>
                      <a href="#" type="button" class="small-box-footer">TOTAL</a>
                    </div>
                  </div>
                  <div class="col-lg-3 col-6">
                    <div class="small-box bg-purple">
                      <div class="inner">
                        <h4>{{$asociados}}</h4><p>Asociados</p>
                      </div>
                      <div class="icon">
                        <i class="ion ion-person"></i>
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
                        <h4>{{$solicitudes}}</h4><p>Solicitudes</p>
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
                        <h4>{{$solPendientes}}</h4><p>Pendiente Autorizar</p>
                      </div>
                      <div class="icon">
                        <i class="fas fa-hourglass"></i>
                      </div>
                      <a href="#" class="small-box-footer">TOTAL</a>
                    </div>
                  </div>
                  <div class="col-lg-3 col-6">
                    <div class="small-box bg-yellow">
                      <div class="inner">
                        <h4>{{$solNoDesembolsadas}}</h4><p>Pendiente Desembolsar</p>
                      </div>
                      <div class="icon">
                        <i class="fas fa-money-bill"></i>
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
        <h3 class="card-title">Cartera</h3>
    </div>
    <div class="card-body">
        <section class="content">
            <div class="container-fluid">
              <div class="row">
                  <div class="col-lg-3 col-6">
                    <div class="small-box bg-lightblue">
                      <div class="inner">
                        <h4>$ {{ number_format($capitalMinistrado[0]->monto_autorizado,2,'.',',') }}</h4><p>Capital Ministrado</p>
                      </div>
                      <div class="icon">
                          <i class="ion ion-cash"></i>
                      </div>
                      <a href="#" class="small-box-footer">TOTAL</a>
                    </div>
                  </div> 
                  <div class="col-lg-3 col-6">
                    <div class="small-box bg-pink">
                      <div class="inner">
                        <h4>$ {{ number_format($interesesGenerados[0]->intereses,2,'.',',') }}</h4><p>Intereses Generados</p>
                      </div>
                      <div class="icon">
                          <i class="fas fa-comments-dollar"></i>
                      </div>
                      <a href="#" class="small-box-footer">TOTAL</a>
                    </div>
                  </div> 
                  <div class="col-lg-3 col-6">
                    <div class="small-box bg-purple">
                      <div class="inner">
                        <h4>$ {{ number_format($capitalRecuperado[0]->capital,2,'.',',') }}</h4><p>Capital Recuperado</p>
                      </div>
                      <div class="icon">
                          <i class="fas fa-hand-holding-usd"></i>
                      </div>
                      <a href="#" class="small-box-footer">TOTAL</a>
                    </div>
                  </div> 
                  <div class="col-lg-3 col-6">
                    <div class="small-box bg-olive">
                      <div class="inner">
                        <h4>$ {{ number_format($interesesRecuperados[0]->intereses_rec,2,'.',',') }}</h3><p>Intereses Recuperados</p>
                      </div>
                      <div class="icon">
                        <i class="fas fa-money-check-alt"></i>
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
                    <div class="small-box bg-indigo">
                      <div class="inner">
                        <h4>{{$plantilla}}</h4><p>Plantilla</p>
                      </div>
                      <div class="icon">
                        <i class="fas fa-users"></i>
                      </div>
                      <a href="#" class="small-box-footer">TOTAL</a>
                    </div>
                  </div>
                  <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                      <div class="inner">
                        <h4>{{$altas}}</h4><p>Altas</p>
                      </div>
                      <div class="icon">
                        <i class="fas fa-user-plus"></i>
                      </div>
                      <a href="#" class="small-box-footer">TOTAL</a>
                    </div>
                  </div>
                  <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                      <div class="inner">
                        <h4>{{$bajas}}</h4><p>Bajas</p>
                      </div>
                      <div class="icon">
                        <i class="fas fa-user-minus"></i>
                      </div>
                      <a href="#" class="small-box-footer">TOTAL</a>
                    </div>
                  </div>
                  <div class="col-lg-3 col-6">
                    <div class="small-box bg-orange">
                      <div class="inner">
                        <h4>$ {{ number_format($montoNomina[0]->total_pagar,2,'.',',') }}</h4><p>Nomina</p>
                      </div>
                      <div class="icon">
                        <i class="fas fa-file-invoice-dollar"></i>
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
        <h3 class="card-title">Compras</h3>
    </div>
    <div class="card-body">
        <section class="content">
            <div class="container-fluid">
              <!-- Small boxes (Stat box) -->
              <div class="row">
                  <div class="col-lg-3 col-6">
                    <div class="small-box bg-navy">
                      <div class="inner">
                        <h4>{{$articulos}}</h4><p>Articulos</p>
                      </div>
                      <div class="icon">
                        <i class="nav-icon fa fa-cubes"></i>
                      </div>
                      <a href="#" class="small-box-footer">TOTAL</a>
                    </div>
                  </div>
                  <div class="col-lg-3 col-6">
                    <div class="small-box bg-maroon">
                      <div class="inner">
                        <h4>{{$proveedor}}</h4><p>Proveedores</p>
                      </div>
                      <div class="icon">
                        <i class="nav-icon fab fa-slideshare"></i>
                      </div>
                      <a href="#" class="small-box-footer">TOTAL</a>
                    </div>
                  </div>
                  <div class="col-lg-3 col-6">
                    <div class="small-box bg-purple">
                      <div class="inner">
                        <h4>$ {{ number_format($gasto[0]->total_gasto,2,'.',',') }}</h4><p>Gastos</p>
                      </div>
                      <div class="icon">
                        <i class="nav-icon fas fa-store"></i>
                      </div>
                      <a href="#" class="small-box-footer">TOTAL</a>
                    </div>
                  </div>
                 
                  <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                      <div class="inner">
                        <h4>$ {{ number_format($activo[0]->total_activo,2,'.',',') }}</h4><p>Activos</p>
                      </div>
                      <div class="icon">
                        <i class="fas fa-chart-line"></i>
                      </div>
                      <a href="#" class="small-box-footer">TOTAL</a>
                    </div>
                  </div>
                 
                  <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                      <div class="inner">
                        <h4>$ {{ number_format($noDeducible[0]->total_noDeducible,2,'.',',') }}</h4><p>No deducibles</p>
                      </div>
                      <div class="icon">
                        <i class="fas fa-chart-bar"></i>
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
      <h3 class="card-title">Tesoreria</h3>
  </div>
  <div class="card-body">
      <section class="content">
          <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
              <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                  <div class="inner">
                    <h4>{{$bancos}}</h3><p>Bancos</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-store-alt"></i>
                  </div>
                  <a href="#" class="small-box-footer">TOTAL</a>
                </div>
              </div>
              <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                  <div class="inner">
                    <h4>{{$cajas}}</h4><p>Cajas</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-window-restore"></i>
                  </div>
                  <a href="#" class="small-box-footer">TOTAL</a>
                </div>
              </div>
              <div class="col-lg-3 col-6">
                <div class="small-box bg-orange">
                  <div class="inner">
                    <h4>$ {{ number_format($capitalMinistrado[0]->monto_autorizado,2,'.',',') }}</h4><p>Monto Desembolsado</p>
                  </div>
                  <div class="icon">
                    <i class="nav-icon fas fa-comment-dollar"></i>
                  </div>
                  <a href="#" class="small-box-footer">TOTAL</a>
                </div>
              </div>
             
              <div class="col-lg-3 col-6">
                <div class="small-box bg-pink">
                  <div class="inner">
                    <h4>$ {{ number_format($pagos[0]->total_pago,2,'.',',') }}</h4><p>Monto Pagos</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-check-circle"></i>
                  </div>
                  <a href="#" class="small-box-footer">TOTAL</a>
                </div>
              </div>
              <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                  <div class="inner">
                    <h4>$ {{ number_format($cobros[0]->monto_pago,2,'.',',') }}</h4><p>Monto Cobros</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-search-dollar"></i>
                  </div>
                  <a href="#" type="button" class="small-box-footer">TOTAL</a>
                </div>
              </div>
              <div class="col-lg-3 col-6">
                <div class="small-box bg-purple">
                  <div class="inner">
                    <h4>$ {{ number_format($capital[0]->capital_invertido,2,'.',',') }}</h4><p>Capital Invertido</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-coins"></i>
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
@endsection