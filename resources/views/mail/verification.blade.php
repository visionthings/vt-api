@vite('resources/css/app.css')

<table dir="rtl" style="width: 100%;   font-family: Cairo, sans-serif;   background-color: #f0f3f8;

" >
    <tr>
        <td>    <img src='https://www11.0zz0.com/2024/02/14/16/275551660.png' alt="header" style="width: 100%" />
    </td>
    </tr>
    <tr>
        <td style="padding-right: 20px; padding-left:20px">
                <p >مرحباً، {{ $user_data['name']}}</p>
                <p >لقد أضفت {{ $user_data['email']}} مؤخراً إلى حسابك على موقع رؤية الأشياء.</p>
                <p >	يرجى تأكيد عنوان البريد الإلكتروني هذا حتى يمكنك الإستفادة من جميع خدماتنا.</p>

                <div style="padding-top:40px">
                    <a href={{$url}} style="cursor:pointer">
                        <button style="border:none; background-color:darkcyan; color:white; padding: 10px 40px; border-radius:7px; cursor:pointer">اضغط هنا لتأكيد البريد الإلكتروني</button>
                    </a>                    
                </div>
                 
                <p style="color:slategray; padding-top:40px">للمساعدة في الحفاظ على أمان حسابك، يرجى عدم إعادة توجيه رسالة البريد الإلكتروني هذه.
                </p>
        </td>
    </tr>
 </table>
 