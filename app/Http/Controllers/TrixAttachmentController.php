<?php

namespace App\Http\Controllers;

use App\Service\TrixAttachmentService;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrixAttachmentController extends Controller
{
    /**
     * Upload a Trix attachment.
     *
     * @throws AuthenticationException
     */
    public function store(Request $request, TrixAttachmentService $service): array
    {
        // TODO make policy
        Auth::authenticate();

        $request->validate(['file' => ['required', 'file', 'max:10240']]);
        $url = $service->store($request->file('file'));

        return [
            'url' => $url,
            'href' => $url,
        ];
    }
}
