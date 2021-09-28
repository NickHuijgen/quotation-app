<?php

namespace App\Http\Controllers;

use App\Jobs\SendPdfMail;
use App\Mail\QuotationMade;
use App\Models\Quotation;
use App\Models\User;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class PdfController extends Controller
{
    public function makepdf(Quotation $quotation, User $user)
    {

//// instantiate and use the dompdf class
//        $dompdf = new Dompdf();
//        $dompdf->loadHtml(view('pdf.quotation_pdf', ['quotation' => $quotation, 'user' => $user]));
//
//// (Optional) Setup the paper size and orientation
//        $dompdf->setPaper('A4', 'portrait');
//
//// Render the HTML as PDF
//        $dompdf->render();
//
//// Output the generated PDF to Browser
//        //Set attachment to false so it doesn't try to download the file when displaying it in browser
//        $dompdf->stream('quotation.pdf', ['Attachment' => false]);

//        Storage::put('public/pdf/quotation.pdf', $dompdf->output());
//
//        SendPdfMail::dispatch($quotation);

        //Define the new message and add a $quotation
//        $message = new QuotationMade($quotation, $user);

        //Attach the newly created pdf to the $message and name it 'quotation.pdf'
//        $message->attachData($dompdf->output(), "quotation.pdf");

        //Send a mail to a user with the $message attached
        Mail::to($quotation->customer_email)->queue(new QuotationMade($quotation, $user));
    }
}
