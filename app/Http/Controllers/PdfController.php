<?php

namespace App\Http\Controllers;

use App\Mail\QuotationMade;
use App\Models\Quotation;
use App\Models\User;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PdfController extends Controller
{
    public function makepdf(Quotation $quotation, User $user)
    {

// instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('pdf.quotation_pdf', ['quotation' => $quotation, 'user' => $user]));

// (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
        $dompdf->render();

// Output the generated PDF to Browser
        $dompdf->stream('quotation.pdf', ['Attachment' => false]);

        $message = new QuotationMade($quotation);
        $message->attachData($dompdf->output(), "quotation.pdf");
        Mail::to('test@test.com')->send($message);
//        Mail::to('test@test.com')->send(new QuotationMade($quotation));
    }
}
