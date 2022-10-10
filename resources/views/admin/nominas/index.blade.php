@extends('layouts.AdminLTE.index')

@section('title', 'Nominas')
@section('header', 'Nominas')

@section('content')
    
    <div class="card">
        <div class="card-header with-border">
            <h3 class="card-title">Lista de Nomina</h3>
            <div class="card-tools pull-right">
                <a href="{{ route('admin.nomina.create') }}"  type="button" class="btn btn-sm btn-primary" title="Agregar Nomina"><li class="fas fa-plus"></li>&nbsp; Nuevo</a>
                <a href="{{ route('admin.concepto.index') }}"  type="button" class="btn btn-sm btn-primary" title="Conceptos"><i class="fas fa-table"></i>&nbsp; Tabla Conceptos</a> 
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped projects">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>N° Nomina</th>
                        <th>Fecha Inicial</th>
                        <th>Fecha Final</th>
                        <th>Modalidad</th>
                        <th>Total a Pagar</th>
                        <th>Estatus</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($nominas as $nomina)
                    <tr>
                        <td>#{{ $nomina->id }}</td>
                        <td>{{ $nomina->num_nomina }}</td>
                        <td>{{ date('d/m/Y', strtotime($nomina->fecha_corte_ini))}}</td>
                        <td>{{ date('d/m/Y', strtotime($nomina->fecha_corte_fin))}}</td>
                        <td>{{ $nomina->modalidad }}</td>
                        <td>$ {{number_format($nomina->total_pagar, 2, '.', '')}}</td>
                        @if ($nomina->state == 'Proceso')
                            <td><small class="badge badge-info">{{ $nomina->state }}&nbsp;&nbsp;<i class="fas fa-sync-alt"></i></small></td>
                        @elseif($nomina->state == 'Autorizado')
                            <td><small class="badge badge-success">{{ $nomina->state }}&nbsp;&nbsp;<i class="fas fa-check"></i></small></td>
                        @endif
                        <td>
                            <a class="btn btn-info btn-sm" href="{{ route('admin.nomina.edit', [$nomina->id]) }}"><i class="fas fa-eye"></i></a>
                            {{-- <a href="#" onClick="downloadPdf({{$nomina->id}})" class="btn btn-default btn-sm"><i class="fas fa-print"></i></a> para descargarlo --}}
                            <a href="{{ route('admin.reciboNomina', [$nomina->id]) }}" target="_blank" class="btn btn-default btn-sm"><i class="fas fa-print"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="float-right">{{ $nominas->links()}}</div>
        </div>
    </div>
@endsection

@push('scripts')

{{-- <script>
    $.ajaxSetup({
        headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
    });
    
    function downloadPdf(id){
        downloadFileGet(
            {
                url: "{{ asset('admin/nomina/pdf/reciboNomina') }}/" + id,
                fileName:"RECIBO{{ $nomina->id }}.pdf",
                msj_finished:'<i class="nav-link-icon lnr-book"></i><span> RECIBO</span>'
            })
    }

    function downloadFileGet({el,url,fileName,msj_finished,logs="No"}){
        makeLoader({el:el,msj_loader: "",status:'loader'})
    //alert(logs);

        $result =  fetch(url,{
            method:'GET',
            headers: {
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            },
        })
        if(logs == "No"){
            $result.then(resp => resp.blob())
            .then(blob => {
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.style.display = 'none';
            a.href = url;
            // the filename you want
            a.download = fileName;
            document.body.appendChild(a);
            a.click();
            window.URL.revokeObjectURL(url);
            //alert('your file has downloaded!'); // or you know, something with better UX...
            makeLoader({el:el,msj_finished : msj_finished,status:'finished'})
            })
            .catch(error =>{ 
                makeLoader({el:el,msj_finished : msj_finished,status:'finished'})
                console.log(error);
                alert('oh no!')});
        }/* else{
        $result.then(resp => {
            console.log(resp)
            makeLoader({el:el,msj_finished : msj_finished,status:'finished'})
        }
        )
        } */
        //makeLoader({el:el,msj_finished : msj_finished,status:'finished'})
        
    }

    function makeLoader({el,msj_loader = "Cargando...",msj_finished = "Aceptar",status}){
        if(el){
        
            if(status == "loader"){
                el.prop('disabled',true)  
            }else if(status == "finished"){
                el.prop('disabled',false)
            }
        }
    
    }
</script> --}}
@endpush