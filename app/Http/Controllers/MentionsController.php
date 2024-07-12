<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class MentionsController extends Controller
{
    public function __invoke(Request $request)
    {
        return User::query()
            ->when($request->input('search'), fn ($query, $search) => (
                $query->where('name', 'like', "%{$search}%")
            ))
            ->orderBy('name')
            ->take(20)
            ->get()
            ->map(fn (User $user) => [
                'sgid' => $user->richTextSgid(),
                'name' => $user->name,
                'content' => $user->richTextRender(),
                'contentType' => $user->richTextContentType(),
            ]);
    }
}
