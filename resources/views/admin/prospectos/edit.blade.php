@extends('layouts.AdminLTE.index')
@section('title', 'Colocacion')
@section('header', 'Colocacion')
@section('content')
<div class="col-md-12">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <h3 class="profile-username text-center">{{$cliente->cliente->getFullName()}}</h3>
                            <p class="text-muted text-center">{{$cliente->personal->sucursal->nombre_ruta}}</p>
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>{{$cliente->primaSuma->productocliente->nombre}}</b> <a class="float-right"></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Periodo</b> <a class="float-right">{{$cliente->primaSuma->periodo->descripcion}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Suma Asegurada</b> <a class="float-right">$ {{$cliente->primaSuma->suma_asegurada}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Monto</b> <a class="float-right">$ {{$cliente->primaSuma->monto}}</a>
                                </li>
                            </ul>
                            {{-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> --}}
                        </div>
                    </div>
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Expediente</h3>
                        </div>

            
                        <div class="card-body">
                            <div class="col-sm-12">
                                <table class="table table-striped table-valign-middle">
                                    <thead>
                                    <tr>
                                      <th>INE</th>
                                      <th>Poliza</th>
                                      <th>Endoso</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            @if ($expediente->ine_anverso == '')
                                                <img src="{{ asset('img/ban.png') }}" style="width:30px;height:30px;" title="Sin documento" alt="">
                                            @else
                                                @php 
                                                    $ext = explode('.', $expediente->ine_anverso);
                                                @endphp

                                                
                                                @if($ext[1] == 'pdf')
                                                    <a target="_blank" href="{{asset($expediente->ine_anverso)}}"><img id="logo" src="{{ asset('img/id-card.png') }}" style="width:30px;height:30px;cursor: pointer" ></a>
                                                @else
                                                    <img src="{{ asset('img/id-card.png') }}" style="width:30px;height:30px;cursor: pointer" onclick="verIneBenefToc('{{ $expediente->ine_anverso }}')" title="Click para ver INE" alt="">
                                                @endif
                                            @endif
                                        </td>
                                        <td>
                                            @if ($expediente->comprobante_ingresos == '')
                                                <img src="{{ asset('img/contract.png') }}" style="width:30px;height:30px;" title="Sin documento" alt="">
                                            @else
                                                @php 
                                                    $extPoliza = explode('.', $expediente->comprobante_ingresos );
                                                @endphp

                                                
                                                @if($extPoliza[1] == 'pdf')
                                                    <a target="_blank" href="{{asset($expediente->comprobante_ingresos )}}"><img id="logo" src="{{ asset('img/contract.png') }}" style="width:30px;height:30px;cursor: pointer" ></a>
                                                @else
                                                    <img src="{{ asset('img/id-card.png') }}" style="width:30px;height:30px;cursor: pointer" onclick="verIneBenefToc('{{$expediente->comprobante_ingresos  }}')" title="Click para ver INE" alt="">
                                                @endif
                                            @endif
                                        </td>
                                      <td><img src="{{ asset('img/ban.png') }}" style="width:30px;height:30px;" title="Sin documento" alt=""></td>
                                     
                                    </tbody>
                                  </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Detalles</a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="activity">
                                    
                                    <div class="post clearfix">
                                        <div class="user-block">
                                            <img class="img-circle img-bordered-sm" src="{{ asset('img/group.png') }}" alt="User Image">
                                            <span class="username">
                                                <a href="#">BENEFICIARIOS</a>
                                                <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                                            </span>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 table-responsive">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Nombre Beneficiario</th>
                                                            <th>Parentesco</th>
                                                            <th>Porcentaje</th>
                                                        </tr>
                                                    </thead>
                                                <tbody>
                                                   
                                                </tbody>
                                                </table>
                                            </div>   
                                        </div>

                                       
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
<div class="modal fade" id="myPicture" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" style="z-index: 2000">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-th-list"></i></h5>
                <div class="card-tools float-right">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
            </div>
            <div class="modal-body">
                <div id="contPicture"></div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>



    const verIneBenefToc = (archivo) => {
        $('#myPicture').modal();
        $("#exampleModalLabel").html(' <i class="fas fa-file-image-o fa-lg"></i> &nbsp; Imagenes')
        $("#contPicture").html(`<img src="{{ asset('${archivo}') }}" class="d-block w-100" alt="${archivo}" />`)
    }


    function verDocumentoFirmadoToc(solicitud){
        $('#contenido_modal').html('<iframe src="public/img/seguros/'+solicitud+'" width="100%" height="100%" scrolling="no"></iframe>');	
        AbrirModalGeneral('ModalPrincipal',1000,500);
    }
</script>
@endpush