<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocaleUpdateRequest;
use Illuminate\Http\RedirectResponse;

class LocaleController extends Controller
{
    /**
     * Updates the locale.
     */
    public function update(LocaleUpdateRequest $request): RedirectResponse
    {
        $locale = $request->validated('locale');

        if (in_array($locale, config('app.available_locales'))) {
            session()->put('locale', $locale);
        }

        return redirect()->back();
    }
}
