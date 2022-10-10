@extends('layouts.AdminLTE.index')

@section('title', 'Usuarios')
@section('header', 'Usuarios')

@section('content')
    
    <div class="card">
        <div class="card-header with-border">
            <h3 class="card-title">Lista de Usuarios</h3>
            <div class="card-tools pull-right">
                <a href="{{ route('admin.usuario.create') }}"   type="button" class="btn btn-sm btn-primary" title="Agregar Personal"><li class="fas fa-plus"></li>&nbsp; Nuevo Usuario</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped projects">
                <thead>
                    <tr>
                        <th style="width: 1%">#</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Fecha Alta</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>#{{ $user->id }}</td>
                        <td>{{ $user->personal->getFullName() }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td>
                            @if ($user->state == 1)
                                <span data-id="{{ $user->id }}" class="badge bg-success badgebtn" style="cursor: pointer" data-toggle="tooltip" data-placement="top" title="Haz click para inactivar este Usuario">Activo</span>
                                {{-- <button class="mr-2 btn btn-success btn-sm ml-1 badgebtn" data-id="{{ $user->id }}" data-toggle="tooltip" data-placement="top" title="Haz click para inactivar esta pregunta">Activa</button> --}}
                            @else
                                <span data-id="{{ $user->id }}" class="badge bg-danger badgebtn" style="cursor: pointer" data-toggle="tooltip" data-placement="top" title="Haz click para activar este Usuario">Inactivo</span>
                                {{-- <button class="mr-2 btn btn-danger btn-sm ml-1 badgebtn" data-id="{{ $user->id }}" data-toggle="tooltip" data-placement="top" title="Haz click para activar esta pregunta">Inactiva</button> --}}
                            @endif
                        </td>
                        <td class="project-actions text-right">
                            <a class="btn btn-info btn-sm" href="{{ route('admin.usuario.edit', [$user->id]) }}"><i class="fas fa-pencil-alt"></i>Editar</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="float-right">{{ $users->links()}}</div>
        </div>
    </div>
@endsection
@push('scripts')
<script>
    $.ajaxSetup({
        headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
    });
    
    $(".badgebtn").on('click', function(){
        id = this.getAttribute('data-id');
        var boton = $(this)
        $.ajax({
            url: "{{ asset('admin/usuarios') }}/" + id,
            type: 'put',
            cache: false,
            beforeSend: function (){

            },
            success: function(data){
                if (boton.hasClass('bg-success')) {
                    boton.removeClass('bg-success').addClass('bg-danger')
                    boton.text('Inactivo')
                    boton.attr('data-original-title', 'Haz click para activar este usuario')
                    
                }
                else if(boton.hasClass('bg-danger')) {
                    boton.removeClass('bg-danger').addClass('bg-success')
                    boton.text('Activo')
                    boton.attr('data-original-title', 'Haz click para inactivar este usuario')
                }
            },
        })
    });

</script>
@endpush