@extends('layouts.AdminLTE.index')

@section('title', 'Reportes')
@section('header', 'Reportes')

@section('content')
    
<div class="card">
    <div class="card-header with-border">
        <h3 class="card-title">Reportes</h3>
    </div>
    <div class="card-body">
        <section class="content">
            <div class="container-fluid">
              <!-- Small boxes (Stat box) -->
              <div class="row">
                <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-info">
                    <div class="inner">
                      <h3>#</h3> <p>Clientes</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="#" type="button" data-toggle="modal" data-target="#exampleModal" class="small-box-footer">Generar Reporte <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-danger">
                    <div class="inner">
                      <h3>150</h3><p>New Orders</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-bag"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
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
