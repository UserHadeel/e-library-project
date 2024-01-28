<?php

namespace App\Console\Commands;

use App\Jobs\LoanJobMail;
use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\Loan;
use Mail;
use App\Mail\LoanMail;

class LoanMailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'the-loan-mail-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $loans = Loan::where('is_returned', false)
        ->whereDate('return_date', '>=', Carbon::now()->addDay())->get();

        foreach($loans as $loan) {
            $user = $loan->user;
            Mail::to($user->email)->send(new LoanMail($user));
        }
    }
}
