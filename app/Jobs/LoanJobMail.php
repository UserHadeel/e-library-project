<?php

namespace App\Jobs;

use App\Mail\LoanMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Loan;
use Carbon\Carbon;
use illuminate\Support\Facades\Mail;
use Log;
class LoanJobMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $loans = Loan::where('is_returned', false)
        ->whereDate('return_date', '>=', Carbon::now()->addDay())->get();

        foreach($loans as $loan) {
            $user = $loan->user;
            Mail::to($user->email)->send(new LoanMail($user));
        }
    }
}
