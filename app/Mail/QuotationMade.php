<?php

namespace App\Mail;

use App\Models\Quotation;
use App\Models\User;
use Dompdf\Dompdf;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class QuotationMade extends Mailable
{
    use Queueable, SerializesModels;

    public $quotation;
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    //Make the quotation variable usable in the mail class
    public function __construct(Quotation $quotation, User $user)
    {
        $this->quotation = $quotation;
        $this->user = $user;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('pdf.quotation_pdf', ['quotation' => $this->quotation, 'user' => $this->user]));

// (Optional) Set up the paper size and orientation
        $dompdf->setPaper('A4');

// Render the HTML as PDF
        $dompdf->render();

// Output the generated PDF to Browser
        //Set attachment to false, so it doesn't try to download the file when displaying it in browser
        $dompdf->stream('quotation.pdf', ['Attachment' => true]);

        return $this->markdown('emails.quotation_made')
            ->attachData($dompdf->output(), "quotation.pdf")
            ->subject('Your quotation');

    }
}
