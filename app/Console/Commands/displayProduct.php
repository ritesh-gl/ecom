<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Product;
use Illuminate\Support\Facades\DB;

class displayProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'display:product';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Display all the items at particular time';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
       print_r(Product::get());
        
    }
}
