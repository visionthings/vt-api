<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Mail\AdminMail;
use App\Mail\ResetPasswordMail;
use App\Mail\VerificationMail;
use App\Models\ContactEmail;
use App\Models\PasswordResetToken;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail as FacadesMail;

use function Laravel\Prompts\error;

class AuthController extends Controller
{
    //
    public function register(AuthRequest $request)
    {

        $user = User::create($request->all());

        $token = $user->createToken('register_token')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        $admin_mail = ContactEmail::latest()->first();
        $subject = 'تم إنشاء حساب جديد على المنصة';
        $message = `تم إنشاء حساب جديد على منصة VT باسم {{$user->name}} ورقم جوال {{$user->phone}}`;
        FacadesMail::to($admin_mail->email)->send(new AdminMail($subject, $message));

        return response()->json($response, 201);
    }

    public function logout(Request $request)
    {
        $user = Auth::user();
        $user->tokens()->delete();
        return ['message' => 'logged out'];
    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        // Check email
        $user = User::where('email', $fields['email'])->with('roles')->first();

        // Check password
        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'البريد الإلكتروني / كلمة المرور غير صحيحة.'
            ], 401);
        }

        if ($user->membership_status == 'blocked') {
            return response(['message' => 'تم إيقاف عضويتك عن طريق إدارة منصة VT.'], 401);
        }

        $token = $user->createToken('login_token')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token,
        ];

        return response($response, 201);
    }
    public function send_verification_email()
    {
        $user = auth()->user();
        $token = substr(sha1(mt_rand()), 17, 6);
        $user->email_verification_token = $token;
        $user->save();
        $url = 'https://vt.com.sa/email-verified?id=' . $user->id . '&token=' . $token;
        FacadesMail::to($user->email)->send(new VerificationMail($user, $url));
        return response(['message' => 'success', 'email' => $user->email], 201);
    }

    public function verify_email(string $id, string $token)
    {
        $user = User::find($id);
        if ($user->email_verification_token == $token) {
            $user->email_verified_at = now();
            $user->stage = '2';
            $user->save();
            return response()->json('success', 200);
        } else {
            return response()->json('failed', 404);
        }
    }

    public function reset_password(Request $request)
    {
        $email = User::where('email', $request->email)->first();

        if (!$email) {
            return response()->json(['message' => __('auth.email_not_found')], 404);
        } else {
            PasswordResetToken::where('email', $request->email)->delete();
            $code = substr(sha1(mt_rand()), 17, 6);
            PasswordResetToken::create(['email' => $request->email, 'token' => $code, 'created_at' => now()]);
            FacadesMail::to($request->email)->send(new ResetPasswordMail($code));
            return response()->json(['message' => 'Email has been sent successfully!'], 200);
        }
    }

    public function create_new_password(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        $token = $request->token;

        $isFound = PasswordResetToken::where([['email', '=', $email], ['token', '=', $token]])->first();

        if ($isFound) {
            $isFound->where('email', $email)->delete();
            $user = User::where('email', $email)->first();
            $user->update(['password' => Hash::make($password)]);
            return response()->json('Success!', 201);
        } else {
            return response()->json('Token is incorrect!', 404);
        }
    }
}
