<?php

namespace App\Http\Controllers;

use App\Models\Email;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail as FacadesMail;
use App\Mail\VerificationMail;


class EmailController extends Controller
{
    public function verification_mail(Request $request)
    {
        $user_data = $request->all();
        $url = 'http://localhost:4200/email-verified/' . $user_data['id'];
        FacadesMail::to($user_data['email'])->send(new VerificationMail($user_data, $url));
        return response(['message' => 'success', 'email' => $user_data['email']], 201);
    }
}
