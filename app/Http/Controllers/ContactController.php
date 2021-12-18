<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\ContactForm;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    public function AdminContact()
    {
        $contacts = Contact::latest()->paginate(5);
        return view('admin.contact.index', compact('contacts'));
    }

    public function AdminAddContact()
    {
        return view('admin.contact.create');
    }

    public function AdminStoreContact(Request $request)
    {
        // ~Validate the request...
        $validatedData = $request->validate(
            [
                'address' => 'required|unique:contacts|min:4',
                'email' => 'required|unique:contacts|min:4',
                'phone' => 'required|unique:contacts|min:4',
            ],
            // ~Custom Error messages
            [
                'address.required' => 'Please input contact address',
                'email.required' => 'Please input contact email',
                'phone.required' => 'Please input contact phone',
            ]
        );

        // ~Inserting data to db
        Contact::insert([
            'address' => $request->address,
            'email' => $request->email,
            'phone' => $request->phone,
            'created_at' => Carbon::now()
        ]);

        return redirect()->route('admin.contact')->with('success', 'Contact Inserted Successfully');
    }

    public function AdminEditContact($id)
    {
        $contacts = Contact::find($id); // ~Eloquent method
        return view('admin.contact.edit', compact('contacts'));
    }

    public function AdminUpdateContact(Request $request, $id)
    {
        // ~Validate the request...
        $validatedData = $request->validate(
            [
                'address' => 'required|min:4',
                'email' => 'required|min:4',
                'phone' => 'required|min:4',
            ],
            // ~Custom Error messages
            [
                'address.required' => 'Please input contact address',
                'email.required' => 'Please input contact email',
                'phone.required' => 'Please input contact phone',
            ]
        );

        Contact::find($id)->update([
            'address' => $request->address,
            'email' => $request->email,
            'phone' => $request->phone,
            'created_at' => Carbon::now()
        ]);

        return redirect()->route('admin.contact')->with('success', 'Contact Updated Successfully');
    }

    public function Delete($id)
    {
        Contact::find($id)->delete();
        return redirect()->back()->with('success', 'Contact Deleted Successfully');
    }

    //========= ADMIN CONTACT MESSAGE =========//

    public function AdminMessage()
    {
        $contact_forms = ContactForm::latest()->paginate(5);
        return view('admin.contact.message', compact('contact_forms'));
    }

    public function DeleteMessage($id)
    {
        ContactForm::find($id)->delete();
        return redirect()->back()->with('success', 'Contact Message Deleted Successfully');
    }

    //========= HOME CONTACT FORM =========//

    public function Contact()
    {
        $contact = Contact::first();
        // $contact = DB::table('contacts')->first(); // ~Query Builder
        return view('pages.contact', compact('contact'));
    }

    // Home Contact Form
    public function StoreContactForm(Request $request)
    {
        // ~Validate the request...
        $validatedData = $request->validate(
            [
                'name' => 'required|min:4',
                'email' => 'required|min:4',
                'subject' => 'required|min:4',
                'message' => 'required|min:4',
            ],
            // ~Custom Error messages
            [
                'name.required' => 'Please input contact name',
                'email.required' => 'Please input contact email',
                'subject.required' => 'Please input contact subject',
                'message.required' => 'Please input contact message',
            ]
        );

        ContactForm::insert([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'created_at' => Carbon::now()
        ]);

        return redirect()->route('contact')->with('success', 'Contact Details Sent Successfully');
    }
}
