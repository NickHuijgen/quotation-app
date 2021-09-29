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
//        $dompdf->stream('quotation.pdf', ['Attachment' => true]);

        //Make an email with the emails.quotation_made view file
        return $this->markdown('emails.quotation_made')
            //Attach the generated pdf to the email and name it 'quotation.pdf'
            ->attachData($dompdf->output(), "quotation.pdf")
            //Set the subject of the mail to 'Your quotation'
            ->subject('Your quotation');

    }
}
