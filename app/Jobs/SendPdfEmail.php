<?php

namespace App\Jobs;

use App\Mail\QuotationMade;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Quotation;
use Illuminate\Support\Facades\Mail;

class SendPdfEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Quotation $quotation, $dompdf)
    {
        $this->quotation = $quotation;
        $this->dompdf = $dompdf;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $message = new QuotationMade($this->quotation);

        $message->attachData($this->dompdf->output(), "quotation.pdf");

        Mail::to($this->quotation->customer_email)->send($message);
    }
}
