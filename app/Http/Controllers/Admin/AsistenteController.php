<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserFormRequest;
use App\Http\Requests\UserCreateFormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\Config;
use PDF;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserMail;

class AsistenteController extends Controller
{
    public function users(Request $request)
    {
        if ($request)
        {
            $queryUser=$request->input('fuser');
            $users = DB::table('users')
            ->where('estado', '=', 1)
            ->where('role_as', '=', 1)
            ->where(function ($query) use ($queryUser) {
            $query->where('name', 'LIKE', '%' . $queryUser . '%')
                ->orWhere('email', 'LIKE', '%' . $queryUser . '%')
                ->orWhere('telefono', 'LIKE', '%' . $queryUser . '%')
                ->orWhere('celular', 'LIKE', '%' . $queryUser . '%');
            })
            ->orderBy('name','asc')
            ->paginate(20);
            $filterUsers = User::all();
            return view('admin.asistente.index', compact('users','queryUser','filterUsers'));
        }
    }

    public function showuser($id)
    {
        $user = User::find($id);
        return view('admin.asistente.show', compact('user'));
    }

    public function adduser()
    {
        return view('admin.asistente.add');
    }

    public function insertuser(UserCreateFormRequest $request)
    {
        $user = new User();
        $fecha_nacimiento = $request->get('fecha_nacimiento');
        $fecha_nacimiento = date("Y-m-d", strtotime($fecha_nacimiento));
        if($request->hasFile('fotografia'))
        {
            $file = $request->file('fotografia');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('assets/imgs/users',$filename);
            $user->fotografia = $filename;
        }
        $user->role_as = 1;
        $user->estado = 1;
        $user->principal = 0;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = 'Flebo'.rand(1111,9999);
        $user->telefono = $request->input('telefono');
        $user->celular = $request->input('celular');
        // $user->especialidad_id = $request->input('especialidad');
        $user->direccion = $request->input('direccion');
        $user->descripcion = $request->input('descripcion');
        $user->fecha_nacimiento = $fecha_nacimiento;
        $user->save();

        // Mail::to($user->email)->send(new UserMail($user));

        return redirect('asistentes')->with('status', __('Asistente agregado exitosamente.'));
    }

    public function edituser($id)
    {
        $user = User::find($id);
        return view('admin.asistente.edit', \compact('user'));
    }

    public function updateuser(UserFormRequest $request, $id)
    {
        $user = User::find($id);
        $emailrepeat = User::where('id', '<>', $id)->where('email', $request->input('email'))->count();
        $fecha_nacimiento = $request->get('fecha_nacimiento');
        $fecha_nacimiento = date("Y-m-d", strtotime($fecha_nacimiento));
        if($request->hasFile('fotografia'))
        {
            $path = 'assets/imgs/users/'.$user->image;
            if(File::exists($path))
            {
                File::delete($path);
            }
            $file = $request->file('fotografia');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('assets/imgs/users',$filename);
            $user->fotografia = $filename;
        }
        $user->name = $request->input('name');
        if ($emailrepeat == "0") {
            $user->email = $request->input('email');
        }
        // $user->password = 'Flebo'.rand(1111,9999);
        $user->telefono = $request->input('telefono');
        $user->celular = $request->input('celular');
        // $user->especialidad_id = $request->input('especialidad');
        $user->direccion = $request->input('direccion');
        $user->descripcion = $request->input('descripcion');
        $user->fecha_nacimiento = $fecha_nacimiento;
        $user->update();

        if ($emailrepeat >= "1") {
            return redirect('show-asistente/'.$id)->with('status',__('Asistente actualizado, email no se pudo editar ya que otro usuario ya lo esta usando.'));
        }
        return redirect('show-asistente/'.$id)->with('status',__('Asistente  actualizado correctamente!'));

    }

    public function destroyuser($id)
    {
        $user = User::find($id);
        if ($user->fotografia)
        {
            $path = 'assets/img/users/'.$user->fotografia;
            if (File::exists($path))
            {
                File::delete($path);

            }
        }
        $user->estado = 0;
        $user->email = $user->email.'-Deleted'.$user->id;
        $user->update();
        return redirect('asistentes')->with('status',__('Asistente  eliminado correctamente!'));
    }

    public function pdf(Request $request)
    {
        if ($request)
        {

            $asistentes = User::where('estado',1)->orderBy('name','asc')->get();
            $verpdf = "Browser";
            $nompdf = date('Y-m-d_H-i-s');
            $path = public_path('assets/imgs/');

            $config = Config::first();

            $currency = $config->currency_simbol;

            if ($config->logo == null)
            {
                $logo = null;
                $imagen = null;
            }
            else
            {
                    $logo = $config->logo;
                    $imagen = public_path('assets/imgs/logos/'.$logo);
            }


            $config = Config::first();

            if ( $verpdf == "Download" )
            {
                $pdf = PDF::loadView('admin.asistente.pdf',['asistentes'=>$asistentes,'path'=>$path,'config'=>$config,'imagen'=>$imagen,'currency'=>$currency]);

                return $pdf->download ('Listado Asistentes '.$nompdf.'.pdf');
            }
            if ( $verpdf == "Browser" )
            {
                $pdf = PDF::loadView('admin.asistente.pdf',['asistentes'=>$asistentes,'path'=>$path,'config'=>$config,'imagen'=>$imagen,'currency'=>$currency]);

                return $pdf->stream ('Listado Asistentes '.$nompdf.'.pdf');
            }
        }
    }

    public function pdfasistente($id)
    {

        $asistente = User::find($id);
        $verpdf = "Browser";
        $nompdf = date('Y-m-d_H-i-s');
        $path = public_path('assets/imgs/');
        $pathasistente = public_path('assets/imgs/users/');

        $config = Config::first();

        $currency = $config->currency_simbol;

        if ($config->logo == null)
        {
            $logo = null;
            $imagen = null;
        }
        else
        {
                $logo = $config->logo;
                $imagen = public_path('assets/imgs/logos/'.$logo);
        }


        $config = Config::first();

        if ( $verpdf == "Download" )
        {
            $pdf = PDF::loadView('admin.asistente.pdfasistente',['asistente'=>$asistente,'path'=>$path,'config'=>$config,'imagen'=>$imagen,'currency'=>$currency,'pathasistente'=>$pathasistente]);

            return $pdf->download ('Asistente: '.$asistente->name.'-'.$nompdf.'.pdf');
        }
        if ( $verpdf == "Browser" )
        {
            $pdf = PDF::loadView('admin.asistente.pdfasistente',['asistente'=>$asistente,'path'=>$path,'config'=>$config,'imagen'=>$imagen,'currency'=>$currency,'pathasistente'=>$pathasistente]);

            return $pdf->stream ('Asistente: '.$asistente->name.'-'.$nompdf.'.pdf');
        }
    }
}
