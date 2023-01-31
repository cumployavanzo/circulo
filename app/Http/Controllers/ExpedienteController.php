<?php

namespace App\Http\Controllers;
use App\Expediente;
use Intervention\Image\Facades\Image;
use File;
use Storage;



use Illuminate\Http\Request;

class ExpedienteController extends Controller
{
    //

    public function subirExpedientes(){
        $detalleNomina = Expediente::where('clientes_id', $request->input('idCliente'))->first(); 

        return view('admin.prospectos.upExpediente');
    }

    public function upExp(Request $request)
    {
        $archivos = new Expediente();
        if($files = $request->file('ine_anverso')) {
            $año = date('Y');
            $mes = date('m');
            // $path = public_path('img/users/'.$año.'/'.$mes.'/'.$request->input('idCliente'));

            $path = public_path('img/users/'.$año.'/'.$mes.'/ClienteID'.$request->input('idCliente'));

            if(!File::isDirectory($path)){
                File::makeDirectory($path, 0777, true, true);

            } 

            $file = $request->file('ine_anverso');
            $extension = $file->getClientOriginalExtension();
            $profilefile = 'ine_anverso'.$request->input('idCliente'). '.' . $extension;
        
            $files->move($path, $profilefile);
            $insert['ine_anverso'] = 'ine_anverso'.$request->input('idCliente'). '.' . $extension;
            $detalleCliente = Expediente::where('clientes_id', $request->input('idCliente'))->first(); 

            if (!empty($detalleCliente))
            {
                if(!empty($detalleCliente->ine_anverso)){
                    unlink($detalleCliente->ine_anverso);
                }
                
                 Expediente::where('clientes_id', $detalleCliente->clientes_id)->update([
                    'ine_anverso' => 'img/users/'.$año.'/'.$mes.'/ClienteID'.$request->input('idCliente').'/ine_anverso'.$request->input('idCliente'). '.' . $extension,
                ]);
                return ['success'];
            }else{
                $archivos->ine_anverso = 'img/users/'.$año.'/'.$mes.'/ClienteID'.$request->input('idCliente').'/ine_anverso'.$request->input('idCliente'). '.' . $extension;
                $archivos->clientes_id = $request->input('idCliente');
                $archivos -> save();
                $saved = $archivos -> save();
                $data['success'] = $saved;
                return $data;
            } 
        }  

        if($files = $request->file('ine_reverso')) {
            $año = date('Y');
            $mes = date('m');
            $path = public_path('img/users/'.$año.'/'.$mes.'/ClienteID'.$request->input('idCliente'));
            
            if(!File::isDirectory($path)){
                File::makeDirectory($path, 0777, true, true);

            } 

            $file = $request->file('ine_reverso');
            $extension = $file->getClientOriginalExtension();
            $profilefile = 'ine_reverso'.$request->input('idCliente'). '.' . $extension;
        
            $files->move($path, $profilefile);
            $insert['ine_reverso'] = 'ine_reverso'.$request->input('idCliente'). '.' . $extension;
            $detalleCliente = Expediente::where('clientes_id', $request->input('idCliente'))->first(); 

            if (!empty($detalleCliente))
            {
                if(!empty($detalleCliente->ine_reverso)){
                    unlink($detalleCliente->ine_reverso);
                }
                
                 Expediente::where('clientes_id', $detalleCliente->clientes_id)->update([
                    'ine_reverso' => 'img/users/'.$año.'/'.$mes.'/ClienteID'.$request->input('idCliente').'/ine_anverso'.$request->input('idCliente'). '.' . $extension,
                ]);
                return ['success'];
            }else{
                $archivos->ine_reverso = 'img/users/'.$año.'/'.$mes.'/ClienteID'.$request->input('idCliente').'/ine_anverso'.$request->input('idCliente'). '.' . $extension;
                $archivos->clientes_id = $request->input('idCliente');
                $archivos -> save();
                $saved = $archivos -> save();
                $data['success'] = $saved;
                return $data;
            } 
        }  

        if($files = $request->file('foto_ine')) {
            $año = date('Y');
            $mes = date('m');
            $path = public_path('img/users/'.$año.'/'.$mes.'/ClienteID'.$request->input('idCliente'));
            
            if(!File::isDirectory($path)){
                File::makeDirectory($path, 0777, true, true);

            } 

            $file = $request->file('foto_ine');
            $extension = $file->getClientOriginalExtension();
            $profilefile = 'foto_ine'.$request->input('idCliente'). '.' . $extension;
        
            $files->move($path, $profilefile);
            $insert['foto_conIne'] = 'foto_ine'.$request->input('idCliente'). '.' . $extension;
            $detalleCliente = Expediente::where('clientes_id', $request->input('idCliente'))->first(); 

            if (!empty($detalleCliente))
            {
                if(!empty($detalleCliente->foto_conIne)){
                    unlink($detalleCliente->foto_conIne);
                }
                
                 Expediente::where('clientes_id', $detalleCliente->clientes_id)->update([
                    'foto_conIne' => 'img/users/'.$año.'/'.$mes.'/ClienteID'.$request->input('idCliente').'/foto_ine'.$request->input('idCliente'). '.' . $extension,
                ]);
                return ['success'];
            }else{
                $archivos->foto_conIne = 'img/users/'.$año.'/'.$mes.'/ClienteID'.$request->input('idCliente').'/foto_ine'.$request->input('idCliente'). '.' . $extension;
                $archivos->clientes_id = $request->input('idCliente');
                $archivos -> save();
                $saved = $archivos -> save();
                $data['success'] = $saved;
                return $data;
            } 
        }  

        if($files = $request->file('curp')) {
            $año = date('Y');
            $mes = date('m');
            $path = public_path('img/users/'.$año.'/'.$mes.'/ClienteID'.$request->input('idCliente'));
            
            if(!File::isDirectory($path)){
                File::makeDirectory($path, 0777, true, true);

            } 

            $file = $request->file('curp');
            $extension = $file->getClientOriginalExtension();
            $profilefile = 'curp'.$request->input('idCliente'). '.' . $extension;
        
            $files->move($path, $profilefile);
            $insert['curp'] = 'curp'.$request->input('idCliente'). '.' . $extension;
            $detalleCliente = Expediente::where('clientes_id', $request->input('idCliente'))->first(); 

            if (!empty($detalleCliente))
            {
                if(!empty($detalleCliente->curp)){
                    unlink($detalleCliente->curp);
                }
                
                 Expediente::where('clientes_id', $detalleCliente->clientes_id)->update([
                    'curp' => 'img/users/'.$año.'/'.$mes.'/ClienteID'.$request->input('idCliente').'/curp'.$request->input('idCliente'). '.' . $extension,
                ]);
                return ['success'];
            }else{
                $archivos->curp = 'img/users/'.$año.'/'.$mes.'/ClienteID'.$request->input('idCliente').'/curp'.$request->input('idCliente'). '.' . $extension;
                $archivos->clientes_id = $request->input('idCliente');
                $archivos -> save();
                $saved = $archivos -> save();
                $data['success'] = $saved;
                return $data;
            } 
        }  

        if($files = $request->file('comprobante_domicilio')) {
            $año = date('Y');
            $mes = date('m');
            $path = public_path('img/users/'.$año.'/'.$mes.'/ClienteID'.$request->input('idCliente'));
            
            if(!File::isDirectory($path)){
                File::makeDirectory($path, 0777, true, true);

            } 

            $file = $request->file('comprobante_domicilio');
            $extension = $file->getClientOriginalExtension();
            $profilefile = 'recibo_luz'.$request->input('idCliente'). '.' . $extension;
        
            $files->move($path, $profilefile);
            $insert['comprobante_domici'] = 'recibo_luz'.$request->input('idCliente'). '.' . $extension;
            $detalleCliente = Expediente::where('clientes_id', $request->input('idCliente'))->first(); 

            if (!empty($detalleCliente))
            {
                if(!empty($detalleCliente->comprobante_domici)){
                    unlink($detalleCliente->comprobante_domici);
                }
                
                 Expediente::where('clientes_id', $detalleCliente->clientes_id)->update([
                    'comprobante_domici' => 'img/users/'.$año.'/'.$mes.'/ClienteID'.$request->input('idCliente').'/recibo_luz'.$request->input('idCliente'). '.' . $extension,
                ]);
                return ['success'];
            }else{
                $archivos->comprobante_domici = 'img/users/'.$año.'/'.$mes.'/ClienteID'.$request->input('idCliente').'/recibo_luz'.$request->input('idCliente'). '.' . $extension;
                $archivos->clientes_id = $request->input('idCliente');
                $archivos -> save();
                $saved = $archivos -> save();
                $data['success'] = $saved;
                return $data;
            } 
        } 

        if($files = $request->file('comprobante_ingresos')) {
            $año = date('Y');
            $mes = date('m');
            $path = public_path('img/users/'.$año.'/'.$mes.'/ClienteID'.$request->input('idCliente'));
            
            if(!File::isDirectory($path)){
                File::makeDirectory($path, 0777, true, true);

            } 

            $file = $request->file('comprobante_ingresos');
            $extension = $file->getClientOriginalExtension();
            $profilefile = 'ingresos'.$request->input('idCliente'). '.' . $extension;
        
            $files->move($path, $profilefile);
            $insert['comprobante_ingresos'] = 'ingresos'.$request->input('idCliente'). '.' . $extension;
            $detalleCliente = Expediente::where('clientes_id', $request->input('idCliente'))->first(); 

            if (!empty($detalleCliente))
            {
                if(!empty($detalleCliente->comprobante_ingresos)){
                    unlink($detalleCliente->comprobante_ingresos);
                }
                
                 Expediente::where('clientes_id', $detalleCliente->clientes_id)->update([
                    'comprobante_ingresos' => 'img/users/'.$año.'/'.$mes.'/ClienteID'.$request->input('idCliente').'/ingresos'.$request->input('idCliente'). '.' . $extension,
                ]);
                return ['success'];
            }else{
                $archivos->comprobante_ingresos = 'img/users/'.$año.'/'.$mes.'/ClienteID'.$request->input('idCliente').'/ingresos'.$request->input('idCliente'). '.' . $extension;
                $archivos->clientes_id = $request->input('idCliente');
                $archivos -> save();
                $saved = $archivos -> save();
                $data['success'] = $saved;
                return $data;
            } 
        }  
        
        if($files = $request->file('estado_cuenta')) {
            $año = date('Y');
            $mes = date('m');
            $path = public_path('img/users/'.$año.'/'.$mes.'/ClienteID'.$request->input('idCliente'));
            
            if(!File::isDirectory($path)){
                File::makeDirectory($path, 0777, true, true);

            } 

            $file = $request->file('estado_cuenta');
            $extension = $file->getClientOriginalExtension();
            $profilefile = 'cuenta'.$request->input('idCliente'). '.' . $extension;
        
            $files->move($path, $profilefile);
            $insert['estado_cuenta'] = 'cuenta'.$request->input('idCliente'). '.' . $extension;
            $detalleCliente = Expediente::where('clientes_id', $request->input('idCliente'))->first(); 

            if (!empty($detalleCliente))
            {
                if(!empty($detalleCliente->estado_cuenta)){
                    unlink($detalleCliente->estado_cuenta);
                }
                
                 Expediente::where('clientes_id', $detalleCliente->clientes_id)->update([
                    'estado_cuenta' => 'img/users/'.$año.'/'.$mes.'/ClienteID'.$request->input('idCliente').'/cuenta'.$request->input('idCliente'). '.' . $extension,
                ]);
                return ['success'];
            }else{
                $archivos->estado_cuenta = 'img/users/'.$año.'/'.$mes.'/ClienteID'.$request->input('idCliente').'/cuenta'.$request->input('idCliente'). '.' . $extension;
                $archivos->clientes_id = $request->input('idCliente');
                $archivos -> save();
                $saved = $archivos -> save();
                $data['success'] = $saved;
                return $data;
            } 
        }  
    }
}

