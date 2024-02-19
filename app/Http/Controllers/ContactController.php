<?php

namespace App\Http\Controllers;
use App\Models\Contact;
use Illuminate\Http\Request;
// Importa la clase Mailable
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function showform(){
        return view('contact.form');
    }



    public function submitform(Request  $request){

    // Valida los datos del formulario
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone_number' => 'required|string|max:255',
        'affair' => 'required|string|max:255',
        'message' => 'required|string',
    ]);

    // Crea un nuevo mensaje en la base de datos
    Contact::create($request->all());

    //luego hare la logica para que envie al correo electronico tambien.
       // Envía el correo electrónico
       \Mail::to('colvenjh@gmail.com')->send(new ContactFormMail($request->all()));

    return redirect()->route('contact.success')->with('success', 'Message sent successfully!');
    }




public function successview(){
    return view('contact.success');
}


public function index()
{
    $messages = Contact::latest()->get();
    return view('contact.index', compact('messages'));
}



public function show(string $id){
    $messagedetail = Contact::findOrFail($id);
    return view ('contact.show' ,['messagedetail' => $messagedetail]);

}
}




