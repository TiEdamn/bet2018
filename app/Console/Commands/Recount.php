<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class Recount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'recount:score';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $users = User::all();

        $bar = $this->output->createProgressBar(count($users));

        foreach ($users as $user) {

            $score = 0;

            foreach ($user->bets as $bet) {
                if($bet->match->home_score != null && $bet->match->visitor_score != null) {
                    if($bet->home == $bet->match->home_score && $bet->visitor == $bet->match->visitor_score)
                        $score+=3;
                    else if(($bet->home == $bet->visitor && $bet->match->home_score == $bet->match->visitor_score) || ($bet->home > $bet->visitor && $bet->match->home_score > $bet->match->visitor_score) || ($bet->home < $bet->visitor && $bet->match->home_score < $bet->match->visitor_score))
                        $score+=1;
                    else
                        $score+=0;
                }
            }

            $user->update(['score' => $score]);

            $bar->advance();
        }

        $bar->finish();
    }
}
