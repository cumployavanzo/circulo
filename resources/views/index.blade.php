@extends('layouts.AdminLTE.index')

@section('title', 'Index')

@section('content')
    
<div class="card">
    <div class="card-header with-border">
        <h3 class="card-title">Expediente</h3>
    </div>
    <div class="card-body">
        <section class="content">
            <div class="container-fluid">
              <!-- Small boxes (Stat box) -->
              <div class="row">
                <div class="col-lg-3 col-6">
                  <div class="small-box bg-success">
                    <div class="inner">
                    <h4>{{$clientes}}</h4><p>Clientes</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="#" class="small-box-footer">TOTAL</a>
                  </div>
                </div>
                <div class="col-lg-3 col-6">
                 
              </div>
              <!-- /.row -->
              <!-- Main row -->
            </div><!-- /.container-fluid -->
          </section>
    </div>
</div>

@endsection