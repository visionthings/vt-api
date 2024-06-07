<?php

namespace App\Http\Controllers;

use App\Mail\AdminMail;
use App\Models\AdminMail as ModelsAdminMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail as FacadesMail;

class AdminMailController extends Controller
{
    //  Send Email
    public function send_mail(Request $request)
    {
        $user = auth()->user();
        if ($user->hasRole('super_admin')) {
            $subject = $request->subject;
            $message = $request->message;
            FacadesMail::to($request->to)->send(new AdminMail($subject, $message));
            ModelsAdminMail::create(['to' => $request->to, 'subject' => $request->subject, 'message' => $request->message]);
            return response()->json(['message' => 'تم الإرسال بنجاح.'], 201);
        } else if (!$user->hasRole('super_admin')) {
            return response()->json(['message' => 'ليس لديك الصلاحية لإرسال بريد إلكتروني.'], 400);
        } else {
            return response()->json(['message' => 'تعذر الإرسال في الوقت الحالي، يرجى المحاولة مرة أخرى.'], 400);
        }
    }

    // Outbox
    public function outbox()
    {
        $user = auth()->user();
        if ($user->hasRole('super_admin')) {
            return ModelsAdminMail::latest()->paginate(10);
        }
    }

    // Delete Email
    public function delete(string $id)
    {
        $user = auth()->user();
        if ($user->hasRole('super_admin')) {
            ModelsAdminMail::destroy($id);
            return response()->json(['message' => 'تم حذف الرسالة بنجاح.'], 200);
        }
    }
}
