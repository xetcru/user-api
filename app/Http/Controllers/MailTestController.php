<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;

class MailTestController extends Controller
{
    public function sendTestMail()
    {
        Mail::to('your-email@example.com')->send(new TestMail());
        return 'Test email sent.';
    }
}
