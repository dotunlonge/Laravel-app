<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\User;
use Mail;
use Illuminate\Http\Request;

class SendVerificationEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    
    protected $user;
    protected $data;
   
    public function __construct($user, $data)
    {
        $this->user = $user;
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
   public function handle(Request $request)
    {
        $data = $this->data;
        Mail::send('emails.email', $data, function($message) use($data){
            $message->to($data['email']);
            $message->subject('Registration Confirmation');
        });
    // Mail::to($this->user->email)->send($email);
    }
}
