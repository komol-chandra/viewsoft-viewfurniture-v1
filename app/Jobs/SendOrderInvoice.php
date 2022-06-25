<?php

namespace App\Jobs;

use App\Models\Order;
use App\Mail\OrderInvoice;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Devfaysal\BangladeshGeocode\Models\District;
use Devfaysal\BangladeshGeocode\Models\Division;

class SendOrderInvoice implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    protected $email;
    protected $orderId;


    public function __construct($email,  $orderId)
    {
        $this->email = $email;
        $this->orderId = $orderId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = $this->email;
        $orderId = $this->orderId;
        $data = Order::where('order_id', $orderId)->first();
        $division = Division::where('id', $data->shipping_division)->get();
        $district = District::where('id', $data->shipping_city)->get();

        Mail::to($email)->send(new OrderInvoice($data, $division, $district));
    }
}
