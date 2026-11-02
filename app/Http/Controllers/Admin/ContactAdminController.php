<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ContactAdminController extends Controller
{
    public function index(): View
    {
        return view('admin.contacts.index', [
            'messages' => ContactMessage::latest()->paginate(10),
        ]);
    }

    public function show(ContactMessage $contact): View
    {
        if (! $contact->is_read) {
            $contact->update(['is_read' => true]);
        }

        return view('admin.contacts.show', ['message' => $contact]);
    }

    public function destroy(ContactMessage $contact): RedirectResponse
    {
        $contact->delete();

        return redirect()
            ->route('admin.contacts.index')
            ->with('success', __('ui.admin.deleted'));
    }
}
