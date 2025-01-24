<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AttachmentsController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate(['attachment' => ['required', 'file']]);

        $path = $request->file('attachment')->store('attachments', [
            'disk' => 'public',
        ]);

        return [
            'attachment_url' => Storage::disk('public')->url($path),
        ];
    }
}
